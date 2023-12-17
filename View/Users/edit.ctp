<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Edit User'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('username');
		echo $this->Form->input('password');
		echo $this->Form->input('role_name', [
			'options' => array('admin' => 'Admin', 'author' => 'Author'),
		]);
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<?php if (in_array('index', $arrowActions, true)) : ?>
			<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?></li>
		<?php elseif (in_array('delete', $arrowActions, true)) : ?>
			<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('User.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('User.id')))); ?></li>
		<?php endif ?>
	</ul>
</div>
