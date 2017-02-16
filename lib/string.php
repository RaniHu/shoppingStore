<?php

//创建随机字符串
function ranStr($type=1,$length=4){

    //类型一:纯数字型
    if ($type == 1) {
        $code=join("",range(0,9));

        //类型二:纯字母型
    }else if ($type==2){
        $code=join("",array_merge(range("a","z"),range("A","Z")));

        //类型三:数字加字母型
    }else if($type==3){
        $code=join("",array_merge(range(0,9),range("a","z"),range("A","Z")));
    }

    //检验字符长度
    if($length>strlen($code)){
        exit("字符长度错误！");
    }


    //随机打乱字符串
    $code=str_shuffle($code);
    //截取字符串
    return substr($code,0,$length);

}


/*生成唯一字符串*/
function getUniName(){
    //microtime返回当前时间戳的微秒数，true表示返回一个浮点数,false表示返回一个字符串
    //uniqid() 函数基于以微秒计的当前时间，生成一个唯一的 ID
    return md5(uniqid(microtime(true),true));
}


/*得到文件扩展名*/
function getExtName($filename){
    return strtolower(end(explode('.',$filename)));
}