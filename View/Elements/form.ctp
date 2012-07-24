
<fieldset>
	<legend><?php echo __d('Metas', 'Meta Tags'); ?></legend>
	<?php
	echo $this->Form->input('Meta.title', array(
		'label' => __d('Metas', 'Title'),
		'required' => false
	));
	echo $this->Form->input('Meta.description', array(
		'label' => __d('Metas', 'Description')
	));
	echo $this->Form->input('Meta.keywords', array(
		'label' => __d('Metas', 'Keywords')
	));
	echo $this->Form->input('Meta.slug', array(
		'label' => __d('Metas', 'Slug'),
		'required' => false
	));
	?>
</fieldset>
