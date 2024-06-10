<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="{{ asset('css\home.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceuil</title>
</head>
@include('welcome')
<body>
  <h2 style="margin-top:35px;margin-left:25px;font-style:bold">Tableau de bord</h2>
  <small style="margin-top:35px;margin-left:25px;font-style:bold;color:dimgray;">Administer un une vue votre site. Inscrire, modifier, créer, mettre à jour et supprimer. </small>
<div class="infos">
    <div class="user-sum">
        <div class="info-container">
            <i class="bi bi-person-check"></i>
            <h6>Utilisateurs inscrits</h6>
        </div>
        <center><h5 class="user-number"> {{$Usercount}} </h5></center>

    </div>

    <div class="course-sum">
    <div class="info-container">
           <i class="bi bi-mortarboard-fill"></i>
            <h6>Total des formations</h6>
        </div>
        <center><h5 class="course-number">{{$Coursecount}}</h5></center>
    </div>

    <div class="paid-course">
    <div class="info-container">
            <i class="bi bi-check-circle"></i>
            <h6>Formations Payées</h6>
        </div>
        <center><h5 class="user-number">174</h5></center>
    </div>

    <div class="funds">
    <div class="info-container">
          <i class="bi bi-cash-stack"></i>
            <h6>Total des ventes</h6>
        </div>
        <center><h5 class="user-number">574.000 CFA</h5></center>
    </div>

</div>

<div class="container">
  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Mes Utilisateurs</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="paiement-tab" data-toggle="tab" href="#paiement" role="tab" aria-controls="paiement" aria-selected="false">Paiements</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="user-tab" data-toggle="tab" href="#user" role="tab" aria-controls="user" aria-selected="false">Utilisateurs actifs</a>
    </li>
  </ul>
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
    <div style="margin-top:45px" class="all-users">
<table class="styled-table">
    <thead>
    <tr>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Domaine</th>
            <th>Poste</th>
            <th>Email</th>
            <th>Rôle</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td> {{ $user->nom }} </td>
            <td> {{ $user->prenom }} </td>
            <td class="active-row"> {{ $user->domaine }} </td>
            <td> {{ $user->poste }} </td>
            <td> {{ $user->email }} </td>
            <td> {{ $user->role }}</td>
            <td>
           <div class="actions">
           <button type="button"  class="btn btn-primary"  data-toggle="modal" data-target="#exampleModal{{$user->id}}">Modifier</button>
           <form method="POST" action="{{ route('user.delete', $user->id) }}" onsubmit="return confirm('Voulez vous supprimer cet utilisateur?')">
                        @csrf
                        @method('DELETE')
                        <button style="margin-left: 5px;" type="submit" class="btn btn-danger">Supprimer</button>
                 </form>
</td>
@endforeach

</tbody> 
</table>        
      <!-- debut du popup  -->
      @foreach ($users as $user)
  <div class="modal fade" id="exampleModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{$user->id}}" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabe{{$user->id}}">Modifier un utilisateur</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- Corps du popup contenant le formulaire  -->
      <div class="modal-body">
  
      <form method="POST" action="{{ route('user.update', $user->id) }}">
    @csrf
    @method('PUT')

    <div class="form-group" style="margin-top:15px">
    <small id="emailHelp" class="form-text text-muted">Modifier le compte rapidement </small>
    <input type="text" class="form-control" value=" {{$user->nom }} " name="nom" id="Nom" readonly aria-describedby="nomHelp">
  </div>
  <div class="form-group"style="margin-top:15px" >
    <input type="text" class="form-control" value=" {{$user->prenom }}" readonly name="prenom" id="Prenom" aria-describedby="prenomHelp" placeholder="Entrer votre prénom">
  </div>
  <div class="form-group" style="margin-top:15px">
    <input type="text" class="form-control" value=" {{$user->domaine }} " name="domaine" id="domaine" aria-describedby="prenomHelp" placeholder="Entrer votre domaine">
  </div>
  <div class="form-group" style="margin-top:15px">
    <input type="text" class="form-control"  name="poste" value=" {{$user->poste }} " id="poste" aria-describedby="prenomHelp" placeholder="Entrer votre poste">
  </div>
  <div class="form-group" style="margin-top:15px">
    <input type="email" class="form-control" value=" {{$user->email }} " name="email" id="Email" aria-describedby="emailHelp" placeholder="Entrer email">
  </div>
  <div class="form-group" style="margin-top:15px">
    <input type="text" class="form-control" value=" {{$user->role }} " name="role" id="role" aria-describedby="roleHelp" >
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
    </div>
  </div>
</div>
@endforeach 
 


                
           </div>
               

    </div>
    <div class="tab-pane fade" id="paiement" role="tabpanel" aria-labelledby="paiement-tab">Aucun paiement pour le moment</div>
    <div class="tab-pane fade" id="user" role="tabpanel" aria-labelledby="user-tab">
<div class="connected-users">
<table style="margin-top:65px;margin-left:175px" class="styled-table">
    <thead>
    <tr>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Poste</th>
            <th>Email</th>
            <th>Rôle</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($connectedUsers as $connectedUser)
        <tr>
            <td> {{ $connectedUser->nom }} </td>
            <td> {{ $connectedUser->prenom }} </td>
            <td> {{ $connectedUser->poste }} </td>
            <td> {{ $connectedUser->email }} </td>
            <td> {{ $connectedUser->role }}</td>

          </tr>
          @endforeach
</tbody>
</table>
</div>

    </div>
  </div>
</div>


</div>




</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>
