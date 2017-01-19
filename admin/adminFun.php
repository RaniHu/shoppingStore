<?php
require_once '../include/include.php';

//检验用户名是否存在
function checkAdmin($sql)
{
    return fetchOne($sql);
}


//检验是否已经登录
function checkLogin()
{
    if (@$_SESSION['adminId'] == ""&&@$_COOKIE['adminId']=="") {
        alertMes("请登录", "html/login.html");
    }
}


//注销登录
function logout()
{
    $_SESSION = array();
    //清除缓存
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), "", time() - 1);
    }
    if (isset($_COOKIE['adminId'])) {
        setcookie("adminId", "", time() - 1);
    }
    if (isset($_COOKIE['adminName'])) {
        setcookie("adminName", "", time() - 1);
    }
    session_destroy();
    echo "<script>window.location='html/login.html';</script>";
}


function  addAdmin(){
    //传递过来的表单数据数组
    $username=$_POST['username'];
    $pwd=$_POST['pwd'];
    $sql="INSERT INTO admin(username,pwd)VALUES ('$username','$pwd')";
    $result=mysqli_query(connect(),$sql);
    if($result){
        echo "成功";
    }else{
        echo mysqli_error(connect());
    }

}