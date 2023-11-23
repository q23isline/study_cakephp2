<?php
declare(strict_types = 1);

namespace App\ApplicationService\Users;

use App\Domain\Models\User\IUserRepository;
use App\Domain\Models\User\Type\UserId;

/**
 * class UserGetApplicationService
 */
class UserGetApplicationService {

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
 * ユーザー詳細を取得する
 *
 * @param \App\ApplicationService\Users\UserGetCommand $command command
 * @return \App\ApplicationService\Users\UserData
 */
	public function handle(UserGetCommand $command) : UserData {
		$id = new UserId($command->getUserId());
		$data = $this->__userRepository->getById($id);

		return new UserData($data);
	}
}
