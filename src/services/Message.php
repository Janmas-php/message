<?php
//+---------------------------------------------------------------------------------------------------------------------
//| 人生是荒芜的旅行，冷暖自知，苦乐在心
//+---------------------------------------------------------------------------------------------------------------------
//| Author:Janmas <janmas@126.com>
//+---------------------------------------------------------------------------------------------------------------------
//| 
//+---------------------------------------------------------------------------------------------------------------------


namespace Janmas\Message\Services;


use Janmas\Message\Model\Config;
use Janmas\Message\Util\Users;
use Janmas\Sms\Sms;
use PHPMailer\PHPMailer\Exception;

class Message
{
	protected $config;
	public static $instance;

	public function __construct(Config $config){
		$this->config = $config;
	}

	public static function instance(Config $config){
		if(!self::$instance instanceof self){
			self::$instance = new self($config);
		}

		return self::$instance;
	}
	/**
	 * 发送消息
	 * @param Users $user
	 * @param string $scene z 站内行 s短信 e邮件 t模板消息
	 * @throws Exception
	 */
	public function send(Users $user,$scene='zset'){
		$scenes = str_split($scene,1);
		foreach($scenes as $scene){
			switch($scene){
				case 'z':
					$scene = 'station';
					break;
				case 's':
					$scene = 'sms';
					break;
				case 'e':
					$scene = 'email';
					break;
				case 't':
					$scene = 'template';
					break;
				default:
					throw new Exception('不存在的消息方式');
			}
			$this->$scene($user);
		}
	}
	/**
	 * 站内信
	 */
	public function station(Users $user){
		$create = [
			'title' => $user->title,
			'content' => $user->content,
			'created_at' => date('Y-m-d H:i:s'),
			'extra' => $user->extra,
			'user_id' => $user->id,
			'scene' => $user->scene,
			'is_read' => 0,
			'read_time' => '0000-00-00 00:00:00'
		];
		return \Janmas\Message\Model\Message::create($create);
	}
	/**
	 * 发送短息
	 * @param Users $user
	 * @param $config
	 *       config = ['ali'=>['key'=>'value']]
	 */
	public function sms(Users $user){
		$driver = $this->config->getOne('sms_driver');
		try{
			$sms = new Sms($driver,$this->config->getDriver('sms'));
			$sms->sendSms($user->phone,$user->code);
		}catch (\Exception $e){
			//异常记录
			if(!$user->ignoreError){
				throw $e;
			}
		}

		return self::$instance;
	}
	/**
	 * 发邮件
	 * @param Users $user
	 * @param $config
	 * @return mixed
	 * @throws \Exception
	 */
	public function email(Users $user,$config){
		try{
			$mail = new Email($this->config->getDriver('email'));
			$mail->sendMail($user);
		}catch (\Exception $e){
			//异常记录
			if(!$user->ignoreError){
				throw $e;
			}
		}
		return self::$instance;
	}

	public function template(){}
}