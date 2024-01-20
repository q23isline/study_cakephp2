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

	<style>
	#nav {
		text-align: center;
		padding: 30px;
	}

	#nav a {
		font-weight: bold;
		color: #2c3e50;
	}
	</style>
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
						<span><?php echo $this->Html->link($loginUserName, "/users/view/{$loginUserId}"); ?></span>
					</div>
				<?php endif ?>
			</div>
		</div>
		<div id="content">
			<div id="nav">
				<a href="/" class="router-link-active">Home</a> |
				<a href="/about" class="">About</a> |
				<a href="/v1/users" class="router-link-exact-active router-link-active" aria-current="page">Vue Users</a> |
				<a href="/users">CakePHP Users</a>
			</div>

			<?php echo $this->Session->flash(); ?>

			<div class="users form">
			<?php echo $this->Form->create('User'); ?>
				<fieldset>
					<legend><?php echo __('ユーザー編集'); ?></legend>
				<?php
					echo $this->Form->input('id', ['label' => 'ID']);
					echo $this->Form->input('username', ['label' => 'アカウント名']);
					echo $this->Form->input('password', ['label' => 'パスワード']);
					echo $this->Form->input('role_name', [
						'label' => '権限',
						'options' => array('admin' => 'Admin', 'author' => 'Author'),
					]);
					echo $this->Form->input('name', ['label' => '氏名']);
				?>
				</fieldset>
			<?php echo $this->Form->end(__('更新')); ?>
			</div>
			<div class="actions">
				<h3><?php echo __('メニュー'); ?></h3>
				<ul>
					<?php if (in_array('index', $arrowActions, true)) : ?>
						<li><?php echo $this->Html->link(__('一覧'), array('action' => 'index')); ?></li>
					<?php endif ?>
					<?php if (in_array('delete', $arrowActions, true)) : ?>
						<li><?php echo $this->Form->postLink(__('削除'), array('action' => 'delete', $this->Form->value('User.id')), array('confirm' => __('削除してもよろしいですか？ ID: %s?', $this->Form->value('User.id')))); ?></li>
					<?php endif ?>
				</ul>
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
