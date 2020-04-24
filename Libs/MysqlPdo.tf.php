<?php
declare(strict_types=1);
/**
 * Author: user
 * Date: 2020/4/23
 * Time: 15:00
 * Email: avril.leo@yahoo.com
 */

namespace TaiFeng\Libs;

class MysqlPdo implements Database
{
    public $db;

    public function connect(string $host, string $user, string $password, string $dbname)
    {
        $dbConfig = json_decode(DB_CONFIG,true);

        $log = new Logger();

        $dsn = $dbConfig['dbms'].":host=".$host.";dbname=".$dbname;

        try {
            $this->db = new \PDO($dsn, $user, $password, array(\PDO::ATTR_PERSISTENT => true));
        } catch (\PDOException $e) {
//            $log->log('数据库连接失败：'.$e->getMessage());
            die ("Error!: " . $e->getMessage() . "<br/>");
        }
    }

    /**
     * 查询
     * @param array $filed
     * @param $where
     *
     * @return array
     */
    public function select(array $filed = array(), $where = '') : array
    {
        if (!empty($where) && !empty($filed)) {
            if (is_array($where)) {
                $where = $this->where($where);
            }
            $sql = sprintf("SELECT %s FROM `%s` WHERE %s", $this->fields($filed), $this->_table, $where);
        } else {
            $sql = sprintf("SELECT %s FROM `%s`", $this->fields($filed), $this->_table);
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        if (!empty($data)) {
            return $data;
        } else {
            return [];
        }
    }

    /**
     * 查询所有
     *
     * @param string $fields
     * @param string $limit
     * @param string $orderBy
     *
     * @return array
     */
    public function selectAll(string $fields = '', string $limit = '', string $orderBy) : array
    {
        $fields = !empty($fields) ? $fields : '*';
        $sql = sprintf("select " . $fields . " from `%s`", $this->_table);
        $sql .= !empty($limit) ? $limit : '';
        $sql .= !empty($orderBy) ? $orderBy : '';

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * 自定义查询, 返回影响的行数
     *
     * @param string $sql
     *
     * @return int
     */
    public function query(string $sql) : int
    {
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->rowCount();
    }

    /**
     * 插入
     *
     * @param array $data
     *
     * @return int
     */
    public function insert($data) : int
    {
        $sql = sprintf("insert into `%s` %s", $this->_table, $this->formatInsert($data));

        return $this->query($sql);
    }

    /**
     * 将数组转换成插入格式的sql语句
     *
     * @param array $data
     *
     * @return string
     */
    private function formatInsert(array $data) : string
    {
        $fields = array();
        $values = array();
        foreach ($data as $key => $value) {
            $fields[] = sprintf("`%s`", $key);
            $values[] = sprintf("'%s'", $value);
        }

        $field = implode(',', $fields);
        $value = implode(',', $values);

        return sprintf("(%s) values (%s)", $field, $value);
    }

    /**
     * 更新
     *
     * @param int $id
     * @param array $data
     *
     * @return int
     */
    public function update($id, $data) : int
    {
        $sql = sprintf("update `%s` set %s where `id` = '%s'", $this->_table, $this->formatUpdate($data), $id);

        return $this->query($sql);
    }

    /**
     * 删除
     *
     * @param int $id
     *
     * @return int
     */
    public function delete(int $id) : int
    {
        $sql = sprintf("delete from `%s` where `id` = '%s'", $this->_table, $id);
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->rowCount();
    }

    /**
     * 将数组转换成更新格式的sql语句
     *
     * @param array $data
     *
     * @return string
     */
    private function formatUpdate(array $data) : string
    {
        $fields = array();
        foreach ($data as $key => $value) {
            $fields[] = sprintf("`%s` = '%s'", $key, $value);
        }
        return implode(',', $fields);
    }

    /**
     * 处理字段
     *
     * @param $data
     *
     * @return string
     */
    private function fields($data) : string
    {
        if ($data == '*') {
            return $data;
        } else {
            foreach ($data as $key => $value) {
                $fileds[] = '`'.$value.'`';
            }

            $str = implode(',', $fileds);
            return $str;
        }
    }

    /**
     * 设置条件语句
     *
     * @param array $where
     *
     * @return string
     */
    private function where(array $where) : string
    {
        $str = '';
        $i = 1;
        foreach ($where as $key => $value) {
            if( $i == 1) {
                $str .= '`'.$key.'` = '."'".$value."'";
            } else {
                $str .= ' AND `'.$key.'` = '."'".$value."'";
            }
            $i++;
        }

        return $str;
    }

    public function close()
    {
        unset($this->db);
    }
}