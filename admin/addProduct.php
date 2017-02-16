<?php
require_once '../include/include.php';
checkLogin();

//获取所有分类
$sql = "SELECT * FROM sorts";
$rows = fetchAll($sql);


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
<script>

    //显示上传文件名称
    function showFileName() {
        var uploadFiles = document.getElementById('uploadFiles');
        var len = uploadFiles.files.length;

        //循环遍历文件名
        for (var i = 0; i < len; i++) {
            var appendAttachItem = "<span class='attachItem'></span>";
            $("#attachList").append(appendAttachItem);
            var attachItem = $("#attachList").find(".attachItem");

            //将遍历的文件名插入新节点中
            attachItem.each(function () {
                var index = $(this).index();
                $(this).text(uploadFiles.files[index].name);
            })
        }


    }

</script>

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
                <h2>添加商品</h2>
            </div>
            <form id="addAdminForm" method="post" action="adminAction.php?act=addProduct" enctype="multipart/form-data">
                <ul class="addProduct">

                    <li>
                        <label>商品名称：</label> <input type="text" name="pName" id="pName" class="required">

                    </li>
                    <li>
                        <label>商品货号：</label><input type="text" name="pNum" id="pNum" class="required">

                    </li>
                    <li>
                        <label>商品数量：</label><input type="text" name="pCount" id="pCount" class="required">

                    </li>
                    <li>
                        <label>市场价：</label><input type="text" name="marPrice" id="marPrice" class="required">

                    </li>
                    <li>
                        <label>商城价：</label><input type="text" name="storePrice" id="storePrice" class="required">

                    </li>
                    <li>
                        <label>上架时间：</label><input type="datetime-local" name="pubTime" id="pubTime" class="required">

                    </li>
                    <li class="select_sorts">
                        <label>商品分类：</label>

                        <select name="sortId">选择商品类型>
                            <?php
                            foreach ($rows as $sorts) {

                                ?>
                                <option value="<?php echo $sorts['id'] ?>"><?php echo $sorts['sortsname'] ?></option>
                                <?php
                            }

                            ?>
                        </select>


                    </li>
                    <li>
                        <label>是否上架：</label>
                        <input type="radio" name="isPub" id="pubTrue" value="1" class="required"
                               checked="checked"><label for="pubTrue" class="selectTitle">是:</label>
                        <input type="radio" name="isPub" id="pubFalse" value="0" class="required"><label for="pubFalse"
                                                                                                         class="selectTitle">否：</label>

                    </li>
                    <li>
                        <label>是否热卖：</label>
                        <input type="radio" name="isHot" id="hotTrue" value="1" class="required"><label for="hotTrue"
                                                                                                        class="selectTitle">是:</label>
                        <input type="radio" name="isHot" id="hotFalse" value="0" class="required"
                               checked="checked"><label for="hotFalse" class="selectTitle">否：</label>

                    </li>
                    <li>
                        <label>商品描述：</label>
                        <textarea name="pDes" id="pDes" class="required"></textarea>
                    </li>
                    <li>
                        <label>商品图片：</label>
                        <!--multiple支持多文件同时上传-->
                        <input type="file" multiple size="80" id="uploadFiles" name="file[]">
                        <a href="javascript:;" id="attachFileBtn" onclick="showFileName()">添加</a>
                        <div id="attachList">

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