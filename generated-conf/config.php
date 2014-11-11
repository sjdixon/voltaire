<?php
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->checkVersion('2.0.0-dev');
$serviceContainer->setAdapterClass('debateclub', 'mysql');
$manager = new \Propel\Runtime\Connection\ConnectionManagerSingle();
$manager->setConfiguration(array (
  'dsn' => 'mysql:host=localhost;dbname=debateclub',
  'user' => 'root',
  'password' => 'C11h22.o12',
  'attributes' =>
  array (
    'ATTR_EMULATE_PREPARES' => false,
  ),
  'classname' => '\\Propel\\Runtime\\Connection\\ConnectionWrapper',
));
$manager->setName('debateclub');
$serviceContainer->setConnectionManager('debateclub', $manager);
$serviceContainer->setDefaultDatasource('debateclub');