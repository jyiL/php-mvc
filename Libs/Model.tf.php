<?php
declare(strict_types=1);
/**
 * 数据库模型
 * Author: user
 * Date: 2020/4/23
 * Time: 14:42
 * Email: avril.leo@yahoo.com
 */

namespace TaiFeng\Libs;

class Model extends MysqlPdo
{
    public $_table = '';
    private $_model;
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger();

        $this->_model = get_class($this);
        $this->_model = rtrim($this->_model, 'Model');

        // 数据库表名与类名一致
        $this->_table = strtolower(str_replace('TaiFeng\Models\\', '', $this->_model));

        $dbConfig = json_decode(DB_CONFIG,true);

        $this->connect($dbConfig['serverName'], $dbConfig['user'], $dbConfig['pass'], $dbConfig['dbName']);
    }

}