<?php
declare(strict_types = 1);

use App\ApplicationService\Permissions\PermissionsArrowGetApplicationService;
use App\ApplicationService\Permissions\PermissionsArrowGetCommand;
use App\ApplicationService\Permissions\PermissionsArrowGetResult;
use App\Domain\Services\PermissionService;
use App\Infrastructure\CakePHP\Menus\CakePHPMenuRepository;
use App\Infrastructure\CakePHP\Users\CakePHPUserRepository;

App::uses('AppController', 'Controller');
/**
 * ApiV1PermissionsArrowGetController
 */
class ApiV1PermissionsArrowGetController extends AppController {

/**
 * @var \App\ApplicationService\Permissions\PermissionsArrowGetApplicationService
 */
	private $__permissionsArrowGetApplicationService;

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

		$this->__permissionsArrowGetApplicationService = new PermissionsArrowGetApplicationService(
			new PermissionService(
				new CakePHPUserRepository(),
				new CakePHPMenuRepository()
			)
		);
	}

/**
 * invoke method
 *
 * @param string $functionKey 機能 Key
 * @return void
 */
	public function invoke(string $functionKey) : void {
		$command = new PermissionsArrowGetCommand($functionKey);
		$types = $this->__permissionsArrowGetApplicationService->handle($command);
		$result = new PermissionsArrowGetResult($types);
		$response = $result->format();

		$this->response->body((string)json_encode($response));
	}
}
