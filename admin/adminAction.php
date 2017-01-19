<?php
require_once '../include/include.php';
require_once 'adminFun.php';
$act = $_REQUEST['act'];

/*注销登录*/
if ($act == "logout") {
    logout();
} /*添加管理员*/
else if ($act == "addAdmin") {
    //传递过来的表单数据数组
    $username = $_POST['username'];
    $pwd = $_POST['pwd'];
    $querySql = mysqli_query($conn,"SELECT * FROM admin WHERE username='$username'");

    //检验用户名是否存在
    if (!empty($querySql)){
        echo "<script>alert('用户名已存在!');</script>";
        echo "<script>window.history.back();</script>";
    } else {
        //插入数据
        $insertSql = "INSERT INTO admin(username,pwd)VALUES ('$username','$pwd')";
        $result = mysqli_query($conn, $insertSql);
        if ($result) {
            echo "<script>alert('添加成功!');</script>";
            echo "<script>window.history.back();</script>";
        }
    }
}
