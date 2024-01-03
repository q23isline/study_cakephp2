<?php
declare(strict_types = 1);

use App\ApplicationService\Users\MyselfGetApplicationService;
use App\ApplicationService\Users\UserGetResult;
use App\Infrastructure\CakePHP\Users\CakePHPUserRepository;

App::uses('AppController', 'Controller');
/**
 * ApiV1MyselfGetController
 */
class ApiV1MyselfGetController extends AppController {

/**
 * @var \App\Infrastructure\CakePHP\Users\CakePHPUserRepository
 */
	private $__userRepository;

/**
 * @var \App\ApplicationService\Users\MyselfGetApplicationService
 */
	private $__userGetApplicationService;

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

		$this->__userRepository = new CakePHPUserRepository();
		$this->__userGetApplicationService = new MyselfGetApplicationService($this->__userRepository);
	}

/**
 * invoke method
 *
 * @return void
 */
	public function invoke() : void {
		$userData = $this->__userGetApplicationService->handle();
		$result = new UserGetResult($userData);
		$response = $result->format();

		$this->response->body((string)json_encode($response));
	}
}
