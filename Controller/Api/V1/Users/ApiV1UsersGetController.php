<?php
declare(strict_types = 1);

use App\ApplicationService\Users\UserGetApplicationService;
use App\ApplicationService\Users\UserGetCommand;
use App\ApplicationService\Users\UserGetResult;
use App\Domain\Shared\Exception\ExceptionItem;
use App\Domain\Shared\Exception\NotFoundException;
use App\Infrastructure\CakePHP\Users\CakePHPUserRepository;

App::uses('AppController', 'Controller');
/**
 * ApiV1UsersGetController
 */
class ApiV1UsersGetController extends AppController {

/**
 * @var \App\Infrastructure\CakePHP\Users\CakePHPUserRepository
 */
	private $__userRepository;

/**
 * @var \App\ApplicationService\Users\UserGetApplicationService
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
		$this->__userGetApplicationService = new UserGetApplicationService($this->__userRepository);
	}

/**
 * invoke method
 *
 * @param string $id ID
 * @return void
 * @throws \NotFoundException
 */
	public function invoke(string $id) : void {
		$command = new UserGetCommand($id);

		try {
			$userData = $this->__userGetApplicationService->handle($command);
			$result = new UserGetResult($userData);
			$response = $result->format();

			$this->response->body((string)json_encode($response));
		} catch (\NotFoundException $e) {
			$error = new NotFoundException([new ExceptionItem('userId', 'ユーザーは存在しません。')]);
			$response = $error->format();

			$this->response->statusCode(400);
			$this->response->body((string)json_encode($response));
		}
	}
}
