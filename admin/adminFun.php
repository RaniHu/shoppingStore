<?php
require_once '../include/include.php';


//检验用户名是否存在
function checkAdmin($sql)
{
    return fetchOne($sql);
}


//检验是否已经登录
function checkLogin()
{
    if (@$_SESSION['adminId'] == "" && @$_COOKIE['adminId'] == "") {
        alertMes("请登录", "login.php");
    }
}


//注销登录
function logout()
{
    $_SESSION = array();
    //清除缓存
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), "", time() - 1);
    }
    if (isset($_COOKIE['adminId'])) {
        setcookie("adminId", "", time() - 1);
    }
    if (isset($_COOKIE['adminName'])) {
        setcookie("adminName", "", time() - 1);
    }
    session_destroy();
    echo "<script>window.location='login.php';</script>";
}

//添加管理员
function addAdmin()
{
    //传递过来的表单数据数组
    $username = $_POST['username'];
    $pwd = md5($_POST['pwd']);
    $querySql = mysqli_query(connect(), "SELECT * FROM admin WHERE username='$username'");

    //检验用户名是否存在
    if (mysqli_fetch_assoc($querySql)) {
        goBack("用户名已存在!");
    } else {
        //插入数据
        $insertSql = "INSERT INTO admin(username,pwd)VALUES ('$username','$pwd')";
        $result = mysqli_query(connect(), $insertSql);
        if ($result) {
            goBack("添加成功!");
        } else {
            goBack("添加失败!");
        }
    }

}

//修改管理员
function updateAdmin()
{
    $username = $_POST['username'];
    $pwd = $_POST['pwd'];
    $id = $_POST['adminId'];
    $insertSql = mysqli_query(connect(), "UPDATE admin SET username='$username',pwd='$pwd' WHERE id='$id'");
    if ($insertSql) {
        alertMes("修改成功！", "adminList.php");
    } else {
        alertMes("修改失败！", "adminList.php");
    }

}

//删除管理员
function delAdmin()
{
    //获取要删除的数据id
    $id = $_GET['id'];

    //删除语句
    $sql = "DELETE FROM admin WHERE id='$id'";
    $query = mysqli_query(connect(), $sql);
    if ($query) {
        alertMes("删除成功", "adminList.php?tab=adminList");
    } else {
        alertMes("删除失败", "adminList.php?tab=adminList");
    }
}


//添加分类
function addSort()
{
    //传递过来的表单数据数组
    $sortsname = $_POST['sortsname'];
    $querySql = mysqli_query(connect(), "SELECT * FROM sorts WHERE sortsname='sortsname'");

    //检验分类是否存在
    if (mysqli_fetch_assoc($querySql)) {
        goBack("分类已存在!");
    } else {
        //插入数据
        $insertSql = "INSERT INTO sorts(sortsname)VALUES ('$sortsname')";
        $result = mysqli_query(connect(), $insertSql);
        if ($result) {
            goBack("添加成功!");
        } else {
            goBack("添加失败!");
            echo mysqli_error(connect());
        }
    }
}

//修改分类
function updateSorts()
{
    $sortsname = $_POST['sortsname'];
    $id = $_POST['sortsId'];
    $insertSql = mysqli_query(connect(), "UPDATE sorts SET sortsname='$sortsname' WHERE id='$id'");
    if ($insertSql) {
        alertMes("修改成功！", "sortsList.php");
    } else {
        alertMes("修改失败！", "sortsList.php");
    }

}

//删除分类
function delSorts()
{
    //获取要删除的数据id
    $id = $_GET['id'];

    //删除语句
    $sql = "DELETE FROM sorts WHERE id='$id'";
    $query = mysqli_query(connect(), $sql);
    if ($query) {
        alertMes("删除成功", "sortsList.php?tab=sortsList");
    } else {
        alertMes("删除失败", "sortsList.php?tab=sortsList");
    }
}


