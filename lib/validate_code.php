<?php
require_once 'string.php';
session_start();
/*
//通过gd库创建验证码
//创建画布
$width=80;
$height=30;

$checkImg=imagecreatetruecolor($width,$height);                 //创建画布
$black=imagecolorallocate($checkImg,0,0,0);                     //设置画笔
$blue=imagecolorallocate($checkImg,0,0,255);
$white=imagecolorallocate($checkImg,255,255,255);
imagefill($checkImg,0,0,$white);                                //区域填充


//生成随机验证码
$checkCode='';
for($i =0 ; $i<4 ; $i++){
    $checkCode.=rand(0,9);                                      //0-9之间的随机四位数
}
imagestring($checkImg,5,20,8,$checkCode,$black);               //将随机数绘制文字
$_SESSION['validateCode']=$checkCode;



//加入噪点干扰
for($i=0; $i<50; $i++){
    //画一个单一元素($img,  x坐标, y坐标 , 点的颜色)
    imagesetpixel($checkImg,rand(0,100),rand(0,100),$black);
    imagesetpixel($checkImg,rand(0,100),rand(0,100),$black);
}

//输出验证码
header("content-type: image/png");
imagepng($checkImg);
imagedestroy($checkImg);*/





//通过gd库创建验证码
//创建画布
function validateCode($type=1,$length=4,$sess_name="checkCode",$pixel=60,$line=0){
    //创建画布
    $width=80;
    $height=30;

    $checkImg=imagecreatetruecolor($width,$height);                 //创建画布
    $black=imagecolorallocate($checkImg,0,0,0);                     //设置画笔
    $white=imagecolorallocate($checkImg,255,255,255);
    imagefill($checkImg,0,0,$white);                                //区域填充


    //生成随机字符串
    $checkCode = ranStr($type,$length);
    $_SESSION[$sess_name] = $checkCode;                            //缓存

    //将ttf型字体写入图片(画布，尺寸，角度，x坐标，y坐标，颜色，字体名称或路径，字符串)
    for ($i = 0; $i < $length; $i++) {
        $size = mt_rand(12, 16);
        $angle = mt_rand(0, 15);
        $x = 5 + $i * $size;
        $y = mt_rand ( 20, 26 );
        $codeColor = imagecolorallocate($checkImg, mt_rand(20, 100), mt_rand(90, 200), mt_rand(45, 190));
        $fontFiles = array("FZLTCXHJW.TTF", "msyh.ttf", "msyhbd.ttf", "simsun.ttc", "SIMYOU.TTF", "STFANGSO.TTF", "STXIHEI.TTF");
        $fontFile = "../common/fonts/" . $fontFiles[mt_rand(0, count($fontFiles) - 1)];
        $text=substr($checkCode,$i,1);
        imagettftext($checkImg, $size, $angle, $x, $y, $codeColor, $fontFile, $text);
    }

    //加入噪点干扰
    if ($pixel){
        for($i=0; $i<$pixel; $i++){
            //画一个单一元素($img,  x坐标, y坐标 , 点的颜色)
            imagesetpixel($checkImg,mt_rand(0,100),rand(0,100),$black);
        }
    }

//加入直线干扰
    if($line) {
        for ($i = 0; $i < $line; $i++) {
            $color = imagecolorallocate($checkImg, mt_rand(0, 100), mt_rand(80, 180), mt_rand(45, 190));
            imageline($checkImg, mt_rand(0, 100), rand(0, 100), mt_rand(0, 100), rand(0, 100), $color);
        }
    }

//输出验证码
    header("content-type: image/png");
    imagepng($checkImg);
    imagedestroy($checkImg);

}

//调用
validateCode();
