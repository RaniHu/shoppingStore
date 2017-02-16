<?php
require_once '../include/include.php';
checkLogin();

//搜索图片
$searchVal = $_REQUEST['searchVal'] ? $_REQUEST['searchVal'] : null;
$where = $searchVal ? "where pName like '%{$searchVal}%'" : null;

$sql = "SELECT album.id, products.pName,album.path FROM album INNER JOIN products on album.productId=products.id $where";

//分页
$limit = 8;
$rows = getPageRows($limit, $sql);


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
            <div class="main_box imgListBox">
                <div class="main_title">
                    <div class="main_title">
                        <h2>图片列表</h2>
                        <div class="right">
                            <!--搜索框-->
                            <span class="search_box">
                             <input type="text" placeholder="search" class="search_input"
                                    value="<?php echo $searchVal ?>">
                             <input type="submit" value="" class="search_btn" onclick="searchAction()">
                            </span>
                            <!--按钮-->
                            <a href="#" class="selectAll">全选</a>
                        </div>

                    </div>
                </div>
                <form method="get">

                    <table id="adminListTb">
                        <tr>
                            <th>编号</th>
                            <th>所属商品</th>
                            <th>商品图片</th>
                            <th>操作</th>
                        </tr>
                        <?php

                        foreach ($rows as $data):

                            ?>
                            <tr>
                                <td><?php echo $data['id'] ?></td>
                                <td><?php echo $data['pName'] ?></td>
                                <td><img src="<?php echo $data['path'] ?>" width="100px" height="80px"></td>

                                <td class="edit">
                                    <a href="updateImg.php?id=<?php echo $data['id'] ?>&&tab=imgList"
                                       class="updateAction">修改</a>
                                    <a href="javascript:;" class="delAction" name="<?php echo $data['id'] ?>">删除</a>
                                </td>
                            </tr>

                            <?php
                        endforeach;
                        ?>
                    </table>
                </form>
                <div id="page_box">
                    <?php echo showPage($page, $pageTotal, "searchVal={$searchVal}&tab=imgList") ?>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    $(function () {
        //删除图片
        delAdmin();
    });


    /*删除操作*/
    function delAdmin() {
        $(".delAction").on("click", function () {
            var id = $(this).attr("name");
            if (window.confirm("确定删除吗？删除后不可恢复！")) {
                window.location = "adminAction.php?act=delImg&&id=" + id;
            }
        });
    }

    /*搜索操作*/
    function searchAction() {
        var searchVal = $("#main_content input.search_input").val();
        window.location = "imgList.php?searchVal=" + searchVal + "&tab=imgList";
    }


</script>
</body>
</html>
