<form class="form needs-validation" method="POST" action="javascript:;" id='formLogin'>
	<div class="card card-login">
		<div class="card-header">
			<div class="card-header">
				<h3 class="header text-center">Recuperar Cuenta</h3>
			</div>
		</div>
		<div class="card-body">
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text">
						<i class="nc-icon nc-single-02"></i>
					</span>
				</div>
				<input type="text" name='email' id='email' class="form-control" placeholder="dirección de email" />
				<div class="invalid-feedback" has-error='email'></div>
			</div>
			<p class="text-category">Ingresa la dirección de email, para restablecer la clave y envíar los datos a un medio seguro.</p>
		</div>
		<div class="card-footer">
			<div class="row justify-content-md-center">
				<button type='button' id='btnSendDataLogin' class="btn btn-warning btn-round btn-block mb-3">Envíar</button>
			</div>
		</div>
		<div class="form-group text-center">
			<a id="btnVolverSesion" class="text-sol-hard" style='text-decoration: none;cursor:pointer'>
				Regresar, iniciar sesión
			</a>
		</div>
	</div>
</form>