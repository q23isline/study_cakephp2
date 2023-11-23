<?php
declare(strict_types = 1);

use App\ApplicationService\Users\UserDeleteApplicationService;
use App\ApplicationService\Users\UserDeleteCommand;
use App\Domain\Shared\Exception\ExceptionItem;
use App\Domain\Shared\Exception\NotFoundException;
use App\Infrastructure\CakePHP\Users\CakePHPUserRepository;

App::uses('AppController', 'Controller');
/**
 * ApiV1UsersDeleteController
 */
class ApiV1UsersDeleteController extends AppController {

/**
 * @var \App\Infrastructure\CakePHP\Users\CakePHPUserRepository
 */
	private $__userRepository;

/**
 * @var \App\ApplicationService\Users\UserDeleteApplicationService
 */
	private $__userDeleteApplicationService;

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
		$this->__userDeleteApplicationService = new UserDeleteApplicationService($this->__userRepository);
	}

/**
 * invoke method
 *
 * @param string $id ID
 * @return void
 * @throws NotFoundException
 */
	public function invoke(string $id) : void {
		$command = new UserDeleteCommand($id);

		try {
			$this->__userDeleteApplicationService->handle($command);
		} catch (\NotFoundException $e) {
			$error = new NotFoundException([new ExceptionItem('userId', 'ユーザーは存在しません。')]);
			$response = $error->format();

			$this->response->statusCode(404);
			$this->response->body((string)json_encode($response));
		}
	}
}
