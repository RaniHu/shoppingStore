<?php
require_once '../include/include.php';
checkLogin();

//搜索管理员
$searchVal = $_REQUEST['searchVal'] ? $_REQUEST['searchVal'] : null;
$where = $searchVal ? "where username like '%{$searchVal}%'" : null;

$sql="SELECT * FROM admin {$where}";

//分页
$limit = 8;
$rows = getPageRows($limit,$sql);

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
            <div class="main_box">
                <div class="main_title">
                    <div class="main_title">
                        <h2>管理员列表</h2>
                        <div class="right">
                            <!--搜索框-->
                            <span class="search_box">
                             <input type="text" placeholder="search" class="search_input" value="<?php echo $searchVal?>">
                             <input type="submit" value="" class="search_btn" onclick="searchAction()">
                            </span>
                            <!--按钮-->
                            <a href="addProduct.php?tab=addProduct" class="addAction">添加</a>
                            <a href="#" class="selectAll">全选</a>
                        </div>

                    </div>
                </div>
                <form method="get">

                    <table id="adminListTb">
                        <tr>
                            <th>编号</th>
                            <th>管理员名称</th>
                            <th>操作</th>
                        </tr>
                        <?php
                        foreach ($rows as $data):


                            ?>
                            <tr>
                                <td><?php echo $data['id'] ?></td>
                                <td><?php echo $data['username'] ?></td>

                                <td class="edit">
                                    <a href="updateAdmin.php?id=<?php echo $data['id'] ?>&&tab=adminList"
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
                    <?php echo showPage($page, $pageTotal, "searchVal={$searchVal}&tab=adminList")  ?>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    $(function () {
        //删除管理员
        delAdmin();

        //返回翻页
       /* $.ajax({
           url: "adminList.php",
           success:function (data) {
               $("#page_box").append(data);
           }
        });*/

    });


    /*删除操作*/
    function delAdmin() {
        $(".delAction").on("click", function () {
            var id = $(this).attr("name");
            if (window.confirm("确定删除吗？删除后不可恢复！")) {
                window.location = "adminAction.php?act=delAdmin&&id=" + id;
            }
        });
    }

    /*搜索操作*/
    function searchAction() {
        var searchVal = $("#main_content input.search_input").val();
        window.location = "adminList.php?searchVal=" + searchVal + "&tab=adminList";
    }


</script>
</body>
</html>
