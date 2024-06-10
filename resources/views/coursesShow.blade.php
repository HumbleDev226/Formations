<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="{{ asset('css\courseShow.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details de formation</title>
</head>
<body>
@include('welcome')
    <div class="row">
    <div class="col-lg-8">
        <img src="{{ asset( $courses->logo) }}"  alt="Description de l'image">

    </div>
    <div class="col-lg-4">
    <div class="titre"></div>
    <p class="card-text">{{ $courses->description }}</p>
    <p class="card-text"> Auteur : {{ $courses->auteur }}</p>
    <p class="card-text"> Modules couvert : {{ $courses->modules }}</p>
    <p class="card-text"> Date de publication : {{ $courses->date }}</p>
    <p class="card-text"> Prix : {{ $courses->prix }} CFA</p>
    <p class="card-text"> Catégorie de la formation : {{ $courses->categorie }}</p>
  
  <div class="action">
    <a href="{{ route('showFichier', ['id' => $courses->id]) }}" class="btn btn-danger">Voir le fichier</a>   
    <a href="{{ route('courses.index') }}" class="btn btn-primary">retour</a>
  </div>
    </div>
    </div>
  

    

 
  




  



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>     

</body>
</html>