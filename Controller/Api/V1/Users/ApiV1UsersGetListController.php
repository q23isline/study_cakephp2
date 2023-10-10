<?php
declare(strict_types = 1);
App::uses('AppController', 'Controller');
/**
 * ApiV1UsersGetListController
 *
 * @property User $User
 */
class ApiV1UsersGetListController extends AppController {

/**
 * This controller does not use a model
 *
 * @var string[]
 */
	public $uses = ['User'];

/**
 * beforeFilter
 *
 * @return void
 */
	public function beforeFilter() : void {
		parent::beforeFilter();
		$this->autoRender = false;
		$this->autoLayout = false;
		$this->response->type('json');
	}

/**
 * invoke method
 *
 * @return void
 */
	public function invoke() : void {
		$page = (int)($this->request->query('page') ?? 1);
		$pageSize = (int)($this->request->query('pageSize') ?? 10);
		$sort = $this->request->query('sort') ?? '+username';

		if (!$this->__validateParamSort($sort)) {
			$errors = [
				[
					'field' => 'sort',
					'reason' => '不正なソートです。'
				]
			];
			$result = $this->__createErrorResult('Bad Request', $errors);
			$this->response->statusCode(400);
			$this->response->body((string)json_encode($result));

			return;
		}

		$count = (int)$this->User->find('count');
		$users = $this->__findUsers($page, $pageSize, $sort);

		$result = $this->__createIndexResult($count, $page, $pageSize, $users);

		$this->response->body((string)json_encode($result));
	}

/**
 * sort のバリデーション
 *
 * @param string $sort ソート
 * @return bool
 */
	private function __validateParamSort(string $sort) : bool {
		$orderKey = substr($sort, 0, 1);
		if (!in_array($orderKey, ['+', '-'], true)) {
			return false;
		}

		$sortKey = substr($sort, 1);
		if (!in_array($sortKey, ['id', 'username', 'password', 'roleName', 'name', 'created', 'modified'], true)) {
			return false;
		}

		return true;
	}

/**
 * ユーザー一覧取得
 *
 * @param int $page ページ番号
 * @param int $pageSize ページサイズ
 * @param string $sort ソート
 * @return array<int,array<string,mixed>>
 */
	private function __findUsers(int $page, int $pageSize, string $sort) : array {
		$orderKey = substr($sort, 0, 1) === '+' ? 'ASC' : 'DESC';
		$sortKey = substr($sort, 1);
		$order = "{$sortKey} {$orderKey}";

		$offset = ($page - 1) * $pageSize;
		$users = $this->User->find('all', [
			'limit' => $pageSize,
			'offset' => $offset,
			'order' => [$order],
		]);

		$result = [];
		if (is_array($users)) {
			foreach ($users as $user) {
				$result[] = [
					'id' => $user['User']['id'],
					'username' => $user['User']['username'],
					'password' => $user['User']['password'],
					'roleName' => $user['User']['role_name'],
					'name' => $user['User']['name'],
					'created' => $user['User']['created'],
					'modified' => $user['User']['modified'],
				];
			}
		}

		return $result;
	}

/**
 * ユーザー一覧のレスポンス作成
 *
 * @param int $count カウント
 * @param int $page ページ
 * @param int $pageSize ページサイズ
 * @param array<int,array<string,mixed>> $users ユーザー一覧
 * @return array<string,mixed>
 */
	private function __createIndexResult(int $count, int $page, int $pageSize, array $users) : array {
		return [
			'meta' => [
				'totalCount' => $count,
				'page' => $page,
				'pageSize' => $pageSize,
			],
			'data' => $users,
		];
	}

/**
 * エラーのレスポンス作成
 *
 * @param string $message エラーメッセージ
 * @param array<int,array<string,mixed>> $errors エラー一覧
 * @return array<string,array<string,mixed>>
 */
	private function __createErrorResult(string $message, array $errors) : array {
		return [
			'error' => [
				'message' => $message,
				'errors' => $errors,
			],
		];
	}
}
