<?php
declare(strict_types = 1);

namespace App\Domain\Models\User\Type;

use Exception;

/**
 * class Username
 */
final class Username {

/**
 * @var string
 */
	private $__value;

/**
 * constructor
 *
 * @param string $value value
 * @throws \Exception
 */
	public function __construct(
		string $value
	) {
		if (mb_strlen($value) > 50) {
			throw new Exception('この項目は50文字までです。');
		}

		if (!preg_match('/^[a-z0-9]+$/i', $value)) {
			throw new Exception('この項目は文字と数字だけしか使えません。');
		}

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
