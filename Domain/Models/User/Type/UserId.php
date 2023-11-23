<?php
declare(strict_types = 1);

namespace App\Domain\Models\User\Type;

/**
 * class UserId
 */
final class UserId {

/**
 * @var string
 */
	private $__value;

/**
 * constructor
 *
 * @param string $value value
 */
	public function __construct(
		string $value
	) {
		$this->__value = $value;
	}

/**
 * value
 *
 * @return string
 */
	public function getValue() : string {
		return $this->__value;
	}
}
