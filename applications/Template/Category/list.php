<?php
declare(strict_types=1);
/**
 * Author: user
 * Date: 2020/4/24
 * Time: 10:57
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
            width: 70%;
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

echo "<input style='float: right;' type='button' value='添加' onclick='add(0);' />";

echo '<table>';
echo '<tr>';
echo '<td>id</td>';
echo '<td>分类名</td>';
echo '<td>创建时间</td>';
echo '<td>操作</td>';
echo '</tr>';

if (!empty($list)) {
    for($i = $startIndex; $i <= $endIndex; $i++) {
        echo '<tr>';
        echo '<td>' . $list[$i]['id'] . '</td>';
        echo '<td>' . $list[$i]['name'] . '</td>';
        echo '<td>' . $list[$i]['created_at'] . '</td>';
        echo "<td>
<input type='button' value='添加' onclick='add({$list[$i]["id"]});' />
<input type='button' value='编辑' onclick='update({$list[$i]["id"]});' />
<input type='button' value='删除' onclick='del({$list[$i]["id"]});' />
</td>";

        // 子类
        getCategoryChildrenHtml($list[$i]);

        echo '</tr>';
    }
} else {
    echo '<tr>暂无数据';
    echo '<td>暂无数据</td>';
    echo '<td>暂无数据</td>';
    echo '<td>暂无数据</td>';
    echo "<td>暂无数据</td>";
    echo "</tr>";
}

echo '</table>';
echo '<div id="pagination">';
echo '<a href="?page=1">首页</a>';
echo '<span>总页数：' . $totalPages . '</span>&nbsp';
echo '<span>当前页数：' . $page . '</span>';
echo '<a href="?page='. ($page-1) .'">上一页</a>';
echo '<a href="?page=' . ($page+1) . '">下一页</a>';
echo '<a href="?page=' . $totalPages . '">尾页</a>';
echo '</div>';

$hiddenForm = <<<form
<form id="hidden-form" method='post' action="/admin/category/create">
    <input type="hidden" name="name" value="" />
    <input type="hidden" name="parent_id" value=0 />
    <input type="hidden" name="id" value=0 />
</form>
form;

echo $hiddenForm;


$script = <<<script
<script>
    function add(id) {
        //第一个参数是提示文字，第二个参数是文本框中默认的内容
        var name = prompt("请输入分类名称","");
        
        if(name){
            var form = document.getElementById('hidden-form');
            form.action = "/admin/category/create";
            form.name.value = name;
            form.parent_id.value = id;
            form.submit();
         }
    }
    function update(id) {
        if (id === 0 || id === undefined) {
            alert('不能修改');
        }
        
        var name = prompt("请输入新的分类名称","");
        
        if(name){
            var form = document.getElementById('hidden-form');
            form.action = "/admin/category/update";
            form.name.value = name;
            form.id.value = id;
            form.submit();
         }
    }
    function del(id) {
        var msg = "您真的确定要删除吗？";
        if (confirm(msg)==true){
            var form = document.getElementById('hidden-form');
            form.action = "/admin/category/delete";
            form.id.value = id;
            form.submit();
        }else{
            return false;
        }
    }
</script>
script;
echo $script;