laravel-apa
================

Amazon Product Advertising APIをLaravelから利用するためのライブラリです。

- [Amazon Product Advertising API](https://affiliate.amazon.co.jp/assoc_credentials/home) 


## 依存ライブラリ
- Laravel5.5以上
- [Apai-IO](http://apai-io.readthedocs.io/en/latest/)


## インストール
インストールするには、Composerを使うことをお勧めします。
```bash
curl -sS https://getcomposer.org/installer | php
```

Composerコマンドを実行して、安定版のlaravel-apaをインストールします。
```bash
composer.phar require macki/laravel-apa
```


## 構成
アプリケーション用の設定ファイルを追加します。

config/amazon-product-api.php

```bash
php artisan vendor：publish
```

.env

```bash
AMAZON_API_KEY=
AMAZON_API_SECRET=
AMAZON_COUNTRY=
AMAZON_ASSOCIATE=
```

## 使い方

利用する前に必要なAPIキーを用意しておいてください。  


```php
<?php
use AmazonProductApiClient;

$response = AmazonProductApiClient::search('All', 'amazon' , 1);

$response = AmazonProductApiClient::browse('1');

$response = AmazonProductApiClient::item('1');

```


## ライセンス
MIT
