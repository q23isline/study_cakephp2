<?php
declare(strict_types = 1);
App::uses('AppController', 'Controller');
/**
 * ApiV1UsersDeleteController
 *
 * @property User $User
 */
class ApiV1UsersDeleteController extends AppController {

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

		$this->User->delete($id);
	}
}
