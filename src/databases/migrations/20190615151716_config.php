<?php
//+---------------------------------------------------------------------------------------------------------------------
//| 人生是荒芜的旅行，冷暖自知，苦乐在心
//+---------------------------------------------------------------------------------------------------------------------
//| Author:Janmas <janmas@126.com>
//+---------------------------------------------------------------------------------------------------------------------
//| 
//+---------------------------------------------------------------------------------------------------------------------


use think\migration\Migrator;
use think\migration\db\Column;

class Config extends \think\migration\command\Migrate
{
	public  function  change()
	{
		// create the table
		$table  =  $this->table('message_extra_config',array('engine'=>'InnoDB','primary_key'=>['id']));
		$table->addColumn('driver', 'string',array('limit'  =>  32,'default'=>'','comment'=>'组名'))
			->addColumn('key', 'string',array('limit'  =>  15,'default'=>'','comment'=>'配置名'))
			->addColumn('value', 'text',array('limit'  =>  0,'default'=>'','comment'=>'配置值'))
			->addColumn('created_at', 'string',array('limit'  =>  '0','default'=>date('Y-m-d H:i:s'),'comment'=>'创建时间'))
			->addIndex(array('driver'), array('NORMAL'  =>  true))
			->addIndex(array('key'), array('NORMAL'  =>  true))
			->create();
	}

}