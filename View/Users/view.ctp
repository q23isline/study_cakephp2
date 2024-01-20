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
						<div class="menu-icon">
							<svg
								class="setting-icon"
								view-box="0 0 33 33"
								xmlns="http://www.w3.org/2000/svg"
							>
								<path
									d="M28.0778 18.2988L28.0428 18.5824L28.2694 18.7565L31.7049 21.3965L31.7048 21.3966L31.715 21.4041C31.8279 21.4864 31.866 21.6208 31.7828 21.769L28.4939 27.3047L28.4938 27.3046L28.4896 27.312C28.4109 27.4497 28.2434 27.5083 28.0945 27.4531L24.0039 25.8544L23.7476 25.7542L23.5258 25.9172C22.7111 26.516 21.8225 27.0335 20.8603 27.4153L20.5916 27.5219L20.5499 27.808L19.9328 32.048L19.9312 32.0584L19.9302 32.0689C19.9188 32.1795 19.8165 32.3 19.6252 32.3H13.0422C12.881 32.3 12.7513 32.2005 12.7117 32.0309L12.097 27.808L12.0553 27.5219L11.7866 27.4153C10.8229 27.0329 9.9554 26.5351 9.1226 25.9183L8.90046 25.7537L8.64298 25.8544L4.56544 27.448C4.38522 27.5013 4.22449 27.4296 4.15728 27.312L4.15734 27.3119L4.15301 27.3047L0.867437 21.7746C0.799787 21.6431 0.837805 21.479 0.9427 21.396L4.4164 18.7583L4.6563 18.5761L4.60739 18.2789C4.52987 17.8079 4.49059 17.2951 4.49059 16.8C4.49059 16.317 4.54817 15.8061 4.62796 15.3212L4.67688 15.024L4.43698 14.8418L0.960322 12.2018L0.960379 12.2018L0.952526 12.196C0.839583 12.1137 0.801523 11.9793 0.884651 11.8311L4.17359 6.29544L4.17365 6.29548L4.17785 6.28812C4.25654 6.15042 4.42408 6.0918 4.57291 6.14698L8.66356 7.74574L8.91992 7.84594L9.1417 7.68292C9.95638 7.08407 10.8449 6.56663 11.8072 6.1848L12.0759 6.07816L12.1176 5.79207L12.7343 1.55463C12.7583 1.40389 12.8735 1.30005 13.0422 1.30005H19.6252C19.8096 1.30005 19.9319 1.41873 19.9537 1.55471C19.9538 1.55523 19.9539 1.55576 19.954 1.55629L20.5705 5.79207L20.6121 6.07816L20.8809 6.1848C21.8446 6.56723 22.7121 7.06496 23.5449 7.68183L23.767 7.84637L24.0245 7.74574L28.102 6.1521C28.2823 6.09883 28.443 6.17051 28.5102 6.28812L28.5101 6.28816L28.5145 6.29544L31.8 11.8255C31.8677 11.957 31.8297 12.121 31.7249 12.204L28.2511 14.8418L28.0112 15.024L28.0601 15.3212C28.1377 15.7927 28.1769 16.2855 28.1769 16.8C28.1769 17.3147 28.1377 17.8137 28.0778 18.2988ZM9.66217 16.8C9.66217 20.3894 12.6766 23.3 16.3337 23.3C19.9909 23.3 23.0053 20.3894 23.0053 16.8C23.0053 13.2107 19.9909 10.3 16.3337 10.3C12.6766 10.3 9.66217 13.2107 9.66217 16.8Z"
									fill="white"
									stroke="black"
								/>
							</svg>
						</div>
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
