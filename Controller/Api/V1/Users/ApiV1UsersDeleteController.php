<?php
declare(strict_types = 1);

use App\ApplicationService\Users\UserDeleteApplicationService;
use App\ApplicationService\Users\UserDeleteCommand;
use App\Domain\Services\PermissionService;
use App\Domain\Shared\Exception\ExceptionItem;
use App\Domain\Shared\Exception\NotFoundException;
use App\Domain\Shared\Exception\PermissionDeniedException;
use App\Infrastructure\CakePHP\Menus\CakePHPMenuRepository;
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
		$menuRepository = new CakePHPMenuRepository();
		$permissionService = new PermissionService($this->__userRepository, $menuRepository);
		$this->__userDeleteApplicationService =
			new UserDeleteApplicationService($this->__userRepository, $permissionService);
	}

/**
 * invoke method
 *
 * @param string $id ID
 * @return void
 */
	public function invoke(string $id) : void {
		$command = new UserDeleteCommand($id);

		try {
			$this->__userDeleteApplicationService->handle($command);
		} catch (PermissionDeniedException $e) {
			$response = $e->format();

			$this->response->statusCode(403);
			$this->response->body((string)json_encode($response));
		}
	}
}
