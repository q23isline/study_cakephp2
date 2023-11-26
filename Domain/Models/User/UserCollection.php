<?php
declare(strict_types = 1);

namespace App\Domain\Models\User;

use App\Domain\Models\User\User;
use ArrayIterator;
use IteratorAggregate;
use Traversable;

/**
 * class UserCollection
 *
 * @implements \IteratorAggregate<\App\Domain\Models\User\User>
 */
final class UserCollection implements IteratorAggregate {

/**
 * @var array<\App\Domain\Models\User\User>
 */
	private $__attributes;

/**
 * constructor
 *
 * @param \App\Domain\Models\User\User[] $attributes attributes
 */
	public function __construct(
		array $attributes = []
	) {
		$this->__attributes = $attributes;
	}

/**
 * add
 *
 * @param \App\Domain\Models\User\User $user user
 * @return void
 */
	public function add(User $user) : void {
		$this->__attributes[] = $user;
	}

/**
 * getIterator
 *
 * @return \Traversable<int,\App\Domain\Models\User\User>
 */
	public function getIterator() : Traversable {
		return new ArrayIterator($this->__attributes);
	}
}