//添加商品
function addProduct()
{
    //传递过来的表单数据数组
    $pName = $_POST['pName'];
    $pNum = $_POST['pNum'];
    $pCount = $_POST['pCount'];
    $marPrice = $_POST['marPrice'];
    $storePrice = $_POST['storePrice'];
    $pDes = $_POST['pDes'];
    $pubTime = $_POST['pubTime'];
    $isPub = $_POST['isPub'];
    $isHot = $_POST['isHot'];
    $sortId = $_POST['sortId'];

    //获取文件并上传
    $filepath = "../upload/product/";
    $uploadFiles = uploadFlie($path = $filepath);

    //生成缩略图
    if (is_array($uploadFiles) && $uploadFiles) {
        foreach ($uploadFiles as $key => $val) {
            resizeImg($filepath . $val['name'], "../upload/image_50/product/" . $val['name'], 50, 50, true);
            resizeImg($filepath . $val['name'], "../upload/image_220/product/" . $val['name'], 220, 220, true);
            resizeImg($filepath . $val['name'], "../upload/image_350/product/" . $val['name'], 350, 350, true);
            resizeImg($filepath . $val['name'], "../upload/image_800/product/" . $val['name'], 800, 800, true);
        }
    }

    //插入数据到商品表
    $insertSql = "INSERT INTO products(pName,pNum,pCount,marPrice,storePrice,pDes,pubTime,isPub,isHot,sortId)VALUES ('$pName','$pNum','$pCount','$marPrice','$storePrice','$pDes','$pubTime','$isPub','$isHot','$sortId')";

    //获取上一次插入的id
    $lastId = get_insert_id($insertSql);
    if ($lastId) {

        foreach ($uploadFiles as $uploadFile) {
            $arr1['productId'] = $lastId;
            $arr1['path'] = $filepath.$uploadFile['name'];

            //插入图片到相册表
            addAlbum($arr1);
        }
        goBack("添加成功!");
    } else {

        //销毁图片
        if (file_exists($path . $uploadFiles['name'])) {
            unlink($filepath . $uploadFiles['name']);

        }
        if (file_exists("../upload/image_50/product/" . $uploadFiles['name'])) {
            unlink("../upload/image_50/product/" . $uploadFiles['name']);

        }
        if (file_exists("../upload/image_220/product/" . $uploadFiles['name'])) {
            unlink("../upload/image_220/product/" . $uploadFiles['name']);

        }
        if (file_exists("../upload/image_350/product/" . $uploadFiles['name'])) {
            unlink("../upload/image_350/product/" . $uploadFiles['name']);

        }
        if (file_exists("../upload/image_800/product/" . $uploadFiles['name'])) {
            unlink("../upload/image_800/product/" . $uploadFiles['name']);

        }
        echo mysqli_error(connect());
        goBack("商品添加失败!");
    }


}

//修改商品
function updateProduct()
{

    //传递过来的表单数据数组
    $id = $_POST['productId'];
    $pName = $_POST['pName'];
    $pNum = $_POST['pNum'];
    $pCount = $_POST['pCount'];
    $marPrice = $_POST['marPrice'];
    $storePrice = $_POST['storePrice'];
    $pDes = $_POST['pDes'];
    $pubTime = $_POST['pubTime'];
    $isPub = $_POST['isPub'];
    $isHot = $_POST['isHot'];
    $sortId = $_POST['sortId'];

    //获取文件并上传
    $filepath = "../upload/product/";
    $uploadFiles = uploadFlie($path = $filepath);

    //生成缩略图
    if (is_array($uploadFiles) && $uploadFiles) {
        foreach ($uploadFiles as $key => $val) {
            resizeImg($filepath . $val['name'], "../upload/image_50/product/" . $val['name'], 50, 50, true);
            resizeImg($filepath . $val['name'], "../upload/image_220/product/" . $val['name'], 220, 220, true);
            resizeImg($filepath . $val['name'], "../upload/image_350/product/" . $val['name'], 350, 350, true);
            resizeImg($filepath . $val['name'], "../upload/image_800/product/" . $val['name'], 800, 800, true);
        }
    }

    //插入数据到商品表
    $updateSql = mysqli_query(connect(), "UPDATE products SET pName='$pName',pNum='$pNum',pCount='$pCount',marPrice='$marPrice',storePrice='$storePrice',pDes='$pDes',pubTime='$pubTime',isPub='$isPub',isHot='$isHot',sortId='$sortId'WHERE id='$id'");

    if ($updateSql) {
        if ($uploadFiles && is_array($uploadFiles)) {
            foreach ($uploadFiles as $uploadFile) {
                $arr1['productId'] = $id;
                $arr1['path'] = $filepath.$uploadFile['name'];

                //插入图片到相册表
                if (addAlbum($arr1)) {
                    alertMes("修改成功！", "productList.php?tab=productList");
                } else {
                    goBack("插入相册失败!");
                }
            }
        }
    } else {

        //销毁图片
        if (file_exists($path . $uploadFiles['name'])) {
            unlink($filepath . $uploadFiles['name']);

        }
        if (file_exists("../upload/image_50/product/" . $uploadFiles['name'])) {
            unlink("../upload/image_50/product/" . $uploadFiles['name']);

        }
        if (file_exists("../upload/image_220/product/" . $uploadFiles['name'])) {
            unlink("../upload/image_220/product/" . $uploadFiles['name']);

        }
        if (file_exists("../upload/image_350/product/" . $uploadFiles['name'])) {
            unlink("../upload/image_350/product/" . $uploadFiles['name']);

        }
        if (file_exists("../upload/image_800/product/" . $uploadFiles['name'])) {
            unlink("../upload/image_800/product/" . $uploadFiles['name']);

        }
        echo mysqli_error(connect());
        alertMes("修改失败！", "productList.php?tab=productList");
    }

}


