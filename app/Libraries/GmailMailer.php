<?php
namespace App\Libraries;

use Config\Services;
use Exception;
use PHPMailer\PHPMailer\Exception as PHPMailerException;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class GmailMailer
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
        $this->email = new PHPMailer(true);
        $this->email->isSMTP();
        $this->email->Host      = 'smtp.gmail.com';
        $this->email->SMTPAuth  = true;
        $this->email->Username  = 'soportesistemas.comfaca@gmail.com';
        $this->email->Password  = 'fqjdyxaavteiflkn';
        $this->email->SMTPSecure= PHPMailer::ENCRYPTION_SMTPS;
        $this->email->Port      = 465; 
        $this->email->CharSet   = "utf-8";

    }

    public function setting(array ...$properties)
    {
        foreach ($properties as $attr) {
            $key  = array_key_last($attr);
            $value = array_values($attr)[0];
            $this->$key = $value;
        }
        return $this;
    }

    public function sendEmail()
    {
        try {
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

            $exp = explode('@', $this->destino);
            
            $this->email->setFrom($this->emisor, $this->nombreEmisor);
            $this->email->addAddress($this->destino, $exp[0]);
            if ($this->conCopia) $this->email->addCC($this->conCopia);
            if ($this->conCopiaOculta) $this->email->addBCC($this->conCopiaOculta);
            
            $this->email->isHTML(true);
            $this->email->Subject = $this->asunto;
            $this->email->Body = $this->mensaje;
            return $this->email->send();
        } catch (PHPMailerException $err){
            throw new Exception($this->email->ErrorInfo .', '. $err->getMessage(), 1);            
        }
    }

}