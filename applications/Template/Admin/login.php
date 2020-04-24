<?php
declare(strict_types=1);
/**
 * Author: user
 * Date: 2020/4/24
 * Time: 17:06
 * Email: avril.leo@yahoo.com
 */

$html = <<<html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登录</title>
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
    <form id="register-form" method='post' action="/admin/user/login">
        <span><h2>登录</h2></span>
        <p>账号：<input type="text" name="name"></p>
        <p>密码：<input type="text" name="password"></p>
        <input type="button" value="注册" onclick="javascript:window.location.href='/admin/user/register'">
        <button>提交</button>
    </form>
</body>
</html>
html;

echo $html;