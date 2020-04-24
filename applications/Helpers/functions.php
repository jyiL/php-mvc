<?php
declare(strict_types=1);
/**
 * 公共函数
 * Author: user
 * Date: 2020/4/24
 * Time: 10:02
 * Email: avril.leo@yahoo.com
 */

/**
 * 检查请求参数
 *
 * @param array $data
 * @param array $paramKeys
 */
function checkRequestParams(array $data, array $paramKeys)
{
    $res = [];

    for ($i = 0; $i < count($paramKeys); $i++) {
        if (!array_key_exists($paramKeys[$i], $data)) {
            return false;
        }

        $res[$paramKeys[$i]] = $data[$paramKeys[$i]];
    }

    return $res;
}

/**
 * md5加密
 *
 * @param string $password
 *
 * @return string
 */
function md5Encrypt(string $password) : string
{
    return base64_encode(md5($password . 'tf@', true));
}

/**
 * 获取子分类html渲染
 *
 * @param array  $data
 */
function getCategoryChildrenHtml(array $data)
{

    if (isset($data['children'])) {
        foreach ($data['children'] as $child) {
            echo '<tr>';
            echo "<td style='width: 100px'>{$child['id']}&nbsp</td>";
            echo "<td>{$child['name']}</td>";
            echo "<td>{$child['created_at']}</td>";
            echo "<td>
<input type='button' value='添加' onclick='add({$child["id"]});' />
<input type='button' value='编辑' onclick='update({$child["id"]});' />
<input type='button' value='删除' onclick='del({$child["id"]});' />
</td>";
            echo '</tr>';

            if (isset($child['children'])) {
                getCategoryChildrenHtml($child);
            }

        }
    }
}