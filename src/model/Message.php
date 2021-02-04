<?php
//+---------------------------------------------------------------------------------------------------------------------
//| 人生是荒芜的旅行，冷暖自知，苦乐在心
//+---------------------------------------------------------------------------------------------------------------------
//| Author:Janmas <janmas@126.com>
//+---------------------------------------------------------------------------------------------------------------------
//| 
//+---------------------------------------------------------------------------------------------------------------------


namespace Janmas\Message\Model;

use think\Model;

/**
 * 用户消息模型（除了站内信需要读，其他场景直接已读）
 * @package Janmas\Message\Model
 */
class Message extends Model
{
	protected $name = 'message';

	protected $schema = [
		'id' => 'int',
		'title' => 'string',
		'content' => 'string',//
		'extra' => 'string', //扩展参数  比如json序列化的订单信息
		'created_at' => 'string',//2021-02-03 00:00:00,
		'user_id' => 'int',
		'scene' => 'int',//场景值 1系统消息 2订单消息 3客服消息 4等等。。。
		'is_read' => 'int',//是否已读
		'read_time' => 'string', //读取时间 2020-09-25 00:00:00
	];


}