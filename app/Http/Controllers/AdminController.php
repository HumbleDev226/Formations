<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'domaine' => 'required|string|max:255',
            'poste' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admin',
            'password' => 'required|string|min:8|confirmed',
        ]);
if('sucess'){
    User::create([
        'nom' => $request->nom,
        'prenom' => $request->prenom,
        'domaine' => $request->domaine,
        'poste' => $request->poste,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    return redirect('/login')->with('success', 'Votre compte a été créé avec succès.');

}
return back()->with(
    'error','Les données saisies ne sont pas valides(Tous les champs sont obligatoires, l\'email doit être de bon type et le mot de passe composé d\'une combinaison d\'au moins 8 caractères avec une majuscule,une miniscule des lettres et des chiffres.). Réessayez',
);
      
}
   public function index(){
   
    $user = Auth::user();
  
    // Vous pouvez accéder aux propriétés de l'utilisateur
    $id = $user->id;
    $nom = $user->nom;
    $prenom = $user->prenom;
    $email = $user->email;
    $role = $user->role;
    $domaine = $user->domaine;
    $poste = $user->poste;

    // Ou utiliser la méthode toArray() pour obtenir un tableau des données de l'utilisateur
    $userData = $user->toArray();

    // Récupère tous les utilisateurs excepté l'utilisateur connecté
    $users = User::where('id', '!=',  $id)->get();


    
    $Coursecount = Course::count();
    $Usercount = User::count();
    $sessionKeyName = 'user_id'; // Clé de session utilisée pour stocker l'ID de l'utilisateur lors de la connexion

    $sessionIds = Session::get($sessionKeyName, []); // Récupérer tous les IDs d'utilisateurs connectés

    $connectedUsers = User::whereIn('id', $sessionIds)->get();
   
        return view('home', compact('users','userData','connectedUsers','Coursecount','Usercount'));


    
   }





  
   public function update(Request $request, $id)
   {
    
       // Récupérer l'utilisateur à mettre à jour
       $utilisateur = User::findOrFail($id);
       if($request->input('password')){
        $utilisateur->update([
            $utilisateur->nom=$request->input('password')
        ]);
       }else{
     
       $utilisateur->update([
            
        $utilisateur->nom = $request->input('nom'),
        $utilisateur->prenom = $request->input('prenom'),
        $utilisateur->domaine =$request->input('domaine'),
        $utilisateur->poste = $request->input('poste'),
        $utilisateur->role = $request->input('role'),
        $utilisateur->email = $request->input('email'),



    ]);
}

       return redirect()->back();
   }
   public function destroy($id){
    $user=User::findOrFail($id);
    $user->delete();
    return redirect()->back();
    
    
   }

   public function showConnectedUsers()
    {
        $sessionKeyName = 'user_id'; // Clé de session utilisée pour stocker l'ID de l'utilisateur lors de la connexion

        $sessionIds = Session::get($sessionKeyName, []); // Récupérer tous les IDs d'utilisateurs connectés

        $connectedUsers = User::whereIn('id', $sessionIds)->get();

        // Afficher les utilisateurs connectés
       return view('home',compact('connectedUsers'));
    }
}

