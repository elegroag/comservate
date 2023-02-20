<?php
require_once 'tcpdf/tcpdf.php';

class PdfParty extends TCPDF
{

	public static $titulo = '';
	public static $orientation = 'P';
	public static $margin_left = '10';
	public static $margin_top = '10';
	public static $numero_parrafos = 0;
	public static $filename = 'file.pdf';

	public function __construct()
	{
		parent::__construct(self::$orientation, "mm", 'Legal');
		$this->SetTitle(self::$titulo);
	}

	public function Header()
	{
		$this->SetY(0);
		$this->Image(APPPATH . "public/assets/img/background_pdf.jpg", 0, 0, 218, 32);
		if (strlen(self::$titulo) > 0) {
			$this->SetX(self::$margin_left);
			$this->SetY(self::$margin_top);
			$this->SetTextColor(0);
			$this->SetFont('helvetica', '', 12);
			$this->Cell(self::$margin_left, 5, self::$titulo, 0, 0, '', 0, '');
		}
	}

	public function Footer()
	{
		$this->SetY(-15);
		$this->SetFont('helvetica', 'I', 8);
		$this->Cell(0, 10, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
	}

	public function addPagina($x = 20, $y = 33, $z = 20)
	{
		if ($x != 20) {
			$this->margin_left = $x;
		}
		$this->SetMargins($x, $y, $z);
		$this->AddPage();
	}

	public function addParrafo($fields, $size = 10)
	{
		foreach ($fields as $field) {
			$position_y = (strlen(self::$titulo) == 0) ? 25 : 30;
			if (self::$numero_parrafos == 0) {
				$this->SetY($position_y);
			}
			$this->SetTextColor(1);
			$this->SetFont('helvetica', '', $size);
			$this->SetX(self::$margin_left);
			if (
				strlen($field) > 120 ||
				strlen(strstr($field, 'style')) > 0 ||
				strlen(strstr($field, '<b>')) > 0 ||
				strlen(strstr($field, '<p')) > 0
			) {
				$this->writeHTML($field, true, false, true, true, 'left');
			} else {
				$this->Cell(self::$margin_left, 5, $field, 0, 0, '', 0, '');
				$this->Ln();
			}
			self::$numero_parrafos++;
		}
	}

	public function addHtml($html)
	{
		$this->writeHTML($html, true, false, true, true, 'left');
	}

	public function out($tipo = 'D')
	{
		ob_end_clean();
		$this->Output(self::$filename, $tipo);
	}
}
