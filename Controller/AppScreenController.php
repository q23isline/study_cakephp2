<?php

App::uses('Controller', 'Controller');

/**
 * AppScreenController
 */
class AppScreenController extends AppController {

/**
 * beforeFilter
 *
 * @return void
 */
	public function beforeFilter() {
		parent::beforeFilter();
		$this->__setRenderLoginUser();
	}

/**
 * getArrowPermissionTypes
 *
 * @param string $key 機能キー名
 * @return array<string>
 */
	protected function _getArrowPermissionTypes(string $key) : array {
		$user = $this->__getLoginUser();

		/** @var Menu $model */
		$model = ClassRegistry::init('Menu');
		$query = [
			'conditions' => [
				'key' => $key,
				'role_name' => $user['roleName'] ?? null,
			],
		];
		$records = $model->find('all', $query);
		if (!is_array($records)) {
			return [];
		}

		$results = [];
		foreach ($records as $record) {
			$results[] = $record['Menu']['permission_type'];
		}

		return $results;
	}

/**
 * __authorize
 *
 * @param array<string> $arrowActions arrowActions
 * @return void
 * @throws NotFoundException
 */
	protected function _authorize(array $arrowActions) : void {
		if (!in_array($this->action, $arrowActions, true)) {
			throw new NotFoundException('Forbidden.');
		}
	}

/**
 * getLoginUser method
 *
 * @return array<string,mixed>
 */
	private function __getLoginUser() : array {
		$id = $this->Auth->user('id');

		/** @var User $model */
		$model = ClassRegistry::init('User');
		$options = ['conditions' => ['User.' . $model->primaryKey => $id]];
		$user = $model->find('first', $options);

		$result = [];
		if (is_array($user) && !empty($user)) {
			$result = [
				'id' => $user['User']['id'],
				'name' => $user['User']['name'],
				'roleName' => $user['User']['role_name'],
			];
		}

		return $result;
	}

/**
 * getLoginUser method
 *
 * @return void
 */
	private function __setRenderLoginUser() : void {
		$user = $this->__getLoginUser();
		$this->set('loginUserId', $user['id'] ?? '');
		$this->set('loginUserName', $user['name'] ?? '');
	}
}
