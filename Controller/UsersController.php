<?php
App::uses('AppScreenController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppScreenController {

/**
 * Components
 *
 * @var string[]
 */
	public $components = array('Paginator');

/**
 * beforeFilter
 *
 * @return void
 */
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('login', 'logout');
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());

		$actions = $this->__getArrowActions($this->action);
		$this->_authorize($actions);
		$this->set('arrowActions', $actions);
	}

/**
 * view method
 *
 * @param string $id id
 * @return void
 * @throws NotFoundException
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));

		$actions = $this->__getArrowActions($this->action);
		$this->_authorize($actions);
		$this->set('arrowActions', $actions);
	}

/**
 * add method
 *
 * @return CakeResponse|null|void
 */
	public function add() {
		$actions = $this->__getArrowActions($this->action);
		$this->_authorize($actions);
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The user could not be saved. Please, try again.'));
			}
		}

		$this->set('arrowActions', $actions);
	}

/**
 * edit method
 *
 * @param string $id id
 * @return CakeResponse|null|void
 * @throws NotFoundException
 */
	public function edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}

		$actions = $this->__getArrowActions($this->action);
		$this->_authorize($actions);

		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$user = $this->User->find('first', $options);
			if (is_array($user)) {
				$this->request->data = $user;
			}
		}

		$this->set('arrowActions', $actions);
	}

/**
 * delete method
 *
 * @param string $id id
 * @return CakeResponse|null|void
 * @throws NotFoundException
 */
	public function delete($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->allowMethod('post', 'delete');

		$actions = $this->__getArrowActions($this->action);
		$this->_authorize($actions);

		if ($this->User->delete($id)) {
			$this->Flash->success(__('The user has been deleted.'));
		} else {
			$this->Flash->error(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * login
 *
 * @return void
 */
	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$this->redirect($this->Auth->redirectUrl());
			} else {
				$this->Flash->error(__('Invalid username or password, try again'));
			}
		}
	}

/**
 * logout
 *
 * @return void
 */
	public function logout() {
		$this->redirect($this->Auth->logout());
	}

/**
 * getArrowActions
 *
 * @param string $selfAction アクション名
 * @return array<string>
 */
	private function __getArrowActions(string $selfAction) : array {
		$arrowPermissionTypes = $this->_getArrowPermissionTypes('user');
		$actions = [];
		foreach ($arrowPermissionTypes as $type) {
			if ($type === 'editable') {
				switch ($selfAction) {
					case 'index':
						$actions[] = 'add';
						$actions[] = 'edit';
						$actions[] = 'delete';
						break;
					case 'view':
						$actions[] = 'add';
						$actions[] = 'edit';
						$actions[] = 'delete';
						break;
					case 'add':
						$actions[] = 'add';
						break;
					case 'edit':
						$actions[] = 'edit';
						$actions[] = 'delete';
						break;
					case 'delete':
						$actions[] = 'delete';
						break;
				}
			} elseif ($type === 'referable') {
				switch ($selfAction) {
					case 'index':
						$actions[] = 'index';
						$actions[] = 'view';
						break;
					case 'view':
						$actions[] = 'index';
						$actions[] = 'view';
						break;
					case 'add':
						$actions[] = 'index';
						$actions[] = 'view';
						break;
					case 'edit':
						$actions[] = 'index';
						$actions[] = 'view';
						break;
				}
			}
		}

		return $actions;
	}
}
