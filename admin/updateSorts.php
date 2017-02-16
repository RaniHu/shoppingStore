<?php

require_once '../include/include.php';
checkLogin();

//获取要修改数据的id
$id = $_GET['id'];
$sql = "SELECT * FROM sorts WHERE id='$id'";
$row = fetchOne($sql);
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
    <script src="../common/js/checkForm.js"></script>
    <script src="../common/js/countPos.js"></script>
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
                <h2>修改商品分类</h2>
            </div>
            <form id="addAdminForm" method="post" action="adminAction.php?act=updateSorts&&id=<?php echo $row['id'] ?>&&tab=sortsList">
                <ul>
                    <input type="hidden" name="sortsId" value="<?php echo $row['id'] ?>"/>
                    <li>
                        <label>分类名称：</label> <input type="text" name="sortsname" id="sortsname" class="required"
                                                      value="<?php echo $row['sortsname'] ?>">

                    </li>
                    <li><span id="prompt_mes"></span></li>


                </ul>
                <div class="form_btn">
                    <input type="button" value="取消" name="cancel_btn" id="cancel_btn">
                    <input type="submit" value="确定" name="confirm_btn" id="confirm_btn" onclick="return checkForm();">
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>