<?php
//+---------------------------------------------------------------------------------------------------------------------
//| 人生是荒芜的旅行，冷暖自知，苦乐在心
//+---------------------------------------------------------------------------------------------------------------------
//| Author:Janmas <janmas@126.com>
//+---------------------------------------------------------------------------------------------------------------------
//| 
//+---------------------------------------------------------------------------------------------------------------------


namespace Janmas\Message\Util;

/**
 * Class Users
 * @package Janmas\Message\Model
 * @property int $id
 * @property string $nickname
 * @property string $phone
 * @property string $email
 * @property string $code
 * @property string $subject
 * @property string $body
 * @property string $altBody
 * @property bool $ignoreError
 * @property array|string $file
 * @property int $scene
 */
abstract class Users
{
	protected $id='';

	/**
	 * 忽略异常
	 * true有异常继续执行
	 * false遇到一场直接中止
	 * @var bool
	 */
	protected $ignoreError = false;

	protected $scene = 1;//默认系统消息
	public function __construct( $data=[]){
		foreach($data as $key=>$value){
			$this->$key = $value;
		}
	}

	public function __get($name){
		if(property_exists($this,$name)){
			return $this->$name;
		}
	}

	public function __set($name,$value){
		if(property_exists($this,$name)){
			$this->$name = $value;
		}
	}

}