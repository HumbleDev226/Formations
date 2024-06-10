<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link href="{{ asset('css\header.css') }}" rel="stylesheet">
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceuil</title>
</head>
<body>
<div class="navbar">
<a class="navbar-brand" href="#"><img class="logo-img" src="{{asset('storage/imgDev/logo.png')}}" alt=""></a>
<div class="nav-link">
    <a href="/home">Acceuil</a>
    <a href="/list-formations">Liste des formations</a>
    <a href="/add-course">Ajouter une formation</a>
    <a href="/register">Inscrire un utilisateur</a>


</div>
@guest
<div class="action-btn">
    <a href="/login" class="btn btn-connexion">Connexion</a>
    <a href="/register" class="btn btn-inscription">Inscription</a>

</div>
@endguest
@auth
<div class="action-btn">
    <a href="{{ route('logout.user') }}" class="btn btn-connexion">Déconnexion</a>
    <a href="" class="btn btn-inscription"  data-toggle="modal" data-target="#exampleModal">Mon compte</a>

</div>
@endauth
</div>



<!-- compte popup  -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> {{ $userData['prenom']}} {{ $userData['nom']}} ({{ $userData['role']}})</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        

      <div class="container ">
  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="Profil-tab" data-toggle="tab" href="#Profil" role="tab" aria-controls="Profil" aria-selected="true">Profil</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="Formations-tab" data-toggle="tab" href="#Formations" role="tab" aria-controls="Formations" aria-selected="false">Formations </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="Autres-tab" data-toggle="tab" href="#Autres" role="tab" aria-controls="Autres" aria-selected="false">Autres</a>
    </li>
  </ul>
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="Profil" role="tabpanel" aria-labelledby="Profil-tab">
     
    <form style="margin-top:15px" method="POST" action="{{ route('user.update', $userData['id']) }}">
    @csrf
    @method('PUT')

    <div class="form-group" style="margin-top:15px">
    <input type="text" class="form-control" value=" {{ $userData['nom']}} " name="nom" readonly id="Nom" aria-describedby="nomHelp">
  </div>
  <div class="form-group" style="margin-top:15px">
    <input type="text" class="form-control" value=" {{ $userData['prenom']}} " name="prenom" readonly id="Prenom" aria-describedby="prenomHelp" placeholder="Entrer votre prénom">
  </div>
  <div class="form-group"style="margin-top:15px">
    <input type="text" class="form-control" value=" {{ $userData['domaine']}} " name="domaine" id="domaine" aria-describedby="prenomHelp" placeholder="Entrer votre domaine">
  </div>
  <div class="form-group" style="margin-top:15px">
    <input type="text" class="form-control" value=" {{ $userData['role']}} " readonly name="role" id="role" aria-describedby="prenomHelp" placeholder="Entrer votre domaine">
  </div>
  <div class="form-group" style="margin-top:15px">
    <input type="text" class="form-control"  name="poste" value=" {{ $userData['poste']}} " id="poste" aria-describedby="prenomHelp" placeholder="Entrer votre poste">
  </div>
  <div class="form-group" style="margin-top:15px">
    <input type="email" class="form-control" value=" {{ $userData['email']}} " name="email" id="Email" aria-describedby="emailHelp" placeholder="Entrer email">
  </div>
  <div class="form-group" style="margin-top:15px">
    <input type="password" class="form-control"  name="password" id="password" placeholder="********">
  </div>
  <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        <button type="submit" class="btn btn-danger">Sauvegarder</button>


        
              
                
      </div>
</form>


    </div>
    <div class="tab-pane fade" id="Formations" role="tabpanel" aria-labelledby="Formations-tab">
      <p>Votre liste de formation.</p>
    </div>
    <div class="tab-pane fade" id="Autres" role="tabpanel" aria-labelledby="Autres-tab">

    <p>Aucune informations à afficher</p>
    </div>
  </div>
</div>



      </div>
   
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>  
</body>
</html>