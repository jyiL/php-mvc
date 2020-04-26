#!/usr/bin/env php
<?php

declare(strict_types = 1);

define('APP_PATH', __DIR__ . DIRECTORY_SEPARATOR);

require_once __DIR__ . DIRECTORY_SEPARATOR . 'Libs' . DIRECTORY_SEPARATOR . 'framework.php';

$dbConfig = json_decode(DB_CONFIG, true);

$mysqlDb = new TaiFeng\Libs\Model();

if (!$mysqlDb) {
    die('Could not connect mysql!');
}

$userTable = "CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;";

$categoryTable = "CREATE TABLE `category` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `parent_id` int(10) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;";

if (!$mysqlDb->query('select * from users')) {
  $mysqlDb->query($userTable);
}

if (!$mysqlDb->query('select * from category')) {
  $mysqlDb->query($categoryTable);
}

printf('install success!!' . PHP_EOL);
