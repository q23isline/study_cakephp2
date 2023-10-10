<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
/**
 * User Model
 *
 */
class User extends AppModel {

/**
 * Validation rules
 *
 * @var array<string,mixed>
 */
	public $validate = array(
		'username' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'この項目は必須入力です。',
				'required' => 'create',
			),
			'alphaNumeric' => array(
				// この指定だと日本語をエラーにしてくれないため、正規表現で指定する
				// 'rule' => 'alphaNumeric',
				'rule' => array('custom', '/^[a-z0-9]+$/i'),
				'message' => 'この項目は文字と数字だけしか使えません。',
			),
			'maxLength' => array(
				'rule' => array('maxLength', '50'),
				'message' => 'この項目は50文字までです。',
			),
			'isUnique' => array(
				'rule' => array('isUnique'),
				'message' => 'その値はすでに使われています。',
			),
		),
		'password' => array(
			'required' => array(
				'rule' => array('notBlank'),
				'message' => 'この項目は必須入力です。',
				'required' => 'create',
			),
			'alphaNumeric' => array(
				'rule' => array('custom', '/^[a-z0-9]+$/i'),
				'message' => 'この項目は文字と数字だけしか使えません。',
			),
			'maxLength' => array(
				'rule' => array('maxLength', '50'),
				'message' => 'この項目は50文字までです。',
			),
		),
		'role_name' => array(
			'valid' => array(
				'rule' => array('inList', array('admin', 'author')),
				'message' => 'admin または author を入力してください。',
				'required' => 'create',
				'allowEmpty' => false,
			),
		),
		'name' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'この項目は必須入力です。',
				'required' => 'create',
			),
			'maxLength' => array(
				'rule' => array('maxLength', '50'),
				'message' => 'この項目は50文字までです。',
			),
		),
	);

/**
 * beforeSave
 *
 * @param array<mixed> $options options
 * @return true
 */
	public function beforeSave($options = array()) {
		if (!$this->data) {
			return true;
		}

		$password = $this->data[$this->alias]['password'] ?? null;
		if ($password !== null) {
			$passwordHasher = new BlowfishPasswordHasher();
			$this->data[$this->alias]['password'] = $passwordHasher->hash($password);
		}
		return true;
	}
}
