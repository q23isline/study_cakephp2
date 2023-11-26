<?php
declare(strict_types = 1);

namespace App\ApplicationService\Users;

/**
 * class UserGetResult
 */
final class UserGetResult {

/**
 * @var \App\ApplicationService\Users\UserData
 */
	private $__userData;

/**
 * constructor
 *
 * @param \App\ApplicationService\Users\UserData $userData userData
 */
	public function __construct(
		UserData $userData
	) {
		$this->__userData = $userData;
	}

/**
 * 整形する
 *
 * @return array<string,array<string,mixed>>
 */
	public function format() : array {
		return [
			'data' => [
				'id' => $this->__userData->getId(),
				'username' => $this->__userData->getUsername(),
				'password' => $this->__userData->getPassword(),
				'roleName' => $this->__userData->getRoleName(),
				'name' => $this->__userData->getName(),
				'created' => $this->__userData->getCreated()->format('Y-m-d H:i:d'),
				'modified' => $this->__userData->getModified()->format('Y-m-d H:i:d'),
			],
		];
	}
}
