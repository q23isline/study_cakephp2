<?php
declare(strict_types = 1);

namespace App\Domain\Models\User;

use App\Domain\Models\Shared\Type\Created;
use App\Domain\Models\Shared\Type\Modified;
use App\Domain\Models\User\Type\Name;
use App\Domain\Models\User\Type\Password;
use App\Domain\Models\User\Type\RoleName;
use App\Domain\Models\User\Type\UserId;
use App\Domain\Models\User\Type\Username;

/**
 * class User
 */
final class User {

/**
 * @var \App\Domain\Models\User\Type\UserId
 */
	private $__id;

/**
 * @var \App\Domain\Models\User\Type\Username
 */
	private $__username;

/**
 * @var \App\Domain\Models\User\Type\Password
 */
	private $__password;

/**
 * @var \App\Domain\Models\User\Type\RoleName
 */
	private $__roleName;

/**
 * @var \App\Domain\Models\User\Type\Name
 */
	private $__name;

/**
 * @var \App\Domain\Models\Shared\Type\Created|null
 */
	private $__created;

/**
 * @var \App\Domain\Models\Shared\Type\Modified|null
 */
	private $__modified;

/**
 * constructor
 *
 * @param \App\Domain\Models\User\Type\UserId $id id
 * @param \App\Domain\Models\User\Type\Username $username username
 * @param \App\Domain\Models\User\Type\Password $password password
 * @param \App\Domain\Models\User\Type\RoleName $roleName roleName
 * @param \App\Domain\Models\User\Type\Name $name name
 * @param \App\Domain\Models\Shared\Type\Created|null $created created
 * @param \App\Domain\Models\Shared\Type\Modified|null $modified modified
 * @return void
 */
	private function __construct(
		UserId $id,
		Username $username,
		Password $password,
		RoleName $roleName,
		Name $name,
		?Created $created,
		?Modified $modified
	) {
		$this->__id = $id;
		$this->__username = $username;
		$this->__password = $password;
		$this->__roleName = $roleName;
		$this->__name = $name;
		$this->__created = $created;
		$this->__modified = $modified;
	}

/**
 * UserId
 *
 * @return \App\Domain\Models\User\Type\UserId
 */
	public function getId() : UserId {
		return $this->__id;
	}

/**
 * Username
 *
 * @return \App\Domain\Models\User\Type\Username
 */
	public function getUsername() : Username {
		return $this->__username;
	}

/**
 * Password
 *
 * @return \App\Domain\Models\User\Type\Password
 */
	public function getPassword() : Password {
		return $this->__password;
	}

/**
 * RoleName
 *
 * @return \App\Domain\Models\User\Type\RoleName
 */
	public function getRoleName() : RoleName {
		return $this->__roleName;
	}

/**
 * Name
 *
 * @return \App\Domain\Models\User\Type\Name
 */
	public function getName() : Name {
		return $this->__name;
	}

/**
 * Created
 *
 * @return \App\Domain\Models\Shared\Type\Created|null
 */
	public function getCreated() : ?Created {
		return $this->__created;
	}

/**
 * Modified
 *
 * @return \App\Domain\Models\Shared\Type\Modified|null
 */
	public function getModified() : ?Modified {
		return $this->__modified;
	}

/**
 * 新規作成
 *       UserId を引数からなくしたい
 *
 * @param \App\Domain\Models\User\Type\UserId $id id
 * @param \App\Domain\Models\User\Type\Username $username username
 * @param \App\Domain\Models\User\Type\Password $password password
 * @param \App\Domain\Models\User\Type\RoleName $roleName roleName
 * @param \App\Domain\Models\User\Type\Name $name name
 * @return self
 */
	public static function create(
		UserId $id,
		Username $username,
		Password $password,
		RoleName $roleName,
		Name $name
	) : self {
		return new self(
			$id,
			$username,
			$password,
			$roleName,
			$name,
			null,
			null
		);
	}

/**
 * 再構成
 *
 * @param \App\Domain\Models\User\Type\UserId $id id
 * @param \App\Domain\Models\User\Type\Username $username username
 * @param \App\Domain\Models\User\Type\Password $password password
 * @param \App\Domain\Models\User\Type\RoleName $roleName roleName
 * @param \App\Domain\Models\User\Type\Name $name name
 * @param \App\Domain\Models\Shared\Type\Created $created created
 * @param \App\Domain\Models\Shared\Type\Modified $modified modified
 * @return self
 */
	public static function reconstruct(
		UserId $id,
		Username $username,
		Password $password,
		RoleName $roleName,
		Name $name,
		Created $created,
		Modified $modified
	) : self {
		return new self(
			$id,
			$username,
			$password,
			$roleName,
			$name,
			$created,
			$modified
		);
	}

/**
 * isMyself
 *
 * @param \App\Domain\Models\User\User $other other
 * @return bool
 */
	public function isMyself(User $other) : bool {
		if ($this === $other) {
			// 同じクラスの同じインスタンスであれば true
			return true;
		}

		return $this->__id->getValue() === $other->getId()->getValue();
	}
}
