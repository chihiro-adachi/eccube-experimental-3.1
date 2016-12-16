<?php

$loader = require_once "vendor/autoload.php";

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src"), true);

$conn = array(
    'driver' => 'pdo_sqlite',
    'path' => __DIR__ . '/db.sqlite',
);

$em = EntityManager::create($conn, $config);
$evm = $em->getEventManager();
$evm->addEventListener('loadClassMetadata', new Listener());

class Listener {

    public function loadClassMetadata(\Doctrine\Common\Persistence\Event\LoadClassMetadataEventArgs $eventArgs)
    {
        $classMetadata = $eventArgs->getClassMetadata();

        /** @var \Doctrine\ORM\Mapping\ClassMetadataInfo $classMetadata */
        $classMetadata = $eventArgs->getClassMetadata();

        $fieldMapping = array(
            'fieldName' => 'about',
            'type' => 'string',
            'length' => 255
        );
        //$classMetadata->mapField($fieldMapping);
    }
}

$product = $em->find('Product', 1);
echo $product->about;

/**
$ php fuga.php
PHP Fatal error:  Uncaught ReflectionException: Property Product::$about does no
t exist in C:\Users\chihiro_adachi\Desktop\hoge\vendor\doctrine\common\lib\Doctr
ine\Common\Persistence\Mapping\RuntimeReflectionService.php:80
Stack trace:
 *
#0 C:\Users\chihiro_adachi\Desktop\hoge\vendor\doctrine\common\lib\Doctrine\Comm
on\Persistence\Mapping\RuntimeReflectionService.php(80): ReflectionProperty->__c
onstruct('Product', 'about')
 *
#1 C:\Users\chihiro_adachi\Desktop\hoge\vendor\doctrine\orm\lib\Doctrine\ORM\Map
ping\ClassMetadataInfo.php(964): Doctrine\Common\Persistence\Mapping\RuntimeRefl
ectionService->getAccessibleProperty('Product', 'about')
 *
#2 C:\Users\chihiro_adachi\Desktop\hoge\vendor\doctrine\orm\lib\Doctrine\ORM\Map
ping\ClassMetadataFactory.php(721): Doctrine\ORM\Mapping\ClassMetadataInfo->wake
upReflection(Object(Doctrine\Common\Persistence\Mapping\RuntimeReflectionService
))
#3 C:\Users\chihiro_adachi\Desktop\hoge\vendor\doctrine\common\lib\Doctrine\Comm
on\Persistence\Mapping\AbstractClassMetadataFactory.php(343): Doctrine\ORM\Ma in
 C:\Users\chihiro_adachi\Desktop\hoge\vendor\doctrine\common\lib\Doctrine\Common
\Persistence\Mapping\RuntimeReflectionService.php on line 80
*/
