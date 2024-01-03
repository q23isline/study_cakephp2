<?php
declare(strict_types = 1);

namespace App\ApplicationService\Users;

use App\Domain\Models\User\IUserRepository;

/**
 * class MyselfGetApplicationService
 */
class MyselfGetApplicationService {

/**
 * @var \App\Domain\Models\User\IUserRepository
 */
	private $__userRepository;

/**
 * constructor
 *
 * @param \App\Domain\Models\User\IUserRepository $userRepository userRepository
 */
	public function __construct(IUserRepository $userRepository) {
		$this->__userRepository = $userRepository;
	}

/**
 * ユーザー詳細を取得する
 *
 * @return \App\ApplicationService\Users\UserData
 */
	public function handle() : UserData {
		$data = $this->__userRepository->getLoginUser();

		return new UserData($data);
	}
}
