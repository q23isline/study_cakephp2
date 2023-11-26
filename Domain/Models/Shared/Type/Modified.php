<?php
declare(strict_types = 1);

namespace App\Domain\Models\Shared\Type;

use DateTimeImmutable;

/**
 * class Modified
 */
final class Modified {

/**
 * @var DateTimeImmutable
 */
	private $__value;

/**
 * constructor
 *
 * @param DateTimeImmutable $value value
 */
	public function __construct(
		DateTimeImmutable $value
	) {
		$this->__value = $value;
	}

/**
 * value
 *
 * @return DateTimeImmutable
 */
	public function getValue() : DateTimeImmutable {
		return $this->__value;
	}
}
