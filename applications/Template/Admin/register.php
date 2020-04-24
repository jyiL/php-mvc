<?php
declare(strict_types=1);
/**
 * Author: user
 * Date: 2020/4/23
 * Time: 18:31
 * Email: avril.leo@yahoo.com
 */

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
    
    <form id="register-form" method='post' action="/admin/user/register">
        <span><h2>注册</h2></span>
        <p>账号：<input type="text" name="name"></p>
        <p>密码：<input type="text" name="password"></p>
        <input type="button" value="登录" onclick="javascript:window.location.href='/admin/user/login'">
        <button>提交</button>
    </form>
</body>
</html>
<script>
    function register() {
        console.log(getElements('register-form'));
        console.log(document.getElementById('register-form'));

        return false;
    }

    function getElements(formId) {
        var form = document.getElementById(formId);
        var elements = new Array();
        var tagElements = form.getElementsByTagName('input');
        for (var j = 0; j < tagElements.length; j++){
            elements.push(tagElements[j]);

        }
        return elements;
    }
</script> 
html;

echo $html;
