<?php

require_once 'string.php';



/*$filename='test.jpg';
resizeImg($filename,"image_50/".$filename,50,50,true);
resizeImg($filename,"image_220/".$filename,220,220,true);
resizeImg($filename,"image_350/".$filename,350,350,true);
resizeImg($filename,"image_800/".$filename,800,800,true);*/



/*生成缩略图*/
function resizeImg($filename,$destination=null,$dst_w=null,$dst_h=null,$reverseResource=true,$scale=0.5){

    //list将列表转换为数组
    //getimagesize(宽度，高度，类型)     获取原图像信息
    list($src_w,$src_h,$imageType)=getimagesize($filename);

    //定义缩放图片
    if(is_null($dst_w)||is_null($dst_h)){
        $dst_w=ceil($src_w*$scale);
        $dst_h=ceil($src_h*$scale);
    }

    //返回图像的 MIME 类型(描述消息内容类型的因特网标准,包含文本、图像、音频、视频以及其他应用程序专用的数据)
    $mime=image_type_to_mime_type($imageType);           //image/jpeg   image/gif等

    //替换/为createfrom 拼接函数imagecreatefromjpeg/gif等
    $createFun=str_replace("/","createfrom",$mime);

    //输出不同类型图像  imagejpeg/imagegif等
    $outFun=str_replace("/",null,$mime);

    //创建原图像
    $src_image=$createFun($filename);

    //创建缩略图画布
    $dst_image=imagecreatetruecolor($dst_w,$dst_h);

    //新建的图，载入的图，载入图坐标，载入宽度，载入高度，原图宽度，原图高度
    imagecopyresampled($dst_image,$src_image,0,0,0,0,$dst_w,$dst_h,$src_w,$src_h);

    //判断文件路径是否存在
    if($destination&&!file_exists(dirname($destination))){
        mkdir(dirname($destination),0777,true);
    }
    //若文件名不存在，则创建唯一文件名
    $dstFileName=$destination==null?getUniName().".".getExtName($filename):$destination;


    //以某种类型输出资源(图片，文件名，质量)
    $outFun($dst_image,$dstFileName);

    //销毁资源
    imagedestroy($src_image);
    imagedestroy($dst_image);

    //是否保留原文件
    if(!$reverseResource){
        unlink($filename);
    }

    //返回文件名
    return $dstFileName;

}