<?php
//+---------------------------------------------------------------------------------------------------------------------
//| 人生是荒芜的旅行，冷暖自知，苦乐在心
//+---------------------------------------------------------------------------------------------------------------------
//| Author:Janmas <janmas@126.com>
//+---------------------------------------------------------------------------------------------------------------------
//| 
//+---------------------------------------------------------------------------------------------------------------------

include_once '../vendor/autoload.php';

$data = [
	'id' => 1,
	'phone' => '15890161317',
	'email' => 'janmas@162.com',
	'nickname' => 'janmas',
	'code' => '123456',
	'subject' => '测试邮件',
	'body' => '这个邮件发给您',
	'file' => '',
	'scene' => 1,
];
$user = new \Janmas\Message\Util\UserSms($data);

$config = \Janmas\Message\Model\Config::instance();
$messageService = \Janmas\Message\Services\Message::instance($config);
$messageService->send($user,'zse');
