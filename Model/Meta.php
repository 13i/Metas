<?php

App::uses('Metas/MetasAppModel', 'Model');

class Meta extends MetasAppModel {
	
	
	public $validate = array(
		'model' => array(
			'required' => array(
				'rule' => 'notempty',
				'required' => true,
				'message' => 'Ce champs est requis.'
			),
			'maxlength' => array (	
				'rule' => array('maxlength', 255),
				'message' => 'Le nombre maximum de caractères autorisés est de 255.'
			)
		),
		'foreign_key' => array(
			'required' => array(
				'rule' => 'notempty',
				'required' => true,
				'message' => 'Ce champs est requis.'
			),
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Ce champs doit être un nombre.'			
			),
			'maxlength' => array (	
				'rule' => array('maxlength', 10),
				'message' => 'Le nombre maximum de caractères autorisés est de 10.'
			)
		),
		'title' => array(
			'maxlength' => array (	
				'rule' => array('maxlength', 160),
				'allowEmpty' => true,
				'message' => 'Le nombre maximum de caractères autorisés est de 160.'
			)
		),
		'description' => array(
			'maxlength' => array (	
				'rule' => array('maxlength', 160),
				'allowEmpty' => true,
				'message' => 'Le nombre maximum de caractères autorisés est de 160.'
			)
		),
		'keywords' => array(
			'maxlength' => array (	
				'rule' => array('maxlength', 160),
				'allowEmpty' => true,
				'message' => 'Le nombre maximum de caractères autorisés est de 160.'
			)
		),
		'slug' => array(
			'maxlength' => array (	
				'rule' => array('maxlength', 255),
				'allowEmpty' => true,
				'message' => 'Le nombre maximum de caractères autorisés est de 255.'
			)
		),
	);
}
