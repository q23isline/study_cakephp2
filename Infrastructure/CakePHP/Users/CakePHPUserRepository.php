<?php
declare(strict_types = 1);

namespace App\Infrastructure\CakePHP\Users;

use App\Domain\Models\Shared\Type\Created;
use App\Domain\Models\Shared\Type\Modified;
use App\Domain\Models\User\IUserRepository;
use App\Domain\Models\User\Type\Name;
use App\Domain\Models\User\Type\Password;
use App\Domain\Models\User\Type\RoleName;
use App\Domain\Models\User\Type\UserId;
use App\Domain\Models\User\Type\Username;
use App\Domain\Models\User\User;
use ClassRegistry;
use DateTimeImmutable;
use NotFoundException;

/**
 * class CakePHPUserRepository
 */
final class CakePHPUserRepository implements IUserRepository {

/**
 * {@inheritDoc}
 * @throws \NotFoundException
 */
	public function getById(UserId $userId) : User {
		/** @var \User $model */
		$model = ClassRegistry::init('User');
		$record = $model->find('first', [
			'conditions' => [
				'id' => $userId->getValue(),
			],
		]);

		if (empty($record) || !is_array($record)) {
			throw new NotFoundException(__('Invalid user'));
		}

		return $this->__buildEntity($record);
	}

/**
 * エンティティビルド
 *
 * @param array<mixed> $record record
 * @return \App\Domain\Models\User\User
 */
	private function __buildEntity(array $record) : User {
		return User::reconstruct(
			new UserId($record['User']['id']),
			new Username($record['User']['username']),
			new Password($record['User']['password']),
			new RoleName($record['User']['role_name']),
			new Name($record['User']['name']),
			new Created(new DateTimeImmutable($record['User']['created'])),
			new Modified(new DateTimeImmutable($record['User']['modified']))
		);
	}
}
