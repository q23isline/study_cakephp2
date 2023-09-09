# study_cakephp2

[![LICENSE](https://img.shields.io/badge/license-MIT-green.svg)](./LICENSE)
[![PHPStan](https://img.shields.io/badge/PHPStan-level%208-brightgreen.svg)](https://github.com/phpstan/phpstan)
[![Open in Visual Studio Code](https://img.shields.io/static/v1?logo=visualstudiocode&label=&message=Open%20in%20Visual%20Studio%20Code&labelColor=555555&color=007acc&logoColor=007acc)](https://open.vscode.dev/q23isline/study_cakephp2)

[![PHP](https://img.shields.io/static/v1?logo=php&label=PHP&message=v7.1.33&labelColor=555555&color=777BB4&logoColor=777BB4)](https://www.php.net)
[![CakePHP](https://img.shields.io/static/v1?logo=cakephp&label=CakePHP&message=v2.10.24&labelColor=555555&color=D33C43&logoColor=D33C43)](https://cakephp.org)
[![MySQL](https://img.shields.io/static/v1?logo=mysql&label=MySQL&message=v8.0&labelColor=555555&color=4479A1&logoColor=4479A1)](https://dev.mysql.com)
[![NGINX](https://img.shields.io/static/v1?logo=nginx&label=NGINX&message=v1.21&labelColor=555555&color=009639&logoColor=009639)](https://www.nginx.com)

## はじめにやること

1. ソースダウンロード

    ```bash
    git clone 'https://github.com/q23isline/study_cakephp2.git'
    ```

2. 以下の`.default`をコピーして貼り付け、`.default`の拡張子を外す

    ```bash
    cp Config/core.php.default Config/core.php
    cp Config/database.php.default Config/database.php
    cp Config/email.php.default Config/email.php
    ```

3. DB コンテナ起動時に Permission Denied で起動できない状態にならないように権限付与する

    ```bash
    sudo chmod -R ugo+rw logs
    ```

4. アプリ立ち上げ

    ```bash
    docker compose build --no-cache
    docker compose down -v
    sudo rm -rf Vendor
    docker create -it --name app study_cakephp2-app bash
    sudo docker cp app:/var/www/html/Vendor $(pwd)
    docker rm -f app
    sudo chown -R 777 Vendor
    docker compose up -d
    ```

## 日常的にやること

### システム起動

```bash
docker compose up -d
```

### システム終了

```bash
docker compose down
```

## 動作確認

### URL

- <http://localhost>

### Permission Denied対策

- ログイン後、画面にPermission Deniedエラーが表示される場合、以下を実行
  - 本番環境では適切に権限を付与すべきだがとりあえず動くようにフル権限を付与

```bash
sudo chmod -R 777 tmp
sudo chmod -R ugo+rw logs
```

## コーディング標準チェック単体実行

```bash
# コーディング標準チェック実行
docker exec -it app ./Vendor/bin/phpcs --standard=CakePHP -p Console/Command/ Console/Templates/ Controller/ Model/ View/
```

## 静的分析チェック単体実行

```bash
docker exec -it app ./Vendor/bin/phpstan analyse
```

## デバッグ実行

### VS Codeの初期設定

- [VS Code | Marketplace | PHP Debug](https://marketplace.visualstudio.com/items?itemName=felixfbecker.php-debug)をインストールする
- VS CodeにXDebug用の構成ファイル（launch.json）を追加する

```JSONC
{
    "version": "0.2.0",
    "configurations": [
        {
            "name": "Listen for Xdebug",
            "type": "php",
            "request": "launch",
            "hostname": "0.0.0.0",
            "pathMappings": {
                "/var/www/html/": "${workspaceRoot}"
            },
            "environment": {
                // デバッグ時はログレベルを 7
                "XDEBUG_CONFIG": "log_level=7"
            }
        }
    ]
}
```
