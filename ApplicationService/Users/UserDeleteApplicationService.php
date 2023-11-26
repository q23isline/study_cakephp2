<?php
declare(strict_types = 1);

namespace App\ApplicationService\Users;

use App\Domain\Models\User\IUserRepository;
use App\Domain\Models\User\Type\UserId;

/**
 * class UserDeleteApplicationService
 */
class UserDeleteApplicationService {

/**
 * @var \App\Domain\Models\User\IUserRepository
 */
	private $__userRepository;

/**
 * constructor
 *
 * @param \App\Domain\Models\User\IUserRepository $userRepository userRepository
 */
	public function __construct(
		IUserRepository $userRepository
	) {
		$this->__userRepository = $userRepository;
	}

/**
 * ユーザーを削除する
 *
 * @param \App\ApplicationService\Users\UserDeleteCommand $command command
 * @return void
 */
	public function handle(UserDeleteCommand $command) : void {
		$id = new UserId($command->getUserId());
		$this->__userRepository->delete($id);
	}
}
