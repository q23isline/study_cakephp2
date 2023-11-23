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
use App\Domain\Models\User\UserCollection;
use ClassRegistry;
use DateTimeImmutable;
use NotFoundException;

/**
 * class CakePHPUserRepository
 */
final class CakePHPUserRepository implements IUserRepository {

/**
 * @var array<string,string>
 */
	private const SORT_TO_COLUMN = [
		'id' => 'id',
		'username' => 'username',
		'password' => 'password',
		'roleName' => 'role_name',
		'name' => 'name',
		'created' => 'created',
		'modified' => 'modified',
	];

/**
 * {@inheritDoc}
 */
	public function count() : int {
		/** @var \User $model */
		$model = ClassRegistry::init('User');
		return (int)$model->find('count');
	}

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
 * {@inheritDoc}
 */
	public function findAll(int $page, int $pageSize, string $sort) : UserCollection {
		$orderKey = substr($sort, 0, 1) === '+' ? 'ASC' : 'DESC';
		$requestSortKey = substr($sort, 1);
		$sortKey = $this->__toColumnName($requestSortKey);
		$order = "{$sortKey} {$orderKey}";

		$offset = ($page - 1) * $pageSize;

		/** @var \User $model */
		$model = ClassRegistry::init('User');
		$users = $model->find('all', [
			'limit' => $pageSize,
			'offset' => $offset,
			'order' => [$order],
		]);

		$data = new UserCollection();
		if (is_array($users)) {
			foreach ($users as $user) {
				$data->add($this->__buildEntity($user));
			}
		}

		return $data;
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

/**
 * テーブル定義のカラム名に変換する
 *
 * @param string $sortKey ソートキー
 * @return string
 */
	private function __toColumnName(string $sortKey) : string {
		return self::SORT_TO_COLUMN[$sortKey];
	}
}
