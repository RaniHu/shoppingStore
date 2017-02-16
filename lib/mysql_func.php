<?php
require_once '../config/config.php';


//连接数据库
function connect(){
    $conn=mysqli_connect(HOST,USERNAME,PASSWORD,DATABASE);
    if(!$conn){
        echo mysqli_error($conn);
    }

//定义字符集
    mysqli_query( $conn,'set names utf8' );
    return $conn;
}


//插入操作
function insert($table,$array){
    $keys = join(",",array_keys($array));
    $vals = "'".join("','",array_values($array))."'";
    $sql = "insert {$table} ($keys) values ({$vals})";
    /*这里不能用connect()是因为使用connect()时又执行了一次数据库连接，
    就拿不到mysqli_insert_id的最新一次id,获取到的永远都是0;*/
    $link = mysqli_connect(HOST,USERNAME,PASSWORD,DATABASE) or die("数据库连接失败");
    //不能用mysqli_query(connect(), $sql);
    mysqli_query($link, $sql);
    //不能用mysqli_insert_id(connect());
    return mysqli_insert_id($link);

   /* $keys=join(",",array_keys($array));
    $vals="'".join("','",array_values($array))."'";
    $sql="insert {$table}($keys) values({$vals})";
    mysqli_query(connect(),$sql);
    return mysqli_insert_id(connect());                         //返回最后一个查询中自动生成的 ID*/

}


//更新操作
function update($table,$array,$where=null){
    $str=null;
    foreach ($array as $key=>$val) {
        if($str=null){                                          //自定义变量
            $sep="";                                            //不是数组时，表示为空
        }else{
            $sep=",";                                           //是数组时，表示逗号连接
        }
        $str.=$sep.$key."='".$val."'";                          //拼接字段
    }
    $sql="update{$table} set{$str}".($where=null?null:"where".$where);
    mysqli_query(connect(),$sql);
    return mysqli_affected_rows(connect());
}


//删除操作
function delete($table,$where=null){
    $where=$where==null?null:"where".$where;
    $sql="delete from {$table} {$where}";
    mysqli_query(connect(),$sql);
    return mysqli_affected_rows(connect());
}


//查询一条
function fetchOne($sql){
    $result=mysqli_query(connect(),$sql);
    $row=mysqli_fetch_assoc($result);
    return $row;
}



//查询所有
function fetchAll($sql){
    $result=mysqli_query(connect(),$sql);
    while ($row=mysqli_fetch_assoc($result)){
        $data[]=$row;
    }
    return $data;
}


//得到结果集条数
function getResultNum($sql){
    $result=mysqli_query(connect(),$sql);
    return mysqli_num_rows($result);

}

function get_insert_id($sql){

    //重新连接数据库
    $link = mysqli_connect(HOST,USERNAME,PASSWORD,DATABASE) or die("数据库连接失败");

    //定义字符集
    mysqli_query( $link,'set names utf8' );

    $res=mysqli_query($link, $sql);

    //返回最后一个查询中自动生成的 ID
    return mysqli_insert_id($link);
}