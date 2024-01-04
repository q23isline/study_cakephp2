<?php
declare(strict_types = 1);

namespace App\ApplicationService\Permissions;

use App\Domain\Services\PermissionService;

/**
 * class PermissionsArrowGetApplicationService
 */
class PermissionsArrowGetApplicationService {

/**
 * @var \App\Domain\Services\PermissionService
 */
	private $__permissionService;

/**
 * constructor
 *
 * @param \App\Domain\Services\PermissionService $permissionService permissionService
 */
	public function __construct(PermissionService $permissionService) {
		$this->__permissionService = $permissionService;
	}

/**
 * ユーザー詳細を取得する
 *
 * @param \App\ApplicationService\Permissions\PermissionsArrowGetCommand $command command
 * @return array<string>
 */
	public function handle(PermissionsArrowGetCommand $command) : array {
		$types = $this->__permissionService->getAllowedActions($command->getFunctionKey());

		return $types;
	}
}
