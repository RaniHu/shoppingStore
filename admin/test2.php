<?php

require_once '../lib/upload.php';

//单文件上传
/*$fileInfo = $_FILES['curFile'];
uploadFlie($fileInfo);*/

$files=uploadFlie();
print_r($files);