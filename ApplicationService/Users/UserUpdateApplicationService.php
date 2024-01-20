<?php
declare(strict_types = 1);

namespace App\ApplicationService\Users;

use App\Domain\Models\User\IUserRepository;
use App\Domain\Models\User\Type\Name;
use App\Domain\Models\User\Type\Password;
use App\Domain\Models\User\Type\RoleName;
use App\Domain\Models\User\Type\UserId;
use App\Domain\Models\User\Type\Username;
use App\Domain\Services\PermissionService;
use App\Domain\Shared\Exception\ExceptionItem;
use App\Domain\Shared\Exception\PermissionDeniedException;

/**
 * class UserUpdateApplicationService
 */
class UserUpdateApplicationService {

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
 * ユーザーを更新する
 *
 * @param \App\ApplicationService\Users\UserUpdateCommand $command command
 * @return void
 * @throws \App\Domain\Shared\Exception\PermissionDeniedException
 */
	public function handle(UserUpdateCommand $command) : void {
		if (!$this->__permissionService->isAllowedSelf('add', 'user')) {
			throw new PermissionDeniedException([new ExceptionItem('', '権限がありません。')]);
		}

		$id = new UserId($command->getUserId());
		$data = $this->__userRepository->getById($id);
		$data = $data->update(
			new Username($command->getUsername()),
			new Password($command->getPassword()),
			new RoleName($command->getRoleName()),
			new Name($command->getName())
		);

		$this->__userRepository->validate($data);

		$this->__userRepository->update($data);
	}
}
