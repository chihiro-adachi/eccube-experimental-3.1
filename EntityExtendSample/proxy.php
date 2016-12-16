<?php
$loader = require_once "vendor/autoload.php";

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src"), true);

$conn = array(
    'driver' => 'pdo_sqlite',
    'path' => __DIR__ . '/db.sqlite',
);

$generator = \Zend\Code\Generator\ClassGenerator::fromReflection(
    new \Zend\Code\Reflection\ClassReflection('Product')
);

$generator->setName('ProductProxy');
// ProductクラスにTraitを追加する
$generator->addTrait('PriceTrait');
$generator->addTrait('TaxTrait');
$code = $generator->generate();

// プロキシを生成
file_put_contents('src/ProductProxy.php', '<?php '.PHP_EOL.$code);

$em = EntityManager::create($conn, $config);
// プロキシを指定してfindする -> tax, priceが取得できる
$em->find('ProductProxy', 1);

// todo: Proxyを直接指定せず、裏で解決する
// @see https://github.com/Ocramius/ProxyManager
