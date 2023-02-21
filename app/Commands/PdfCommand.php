<?php
namespace App\Commands;

use App\ThirdParty\PdfParty;
use CodeIgniter\CLI\BaseCommand;

class PdfCommand extends BaseCommand
{
    protected $group       = 'Server';
    protected $name        = 'app:pdf';
    protected $description = 'Displays basic application information.';

    public function run(array $params)
    {
        $this->informePdf();
        echo 'PDF OK';
    }

    public function informePdf()
	{
		try {
			$pdf = new PdfParty(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		} catch (\Exception $err) {
			var_export($err->getMessage());
		}
	}
}