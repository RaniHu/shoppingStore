<?php
require_once '../include/include.php';
require_once 'adminFun.php';


//获取用户输入信息
$username = $_POST['username'];
$pwd = $_POST['password'];
$validate_code = $_POST['validate_code'];
$checkCode = $_SESSION['checkCode'];
$autoLogin = $_POST['autoLogin'];

//数据库查询数据
$sql = "SELECT * FROM admin WHERE username='{$username}' AND pwd='{$pwd}'";
$res = checkAdmin($sql);

/*信息验证*/
//检验验证码
if ($validate_code == $checkCode) {

    //检验用户名密码
    if ($res) {

        //如果选择了自动登录
        if ($autoLogin) {
            setcookie("adminId",$res['id'],time()+7*24*3600);
            setcookie("adminName",$res['username'],time()+7*24*3600);
        }

        //记住id和用户名
        $_SESSION['adminId'] = $res['id'];
        $_SESSION['adminName'] = $res['username'];
        alertMes("登陆成功!", "index.php");

    } else {
        echo mysqli_error($conn);
        alertMes("用户名或密码错误!", "html/login.html");
    }

} else {
    alertMes("验证码错误!", "html/login.html");
}

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
    <form id="login_form" method="post" action="login.php">
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