//删除商品
function delProduct()
{
    //获取要删除的数据id
    $id = $_GET['id'];

    //删除语句
    $sql = "DELETE FROM products WHERE id='$id'";
    $query = mysqli_query(connect(), $sql);
    if ($query) {
        alertMes("删除成功", "productList.php?tab=productList");
    } else {
        alertMes("删除失败", "productList.php?tab=productList");
    }
}


//添加用户
function addUser()
{
    //传递过来的表单数据数组
    $username = $_POST['username'];
    $pwd = md5($_POST['pwd']);
    $sex = $_POST['sex'];
    $email = $_POST['email'];
    $regTime = date('Y:m:d H:i:s');

    //获取头像文件并上传
    $filepath = "../upload/userFace/";
    $uploadFiles = uploadFlie($path = $filepath);
    $face="../upload/userFace/".$uploadFiles[0]['name'];

    //生成缩略图
    if (is_array($uploadFiles) && $uploadFiles) {
        foreach ($uploadFiles as $key => $val) {
            resizeImg($filepath . $val['name'], "../upload/image_50/userFace/" . $val['name'], 50, 50, true);
            resizeImg($filepath . $val['name'], "../upload/image_220/userFace/" . $val['name'], 220, 220, true);
            resizeImg($filepath . $val['name'], "../upload/image_350/userFace/" . $val['name'], 350, 350, true);
            resizeImg($filepath . $val['name'], "../upload/image_800/userFace/" . $val['name'], 800, 800, true);
        }
    }


    //插入语句
    $querySql = mysqli_query(connect(), "SELECT * FROM user WHERE username='$username'");

    //检验用户名是否存在
    if (mysqli_fetch_assoc($querySql)) {
        goBack("用户名已存在!");
    } else {
        //插入数据
        $insertSql = "INSERT INTO user(username,pwd,sex,face,email,regTime)VALUES ('$username','$pwd','$sex','$face','$email','$regTime')";
        $result = mysqli_query(connect(), $insertSql);
        if ($result) {
            goBack("添加成功!");
        } else {
            //销毁图片
            if (file_exists($path . $uploadFiles['name'])) {
                unlink($filepath . $uploadFiles['name']);

            }
            if (file_exists("../upload/image_50/userFace/" . $uploadFiles['name'])) {
                unlink("../upload/image_50/userFace/" . $uploadFiles['name']);

            }
            if (file_exists("../upload/image_220/userFace/" . $uploadFiles['name'])) {
                unlink("../upload/image_220/userFace/" . $uploadFiles['name']);

            }
            if (file_exists("../upload/image_350/userFace/" . $uploadFiles['name'])) {
                unlink("../upload/image_350/userFace/" . $uploadFiles['name']);

            }
            if (file_exists("../upload/image_800/userFace/" . $uploadFiles['name'])) {
                unlink("../upload/image_800/userFace/" . $uploadFiles['name']);

            }
            goBack("添加失败!");
        }
    }

}


