<?php
declare(strict_types = 1);

namespace App\Domain\Models\User\Type;

/**
 * class Password
 */
final class Password {

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
		// パスワードのハッシュ化は CakePHP のモデルで実施しているため
		// DBから取得時はハッシュ化状態、登録時は入力値の生パスワード状態となる
		// Model/User.php
		// そのため、文字数や文字種のチェックはしない
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
