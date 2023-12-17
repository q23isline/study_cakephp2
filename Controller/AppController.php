<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		https://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	/** @var mixed[] $components */
	public $components = array(
		'DebugKit.Toolbar',
		'Flash',
		'Auth' => array(
			'loginRedirect' => array(
				'controller' => 'pages',
				'action' => 'index',
			),
			'logoutRedirect' => array(
				'controller' => 'users',
				'action' => 'login',
			),
			'authenticate' => array(
				'Form' => array(
					'passwordHasher' => 'Blowfish',
				),
			),
		),
	);

/**
 * beforeFilter
 *
 * @return void
 */
	public function beforeFilter() {
		parent::beforeFilter();
		$this->__getLoginUser();
	}

/**
 * getLoginUser method
 *
 * @return void
 */
	private function __getLoginUser() : void {
		$id = $this->Auth->user('id');
		$this->set('loginUserId', $id);

		/** @var User $model */
		$model = ClassRegistry::init('User');
		$options = ['conditions' => ['User.' . $model->primaryKey => $id]];
		$user = $model->find('first', $options);

		$userName = '';
		if (is_array($user)) {
			$userName = $user['User']['name'] ?? '';
		}

		$this->set('loginUserName', $userName);
	}
}
