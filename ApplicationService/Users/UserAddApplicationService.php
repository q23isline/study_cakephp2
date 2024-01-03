<?php
declare(strict_types = 1);

namespace App\ApplicationService\Users;

use App\Domain\Models\User\IUserRepository;
use App\Domain\Models\User\Type\Name;
use App\Domain\Models\User\Type\Password;
use App\Domain\Models\User\Type\RoleName;
use App\Domain\Models\User\Type\Username;
use App\Domain\Models\User\User;
use App\Domain\Services\PermissionService;
use App\Domain\Services\UserService;
use App\Domain\Shared\Exception\ExceptionItem;
use App\Domain\Shared\Exception\PermissionDeniedException;
use App\Domain\Shared\Exception\ValidateException;

/**
 * class UserAddApplicationService
 */
class UserAddApplicationService {

/**
 * @var \App\Domain\Models\User\IUserRepository
 */
	private $__userRepository;

/**
 * @var \App\Domain\Services\UserService
 */
	private $__userService;

/**
 * @var \App\Domain\Services\PermissionService
 */
	private $__permissionService;

/**
 * constructor
 *
 * @param \App\Domain\Models\User\IUserRepository $userRepository userRepository
 * @param \App\Domain\Services\UserService $userService userService
 * @param \App\Domain\Services\PermissionService $permissionService permissionService
 */
	public function __construct(
		IUserRepository $userRepository,
		UserService $userService,
		PermissionService $permissionService
	) {
		$this->__userRepository = $userRepository;
		$this->__userService = $userService;
		$this->__permissionService = $permissionService;
	}

/**
 * ユーザーを新規追加する
 *
 * @param \App\ApplicationService\Users\UserAddCommand $command command
 * @return void
 * @throws \App\Domain\Shared\Exception\PermissionDeniedException
 * @throws \App\Domain\Shared\Exception\ValidateException
 */
	public function handle(UserAddCommand $command) : void {
		if (!$this->__permissionService->isAllowedSelf('add', 'user')) {
			throw new PermissionDeniedException([new ExceptionItem('', '権限がありません。')]);
		}

		$data = User::create(
			$this->__userRepository->assignId(),
			new Username($command->getUsername()),
			new Password($command->getPassword()),
			new RoleName($command->getRoleName()),
			new Name($command->getName())
		);

		$this->__userRepository->validate($data);

		if ($this->__userService->isExists($data)) {
			throw new ValidateException([new ExceptionItem('username', 'username は既に存在しています。')]);
		}

		$this->__userRepository->save($data);
	}
}
