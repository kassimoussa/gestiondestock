<!DOCTYPE html>
<html lang="en">
<head>
	<title>Restitution de mot de passe</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/util.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
            <div class="">
                @if ($message = Session::get('fail'))
                <div class="alert alert-danger text-center">
                    <p>{{ $message }}</p>
                </div>
            @endif
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50">
				<form class="login100-form validate-form" action="resetpassword" method="POST">
                    @csrf
                    @method('PUT')
					<span class="login100-form-title p-b-25">
						Restitution de mot de passe
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                        <input type="email" class="input100 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Taper votre email">
                        <span  class="invalid-feedback">@error('email') {{ $message }} @enderror</span>
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>

					<div class="container-login100-form-btn m-t-20 mb-3">
                        <button type="submit" class="login100-form-btn fw-bold">ENVOYER</button>
					</div>
                    <div class="d-flex justify-content-between">
                        {{-- <a href="register" class="linky" >Ajouter un utilisateur</a> --}}   
                        <a href="/" class="linky" >Se Connecter</a> 
                    </div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>