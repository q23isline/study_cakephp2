<?php
declare(strict_types = 1);

namespace App\ApplicationService\Users;

/**
 * class UserDeleteCommand
 */
final class UserDeleteCommand {

/**
 * @var string
 */
	private $__userId;

/**
 * constructor
 *
 * @param string $userId userId
 */
	public function __construct(
		string $userId
	) {
		$this->__userId = $userId;
	}

/**
 * UserId
 *
 * @return string
 */
	public function getUserId() : string {
		return $this->__userId;
	}
}
