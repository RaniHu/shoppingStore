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
                <h2>添加用户</h2>
            </div>
            <form id="addAdminForm" method="post" action="adminAction.php?act=addUser" enctype="multipart/form-data">
                <ul class="addUser">

                    <li>
                        <label>用户名：</label> <input type="text" name="username" class="required">

                    </li>
                    <li>
                        <label>密码：</label><input type="password" name="pwd" class="required">

                    </li>
                    <li>
                        <label>邮箱：</label> <input type="email" name="email" class="required">

                    </li>
                    <li>
                        <label>性别：</label>
                        <input type="radio" name="sex" class="required" value="男" id="male" checked="checked"><label for="male">男</label>
                        <input type="radio" name="sex" class="required" value="女" id="female"><label for="female">女</label>

                    </li>

                    <li>
                        <label>头像：</label> <input type="file" name="face" class="required">

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