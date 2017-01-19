<?php
require_once '../config/config.php';

//连接数据库
    $conn=mysqli_connect(HOST,USERNAME,PASSWORD,DATABASE);
    if(!$conn){
        echo mysqli_error($conn);
    }

//定义字符集
    mysqli_query( $conn,'set names utf8' );

