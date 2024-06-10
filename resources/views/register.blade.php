<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="{{ asset('css\register.css') }}" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
  @include('welcome')

  <form method="POST" action="{{ route('register.admin') }}">
@csrf
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

    <div class="row">
    <div class="form-group col-lg-6">
<input type="text" class="form-control" name="nom" value="{{ old('nom') }}" id="Nom" aria-describedby="nomHelp" placeholder="Entrer votre nom">
@error('nom')
<div class="alert alert-danger">
    Le champ nom est requis et composé au minimum de 2 caractères. 
</div>
    
@enderror
</div>
<div class="form-group col-lg-6">
<input type="text" class="form-control" name="prenom" value="{{ old('prenom') }}" id="Prenom" aria-describedby="prenomHelp" placeholder="Entrer votre prénom">
@error('prenom')
<div class="alert alert-danger">
    Le champ prenom est requis et composé au minimum de 2 caractères. 
</div>
    
@enderror
</div>
<div class="form-group col-lg-6">
<input type="text" class="form-control" value="{{ old('domaine') }}" name="domaine" id="domaine" aria-describedby="prenomHelp" placeholder="Entrer votre domaine">
@error('domaine')
<div class="alert alert-danger">
    Le champ domaine est requis et composé au minimum de 2 caractères. 
</div>
@enderror
</div>

<div class="form-group col-lg-6">
<input type="text" class="form-control" value="{{ old('poste') }}" name="poste" id="poste" aria-describedby="prenomHelp" placeholder="Entrer votre poste">
@error('poste')
<div class="alert alert-danger">
    Le champ poste est requis et composé au minimum de 2 caractères. 
</div>
    
@enderror 

</div>

<div class="form-group">
<input type="email" class="form-control" value="{{ old('email') }}" name="email" id="Email" aria-describedby="emailHelp" placeholder="Entrer email">
@error('email')
<div class="alert alert-danger">
    L'email invalide (Mal formaté ou déjà existant). 
</div>
    
@enderror

</div>

<div class="form-group">
<input type="password" class="form-control" value="{{ old('password') }}"  name="password" id="password" placeholder="********">
@error('password')
<div class="alert alert-danger">
    Le mot de passe est réquis et doit avoir au moins 8 caractères (Majuscule,Miniscule et lettre) compris. 
</div>
@enderror
</div>

<button type="submit" class=" btn-register">Créer le compte</button>

<div class="other-action">
<a href="/home">Retourner à l'acceuil</a>
</div>
 </div>




</form>

    

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script></body>
</html>
