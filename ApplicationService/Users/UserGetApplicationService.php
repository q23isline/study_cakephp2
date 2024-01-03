<?php
declare(strict_types = 1);

namespace App\ApplicationService\Users;

use App\Domain\Models\User\IUserRepository;
use App\Domain\Models\User\Type\UserId;
use App\Domain\Services\PermissionService;
use App\Domain\Shared\Exception\ExceptionItem;
use App\Domain\Shared\Exception\PermissionDeniedException;

/**
 * class UserGetApplicationService
 */
class UserGetApplicationService {

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
 * ユーザー詳細を取得する
 *
 * @param \App\ApplicationService\Users\UserGetCommand $command command
 * @return \App\ApplicationService\Users\UserData
 * @throws \App\Domain\Shared\Exception\PermissionDeniedException
 */
	public function handle(UserGetCommand $command) : UserData {
		if (!$this->__permissionService->isAllowedSelf('view', 'user')) {
			throw new PermissionDeniedException([new ExceptionItem('', '権限がありません。')]);
		}

		$id = new UserId($command->getUserId());
		$data = $this->__userRepository->getById($id);

		return new UserData($data);
	}
}
