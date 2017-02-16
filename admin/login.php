<?php


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>管理员登录</title>
    <link rel="stylesheet" href="../common/css/reset.css">
    <link rel="stylesheet" href="css/login.css">
    <script src="../common/plugins/jquery-1.9.1-min.js"></script>
    <script src="../common/js/countPos.js"></script>
</head>
<body>
<!--登陆框-->
<div id="login_box">
    <form id="login_form" method="post" action="doLogin.php">
        <h1 class="form_title">管理员登录</h1>
        <ul class="form_input">
            <li><label class="user_name">用户名</label><input type="text"  class="input_text required" name="username" id="username"></li>
            <li><label class="user_psw">密码</label><input type="password" class="input_text required" name="password" id="pwd"></li>
            <li>
                <label class="user_psw">验证码</label>
                <span class="validate_input">
                    <input type="text"   class="input_text required" id="validate_code" name="validate_code">
                    <img src="../lib/validate_code.php" id="validate_img">
                </span>
            </li>
            <li class="autoLogin">
                <input type="checkbox" name="autoLogin" id="autoLogin">
                <label for="autoLogin">自动登录</label>
                <span id="prompt_mes"></span>
            </li>
        </ul>
        <input type="submit" id="login_btn" value="登录" onclick="return checkForm()">
    </form>
</div>
</body>
</html>