//修改用户
function updateUser()
{
    //传递过来的表单数据数组
    $id = $_POST['userId'];
    $username = $_POST['username'];
    $pwd = md5($_POST['pwd']);
    $sex = $_POST['sex'];
    $email = $_POST['email'];


    //获取头像文件并上传
    $filepath = "../upload/userFace/";
    $uploadFiles = uploadFlie($path = $filepath);
    $face="../upload/userFace/".$uploadFiles[0]['name'];

    //生成缩略图
    if (is_array($uploadFiles) && $uploadFiles) {
        foreach ($uploadFiles as $key => $val) {
            resizeImg($filepath . $val['name'], "../upload/image_50/userFace/" . $val['name'], 50, 50, true);
            resizeImg($filepath . $val['name'], "../upload/image_220/userFace/" . $val['name'], 220, 220, true);
            resizeImg($filepath . $val['name'], "../upload/image_350/userFace/" . $val['name'], 350, 350, true);
            resizeImg($filepath . $val['name'], "../upload/image_800/userFace/" . $val['name'], 800, 800, true);
        }
    }



    //修改数据
    $insertSql = mysqli_query(connect(), "UPDATE user SET face='$face',username='$username',pwd='$pwd',sex='$sex',email='$email'WHERE id='$id'");
    if ($insertSql) {
        alertMes("修改成功！", "userList.php");
    } else {
        //销毁图片
        if (file_exists($path . $uploadFiles['name'])) {
            unlink($filepath . $uploadFiles['name']);

        }
        if (file_exists("../upload/image_50/userFace/" . $uploadFiles['name'])) {
            unlink("../upload/image_50/userFace/" . $uploadFiles['name']);

        }
        if (file_exists("../upload/image_220/userFace/" . $uploadFiles['name'])) {
            unlink("../upload/image_220/userFace/" . $uploadFiles['name']);

        }
        if (file_exists("../upload/image_350/userFace/" . $uploadFiles['name'])) {
            unlink("../upload/image_350/userFace/" . $uploadFiles['name']);

        }
        if (file_exists("../upload/image_800/userFace/" . $uploadFiles['name'])) {
            unlink("../upload/image_800/userFace/" . $uploadFiles['name']);

        }
        alertMes("修改失败！", "userList.php");
    }
}


//删除用户
function delUser()
{
    //获取要删除的数据id
    $id = $_GET['id'];

    //删除语句
    $sql = "DELETE FROM user WHERE id='$id'";
    $query = mysqli_query(connect(), $sql);
    if ($query) {
        alertMes("删除成功", "userList.php?tab=userList");
    } else {
        alertMes("删除失败", "userList.php?tab=userList");
    }
}

//添加相册
function addAlbum($arr)
{
    $res = insert('album', $arr);
    return $res;

}

//修改图片
function updateImg(){
    $id = $_POST['id'];
    $pName = $_POST['pName'];
    $productId = $_POST['productId'];

    //获取头像文件并上传
    $filepath = "../upload/product/";
    $uploadFiles = uploadFlie($path = $filepath);
    $path=$filepath.$uploadFiles[0]['name'];

    //生成缩略图
    if (is_array($uploadFiles) && $uploadFiles) {
        foreach ($uploadFiles as $key => $val) {
            resizeImg($filepath . $val['name'], "../upload/image_50/product/" . $val['name'], 50, 50, true);
            resizeImg($filepath . $val['name'], "../upload/image_220/product/" . $val['name'], 220, 220, true);
            resizeImg($filepath . $val['name'], "../upload/image_350/product/" . $val['name'], 350, 350, true);
            resizeImg($filepath . $val['name'], "../upload/image_800/product/" . $val['name'], 800, 800, true);
        }
    }

    //插入数据
    $insertAlbum = mysqli_query(connect(), "UPDATE album SET productId='$productId',path='$path' WHERE id='$id'");
    $insertProduct = mysqli_query(connect(), "UPDATE products SET pName='$pName' WHERE id='$productId'");
    if ($insertAlbum&&$insertProduct) {
        alertMes("修改成功！", "imgList.php");
    } else {
        //销毁图片
        if (file_exists($filepath . $uploadFiles['name'])) {
            unlink($filepath . $uploadFiles['name']);

        }
        if (file_exists("../upload/image_50/product/" . $uploadFiles['name'])) {
            unlink("../upload/image_50/product/" . $uploadFiles['name']);

        }
        if (file_exists("../upload/image_220/product/" . $uploadFiles['name'])) {
            unlink("../upload/image_220/product/" . $uploadFiles['name']);

        }
        if (file_exists("../upload/image_350/product/" . $uploadFiles['name'])) {
            unlink("../upload/image_350/product/" . $uploadFiles['name']);

        }
        if (file_exists("../upload/image_800/product/" . $uploadFiles['name'])) {
            unlink("../upload/image_800/product/" . $uploadFiles['name']);

        }
        alertMes("修改失败！", "imgList.php");
    }
}


//删除相片
function delImg(){

    //获取要删除的数据id
    $id = $_GET['id'];

    //删除语句
    $sql = "DELETE FROM album WHERE id='$id'";
    $query = mysqli_query(connect(), $sql);
    if ($query) {
        alertMes("删除成功", "imgList.php?tab=imgList");
    } else {
        alertMes("删除失败", "imgList.php?tab=imgList");
    }
}
