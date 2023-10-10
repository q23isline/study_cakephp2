<?php
declare(strict_types = 1);
App::uses('AppController', 'Controller');
/**
 * ApiV1UsersGetController
 *
 * @property User $User
 */
class ApiV1UsersGetController extends AppController {

/**
 * This controller does not use a model
 *
 * @var string[]
 */
	public $uses = ['User'];

/**
 * beforeFilter
 *
 * @return void
 */
	public function beforeFilter() : void {
		parent::beforeFilter();
		$this->autoRender = false;
		$this->autoLayout = false;
		$this->response->type('json');
	}

/**
 * invoke method
 *
 * @param string $id ID
 * @return void
 * @throws NotFoundException
 */
	public function invoke(string $id) : void {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}

		$user = $this->__findUserById($id);

		$result = [
			'data' => $user,
		];

		$this->response->body((string)json_encode($result));
	}

/**
 * ユーザー取得
 *
 * @param string $id ID
 * @return array<string,mixed>
 */
	private function __findUserById(string $id) : array {
		$user = $this->User->find('first', [
			'conditions' => [
				'User.' . $this->User->primaryKey => $id,
			],
		]);

		$result = [];
		if (is_array($user)) {
			$result = [
				'id' => $user['User']['id'],
				'username' => $user['User']['username'],
				'password' => $user['User']['password'],
				'roleName' => $user['User']['role_name'],
				'name' => $user['User']['name'],
				'created' => $user['User']['created'],
				'modified' => $user['User']['modified'],
			];
		}

		return $result;
	}
}
