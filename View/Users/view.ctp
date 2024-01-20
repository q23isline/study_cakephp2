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

			<div class="users view">
			<h2><?php echo __('ユーザー詳細'); ?></h2>
				<dl>
					<dt><?php echo __('ID'); ?></dt>
					<dd>
						<?php echo h($user['User']['id']); ?>
						&nbsp;
					</dd>
					<dt><?php echo __('アカウント名'); ?></dt>
					<dd>
						<?php echo h($user['User']['username']); ?>
						&nbsp;
					</dd>
					<dt><?php echo __('権限'); ?></dt>
					<dd>
						<?php echo h($user['User']['role_name']); ?>
						&nbsp;
					</dd>
					<dt><?php echo __('氏名'); ?></dt>
					<dd>
						<?php echo h($user['User']['name']); ?>
						&nbsp;
					</dd>
					<dt><?php echo __('作成日'); ?></dt>
					<dd>
						<?php echo h($user['User']['created']); ?>
						&nbsp;
					</dd>
					<dt><?php echo __('更新日'); ?></dt>
					<dd>
						<?php echo h($user['User']['modified']); ?>
						&nbsp;
					</dd>
				</dl>
			</div>
			<div class="actions">
				<h3><?php echo __('メニュー'); ?></h3>
				<ul>
					<?php if (in_array('index', $arrowActions, true)) : ?>
						<li><?php echo $this->Html->link(__('一覧'), array('action' => 'index')); ?></li>
					<?php endif ?>
					<?php if (in_array('edit', $arrowActions, true)) : ?>
						<li><?php echo $this->Html->link(__('編集'), array('action' => 'edit', $user['User']['id'])); ?> </li>
					<?php endif ?>
					<?php if (in_array('delete', $arrowActions, true)) : ?>
						<li><?php echo $this->Form->postLink(__('削除'), array('action' => 'delete', $user['User']['id']), array('confirm' => __('削除してもよろしいですか？ ID: %s?', $user['User']['id']))); ?> </li>
					<?php endif ?>
					<?php if (in_array('add', $arrowActions, true)) : ?>
						<li><?php echo $this->Html->link(__('追加'), array('action' => 'add')); ?> </li>
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
