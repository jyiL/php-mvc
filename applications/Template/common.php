<?php
declare(strict_types=1);
/**
 * 公共js
 * Author: user
 * Date: 2020/4/26
 * Time: 10:49
 * Email: avril.leo@yahoo.com
 */

$commonJavascript = <<<javascript
<script>
    function checkForm(id) {
        var form = document.getElementById(id);
        return verificationName(form.name) && verificationPwd(form.password);
    }
    
    function verificationName(name) {
        var p=/^\w\w{5,11}$/; //用户名必须为8-12为字母或数字
			var r=p.test(name.value); //校验
			if(!r){
				document.getElementById('name-error-message').innerText = '用户名必须为6-12为字母或数字';
				return false;
			}
			
			document.getElementById('name-error-message').innerText = '';
			return true;
    }
    
    function verificationPwd(password) {
        var p=/^\d\d{5}$/; //6位数字
			var r=p.test(password.value); //校验
			if(!r){
				document.getElementById('password-error-message').innerText = '密码必须为6位数字';
				return false;
			}
			
			document.getElementById('password-error-message').innerText = '';
			return true;
    }
</script>
javascript;

echo $commonJavascript;
