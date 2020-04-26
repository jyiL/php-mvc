<?php
declare(strict_types=1);
/**
 * Author: user
 * Date: 2020/4/23
 * Time: 18:32
 * Email: avril.leo@yahoo.com
 */

if (!isset($_SESSION['user_info'])) {
    $_headerUrl = APP_URL ? APP_URL . '/Admin/User/login' : '/Admin/User/login';
    header("location:{$_headerUrl}");
}

$logout_url = APP_URL ? APP_URL . '/admin/user/logout' : '/admin/user/logout';

$html = <<<eof
<html>
<h1>header</h1>
<h2>用户名：{$_SESSION['user_info'][0]['name']}</h2>
<input type='button' value='退出登录' onclick='logout();' />
</html>
eof;

echo $html;

$hiddenForm = <<<form
<form id="hidden-form-header" method='post' action="{$logout_url}">
</form>
form;

echo $hiddenForm;

$sccipt = <<<script
<script>
    function logout() {
        var form = document.getElementById('hidden-form-header');
        form.submit();
    }
</script>
script;

echo $sccipt;

