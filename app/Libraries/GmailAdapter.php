<?php
namespace App\Libraries;

use Config\Services;

class GmailAdapter
{

    private $email;
    protected $emisor;
    protected $nombreEmisor;
    protected $destino;
    protected $conCopia;
    protected $conCopiaOculta;
    protected $asunto;
    protected $mensaje;

    public function __construct()
    {
        $config = [
            'protocol' => 'smtp',
            'charset'  => 'utf-8',
            'wordWrap' => true,
            'userAgent' => 'Comserva',
            'SMTPHost' => 'ssl://smtp.gmail.com',
            'SMTPUser' => 'soportesistemas.comfaca@gmail.com',
            'SMTPPass' => '',
            'SMTPPort' => 465,
            'mailtype' => 'html',
            'newline' => "\r\n",
            'bcc_batch_mode' => true
        ];
        $this->email = Services::email($config);
    }

    public function setting($properties)
    {
        foreach ($properties as $key => $value) {
            $this->$key = $value;
        }
    }

    public function sendEmail()
    {
        if(!$this->asunto){
            throw new \Exception("Error no puede estar sin asunto el correo", 1);
        }
        if(!$this->mensaje){
            throw new \Exception("Error no puede estar sin mensaje el correo", 1);
        }
        if(!$this->destino){
            throw new \Exception("Error no puede estar sin destino el correo", 1);
        }
        if(!$this->emisor){
            throw new \Exception("Error no puede estar sin emisor el correo", 1);
        }
        if(!$this->nombreEmisor) $this->nombreEmisor = 'Comserva';
 
        $this->email->setFrom($this->emisor, $this->nombreEmisor);
        $this->email->setTo($this->destino);
        if ($this->conCopia) $this->email->setCC($this->conCopia);
        if ($this->conCopiaOculta) $this->email->setBCC($this->conCopiaOculta);
        $this->email->setSubject($this->asunto);
        $this->email->setMessage($this->mensaje);
        $this->email->send();
        return $this->email->printDebugger();
    }

}