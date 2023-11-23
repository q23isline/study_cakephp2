<?php
declare(strict_types = 1);
use App\ApplicationService\Users\UserListApplicationService;
use App\ApplicationService\Users\UserListCommand;
use App\ApplicationService\Users\UserListResult;
use App\Domain\Shared\Exception\ValidateException;
use App\Infrastructure\CakePHP\Users\CakePHPUserRepository;

App::uses('AppController', 'Controller');
/**
 * ApiV1UsersGetListController
 */
class ApiV1UsersGetListController extends AppController {

/**
 * @var \App\Infrastructure\CakePHP\Users\CakePHPUserRepository
 */
	private $__userRepository;

/**
 * @var \App\ApplicationService\Users\UserListApplicationService
 */
	private $__userListApplicationService;

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
		$this->__userListApplicationService = new UserListApplicationService($this->__userRepository);
	}

/**
 * invoke method
 *
 * @return void
 */
	public function invoke() : void {
		$page = (int)($this->request->query('page') ?? 1);
		$pageSize = (int)($this->request->query('pageSize') ?? 10);
		$sort = $this->request->query('sort') ?? '+username';

		$command = new UserListCommand($page, $pageSize, $sort);

		try {
			$serviceResult = $this->__userListApplicationService->handle($command);
			$meta = $serviceResult[0];
			$data = $serviceResult[1];
			$result = new UserListResult($meta, $data);
			$response = $result->format();
			$this->response->body((string)json_encode($response));
		} catch (ValidateException $e) {
			$response = $e->format();

			$this->response->statusCode(400);
			$this->response->body((string)json_encode($response));
		}
	}
}
