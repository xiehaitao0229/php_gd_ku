<?php
/*
 * 画布黑色
 * 字体大小
 * */

//  创建画布
$image = imagecreatetruecolor(500,500);
//  创建颜色
$white = imagecolorallocate($image,255,255,255);
$randColor = imagecolorallocate($image,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
//  imagefilledrectangle():绘制填充矩形
imagefilledrectangle($image,0,0,500,500,$white);

imagettftext($image,20,0,100,100,$randColor,'font/msyhbd.ttc','xiehaitao');
imagettftext($image,20,40,100,200,$randColor,'font/msyhbd.ttc','imooc');

header('content-type:image/png');
imagepng($image);

//  保存文件
imagepng($image,'images/1.png');

//  销毁资源
imagedestroy($image);

