<?php
require_once '../lib/string.php';

/*function upload($fileName, $path, $size)
{
    //获取文件
    $file = $_FILES[$fileName];

    //获取文件名/类型/大小/错误
    $filename = $file['name'];
    $filetype = $file['type'];
    $filesize = $file['size'];
    $fileerror = $file['error'];

    //文件存放地址
    $upload_dir = $path;


    //如果上传的是jpg或gif图片
    if ((($filetype == "image/JPG") || ($filetype == "image/jpeg") || ($filetype == "image/jpg"))) {
        //若文件上传出错
        if ($_FILES['file']['error'] > 0) {
            echo "error:" . $fileerror . "<br/>";
        }
        //若图片大小超过20kb
        if ($filesize > $size) {
            echo "图片大小超过限制！";
        } else {

            //若文件已存在
            if (file_exists($upload_dir . $filename)) {
                echo "已经上传过图片！";
            } else {

                //把上传的文件移动到新位置(临时文件名,移动位置)
                move_uploaded_file($file['tmp_name'], $upload_dir . $filename);
                echo "文件上传成功!";
            }
        }
    } else {
        echo "文件格式错误！";
    }

}*/


function uploadFlie($path = '../upload/', $allowType = array("gif", "jpeg", "jpg", "png", "JPG", "JPEG", "PNG"),$maxSize=2097152, $imgFlag = true)
{


    //判断文件夹是否存在，不存在则创建
    if (!file_exists($path)) {
        mkdir($path, 0777, true);                                   //创建目录(0777最大权限)
    }


    //获取文件信息
    $i = 0;
    $files = buildFile();

    if(!($files&&is_array($files))){
        return ;
    }

    //单文件
    foreach ($files as $file) {

        //没有错误的情况下
        if ($file['error'] === UPLOAD_ERR_OK) {

            //获取文件扩展名
            $extName = getExtName($file['name']);


            //判断文件的扩展名是否符合
            if (!in_array($extName, $allowType)) {
                echo("文件类型错误!");
                echo $file['name'];
            }


            //验证上传文件类型是否是真正的图片
            if ($imgFlag) {
                $fileReal = getimagesize($file['tmp_name']);              //获取图像信息(宽，高，类型，宽高字符串，颜色位数，通道值)
                if (!$fileReal) {
                    exit("图片类型错误");
                }
            }

            //判断文件大小是否超过限制
            if ($file['size'] > $maxSize) {
                exit("文件大小超过限制!");
            }

            //检查是否是通过http post方式上传
            if (is_uploaded_file($file['tmp_name'])) {

                //为文件创建唯一的文件名
                $filename = getUniName() . "." . $extName;

                //保存文件路径
                $upload_dir = $path . $filename;

                //把上传的文件移动到新位置(临时文件名,移动位置)
                if (move_uploaded_file($file['tmp_name'], $upload_dir)) {
                    $file['name'] = $filename;                         //文件名为创建的唯一文件名
                    unset($file['tmp_name'], $file['size'], $file['type']);
                    $uploadedFiles[$i] = $file;
                    $i++;
                    echo "文件上传成功!";
                } else {
                    echo "文件上传失败!";
                }
            } else {
                echo "文件不是通过http post方式上传";
            }


        }

    }
    return $uploadedFiles;

}


//构建文件信息
function buildFile()
{
    $i = 0;
    foreach ($_FILES as $val) {
        //单文件
        if (is_string($val['name'])) {
            $files[$i] = $val;
            $i++;
        } //多文件
        else {

            //循环遍历键名key(下标)和值val
            foreach ($val['name'] as $key => $value) {
                $files[$i]['name'] = $value;
                $files[$i]['type'] = $val['type'][$key];
                $files[$i]['size'] = $val['size'][$key];
                $files[$i]['error'] = $val['error'][$key];
                $files[$i]['tmp_name'] = $val['tmp_name'][$key];
                $i++;
            }
        }

    }

    //返回文件数组
    return $files;
}



