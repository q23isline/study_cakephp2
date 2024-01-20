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

			<div class="users index">
				<h2><?php echo __('ユーザー一覧'); ?></h2>
				<table cellpadding="0" cellspacing="0">
				<thead>
				<tr>
						<th><?php echo $this->Paginator->sort('id', 'ID'); ?></th>
						<th><?php echo $this->Paginator->sort('username', 'アカウント名'); ?></th>
						<th><?php echo $this->Paginator->sort('role_name', '権限'); ?></th>
						<th><?php echo $this->Paginator->sort('name', '氏名'); ?></th>
						<th><?php echo $this->Paginator->sort('created', '作成日'); ?></th>
						<th><?php echo $this->Paginator->sort('modified', '更新日'); ?></th>
						<th class="actions"></th>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($users as $user): ?>
				<tr>
					<td><?php echo h($user['User']['id']); ?>&nbsp;</td>
					<td><?php echo h($user['User']['username']); ?>&nbsp;</td>
					<td><?php echo h($user['User']['role_name']); ?>&nbsp;</td>
					<td><?php echo h($user['User']['name']); ?>&nbsp;</td>
					<td><?php echo h($user['User']['created']); ?>&nbsp;</td>
					<td><?php echo h($user['User']['modified']); ?>&nbsp;</td>
					<td class="actions">
						<?php if (in_array('view', $arrowActions, true)) : ?>
							<?php echo $this->Html->link(__('詳細'), array('action' => 'view', $user['User']['id'])); ?>
						<?php endif ?>
						<?php if (in_array('edit', $arrowActions, true)) : ?>
							<?php echo $this->Html->link(__('編集'), array('action' => 'edit', $user['User']['id'])); ?>
						<?php endif ?>
						<?php if (in_array('delete', $arrowActions, true)) : ?>
							<?php echo $this->Form->postLink(__('削除'), array('action' => 'delete', $user['User']['id']), array('confirm' => __('削除してもよろしいですか？ ID: %s?', $user['User']['id']))); ?>
						<?php endif ?>
					</td>
				</tr>
			<?php endforeach; ?>
				</tbody>
				</table>
				<p>
				<?php
				echo $this->Paginator->counter(array(
					'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
				));
				?>	</p>
				<div class="paging">
				<?php
					echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
					echo $this->Paginator->numbers(array('separator' => ''));
					echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
				?>
				</div>
			</div>
			<div class="actions">
				<h3><?php echo __('メニュー'); ?></h3>
				<ul>
					<?php if (in_array('add', $arrowActions, true)) : ?>
						<li><?php echo $this->Html->link(__('追加'), array('action' => 'add')); ?></li>
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
