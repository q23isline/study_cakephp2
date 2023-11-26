<?php
declare(strict_types = 1);

namespace App\ApplicationService\Users;

use App\Domain\Shared\Exception\ExceptionItem;
use App\Domain\Shared\Exception\ValidateException;

/**
 * class UserUpdateCommand
 */
final class UserUpdateCommand {

/**
 * @var string
 */
	private $__userId;

/**
 * @var string
 */
	private $__username;

/**
 * @var string
 */
	private $__password;

/**
 * @var string
 */
	private $__roleName;

/**
 * @var string
 */
	private $__name;

/**
 * constructor
 *
 * @param string $userId userId
 * @param string|null $username username
 * @param string|null $password password
 * @param string|null $roleName roleName
 * @param string|null $name name
 * @throws \App\Domain\Shared\Exception\ValidateException
 */
	public function __construct(
		string $userId,
		?string $username,
		?string $password,
		?string $roleName,
		?string $name
	) {
		$errors = [];

		if (empty($username)) {
			$errors[] = new ExceptionItem('username', '必須項目が不足しています。');
		}

		if (empty($password)) {
			$errors[] = new ExceptionItem('password', '必須項目が不足しています。');
		}

		if (empty($roleName)) {
			$errors[] = new ExceptionItem('roleName', '必須項目が不足しています。');
		}

		if (empty($name)) {
			$errors[] = new ExceptionItem('name', '必須項目が不足しています。');
		}

		if (empty($username) || empty($password) || empty($roleName) || empty($name)) {
			throw new ValidateException($errors);
		}

		$this->__userId = $userId;
		$this->__username = $username;
		$this->__password = $password;
		$this->__roleName = $roleName;
		$this->__name = $name;
	}

/**
 * UserId
 *
 * @return string
 */
	public function getUserId() : string {
		return $this->__userId;
	}

/**
 * Username
 *
 * @return string
 */
	public function getUsername() : string {
		return $this->__username;
	}

/**
 * Password
 *
 * @return string
 */
	public function getPassword() : string {
		return $this->__password;
	}

/**
 * RoleName
 *
 * @return string
 */
	public function getRoleName() : string {
		return $this->__roleName;
	}

/**
 * Name
 *
 * @return string
 */
	public function getName() : string {
		return $this->__name;
	}
}
