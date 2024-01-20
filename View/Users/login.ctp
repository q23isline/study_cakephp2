<?php
/**
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @var \View $this
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
		echo $this->Html->css('header');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<div class="header-inner">
				<h1 class="header-logo"><?php echo $this->Html->link($cakeDescription, 'https://cakephp.org'); ?></h1>
				<?php if (isset($loginUserId) && !empty($loginUserId)) : ?>
					<div class="menu-icons">
						<span><?php echo $this->Html->link('ログアウト', '/users/logout'); ?></span>
						<div class="menu-icon profile-icon"><?php echo mb_substr($loginUserName, 0, 1) ?></div>
						<span><?php echo $loginUserName ?></span>
					</div>
				<?php endif ?>
			</div>
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<div class="users form">
			<?php echo $this->Flash->render('auth'); ?>
			<?php echo $this->Form->create('User'); ?>
				<fieldset>
					<legend>
						<?php echo __('Please enter your username and password'); ?>
					</legend>
					<?php echo $this->Form->input('username');
					echo $this->Form->input('password');
				?>
				</fieldset>
			<?php echo $this->Form->end(__('Login')); ?>
			</div>
		</div>
		<div id="footer">
			<?php echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
					'https://cakephp.org/',
					array('target' => '_blank', 'escape' => false)
				);
			?>
		</div>
	</div>
</body>
</html>
