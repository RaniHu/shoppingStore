<?php
require_once '../include/include.php';
checkLogin();


function getAllAdmin()
{
    $sql = "SELECT * FROM admin ORDER BY id ";
    $rows = fetchAll($sql);
    return $rows;
}
$rows = getAllAdmin();
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
    <!--侧边栏-->
    <div id="sidebar">

    </div>
    <div id="main">
        <!--顶部菜单-->
        <div id="main_top">

        </div>

        <!--主要内容-->
        <div id="main_content">
            <form method="post">

        </div>
    </div>
</div>

<script>
    $(function () {
        $("#addAdmin").addClass("active");
    })
</script>
</body>
</html>


