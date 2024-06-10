<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body style="background: #e5e5e5; padding: 30px;" >

<div style="max-width: 320px; margin: 0 auto; padding: 20px; background: #fff; border-radius: 25px">
<img src="public\storage\imgDev\logo.png" width="90px" height="90px" alt="logo">
<p>Merci pour votre inscription. Sans plus tarder cliquer sur le lien ci-dessous pour vérifier votre email</p> <br>
	<small class="text-danger">Ce lien expire dans 30 minutes</small>
<a href="{{ $verificationUrl }}">Cliquer ici</a>
</div>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>     
</body>
</html>

</html>