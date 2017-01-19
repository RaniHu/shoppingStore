<?php
require_once 'adminFun.php';
//验证是否登录
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
    <script src="../common/js/countPos.js"></script>
    <script src="../common/js/sideAction.js"></script>
    <script src="../common/js/checkForm.js"></script>


</head>
<body>
<script>
    $(function () {
       $("#addAdmin").click(function () {
           $("#main_content").load("html/addAdmin.html");
       });
    });
</script>


<div class="wrapper">
    <div id="sidebar">
        <h1>后台管理</h1>
        <input type="hidden">
        <!--侧边导航-->
        <ul id="sidemenu">
            <li>
                <h3 class="side_admin_icon">用户管理<i class="open_icon"></i></h3>
                <dl class="second_list">
                    <dd>
                        <a href="javascript:;">添加用户</a>
                    </dd>
                    <dd>
                        <a href="javascript:;">用户列表</a>
                    </dd>
                </dl>
            </li>
            <li>
                <h3 class="side_product_icon">商品管理<i class="open_icon"></i></h3>
                <dl class="second_list">
                    <dd>
                        <a href="javascript:;">添加商品</a>
                    </dd>
                    <dd>
                        <a href="javascript:;">商品列表</a>
                    </dd>
                </dl>
            </li>
            <li>
                <h3 class="side_sort_icon">分类管理<i class="open_icon"></i></h3>
                <dl class="second_list">
                    <dd>
                        <a href="javascript:;">添加分类</a>
                    </dd>
                    <dd>
                        <a href="javascript:;">管理分类</a>
                    </dd>
                </dl>
            </li>
            <li>
                <h3 class="side_order_icon">订单管理<i class="open_icon"></i></h3>
                <dl class="second_list">
                    <dd>
                        <a href="javascript:;">添加订单</a>
                    </dd>
                    <dd>
                        <a href="javascript:;">订单列表</a>
                    </dd>
                </dl>
            </li>
            <li>
                <h3 class="side_user_icon">管理员管理<i class="open_icon"></i></h3>
                <dl class="second_list">
                    <dd>
                        <a href="javascript:;" id="addAdmin">添加管理员</a>
                    </dd>
                    <dd>
                        <a href="javascript:;">管理员列表</a>
                    </dd>
                </dl>
            </li>
        </ul>
    </div>
    <div id="main">
        <!--顶部菜单-->
        <div id="main_top">
            <ul id="top_menu">
                <li>
                    <a href="#">欢迎您
                        <span>
                            <?php
                            if (isset($_SESSION['adminName'])) {
                                echo $_SESSION['adminName'];
                            }else if(isset($_COOKIE["adminName"])){
                                echo $_COOKIE["adminName"];
                            }
                            ?>
                        </span>
                    </a>
                </li>
                <li><a href="#">首页</a></li>
                <li><a href="#">刷新</a></li>
                <li><a href="adminAction.php?act=logout">退出</a></li>
            </ul>
        </div>
        <!--主要内容-->
        <div id="main_content">
<!--            <h2>商品管理</h2>-->



        </div>
    </div>
</div>


<script>
    $(function () {
        //计算主要内容高低
        countHeight($("#main_content"), $("#main_top"));

        addClass($("#sidemenu a"),"li","a","click","active");

    });

</script>

</body>
</html>


