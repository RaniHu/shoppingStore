<?php

require_once '../include/include.php';


//获取用户输入信息
//addslashes() 添加反斜杠的引用特殊字符。
//mysqli_real_escape_string() 转义sql语句中的特殊字符
//$username = addslashes($_POST['username']);
$username = mysqli_real_escape_string($conn,$_POST['username']);
$pwd = mysqli_real_escape_string($conn,$_POST['password']);
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
        alertMes("用户名或密码错误!", "login.php");
    }

} else {
    alertMes("验证码错误!", "login.php");
}