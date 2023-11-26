<?php
declare(strict_types = 1);

namespace App\Domain\Models\Shared\Type;

use DateTimeImmutable;

/**
 * class Created
 */
final class Created {

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
