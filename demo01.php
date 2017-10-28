<?php
//  1.创建画布
$width = 500;
$height = 500;

$image = imagecreatetruecolor($width,$height);

//  2.创建颜色
$white = imagecolorallocate($image,255,255,255);

//  3.开始绘画
imagestring($image,50,50,50,'fas1d23f03',$white);

//  4.告诉浏览器以图片的形式来显示
header('content-type:image/png');

//  5.imagepng($image):输出图像
imagepng($image);

//  6.销毁资源
imagedestroy($image);