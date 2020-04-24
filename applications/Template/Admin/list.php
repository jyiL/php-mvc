<?php
declare(strict_types=1);
/**
 * Author: user
 * Date: 2020/4/23
 * Time: 18:31
 * Email: avril.leo@yahoo.com
 */

$perNum = 3;

$nums = count($list);
$totalPages = ceil($nums / $perNum);

$page = max($page, 1);
$page = min($page, $totalPages);

$startIndex = ($page - 1) *  $perNum;
$endIndex = $page * $perNum - 1;
$endIndex = min($nums - 1, $endIndex);

$head = <<<head
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>列表</title>
    <style>
        table {
            border: 1px solid red;
            width: 50%;
            height: 10%;
            text-align: center;
            margin: 100px 30% 10px 30%;
            border-collapse: collapse;
        }
        
        td {
            border: 1px solid red;
            text-align: center;
        }
        
        #pagination {
            text-align: center;
        }
        
        a {
            margin: 10px 10px;
        }
    </style>
</head>
head;

echo $head;

echo '<table>';
echo '<tr>';
echo '<td>id</td>';
echo '<td>姓名</td>';
echo '<td>注册时间</td>';
echo '<td>操作</td>';
echo '</tr>';

for($i = $startIndex; $i <= $endIndex; $i++) {
    echo '<tr>';
    echo '<td>' . $list[$i]['id'] . '</td>';
    echo '<td>' . $list[$i]['name'] . '</td>';
    echo '<td>' . $list[$i]['created_at'] . '</td>';
    echo '<td><button>编辑</button><button>删除</button></td>';
}

echo '</table>';
echo '<div id="pagination">';
echo '<a href="?page=1">首页</a>';
echo '<a href="?page='. ($page-1) .'">上一页</a>';
echo '<a href="?page=' . ($page+1) . '">下一页</a>';
echo '<a href="?page=' . $totalPages . '">尾页</a>';
echo '</div>';