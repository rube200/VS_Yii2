<?php
$db = require __DIR__ . '/db.php';
// test database! Important not to run tests on production or development databases
$db['dsn'] = 'mssql:host=localhost;dbname=VS_Yii2_Test';

return $db;
