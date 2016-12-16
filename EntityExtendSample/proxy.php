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
$generator->addTrait('PriceTrait');
$generator->addTrait('TaxTrait');
$code = $generator->generate();
file_put_contents('src/ProductProxy.php', '<?php '.PHP_EOL.$code);

$em = EntityManager::create($conn, $config);
$em->find('ProductProxy', 1);
