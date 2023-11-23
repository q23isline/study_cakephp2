<?php
declare(strict_types = 1);

namespace App\ApplicationService\Users;

use App\Domain\Models\User\IUserRepository;
use App\Domain\Models\User\Type\Name;
use App\Domain\Models\User\Type\Password;
use App\Domain\Models\User\Type\RoleName;
use App\Domain\Models\User\Type\UserId;
use App\Domain\Models\User\Type\Username;
use App\Domain\Services\UserService;
use App\Domain\Shared\Exception\ExceptionItem;
use App\Domain\Shared\Exception\ValidateException;

/**
 * class UserUpdateApplicationService
 */
class UserUpdateApplicationService {

/**
 * @var \App\Domain\Models\User\IUserRepository
 */
	private $__userRepository;

/**
 * @var \App\Domain\Services\UserService
 */
	private $__userService;

/**
 * constructor
 *
 * @param \App\Domain\Models\User\IUserRepository $userRepository userRepository
 * @param \App\Domain\Services\UserService $userService userService
 */
	public function __construct(
		IUserRepository $userRepository,
		UserService $userService
	) {
		$this->__userRepository = $userRepository;
		$this->__userService = $userService;
	}

/**
 * ユーザーを更新する
 *
 * @param \App\ApplicationService\Users\UserUpdateCommand $command command
 * @return void
 * @throws \App\Domain\Shared\Exception\ValidateException
 */
	public function handle(UserUpdateCommand $command) : void {
		$id = new UserId($command->getUserId());
		$data = $this->__userRepository->getById($id);
		$data = $data->update(
			new Username($command->getUsername()),
			new Password($command->getPassword()),
			new RoleName($command->getRoleName()),
			new Name($command->getName())
		);

		if ($this->__userService->isExists($data)) {
			throw new ValidateException([new ExceptionItem('username', 'メールアドレスは既に存在しています。')]);
		}

		$this->__userRepository->update($data);
	}
}
