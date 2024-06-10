<?php
namespace App\Http\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class MaVueComposer
{
    public function compose(View $view)

    {
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
        $view->with('userData', $userData);
    }
}
?>