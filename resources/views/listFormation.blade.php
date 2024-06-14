<!-- resources/views/listformations.blade.php -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des formations</title>
    <link href="{{ asset('css/listCourse.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @include('welcome')

    <div class="container mt-5">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            @foreach($categories as $category)
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ $loop->first ? 'active' : '' }}" id="tab-{{ $category->id }}" data-bs-toggle="tab" data-bs-target="#tab-{{ $category->id }}" type="button" role="tab" aria-controls="tab-{{ $category->id }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">{{ $category->nom }}</button>
                </li>
            @endforeach
        </ul>
        <!-- Tab panes -->
        <div class="tab-content" id="myTabContent">
            @foreach($categories as $category)
                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="tab-{{ $category->id }}" role="tabpanel" aria-labelledby="tab-{{ $category->id }}">
                    <div class="courses-container">
                        @foreach($category->courses as $course)
                            <div class="card" style="width: 21rem;">
                                <img class="card-img-top" src="{{ $course->logo }}" alt="Image de {{ $course->titre }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $course->titre }}</h5>
                                    <p class="card-text">{{ $course->description }}</p>
                                    <p class="card-text">Modules: {{ $course->modules }}</p>
                                    <p class="card-text">Prix: {{ $course->prix }} CFA</p>
                                    <a href="{{ route('courses.show', $course->id) }}" class="btn btn-primary">Voir</a>
                                    <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-warning">Modifier</a>
                                    <form method="POST" action="{{ route('courses.destroy', $course->id) }}" onsubmit="return confirm('Voulez-vous supprimer ce cours?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Supprimer</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
