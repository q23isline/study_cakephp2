<?php
declare(strict_types = 1);
App::uses('AppController', 'Controller');
/**
 * ApiV1UsersAddController
 *
 * @property User $User
 */
class ApiV1UsersAddController extends AppController {

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
 * @throws InternalErrorException
 */
	public function invoke() : void {
		// リクエストボディは raw 想定
		// raw だと $this->request->data; ではリクエストパラメータが取得できないため、 input() で取得する
		// https://book.cakephp.org/2/ja/controllers/request-response.html#xml-json
		$data = $this->request->input('json_decode', true);
		if ($data === null) {
			$errors = [
				[
					'field' => '',
					'reason' => '不正なパラメータです。'
				],
			];
			$result = $this->__createErrorResult('Bad Request', $errors);
			$this->response->statusCode(400);
			$this->response->body((string)json_encode($result));

			return;
		}

		$saveData = $this->__convertToSaveData($data);
		$this->User->create($saveData);
		if (!$this->User->validates()) {
			$errors = $this->__createErrorItems($this->User->validationErrors);
			$result = $this->__createErrorResult('Bad Request', $errors);
			$this->response->statusCode(400);
			$this->response->body((string)json_encode($result));

			return;
		}

		if (!$this->User->save()) {
			throw new InternalErrorException();
		}
	}

/**
 * DB 保存用に整形する
 *
 * @param array<string,mixed> $data データ
 * @return array<string,array<string,mixed>>
 */
	private function __convertToSaveData(array $data) : array {
		$result['User']['id'] = null;
		if (isset($data['username'])) {
			$result['User']['username'] = $data['username'];
		}

		if (isset($data['password'])) {
			$result['User']['password'] = $data['password'];
		}

		if (isset($data['roleName'])) {
			$result['User']['role_name'] = $data['roleName'];
		}

		if (isset($data['name'])) {
			$result['User']['name'] = $data['name'];
		}

		return $result;
	}

/**
 * パラメータ名をカラム名から取得
 *
 * @param string $columnName カラム名
 * @return string
 */
	private function __getParamName(string $columnName) : string {
		switch ($columnName) {
			case 'username':
				return 'username';
			case 'password':
				return 'password';
			case 'role_name':
				return 'roleName';
			case 'name':
				return 'name';
		}

		return '';
	}

/**
 * エラーデータをレスポンス用に作成
 *
 * @param array<string,mixed> $errors エラーデータ
 * @return array<int,array<string,mixed>>
 */
	private function __createErrorItems(array $errors) : array {
		$result = [];
		foreach ($errors as $columnName => $errorList) {
			$result[] = [
				'field' => $this->__getParamName($columnName),
				// 1つの項目で複数のエラーがある場合でも 1つ目のエラーだけ返す
				'reason' => $errorList[0],
			];
		}

		return $result;
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
