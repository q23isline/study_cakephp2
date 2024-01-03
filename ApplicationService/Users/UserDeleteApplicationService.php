<?php
declare(strict_types = 1);

namespace App\ApplicationService\Users;

use App\Domain\Models\User\IUserRepository;
use App\Domain\Models\User\Type\UserId;
use App\Domain\Services\PermissionService;
use App\Domain\Shared\Exception\ExceptionItem;
use App\Domain\Shared\Exception\PermissionDeniedException;

/**
 * class UserDeleteApplicationService
 */
class UserDeleteApplicationService {

/**
 * @var \App\Domain\Models\User\IUserRepository
 */
	private $__userRepository;

/**
 * @var \App\Domain\Services\PermissionService
 */
	private $__permissionService;

/**
 * constructor
 *
 * @param \App\Domain\Models\User\IUserRepository $userRepository userRepository
 * @param \App\Domain\Services\PermissionService $permissionService permissionService
 */
	public function __construct(
		IUserRepository $userRepository,
		PermissionService $permissionService
	) {
		$this->__userRepository = $userRepository;
		$this->__permissionService = $permissionService;
	}

/**
 * ユーザーを削除する
 *
 * @param \App\ApplicationService\Users\UserDeleteCommand $command command
 * @return void
 * @throws \App\Domain\Shared\Exception\PermissionDeniedException
 */
	public function handle(UserDeleteCommand $command) : void {
		if (!$this->__permissionService->isAllowedSelf('add', 'user')) {
			throw new PermissionDeniedException([new ExceptionItem('', '権限がありません。')]);
		}

		$id = new UserId($command->getUserId());
		$this->__userRepository->delete($id);
	}
}
