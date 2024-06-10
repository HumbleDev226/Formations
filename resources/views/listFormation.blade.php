<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="{{ asset('css\listCourse.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des formations</title>
</head>
@include('welcome')
<body>
<div class="container mt-5">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            @foreach($courses->unique('categorie') as $course)
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ $loop->first ? 'active' : '' }}" id="tab-{{ $course->categorie }}" data-bs-toggle="tab" data-bs-target="#tab-{{ $course->categorie }}" type="button" role="tab" aria-controls="tab-{{ $course->categorie }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">{{ $course->categorie }}</button>
                </li>
            @endforeach
        </ul>
        <!-- Tab panes -->
        <div class="tab-content" id="myTabContent">
        @foreach($courses->unique('categorie') as $course)

            
                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="tab-{{ $course->categorie }}" role="tabpanel" aria-labelledby="tab-{{ $course->categorie }}">
                    <!-- Ajoutez ici le contenu spécifique à cette catégorie -->
                
        
                <div class="courses-container">
                @foreach($courses as $course)

                    <div class="card" style="width: 21rem;">
                        <img class="card-img-top" src="{{ $course->logo }}" alt="Card image cap">
                            <div class="card-body">
                                <a href="{{ route('courses.show', $course->id) }}" class="card-title"> {{ $course->titre }} </a>
                                <p class="card-text">{{ $course->description }}</p>
                                    <div class="card-action d-flex">
                                        <span style="margin-top: 15px;">{{ $course->prix }} CFA</span>
                                        <a href="{{ route('courses.show', $course->id) }}" class="paid-btn">Voire</a>
                                        <a href="{{ route('courses.edit', $course->id) }}" class="cart-btn">  Modifier</a>
                                        <form method="POST" action="{{ route('courses.destroy', $course->id) }}" onsubmit="return confirm('Voulez vous supprimer ce cours?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Supprimer</button>
                                    </form>

                                    </div>
            
                            </div>
                   </div>
                   @endforeach

                    </div>


                  


                   
                </div>
                @endforeach

        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>