<?php
declare(strict_types = 1);

namespace App\Domain\Shared\Exception;

/**
 * class ExceptionItem
 */
final class ExceptionItem {

/**
 * @var string
 */
	private $__field;

/**
 * @var string
 */
	private $__reason;

/**
 * constructor
 *
 * @param string $field field
 * @param string $reason reason
 */
	public function __construct(
		string $field,
		string $reason
	) {
		$this->__field = $field;
		$this->__reason = $reason;
	}

/**
 * field
 *
 * @return string
 */
	public function getField() : string {
		return $this->__field;
	}

/**
 * reason
 *
 * @return string
 */
	public function getReason() : string {
		return $this->__reason;
	}
}
