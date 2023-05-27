# Requirement
- Docker version 20.10.21
- Docker Compose version v2.13.0
- Laravel Framework 9.45.1
- node v18.16.0
- vite/4.0.0

# インストール手順

windowsユーザーは下記を変更
    - "5173:5173" を app: の ports: に追加
    platform: linux/amd64 を db: から削除

dockerをbuild    
```
docker-compose build
```

コンテナを起動
```
docker-compose up -d
```

プロジェクトディレクトリに移動
```
cd src/nok_php 
```

composerをアップデート
```
composer update
```

npmをインストール
```
npm install
```

env.exampleをコピーし .envファイルを作成（以下を追加）
```
DB_CONNECTION=mysql
DB_HOST=nok_php_db
DB_PORT=3306
DB_DATABASE=nok_php_db
DB_USERNAME=root
DB_PASSWORD=root
```

コンテナのプロジェクトディレクトリに移動
```
docker exec -it nok_php_app bash
```

プロジェクトに移動
```
cd /var/www/html/nok_php
```

アプリキーを作成
```
php artisan key:generate
```

migrationとseederを実行
```
php artisan migrate:fresh --seed
```

下記をブラウザで入力
```
http://localhost:8080/
```

# Usage
フロントエンドのビルド
```
npm run dev
```

## ログイン情報
### email
```
naoki@test.com
```
### password
```
naoki123
```