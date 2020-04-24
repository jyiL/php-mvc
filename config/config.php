<?php
declare(strict_types=1);

/**
 * 配置文件
 * Author: user
 * Date: 2020/4/22
 * Time: 17:00
 * Email: avril.leo@yahoo.com
 */

/**
 * 数据库配置
 */
$db_conf = array(
    'driver'        =>  'MysqlPdo',
    'dbms'          =>  'mysql',    // 数据库类型
    'serverName'    =>  'mysql',    // 地址
    'dbName'        =>  'tf_mvc',    // 数据库
    'user'          =>  'root',    // 账号
    'pass'          =>  'root',    // 密码
);

define('DB_CONFIG',json_encode($db_conf));

/**
 * 日志配置
 */
$log_conf = array(
    'log_file'    =>    'logs',
    'separator'   =>    '^_^',
);

define('LOG_CONF',json_encode($log_conf));
