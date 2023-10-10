<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 */

	// API
	Router::connect('/api/v1/users', array('controller' => 'ApiV1UsersGetList', 'action' => 'invoke', '[method]' => 'GET'));
	Router::connect('/api/v1/users', array('controller' => 'ApiV1UsersAdd', 'action' => 'invoke', '[method]' => 'POST'));
	Router::connect('/api/v1/users/:id', array('controller' => 'ApiV1UsersGet', 'action' => 'invoke', '[method]' => 'GET'), array('pass' => array('id'), 'id' => '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}'));

/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
	Router::connect('/', array('controller' => 'pages', 'action' => 'index'));
	Router::connect('/users', array('controller' => 'users', 'action' => 'index'));
	Router::connect('/users/login', array('controller' => 'users', 'action' => 'login'));
	Router::connect('/users/logout', array('controller' => 'users', 'action' => 'logout'));
	Router::connect('/users/add', array('controller' => 'users', 'action' => 'add'));
	Router::connect('/users/view/:id', array('controller' => 'users', 'action' => 'view'), array('pass' => array('id'), 'id' => '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}'));
	Router::connect('/users/edit/:id', array('controller' => 'users', 'action' => 'edit'), array('pass' => array('id'), 'id' => '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}'));
	Router::connect('/users/delete/:id', array('controller' => 'users', 'action' => 'delete'), array('pass' => array('id'), 'id' => '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}'));
/**
 * ...and connect the rest of 'Pages' controller's URLs.
 */
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));

	// vue を呼び出すルーティング
	Router::connect('/*', array('controller' => 'pages', 'action' => 'index'));

/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
