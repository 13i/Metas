<?php

// cake schema create metas.metas

class MetasSchema extends CakeSchema {
	
	public $metas = array(
		'id' =>  array('type' => 'integer', 'length' => 11, 'null' => false, 'key' => 'primary'),
		'model' => array('type' => 'string', 'length' => 255, 'null' => false, 'key' => 'index'),
		'foreign_key' => array('type' => 'integer', 'null' => false, 'length' => 10, 'key' => 'index'),
		'title' =>  array('type' => 'string', 'length' => 160, 'null' => false),
		'description' =>  array('type' => 'string', 'length' => 160, 'null' => true, 'default' => null),
		'keywords' =>  array('type' => 'string', 'length' => 160, 'null' => true, 'default' => null),
		'slug' =>  array('type' => 'string', 'length' => 255, 'null' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1), 
			'model' => array('column' => 'model', 'unique' => 0), 
			'row_id' => array('column' => 'foreign_key', 'unique' => 0)
		)
	);
	
}
