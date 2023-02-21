<?php
namespace App\Controllers;

use App\Libraries\GmailAdapter;
use App\Libraries\GmailMailer;
use App\Services\UsuarioService;
use App\ThirdParty\PdfParty;

class PerfilController extends BaseController
{

	private $usuarioService;
	private $session;

	public function __construct()
	{
		$this->session = session();
		$this->usuarioService = new UsuarioService();
		helper('tag');
		helper('uri');
		helper('html');
	}

	public function index()
	{
		$auth = $this->session->get('auth');
		$user = $this->usuarioService->getUsuarioById($auth['id']);
		return view('perfil_manager/perfil', ['title'=> 'Perfil Usuario', 'usuario'=> json_encode($user)]);
	}

	public function changeClave()
	{
		$auth = $this->session->get('auth');
		$gmailAdapter = new GmailAdapter();
		$gmailAdapter->setting(
			['asunto'=> 'Mensaje de prueba'],
			['mensaje'=> 'Hola prueba 01'],
			['emisor'=> 'soportesistemas.comfaca@gmail.com'],
			['destino'=> 'maxedwwin@gmail.com'],
			['nombreEmisor'=> 'soportesistemas']
		);
		$out = $gmailAdapter->sendEmail();
		var_export($out);
	}

	public function informePdf()
	{
		try {
			PdfParty::setInitial('temp/ejemplo01.pdf', 'CARTA PRUEBA', 10, 10);
			$pdf = new PdfParty();
			$pdf->addPagina(10,10,10);
			$pdf->addParrafo(
				[
					"Hola ok",
					"Prueba ok",
				]
			);
			$pdf->out('D');
		} catch (\Exception $err) {
			var_export($err->getMessage());
		}
	}
}
