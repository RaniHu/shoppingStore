<?php
require_once '../include/include.php';

?>


<ul id="top_menu">
    <li>
        <a href="#">欢迎您
            <span>
                            <?php
                            if (isset($_SESSION['adminName'])) {
                                echo $_SESSION['adminName'];
                            } else if (isset($_COOKIE["adminName"])) {
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