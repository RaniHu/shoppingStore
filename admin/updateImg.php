<?php

require_once '../include/include.php';


//获取要修改数据的id
$id = $_GET['id'];
$sql = $sql = "SELECT album.id, products.pName , album.productId FROM album INNER JOIN products on album.productId=products.id $where";
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
                <h2>修改图片</h2>
            </div>
            <form id="addAdminForm" method="post" enctype="multipart/form-data" action="adminAction.php?act=updateImg&&id=<?php echo $row['id'] ?>&&tab=imgList">
                <ul class="addProduct">
                    <input type="hidden" name="id" value="<?php echo $row['id'] ?>"/>
                    <input type="hidden" name="productId" value="<?php echo $row['productId'] ?>"/>
                    <li>
                        <label>商品名称：</label> <input type="text" name="pName" id="pName" class="required"
                                                    value="<?php echo $row['pName'] ?>">

                    </li>
                    <li>
                        <label>商品图片：</label>
                        <!--multiple支持多文件同时上传-->
                        <input type="file" multiple size="80" id="uploadFiles" name="file[]">
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