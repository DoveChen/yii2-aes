Yii2-AES
========
Yii2 AES Encrypt && Decrypt

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist dovechen/yii2-aes "*"
```

or add

```
"dovechen/yii2-aes": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Aes init
```php
'components' => [
    ...
    'aes' => [
        'class' => 'dovechen\yii2\aes\Aes',
        'key'   => 'Y34lM1IyOSUTEa5h', // The encrypt & decrypt key.
        'iv'    => 'jKWFi17PZhpy08In', // A non-NULL Initialization Vector, default: 397e2eb61307109f.
    ]
  ...
]
// Global Use
$aesMcrypt = Yii::$app->aes; 


// More Use
$aesMcrypt = Yii::createObject([
    'class' => 'dovechen\yii2\aes\Aes',
    'key'   => 'Y34lM1IyOSUTEa5h', // The encrypt & decrypt key.
    'iv'    => 'jKWFi17PZhpy08In', // A non-NULL Initialization Vector, default: 397e2eb61307109f.
]);
```

Example:
```php
$content = "hello world";

echo '<pre>' . PHP_EOL;
echo 'mcrypt 加密:' . PHP_EOL;
$aesMcrypt = Yii::$app->aes;
var_dump($data = Yii::$app->aes->encrypt($content));
echo 'mcrypt 解密:' . PHP_EOL;
var_dump(Yii::$app->aes->decrypt($data));
echo '</pre>'. PHP_EOL;
```
