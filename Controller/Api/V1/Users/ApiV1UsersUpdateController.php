<?php
declare(strict_types = 1);

use App\ApplicationService\Users\UserUpdateApplicationService;
use App\ApplicationService\Users\UserUpdateCommand;
use App\Domain\Services\PermissionService;
use App\Domain\Services\UserService;
use App\Domain\Shared\Exception\PermissionDeniedException;
use App\Domain\Shared\Exception\ValidateException;
use App\Infrastructure\CakePHP\Menus\CakePHPMenuRepository;
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
		$menuRepository = new CakePHPMenuRepository();
		$permissionService = new PermissionService($this->__userRepository, $menuRepository);
		$this->__userUpdateApplicationService =
			new UserUpdateApplicationService($this->__userRepository, $this->__userService, $permissionService);
	}

/**
 * invoke method
 *
 * @param string $id ID
 * @return void
 */
	public function invoke(string $id) : void {
		// PUT だと $this->request->data; ではリクエストパラメータが取得できないため、 input() で取得する
		// リクエストボディは raw 想定（ form-data ではパラメータが取得できない）
		// https://book.cakephp.org/2/ja/controllers/request-response.html#xml-json
		$jsonData = $this->request->input('json_decode', true);

		try {
			$command = new UserUpdateCommand(
				$id,
				$jsonData['username'] ?? null,
				$jsonData['password'] ?? null,
				$jsonData['roleName'] ?? null,
				$jsonData['name'] ?? null
			);

			$this->__userUpdateApplicationService->handle($command);
		} catch (ValidateException $e) {
			$response = $e->format();

			$this->response->statusCode(400);
			$this->response->body((string)json_encode($response));
		} catch (PermissionDeniedException $e) {
			$response = $e->format();

			$this->response->statusCode(403);
			$this->response->body((string)json_encode($response));
		}
	}
}
