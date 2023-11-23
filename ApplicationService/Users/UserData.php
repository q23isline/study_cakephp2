<?php
declare(strict_types = 1);

namespace App\ApplicationService\Users;

use App\Domain\Models\User\User;
use DateTimeImmutable;
use Exception;

/**
 * class UserData
 */
final class UserData {

/**
 * @var string
 */
	private $__id;

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
 * @var DateTimeImmutable
 */
	private $__created;

/**
 * @var DateTimeImmutable
 */
	private $__modified;

/**
 * constructor
 *
 * @param \App\Domain\Models\User\User $source source
 * @throws \Exception
 */
	public function __construct(User $source) {
		if (empty($source->getCreated()) || empty($source->getModified())) {
			throw new Exception('Required field is empty.');
		}

		$this->__id = $source->getId()->getValue();
		$this->__username = $source->getUsername()->getValue();
		$this->__password = $source->getPassword()->getValue();
		$this->__roleName = $source->getRoleName()->getValue();
		$this->__name = $source->getName()->getValue();
		$this->__created = $source->getCreated()->getValue();
		$this->__modified = $source->getModified()->getValue();
	}

/**
 * Id
 *
 * @return string
 */
	public function getId() : string {
		return $this->__id;
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
 * Username
 *
 * @return string
 */
	public function getUsername() : string {
		return $this->__username;
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

/**
 * Created
 *
 * @return DateTimeImmutable
 */
	public function getCreated() : DateTimeImmutable {
		return $this->__created;
	}

/**
 * Modified
 *
 * @return DateTimeImmutable
 */
	public function getModified() : DateTimeImmutable {
		return $this->__modified;
	}
}
