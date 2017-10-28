<?php
//  1.创建画布
//  imagecreatetruecolor($width,$heigth):创建画布，返回资源，返回图片标识符
$width = 500;
$heigth = 300;
$image = imagecreatetruecolor($width,$heigth);

//  2.创建颜色
//  imagecolorallocate():创建颜色
$red = imagecolorallocate($image,255,0,0);
$blue = imagecolorallocate($image,0,0,255);
$white = imagecolorallocate($image,255,255,255);

//  3.开始绘画
//  横着写一个字符
//  imagechar():水平的绘制一个字符
imagechar($image,5,50,100,'k',$red);
imagecharup($image,50,100,200,'f',$blue);
imagestring($image,50,300,100,'fsafs',$white);

//  4.告诉浏览器以图片的形式来显示
header('content-type:image/jpeg');

//  5.imagejpeg($image):输出图像
imagejpeg($image);

//  6.销毁资源
imagedestroy($image);