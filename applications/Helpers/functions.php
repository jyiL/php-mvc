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

function printTree(&$data,$level=0)
{
    foreach($data as $key=>&$value){
        for($i=0;$i<$level;$i++){
            // echo '&emsp;&emsp;';
            $value['name'] = '└―' . $value['name'];
        }
        for($i=0;$i<$level;$i++){
            // echo '&emsp;&emsp;';
            $value['name'] = '&emsp;' . $value['name'];
        }

        if(!empty($value['children'])){
            printTree($value['children'],$level+1);
        }
    }

    return $data;
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
            echo "<td style='text-align: left'>{$child['name']}</td>";
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

/**
 * 校验用户名
 *
 * @param string $name
 *
 * @return bool
 */
function isName(string $name) : bool
{
    $pattern="/^\w\w{5,11}$/";
    if(preg_match($pattern, $name)){
        return true;
    } else {
        return false;
    }
}

/**
 * 检验密码
 *
 * @param string $password
 *
 * @return bool
 */
function isPassword(string $password) : bool
{
//        $pattern="/^[0-9a-zA-Z]{6,16}$/i";
    $pattern="/^\d\d{5}$/";
    if(preg_match($pattern, $password)){
        return true;
    } else {
        return false;
    }
}