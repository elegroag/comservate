<?php
namespace App\Controllers;

use App\Libraries\GmailAdapter;
use App\Libraries\GmailMailer;
use App\Libraries\JwtLibrary;
use App\Models\RolUsuarioModel;
use App\Models\UsuarioModel;
use App\Services\HashService;
use App\Services\JwtService;
use App\Services\UsuarioService;
use Config\Services;

class LoginController extends BaseController
{

	private $userModel;
	private $jwtLibrary;
	private $jwtService;
	private $session;

	public function __construct()
	{
		$this->userModel = new UsuarioModel();
		$this->jwtLibrary = new JwtLibrary();
		$this->jwtService = new JwtService();
		$this->session = Services::session();
		helper('tag');
		helper('uri');
	}

	public function index()
	{
		helper('tag');
		helper('html');
		return view('autenticar/login', ['title'=> 'Login']);
	}

	public function validation($jwt)
	{
		try {
			$decoded = $this->jwtLibrary->validateToken($jwt);
			$jwtIngreso = $this->jwtService->getJwtIngresoById($jwt);
			if(!$decoded)
			{
				if($jwtIngreso){
					$this->jwtService->updateJwtIngreso($jwt, [ "estado"=> "I"]);
				}
				throw new \Exception('Error no es valido el token');
			} else {
				if($jwtIngreso)
				{
					$this->jwtService->updateJwtIngreso($jwt, [ "consumo"=> $jwtIngreso->consumo + 1]);
					$user= $this->userModel->getfindByUsername($decoded['data']->username);
					$id = $decoded['data']->id;
					if(!$user){
						throw new \Exception('Error, el usuario que hace consumo del servicio no es valido para ingresar');
					}

					$rolesUsuarios = new RolUsuarioModel;
					$roles = $rolesUsuarios->asArray()->where('id_usuario', $user->id)->findAll();
					$rolesUsuario = array();
					foreach ($roles as $rol)
					{
						$rolesUsuario[] = $rol['id_rol'];
					}
					$this->session->set('auth',
						[
							'usuario' => $user->usuario,
							'correo' => $user->correo,
							'roles' => $rolesUsuario,
							'id' => $id,
							'token' => $jwt
						]
					);
					return redirect('web/inicio');
				} else {
					throw new \Exception('Error, el token no se almaceno de forma correcta.');
				}
			}
		} catch (\Exception $err) {
			return $this->response->setJSON(array(
				'status' => false,
				'message' => $err->getMessage()
			));
		}
	}

	public function logout()
	{
		$this->session->destroy();
		return redirect('login');
	}

	public function recovery()
	{
		try {
			$request = $this->request->getJSON();
			if (!isset($request->username)) {
				throw new \Exception('Lo siento, no se dispone de usuario para la autenticación', 404);
			}
			if (!isset($request->email)) {
				throw new \Exception('Lo siento, no se dispone de un email para la recuperación de la cuenta', 404);
			}
			$username = $request->username;
			$user = $this->userModel->getfindByUsername($username);
			if (!$user) {
				throw new \Exception('Lo siento, el nombre de usuario no está registrado en base de datos.', 404);
			}
			if (strtoupper($user->correo) != strtoupper($request->email)) {
				throw new \Exception('Lo siento, el correo registrado es diferente al que tenemos de referencia en base de datos. '.$user->correo.' - '.$request->email, 404);
			}
			$usuarioService = new UsuarioService();
			$password = $this->claveAleatoria();

			$hashService = new HashService();
			$hash = $hashService->getClaveHash($password, $username);
			$data = [
				"password" => $hash
			];
			if ($usuarioService->updateUsuario($user->id, $data)) {
				$parser = Services::parser();

				$gmailAdapter = new GmailMailer();
				$gmailAdapter->setting(
					['asunto' => 'Recuperación de cuenta Comserva'],
					[
						'mensaje' => $parser->setData([
							'nombres' => $user->nombres,
							'username' => $username,
							'usuario_clave' => $password
						])->render('autenticar/recovery_parse')
					],
					['emisor' => 'soportesistemas.comfaca@gmail.com'],
					['destino' => $user->correo],
					['nombreEmisor' => 'soportesistemas']
				);
				$gmailAdapter->sendEmail();
				return $this->response->setJSON([
					'status' => true,
					'message' => 'Se ha editado con éxito el registro',
					'usuario' => $usuarioService->getUsuarioById($user->id)
				]);
			} else {
				return $this->response->setJSON([
					'status' => false,
					'message' => "Error de validación servicio de clientes",
					'errors' => $usuarioService->getErrors()
				]);
			}
		} catch (\Exception $err) {
			return $this->response->setJSON([
				'status' => false,
				'message' => $err->getMessage()
			]);
		}
	}

	function claveAleatoria($long = 8)
	{
		$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890&_.";
		$password = "";
		for($i=0; $i < $long; $i++) {
			$password .= substr($str, rand(0,62),1);
		}
		return $password;
	}
}