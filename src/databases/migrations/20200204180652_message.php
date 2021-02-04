<?php
//+---------------------------------------------------------------------------------------------------------------------
//| 人生是荒芜的旅行，冷暖自知，苦乐在心
//+---------------------------------------------------------------------------------------------------------------------
//| Author:Janmas <janmas@126.com>
//+---------------------------------------------------------------------------------------------------------------------
//| 
//+---------------------------------------------------------------------------------------------------------------------

class Message extends \think\migration\Migrator{
	public function change(){
		// create the table
		$table  =  $this->table('message',array('engine'=>'InnoDB','primary_key'=>['id']));
		$table->addColumn('title', 'string',array('limit'  =>  50,'default'=>'','comment'=>'消息标题'))
			->addColumn('content', 'text',array('limit'  =>  0,'default'=>'','comment'=>'消息内容'))
			->addColumn('extra', 'string',array('limit'  =>  '0','default'=>'','comment'=>'消息扩展内容（订单的json序列化数据）'))
			->addColumn('created_at', 'int',array('limit'  =>  '0','default'=>date('Y-m-d H:i:s'),'comment'=>'用户id'))
			->addColumn('extra', 'string',array('limit'  =>  '0','default'=>'','comment'=>'消息扩展内容（订单的json序列化数据）'))
			->addColumn('extra', 'string',array('limit'  =>  '0','default'=>'','comment'=>'消息扩展内容（订单的json序列化数据）'))
			->addColumn('extra', 'string',array('limit'  =>  '0','default'=>'','comment'=>'消息扩展内容（订单的json序列化数据）'))
			->addColumn('extra', 'string',array('limit'  =>  '0','default'=>'','comment'=>'消息扩展内容（订单的json序列化数据）'))
			->create();
	}
}