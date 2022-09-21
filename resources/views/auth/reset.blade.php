<!DOCTYPE html>
<html lang="en">
<head>
	<title>Réinitialisation de mot de passe</title>
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
				<form class="login100-form validate-form" action="reset" method="POST">
                    @csrf
					@method('PUT')
					<span class="login100-form-title p-b-25">
						Réinitialisation de mot de passe
					</span>

					<div class="wrap-input100 validate-input" >
                        <input type="text" class="input100 " name="reset_pass" required  autofocus placeholder="Taper le code secret" maxlength="6" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" max="6" >
                        <span  class="invalid-feedback">@error('reset_pass') {{ $message }} @enderror</span>
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>
					<div class="wrap-input100 rs1 validate-input" data-validate="Password is required" >
                        <input type="password" class="input100" name="password" placeholder="Taper un nouveau mot de passe" required >
                        <span class="text-danger">@error('password') {{ $message }} @enderror</span>
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>
					<div class="wrap-input100 rs1 validate-input" data-validate="Password is required">
                        <input type="password" class="input100" name="password2" placeholder="Rétaper le mot de passe" required >
                        <span class="text-danger">@error('password2') {{ $message }} @enderror</span>
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>

					<div class="container-login100-form-btn m-t-20 mb-3">
                        <button type="submit" class="login100-form-btn fw-bold">ENVOYER</button>
					</div>
                    <div class="d-flex justify-content-between">  
                        <a href="/" class="linky" >Se Connecter</a> 
                    </div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>