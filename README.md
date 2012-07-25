METAS PLUGIN 
===========

This plugin helps you to configure your meta tags.

It automatically generates the meta tag title and a slug for a created content.
The others meta tags are configurable.



Installation
------------

### Copy files

#### Git

	git submodule add git://... plugins/metas
	git submodule init
	git submodule update

#### Manual

Download the archive, copy the "metas" folder to your "app/plugins" folder

## Database Schema

Add the Metas table to your database with Bake.

cake schema create Metas.Metas

### Model

Add the behavior Metas to your model as usual, with fields associed to metas (name) and slug (title) :


	//In model
	public $actsAs = array(
		'Metas.Metas' => array(
			'title_field' => 'name',
			'slug_field' => 'title'
		)
	);

### View

Add the element form of the plugin to your view.

Example :
	
	echo $this->element('Metas.form');
	

Requirements
------------

- PHP 5.2
- CakePHP 2


Todo
----

- Automatic metatags setting

