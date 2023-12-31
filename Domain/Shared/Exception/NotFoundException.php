<?php
declare(strict_types = 1);

namespace App\Domain\Shared\Exception;

use Exception;

/**
 * class NotFoundException
 */
final class NotFoundException extends Exception {

/**
 * @var array<\App\Domain\Shared\Exception\ExceptionItem>
 */
	protected $__errors;

/**
 * constructor
 *
 * @param \App\Domain\Shared\Exception\ExceptionItem[] $errors errors
 * @param \Exception|null $previous previous
 */
	public function __construct(
		array $errors = [],
		?Exception $previous = null
	) {
		// 親 Exception クラスでプロパティ定義済
		$message = 'Not Found';
		$code = 404;

		$this->__errors = $errors;

		parent::__construct($message, $code, $previous);
	}

/**
 * Get the value of errors
 *
 * @return \App\Domain\Shared\Exception\ExceptionItem[]
 */
	public function getErrors() : array {
		return $this->__errors;
	}

/**
 * 整形する
 *
 * @return array<string,array<string,mixed>>
 */
	public function format() : array {
		$errors = [];
		foreach ($this->getErrors() as $error) {
			$errors[] = [
				'field' => $error->getField(),
				'reason' => $error->getReason(),
			];
		}

		return [
			'error' => [
				'message' => $this->getMessage(),
				'errors' => $errors,
			],
		];
	}
}
