<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="{{ asset('css\login.css') }}" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
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

    <div class="register-form">
    <form method="POST" action="{{ route('login.user') }}">
    @csrf
        <img src=" {{ asset('storage/imgDev/logo.png') }} " alt="">
        <h3>Connectez-vous rapidement</h3>

  <div class="form-group">
    <input type="email" class="form-control" name="email" id="Email" aria-describedby="emailHelp" placeholder="Entrer email">
  </div>
  <div class="form-group">
    <div class="input-group">
        <input id="password" type="password" class="form-control" placeholder="*********" name="password" required autocomplete="new-password">
            <button id="show_password" type="button">
            <i class="bi bi-eye"></i><!-- Utilisez la classe appropriée pour votre icône -->
            </button>
    </div>
</div>
  <div class="other-action">
  <a href="/">Mot de passe oublié</a>
  </div>
  <div class="form-group">
  <button type="submit" class=" btn-register">Connexion</button>

 

  </div>
</form>
    </div>

    <script>
    document.getElementById("show_password").addEventListener("click", function () {
        var passwordInput = document.getElementById("password");
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
        } else {
            passwordInput.type = "password";
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>     
</body>
</html>
