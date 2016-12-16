<?php
// cli-config.php
require_once "hoge.php";

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);