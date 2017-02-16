<?php
require_once '../include/include.php';

checkLogin();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>后台管理</title>
    <link rel="stylesheet" href="../common/css/reset.css">
    <link rel="stylesheet" href="css/index.css">
    <script src="../common/plugins/jquery-1.9.1-min.js"></script>
    <script src="../common/js/loadMenu.js"></script>
    <script src="../common/js/countPos.js"></script>
    <script src="../common/js/checkForm.js"></script>
</head>
<body>


<div class="wrapper">
    <div id="sidebar">

    </div>
    <div id="main">
        <!--顶部菜单-->
        <div id="main_top">

        </div>
        <!--主要内容-->
        <div id="main_content">
            <div class="main_title">
                <h2>添加管理员</h2>
            </div>
            <form id="addAdminForm" method="post" action="adminAction.php?act=addAdmin">
                <ul>

                    <li>
                        <label>管理员用户名：</label> <input type="text" name="username" id="username" class="required">

                    </li>
                    <li>
                        <label>管理员密码：</label><input type="password" name="pwd" id="pwd" class="required">

                    </li>
                    <li><span id="prompt_mes"></span></li>


                </ul>
                <div class="form_btn">
                    <input type="button" value="取消" name="cancel_btn" id="cancel_btn">
                    <input type="submit" value="确定" name="confirm_btn" id="confirm_btn"
                           onclick="return checkForm();">
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>