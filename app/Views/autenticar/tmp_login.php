<form class="form needs-validation" method="POST" action="javascript:;" id='formLogin'>
	<div class="card card-login">
		<div class="card-header">
			<div class="card-header">
				<h3 class="header text-center">Login</h3>
			</div>
		</div>
		<div class="card-body">
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text">
						<i class="nc-icon nc-single-02"></i>
					</span>
				</div>
				<input type="text" name='username' id='username' class="form-control" placeholder="Código Usuario" />
				<div class="invalid-feedback" has-error='username'></div>
			</div>
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text">
						<i class="nc-icon nc-key-25"></i>
					</span>
				</div>
				<input type="password" name='password' id='password' placeholder="Clave" class="form-control" />
				<button id="btnShowPassword" class="btn bg-sol-hard border-0 mt-0 mb-0" style="padding:8px" type="button" id="button-addon2"><i class="fa fa-eye"></i></button>
				<div class="invalid-feedback" has-error='password'></div>
			</div>
			<br />
			<div class="form-group">
				<div class="form-check">
					<label class="form-check-label">
						<input class="form-check-input" type="checkbox" value="" checked="" />
						<span class="form-check-sign"></span>
						Recordar las credenciales de acceso
					</label>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<div class="row justify-content-md-center">
				<button type='button' id='btnSendDataLogin' class="btn btn-warning btn-round btn-block mb-3">Iniciar Sesión</button>
			</div>
		</div>
		<div class="form-group text-center">
			<a id="btnRecoveryPassword" class="text-sol-hard" style='text-decoration: none;cursor:pointer'>
				Olvido contraseña,<br/>Problemas para acceder al aplicativo
			</a>
		</div>
	</div>
</form>