<?php
declare(strict_types = 1);

use App\ApplicationService\Users\UserAddApplicationService;
use App\ApplicationService\Users\UserAddCommand;
use App\Domain\Services\UserService;
use App\Domain\Shared\Exception\ExceptionItem;
use App\Domain\Shared\Exception\ValidateException;
use App\Infrastructure\CakePHP\Users\CakePHPUserRepository;

App::uses('AppController', 'Controller');
/**
 * ApiV1UsersAddController
 */
class ApiV1UsersAddController extends AppController {

/**
 * @var \App\Infrastructure\CakePHP\Users\CakePHPUserRepository
 */
	private $__userRepository;

/**
 * @var \App\Domain\Services\UserService
 */
	private $__userService;

/**
 * @var \App\ApplicationService\Users\UserAddApplicationService
 */
	private $__userAddApplicationService;

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
		$this->__userService = new UserService($this->__userRepository);
		$this->__userAddApplicationService = new UserAddApplicationService($this->__userRepository, $this->__userService);
	}

/**
 * invoke method
 *
 * @return void
 */
	public function invoke() : void {
		// リクエストボディは raw 想定
		// raw だと $this->request->data; ではリクエストパラメータが取得できないため、 input() で取得する
		// https://book.cakephp.org/2/ja/controllers/request-response.html#xml-json
		$jsonData = $this->request->input('json_decode', true);
		if ($jsonData === null) {
			$error = new ValidateException([new ExceptionItem('', '不正なパラメータです。')]);
			$response = $error->format();

			$this->response->statusCode(400);
			$this->response->body((string)json_encode($response));

			return;
		}

		$command = new UserAddCommand(
			$jsonData['username'] ?? null,
			$jsonData['password'] ?? null,
			$jsonData['roleName'] ?? null,
			$jsonData['name'] ?? null
		);

		try {
			$this->__userAddApplicationService->handle($command);
		} catch (ValidateException $e) {
			$response = $e->format();

			$this->response->statusCode(400);
			$this->response->body((string)json_encode($response));
		}
	}
}
