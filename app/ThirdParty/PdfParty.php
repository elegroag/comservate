<?php
namespace App\ThirdParty;

require_once 'tcpdf/tcpdf.php';
use TCPDF;

class PdfParty extends TCPDF
{

	public static $titulo = '';
	public static $orientation = 'P';
	public static $margin_left = 10;
	public static $margin_top = 10;
	public static $numero_parrafos = 0;
	public static $filename = 'file.pdf';

	public function __construct()
	{
		parent::__construct(self::$orientation, "mm", 'Legal');
		$this->SetAutoPageBreak(TRUE, 10);
        $this->SetHeaderMargin(self::$margin_left);
        $this->SetFooterMargin(10);
		$this->SetTitle(self::$titulo);
		$this->SetAuthor('Comserva');
		$this->setSubject('Oficio Comserva');
		$this->setKeywords('Documento, PDF, oficio, carta');
	}
	
	public static function setInitial(string $filename, string $titulo, int $margin_left, int $margin_top)
    {
        self::$titulo = $titulo;
        self::$margin_left = $margin_left;
		self::$margin_top = $margin_top;
		self::$filename = $filename;
    }

	public function Header()
	{
		$this->SetY(0);

		$bMargin = $this->getBreakMargin();

		$auto_page_break = $this->AutoPageBreak;

		$this->SetAutoPageBreak(false, 0);

		$img_file = FCPATH . "assets/img/background_membrete.jpg";

		$this->Image($img_file, 0, 0, 217, 298, '', '', '', false, 300, '', false, false, 0);

		$this->SetAutoPageBreak($auto_page_break, $bMargin);
		
		$this->setPageMark();

		if (strlen(self::$titulo) > 0) 
		{
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

	public function addPagina($x = 15, $y = 30, $z = 15)
	{
		self::$margin_left = $x;
		self::$margin_top = $y;
		$this->SetMargins(self::$margin_left, self::$margin_top, $z);
		$this->AddPage();
	}

	public function addParrafo($fields, $size = 10)
	{
		foreach ($fields as $field) 
		{
			$position_y = (strlen(self::$titulo) == 0) ? 25 : 30;
			if (self::$numero_parrafos == 0) $this->SetY($position_y);
			
			$this->SetTextColor(1);
			$this->SetFont('helvetica', '', $size);
			$this->SetX(self::$margin_left);

			if (
				strlen($field) > 120 ||
				strlen(strstr($field, 'style')) > 0 ||
				strlen(strstr($field, '<b>')) > 0 ||
				strlen(strstr($field, '<p')) > 0
			) {
				if(strlen(strstr($field, 'text-align:center')) > 0) 
				{
                    $this->writeHTML($field, true, false, true, true, 'C');
                } else {
                    if(strlen(strstr($field, 'text-align:justify')) > 0) 
					{
                        $this->writeHTML($field, true, false, true, true, 'J');
                    } else { 
                        $this->writeHTML($field, true, false, true, true, 'L');
                    }
                }
			} else {
				if(strlen(strstr($field, 'text-align:center')) > 0) 
				{
					$this->Cell(self::$margin_left, 5, $field, 0, 0, 'C', 0, '');
                } else {
                    if(strlen(strstr($field, 'text-align:justify')) > 0) 
					{
						$this->Cell(self::$margin_left, 5, $field, 0, 0, 'J', 0, '');
                    } else { 
						$this->Cell(self::$margin_left, 5, $field, 0, 0, 'L', 0, '');
                    }
                }
				$this->Ln();
			}
			self::$numero_parrafos++;
		}
	}

	public function addHtml($html)
	{
		if(strlen(strstr($html, 'text-align:center')) > 0) {
			$this->writeHTML($html, true, false, true, true, 'C');
		} else {
			if(strlen(strstr($html, 'text-align:justify')) > 0) 
			{
				$this->writeHTML($html, true, false, true, true, 'J');
			} else { 
				$this->writeHTML($html, true, false, true, true, 'L');
			}
		}
	}

	public function out($tipo = 'D')
	{
		ob_end_clean();
		$this->Output(FCPATH .'storage/'. self::$filename, $tipo);
	}
}
