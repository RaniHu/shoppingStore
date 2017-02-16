<?php
require_once '../include/include.php';
require_once 'adminFun.php';
$act = $_REQUEST['act'];

/*注销登录*/
if ($act == "logout") {
    logout();
} /*添加管理员*/
else if ($act == "addAdmin") {
    addAdmin();
} /*修改管理员*/
else if ($act == "updateAdmin") {
    updateAdmin();
} else if ($act == "delAdmin") {
    delAdmin();
}else if ($act == "addSort") {
    addSort();
}else if ($act == "updateSorts") {
    updateSorts();
}else if ($act == "delSorts") {
    delSorts();
}else if ($act == "addProduct") {
    addProduct();
}else if ($act == "updateProduct") {
    updateProduct();
}else if ($act == "delProduct") {
    delProduct();
}else if ($act == "addUser") {
    addUser();
}else if ($act == "delUser") {
    delUser();
}else if ($act == "updateUser") {
    updateUser();
}else if ($act == "updateImg") {
    updateImg();
}else if ($act == "delImg") {
    delImg();
}