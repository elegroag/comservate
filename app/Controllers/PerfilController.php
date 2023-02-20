<?php
namespace App\Controllers;

use App\Libraries\GmailAdapter;
use App\Libraries\GmailMailer;
use App\Libraries\PdfLibrary;
use App\Services\UsuarioService;

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

		// $gmailAdapter = new GmailMailer();
		// $gmailAdapter->setting(
		//     ['asunto'=> 'Mensaje de prueba'],
		//     ['mensaje'=> 'Hola prueba 01'],
		//     ['emisor'=> 'soportesistemas.comfaca@gmail.com'],
		//     ['destino'=> 'maxedwwin@gmail.com'],
		//     ['nombreEmisor'=> 'soportesistemas']
		// );
		$out = $gmailAdapter->sendEmail();
		var_export($out);
	}


	public function informePdf()
	{
		try {
			$pdf = new PdfLibrary(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

			// set document information
			$pdf->setCreator(PDF_CREATOR);
			$pdf->setAuthor('Nicola Asuni');
			$pdf->setTitle('TCPDF Example 023');
			$pdf->setSubject('TCPDF Tutorial');
			$pdf->setKeywords('TCPDF, PDF, example, test, guide');

			// set default header data
			$pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 023', PDF_HEADER_STRING);

			// set header and footer fonts
			$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

			// set default monospaced font
			$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

			// set margins
			$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			$pdf->setHeaderMargin(PDF_MARGIN_HEADER);
			$pdf->setFooterMargin(PDF_MARGIN_FOOTER);

			// set auto page breaks
			$pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

			// set image scale factor
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

			// set some language-dependent strings (optional)
			if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
				require_once(dirname(__FILE__) . '/lang/eng.php');
				$pdf->setLanguageArray($l);
			}

			// ---------------------------------------------------------

			// set font
			$pdf->setFont('times', 'BI', 14);

			// Start First Page Group
			$pdf->startPageGroup();

			// add a page
			$pdf->AddPage();

			// set some text to print
			$txt = <<<EOD
			Example of page groups.
			Check the page numbers on the page footer.

			This is the first page of group 1.
			EOD;

			// print a block of text using Write()
			$pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);

			// add second page
			$pdf->AddPage();
			$pdf->Cell(0, 10, 'This is the second page of group 1', 0, 1, 'L');

			// Start Second Page Group
			$pdf->startPageGroup();

			// add some pages
			$pdf->AddPage();
			$pdf->Cell(0, 10, 'This is the first page of group 2', 0, 1, 'L');
			$pdf->AddPage();
			$pdf->Cell(0, 10, 'This is the second page of group 2', 0, 1, 'L');
			$pdf->AddPage();
			$pdf->Cell(0, 10, 'This is the third page of group 2', 0, 1, 'L');
			$pdf->AddPage();
			$pdf->Cell(0, 10, 'This is the fourth page of group 2', 0, 1, 'L');

			// ---------------------------------------------------------

			//Close and output PDF document
			$pdf->Output('C:/xampp/htdocs/html7/test_tcpdf/example2.pdf', 'F');
		} catch (\Exception $err) {
			var_export($err->getMessage());
		}
	}
}
