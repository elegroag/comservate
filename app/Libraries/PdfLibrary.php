<?php
namespace App\Libraries;
require_once APPPATH . 'ThirdParty/tcpdf/tcpdf.php';

use TCPDF;

class PdfLibrary extends TCPDF
{
    public function __construct() { 
		parent::__construct(); 
	}
	
    public function Header() {
        $this->SetFont('helvetica', 'B', 20);
        $this->Cell(0, 15, 'Sales Information for Products', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    public function Footer() {
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 8);
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}