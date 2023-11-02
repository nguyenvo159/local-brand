<?php

// require_once __DIR__ . '/src/helpers.php';
require_once __DIR__ . '/libraries/Psr4AutoloaderClass.php';


$loader = new Psr4AutoloaderClass;
$loader->register();

// Các lớp có không gian tên bắt đầu với CT275\Labs nằm ở src
$loader->addNamespace('CT275\Labs', __DIR__ . '/src');

require_once __DIR__ . '/src/helpers.php';

try {
        $PDO = (new CT275\Labs\PDOFactory())->create([
            'dbhost' => 'localhost',
            'dbname' => 'ct275_project',
            'dbuser' => 'root',
            'dbpass' => '2518700146'
        ]);
        $userRepository = new CT275\Labs\UserRepository($PDO);
        $cartRepository = new \CT275\Labs\CartRepository($PDO);
    } catch (Exception $ex) {
        echo 'Không thể kết nối đến MySQL,
            kiểm tra lại username/password đến MySQL.<br>';
        exit("<pre>${ex}</pre>");
    }