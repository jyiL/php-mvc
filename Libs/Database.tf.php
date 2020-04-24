<?php
declare(strict_types=1);
/**
 * Author: user
 * Date: 2020/4/23
 * Time: 14:57
 * Email: avril.leo@yahoo.com
 */

namespace TaiFeng\Libs;

interface Database
{
    /**
     * 连接
     *
     * @param string $host
     * @param string $user
     * @param string $password
     * @param string $dbname
     */
    public function connect(string $host, string $user, string $password, string $dbname);

    /**
     * 查询
     *
     * @param array $filed
     * @param string $where
     */
    public function select(array $filed = array(), string $where = '');

    /**
     * 查询所有
     *
     * @param string $fields
     * @param string $limit
     * @param string $orderBy
     */
    public function selectAll(string $fields, string $limit, string $orderBy);

    /**
     * 自定义查询
     *
     * @param string $sql
     */
    public function query(string $sql);

    /**
     * 插入
     *
     * @param $data
     */
    public function insert($data);

    /**
     * 更新
     *
     * @param int $id
     * @param array $data
     */
    public function update(int $id, array $data);

    /**
     * 删除
     *
     * @param int $id
     */
    public function delete(int $id);

    /**
     * 关闭
     */
    public function close();
}