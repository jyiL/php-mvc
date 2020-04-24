<?php
declare(strict_types=1);
/**
 * Author: user
 * Date: 2020/4/23
 * Time: 18:32
 * Email: avril.leo@yahoo.com
 */

if (!isset($_SESSION['user_info'])) header('location:/Admin/User/login');

$html = <<<eof
<html>
<h1>header</h1>
<h2>用户名：{$_SESSION['user_info'][0]['name']}</h2>
<input type='button' value='退出登录' onclick='logout();' />
</html>
eof;

echo $html;

$hiddenForm = <<<form
<form id="hidden-form" method='post' action="/admin/user/logout">
</form>
form;

echo $hiddenForm;

$sccipt = <<<script
<script>
    function logout() {
        var form = document.getElementById('hidden-form');
        form.submit();
    }
</script>
script;

echo $sccipt;

