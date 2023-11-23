<?php
declare(strict_types = 1);

use App\ApplicationService\Users\UserUpdateApplicationService;
use App\ApplicationService\Users\UserUpdateCommand;
use App\Domain\Services\UserService;
use App\Domain\Shared\Exception\ValidateException;
use App\Infrastructure\CakePHP\Users\CakePHPUserRepository;

App::uses('AppController', 'Controller');
/**
 * ApiV1UsersUpdateController
 */
class ApiV1UsersUpdateController extends AppController {

/**
 * @var \App\Infrastructure\CakePHP\Users\CakePHPUserRepository
 */
	private $__userRepository;

/**
 * @var \App\Domain\Services\UserService
 */
	private $__userService;

/**
 * @var \App\ApplicationService\Users\UserUpdateApplicationService
 */
	private $__userUpdateApplicationService;

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
		$this->__userUpdateApplicationService = new UserUpdateApplicationService($this->__userRepository, $this->__userService);
	}

/**
 * invoke method
 *
 * @param string $id ID
 * @return void
 * @throws \App\Domain\Shared\Exception\NotFoundException
 * @throws \App\Domain\Shared\Exception\ValidateException
 */
	public function invoke(string $id) : void {
		// PUT だと $this->request->data; ではリクエストパラメータが取得できないため、 input() で取得する
		// リクエストボディは raw 想定（ form-data ではパラメータが取得できない）
		// https://book.cakephp.org/2/ja/controllers/request-response.html#xml-json
		$jsonData = $this->request->input('json_decode', true);

		$command = new UserUpdateCommand(
			$id,
			$jsonData['username'] ?? null,
			$jsonData['password'] ?? null,
			$jsonData['roleName'] ?? null,
			$jsonData['name'] ?? null
		);
		try {
			$this->__userUpdateApplicationService->handle($command);
		} catch (ValidateException $e) {
			$response = $e->format();

			$this->response->statusCode(400);
			$this->response->body((string)json_encode($response));
		}
	}
}
