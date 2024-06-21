<?php
$db = require __DIR__ . '/db.php';
// test database! Important not to run tests on production or development databases
$db['dsn'] = 'sqlsrv:Server=localhost;Database=VS_Yii2_Test';

return $db;
