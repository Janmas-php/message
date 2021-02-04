<?php
//+---------------------------------------------------------------------------------------------------------------------
//| 人生是荒芜的旅行，冷暖自知，苦乐在心
//+---------------------------------------------------------------------------------------------------------------------
//| Author:Janmas <janmas@126.com>
//+---------------------------------------------------------------------------------------------------------------------
//| 
//+---------------------------------------------------------------------------------------------------------------------


namespace Janmas\Message\Services;


use Janmas\Message\Util\UserEmail;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class Email
{
	protected $config = null;

	public function __construct( $config=null){
		$this->config = $config;
	}

	public function sendMail(UserEmail $user){
		return $this->send($user);
	}

	private function send($user){
		$mail = new PHPMailer(true);
		try {
			$mail->SMTPDebug =$this->config['debug'];
			$mail->isSMTP();
			$mail->Host       = $this->config['host'];
			$mail->SMTPAuth   = $this->config['auth'];
			$mail->Username   = $this->config['username'];
			$mail->Password   = $this->config['password'];
			$mail->SMTPSecure = $this->config['encryption'];
			$mail->Port       = $this->config['port'];

			$mail->setFrom($this->config['email'], $this->config['username']);

			if(is_array($user->email)){
				$emails = $user->email;
				array_walk($emails,function($item)use($mail){
					if(is_string($item)){
						$mail->addAddress($item);
					}else{
						$mail->addAddress($item['email'],$item['nickname']);
					}
				});
			}else{
				$mail->addAddress($user->email, $user->nickname);
			}

			if(property_exists($user,'file') && !empty($user->file)){
				$file = is_array($user->attachment)?$user->attachment:[$user->attachment];
				array_walk($file,function($item)use($mail){
					if(is_array($item)){
						$mail->addAttachment(
							$item['path'],
							$item['name'],
							isset($item['encoding'])?$item['encoding']:PHPMailer::ENCODING_BASE64,
							isset($item['disposition'])?$item['disposition']:'attachment'
						);
					}else{
						$mail->addAttachment($item);
					}
				});
			}

			$mail->isHTML(true);
			$mail->Subject = $user->subject;
			$mail->Body    = $user->body;
			$mail->AltBody = $user->altBody;

			if(!$mail->send()){
				return false;
			}
			if(!$mail->isError()){
				throw new Exception( "Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
			}
		} catch (Exception $e) {
			throw new \Exception( "Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
		}
		return true;
	}
}