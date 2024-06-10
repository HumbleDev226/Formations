<!DOCTYPE html>
<html lang="fr">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="{{ asset('css\addFormation.css') }}" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier votre formation</title>
</head>
@include('welcome')
<body>
<div class="add-course-form">
<form action="{{ route('courses.update',$course->id) }}"  method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <h2>Modifier une formation</h2>
   
    <small class="msgForm">Modifier rapidement les champs que vous voulez.</small> <br> <br>
    <div class="row">
        <div class="col-lg-6">

            <div class="form-group">
                <label for="inputLogo">Selectionner l'image </label>
                <input type="file" class="form-control" name="logo" id="imageInput"  accept="image/*">
            </div>
            <p> Ancienne image url : {{ $course->logo }}</p>

        </div>
        <div class="col-lg-6">
        <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputIntitule">Intitulé</label>
      <input type="text" class="form-control" value="{{ $course->titre}}" name="titre" id="inputIntitule" placeholder="votre titre de cours">
    </div>
        </div>


    </div>


    <div class="form-group col-lg-12">
      <label for="inputDescription">Description</label>
      <input type="text" name="description"  value="{{ $course->description}}" class="form-control" id="inputDescription" placeholder="Briève description de la formation">
    </div>
  </div>


  <div class="row">
  <div class="col-lg-6">
  <div class="form-group">
    <label for="inputAuteur">Auteur </label>
    <input type="text" class="form-control" value="{{ $course->auteur}}" name="auteur" id="inputAuteur" placeholder="Nom du formateur">
  </div>
  </div>

<div class="col-lg-6">
<div class="form-group col-md-4">
      <label for="inputState">Catégories</label>
      <select id="inputCatégorie"  name="categorie" class="form-control">
        <option  selected>{{ $course->categorie}}</option>
        <option>Informatique</option>
        <option>Economie</option>
        <option>Comptabilité</option>
        <option>Finance</option>
        <option>Assurance</option>
      </select>
    </div>
</div>





  <div class="form-row">
    <div class="form-group col-lg-12">
      <label for="inputCity">Date</label>
      <input type="date" value="{{ $course->date }}" class="form-control" name="date" id="inputDate">
    </div>
  
<div class="row">
    <div class="col-lg-6">
    <div class="form-group col-lg-6">
      <label for="inputZip">Contenu de la formation</label>
      <input type="file" class="form-control-file" name="fichier"   id="inputFile">
      <p> Ancien fihier url : {{ $course->fichier }}</p>
    </div>
    </div>
    <div class="col-lg-6">
    <div class="form-group">
    <label for="inputPrix">Prix </label>
    <input type="number" class="form-control" value="{{ $course->prix}}" name="prix" id="inputPrix" placeholder="Prix">
  </div>
    </div>

</div>

   
  </div>
 
  <div class="form-group">
    <label for="exampleFormControlModule">Modules couverts</label>
    <textarea class="form-control" name="module" id="exampleFormControlModule" rows="10">{{ $course->modules}}</textarea>
  </div>
</div>
<button type="submit" class="btn-addCourse">Mettre à jour</button>
<a href="/list-formations" class="btn-lookCourse">Voire les formations</a>


</form>

</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script></body>
</html>


