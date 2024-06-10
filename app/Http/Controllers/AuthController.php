<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Mail\VerifyEmail;
use Illuminate\Mail\Mailable;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;


class AuthController extends Controller
{
    protected $redirectTo = RouteServiceProvider::HOME;
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'domaine' => 'required|string|max:255',
            'poste' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:5|max:255',
        ]);
        if('sucess'){
        $user = User::create([
            'nom' => $validatedData['nom'],
            'prenom' => $validatedData['prenom'],
            'domaine' => $validatedData['domaine'],
            'poste' => $validatedData['poste'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        return redirect('/home')->with('success', 'Votre compte a été créé avec succès. Veuillez vous connecter.');
    }
    return back()->with('error','Les données saisies ne sont pas valides(Tous les champs sont obligatoires, l\'email doit être de bon type et le mot de passe composé d\'une combinaison d\'au moins 8 caractères avec une majuscule,une miniscule des lettres et des chiffres.). Réessayez',);

    }

    private function sendVerificationEmail($user)
    {
        $verificationUrl = route('verification.verify', ['id' => $user->id, 'hash' => sha1($user->email)]);
        
        Mail::to($user->email)->send(new VerifyEmail($verificationUrl));
    }

    
public function registerAdmin(Request $request)
{
    $validatedData = $request->validate([
        'nom' => 'required|string|max:255|min:2',
        'prenom' => 'required|string|max:255|min:2',
        'domaine' => 'required|string|max:255|min:2',
        'poste' => 'required|string|max:255|min:2',
        'email' => 'required|string|email|unique:users|max:255|min:5',
        'role' => 'string|default:admin',
        'password' => [
            'required',
            'string',
            'min:8',
            'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
        ],
        
    ]);

    // Créer un nouvel utilisateur avec le rôle d'administrateur
    try{
        $user = User::create($validatedData);
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify', now()->addMinutes(30), ['id' => $user->id]
        );
        Mail::to($user->email)->send(new VerifyEmail($verificationUrl));
        return redirect('/register')->with('success', 'Inscription réussie! Un email a été envoyé sur ' .$user->email.  ' consulter le pour verifier votre email.');
    }catch(QueryException $e){
        return back()->with('error','Les données saisies ne sont pas valides');

    }

    
  
}


public function verify(Request $request, $id)
{
    $user = User::findOrFail($id);

    if (!$request->hasValidSignature() || $user->email_verified_at !== null) {
        abort(404) ;
    }

    $user->update([$user->email_verified_at = now()]);

    return view('emails.emailVerificationSucces')->with('success', 'Votre adresse e-mail a été vérifiée avec succès.');
}


    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $user = User::where('email',$request->email)->first();
        if ( $user->email_verified_at !== null && Auth::attempt($credentials) ) {
            
            // Authentification réussie
            $request->session()->regenerate();
    
            // Ajouter l'ID de l'utilisateur à la liste des utilisateurs connectés
            $sessionKeyName = 'user_id';
            $connectedUserIds = Session::get($sessionKeyName, []);
            $connectedUserIds[] = Auth::user()->id;
            Session::put($sessionKeyName, $connectedUserIds);
    
            return redirect()->intended('/home')->with('success', 'Connexion réussie !');
        }else if($user->email_verified_at == null ){
            return back()->with(
                'error','Email non vérifié veuillez consulter votre boite email pour le verifier.',
            );
        }
        // Authentification échouée
    return back()->with(
        'error','Informations de connexion incorrect',
    );
    }



    public function logout(Request $request)
    {
        // Retirer l'ID de l'utilisateur de la liste des utilisateurs connectés
    $sessionKeyName = 'user_id';
    $connectedUserIds = Session::get($sessionKeyName, []);
    $connectedUserIds = array_diff($connectedUserIds, [Auth::user()->id]);
    Session::put($sessionKeyName, $connectedUserIds);

    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
        
        return redirect('/')->with('success', 'Déconnexion réussie! Veuillez vous connecter.');
    }
}

