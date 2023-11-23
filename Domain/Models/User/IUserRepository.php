<?php
declare(strict_types = 1);

namespace App\Domain\Models\User;

use App\Domain\Models\User\Type\UserId;
use App\Domain\Models\User\Type\Username;

/**
 * interface IUserRepository
 */
interface IUserRepository {

/**
 * 採番を取得
 *
 * @return \App\Domain\Models\User\Type\UserId
 */
	public function assignId();

/**
 * カウント
 *
 * @return int
 */
	public function count();

/**
 * IDで検索
 *
 * @param \App\Domain\Models\User\Type\UserId $userId userId
 * @return \App\Domain\Models\User\User
 * @throws \NotFoundException
 */
	public function getById(UserId $userId);

/**
 * メールアドレスで検索
 *
 * @param \App\Domain\Models\User\Type\Username $username username
 * @return \App\Domain\Models\User\User|null
 */
	public function findByUsername(Username $username);

/**
 * すべて取得
 *
 * @param int $page ページ番号
 * @param int $pageSize ページサイズ
 * @param string $sort ソート
 * @return \App\Domain\Models\User\UserCollection
 */
	public function findAll(int $page, int $pageSize, string $sort);

/**
 * 保存
 *
 * @param \App\Domain\Models\User\User $user user
 * @return void
 * @throws \InternalErrorException
 */
	public function save(User $user);

/**
 * 更新
 *
 * @param \App\Domain\Models\User\User $user user
 * @return void
 * @throws \InternalErrorException
 */
	public function update(User $user);

/**
 * バリデーション
 *
 * @param \App\Domain\Models\User\User $user user
 * @return void
 * @throws \App\Domain\Shared\Exception\ValidateException
 */
	public function validate(User $user);
}
