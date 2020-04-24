<?php
declare(strict_types=1);
/**
 * Author: user
 * Date: 2020/4/24
 * Time: 10:30
 * Email: avril.leo@yahoo.com
 */

namespace TaiFeng\Models;

use TaiFeng\Libs\Model;

class CategoryModel extends Model
{
    /**
     * 获取分类
     *
     * @return array
     */
    public function category() : array
    {
        return $this->generateTree($this->selectAll('', '', 'order by created_at desc'));
    }

    /**
     * 获取子类
     *
     * @param array $list
     * @param int $level
     *
     * @return array
     */
    public function generateTree(array $list, int $level = 0) : array
    {
        $tree = array();

        $packData = array();

        foreach ($list as $data) {
            $packData[$data['id']] = $data;
        }

        foreach ($packData as $key => &$val) {
            if ($val['parent_id'] == $level) {
                $tree[] = &$packData[$key];
            } else {
//                $flg = str_repeat('└―', $lv);
//                $val['name'] = $flg . $val['name'];
                $packData[$val['parent_id']]['children'][] = &$packData[$key];
            }
        }

        return $tree;
    }
}