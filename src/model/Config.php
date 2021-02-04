<?php
//+---------------------------------------------------------------------------------------------------------------------
//| 人生是荒芜的旅行，冷暖自知，苦乐在心
//+---------------------------------------------------------------------------------------------------------------------
//| Author:Janmas <janmas@126.com>
//+---------------------------------------------------------------------------------------------------------------------
//| 
//+---------------------------------------------------------------------------------------------------------------------


namespace Janmas\Message\Model;


class Config extends \think\Model
{
	protected $name = 'message_extra_config';

	protected $schema = [
		'id'         => 'int',
		'driver'     => 'string',
		'key'        => 'string',
		'value'      => 'string',
		'created_at' => 'string',
	];
	public static $instance;

	public static function instance(){
		if(!self::$instance instanceof self){
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function getDriver($driver=''){
		return self::where('driver',$driver)->column('value','key');
	}

	public function getOne($key){
		return self::where('key',$key)->value('value');
	}
}