<?php
declare(strict_types=1);
/**
 * Author: user
 * Date: 2020/4/23
 * Time: 18:31
 * Email: avril.leo@yahoo.com
 */

$login_url = APP_URL ? APP_URL . '/admin/user/login' : '/admin/user/login';
$register_url = APP_URL ? APP_URL . '/admin/user/register' : '/admin/user/register';

$html = <<<html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>注册</title>
    <style>
        #register-form {
            border: 1px solid red;
            width: 30%;
            height: 10%;
            text-align: center;
            margin: 300px 30%;
        }
        h2 {
            text-align: center;
        }
    </style>
</head>
<body>
    <form id="register-form" method='post' action="{$register_url}" onsubmit="return checkForm('register-form');">
        <span><h2>注册</h2></span>
        <p>账号：<input type="text" name="name"></p>
        <p><span id="name-error-message" style="color: red;"></span></p>
        <p>密码：<input type="text" name="password"></p>
        <p><span id="password-error-message" style="color: red;"></span></p>
        <input type="button" value="登录" onclick="javascript:window.location.href='{$login_url}'">
        <button>提交</button>
    </form>
</body>
</html>
html;

echo $html;

require_once TEMPLATE_PATH . 'common.php';