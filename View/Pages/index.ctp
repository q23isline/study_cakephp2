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
		echo $this->Html->css('content');
		echo $this->Html->css('header');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	<link href="/css/index.css" rel="preload" as="style">
	<link href="/js/about.js" rel="preload" as="script">
	<link href="/js/chunk-vendors.js" rel="preload" as="script">
	<link href="/js/index.js" rel="preload" as="script">
	<link href="/css/index.css" rel="stylesheet">
</head>
<body>
	<div id="app">
	</div>
	<?= $this->Html->script('/js/about.js') ?>
	<?= $this->Html->script('/js/chunk-vendors.js') ?>
	<?= $this->Html->script('/js/index.js') ?>
</body>
</html>
