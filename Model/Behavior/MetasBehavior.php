<?php

class MetasBehavior extends ModelBehavior {
	

	public function setup(Model $Model, $settings = array()) {
		if (!isset($this->settings[$Model->alias])) {
			$displayField = isset($Model->displayField) && !empty($Model->displayField) ? $Model->displayField : null;
			$this->settings[$Model->alias] = array(
				'title_field' => $displayField,
				'slug_field' => $displayField
			);
		}
		
		$this->settings[$Model->alias] = array_merge($this->settings[$Model->alias], $settings);
		if(
			!$this->settings[$Model->alias]['title_field']
			|| !$this->settings[$Model->alias]['slug_field']
		){
			trigger_error(__d('Metas', 'Metas behavior is not correctly set up.'), E_USER_ERROR);
		}

		$Model->bindModel(array(
			'hasOne' => array(
				'Meta' => array(
					'className' => 'Metas.Meta',
					'foreignKey' => 'foreign_key',
					'conditions' => array(
						'Meta.model' => $Model->alias
					),
					'dependent' => true
				)
			)
		), false);
	}
	
	public function beforeValidate(Model $Model){
		$alias = $Model->alias;
		$primaryKey = $Model->primaryKey;
		$titleField = $this->settings[$alias]['title_field'];
		$slugField = $this->settings[$alias]['slug_field'];
		$update = isset($Model->data[$alias][$primaryKey]) && !empty($Model->data[$alias][$primaryKey]);
		if(!$update){
			if(
				(
					!isset($Model->data[$alias][$titleField])
					|| empty($Model->data[$alias][$titleField])
				)
				&& (
					!isset($Model->data['Meta'])
					|| !isset($Model->data['Meta']['title'])
					|| empty($Model->data['Meta']['title'])
				)
			){
				$Model->invalidate($titleField, __d('Metas', 'Field "%s" is required to generate metas', $titleField));
				return false;
			}
			if(
				(
					!isset($Model->data[$alias][$slugField])
					|| empty($Model->data[$alias][$slugField])
				)
				&& (
					!isset($Model->data['Meta'])
					|| !isset($Model->data['Meta']['slug'])
					|| empty($Model->data['Meta']['slug'])
				)
			){
				$Model->invalidate($slugField, __d('Metas', 'Field "%s" is required to generate metas', $slugField));
				return false;
			}
		}
		return true;
	}
	
	public function afterSave(Model $Model, $created) {
		$alias = $Model->alias;
		$primaryKey = $Model->primaryKey;
		if($created){
			$title = isset($Model->data['Meta']['title']) && !empty($Model->data['Meta']['title']) ? $Model->data['Meta']['title'] : $Model->field($this->settings[$Model->alias]['title_field']);
			$slug = isset($Model->data['Meta']['slug']) && !empty($Model->data['Meta']['slug']) ? Inflector::slug($Model->data['Meta']['slug']) : Inflector::slug($Model->field($this->settings[$Model->alias]['slug_field']));
			$data = array(
				'Meta' => array(
					'model' => $Model->alias,
					'foreign_key' => $Model->id,
					'title' => $title,
					'slug' => $slug,
					'description' => isset($Model->data['Meta']['description']) ? $Model->data['Meta']['description'] : null,
					'keywords' => isset($Model->data['Meta']['keywords']) ? $Model->data['Meta']['keywords'] : null
				)
			);
			$Model->Meta->create($data);
			if(
				!$Model->Meta->validates()
				|| !$Model->Meta->save()
			){
				return false;
			}

		}
		else {
			$data = $Model->Meta->find('first', array(
				'conditions' => array(
					'Meta.model' => $Model->alias,
					'Meta.foreign_key' => $Model->id
				)
			));
			if(empty($data)){
				trigger_error(__d('Metas', 'This record has no Metas attached'), E_USER_ERROR);
			}


			$data['Meta']['title'] = isset($Model->data['Meta']['title']) && !empty($Model->data['Meta']['title']) ? $Model->data['Meta']['title'] : $Model->field($this->settings[$Model->alias]['title_field']);
			$data['Meta']['slug'] = isset($Model->data['Meta']['slug']) && !empty($Model->data['Meta']['slug']) ? Inflector::slug($Model->data['Meta']['slug']) : Inflector::slug($Model->field($this->settings[$Model->alias]['slug_field']));
			
			
			if(isset($Model->data['Meta']['keywords'])){
				$data['Meta']['keywords'] = $Model->data['Meta']['keywords'];
			}
			if(isset($Model->data['Meta']['description'])){
				$data['Meta']['description'] = $Model->data['Meta']['description'];
			}
			
			if(!$Model->Meta->save($data)){
				trigger_error(__d('Metas', 'Unable to update model metas'), E_USER_ERROR);
			}
		}
		return true;
	}
	
}