<?php
require_once '../include/include.php';
checkLogin();


//搜索商品
$searchVal = $_REQUEST['searchVal'] ? $_REQUEST['searchVal'] : null;
$where = $searchVal ? "where pName like '%{$searchVal}%'" : null;

$sql="SELECT * FROM products {$where}";

//分页
$limit = 6;
$rows = getPageRows( $limit, $sql);


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
            <div class="main_box productListBox">
                <!--表单-->
                <div class="main_title">
                    <h2>商品列表</h2>
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

                <table id="adminListTb" class="productListTb">
                    <tr>
                        <th>商品编号</th>
                        <th>商品名称</th>
                        <th>商品货号</th>
                        <th>商品数量</th>
                        <th>市场价</th>
                        <th>商城价</th>
                        <th>上架时间</th>
                        <th>商品分类</th>
                        <th>上架</th>
                        <th>热卖</th>
                        <th>操作</th>
                    </tr>
                    <?php
                    foreach ($rows as $data):

                        //查询显示商品分类名
                        $sortsId = $data['sortId'];
                        $sortsSql = "SELECT sortsname FROM sorts WHERE id='$sortsId'";
                        $sortsRes = fetchOne($sortsSql);

                        //显示是否上架或热卖
                        if ($data['isPub'] == 0) {
                            $data['isPub'] = "否";
                        } else if ($data['isPub'] == 1) {
                            $data['isPub'] = "是";
                        }
                        if ($data['isHot'] == 0) {
                            $data['isHot'] = "否";
                        } else if ($data['isHot'] == 1) {
                            $data['isHot'] = "是";
                        }

                        ?>
                        <tr>
                            <td class="overflow_ellipsis"><?php echo $data['id'] ?></td>
                            <td class="overflow_ellipsis"><?php echo $data['pName'] ?></td>
                            <td class="overflow_ellipsis"><?php echo $data['pNum'] ?></td>
                            <td class="overflow_ellipsis"><?php echo $data['pCount'] ?></td>
                            <td class="overflow_ellipsis"><?php echo $data['marPrice'] ?></td>
                            <td class="overflow_ellipsis"><?php echo $data['storePrice'] ?></td>
                            <td class="overflow_ellipsis"><?php echo $data['pubTime'] ?></td>
                            <td class="overflow_ellipsis"><?php echo $sortsRes['sortsname'] ?></td>
                            <td class="overflow_ellipsis"><?php echo $data['isPub'] ?></td>
                            <td class="overflow_ellipsis"><?php echo $data['isHot'] ?></td>

                            <td class="edit">
                                <a href="updateProduct.php?id=<?php echo $data['id'] ?>&&tab=productList"
                                   class="updateAction">修改</a>
                                <a href="javascript:;" class="delAction" name="<?php echo $data['id'] ?>"
                                   onclick="delAction()">删除</a>
                            </td>
                        </tr>

                        <?php
                    endforeach;
                    ?>
                </table>
                <div id="page_box">
                    <?php echo showPage($page, $pageTotal, "searchVal={$searchVal}&tab=productList")  ?>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    $(function () {

    });


    /*删除操作*/
    function delAction() {
        var id = $(this).attr("name");
        if (window.confirm("确定删除吗？删除后不可恢复！")) {
            window.location = "adminAction.php?act=delProduct&&id=" + id;
        }
    }

    /*搜索操作*/
    function searchAction() {

        var searchVal = $("#main_content input.search_input").val();
        window.location = "productList.php?searchVal=" + searchVal + "&tab=productList";
    }


</script>
</body>
</html>
