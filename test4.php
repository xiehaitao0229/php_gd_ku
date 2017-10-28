<?php
$width = 200;
$height = 40;
$image = imagecreatetruecolor($width,$height);
$white = imagecolorallocate($image,255,255,255);
imagefilledrectangle($image,0,0,$width,$height,$white);

//  获取随机颜色
function getRandColor($image){
    return imagecolorallocate($image,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
}

//  快速创建字符串  0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ
$string = join('',array_merge(range(0,9),range('a','z'),range('A','Z')));

/*echo $string;*/

//  得到字体的宽度
$textWidth = imagefontwidth(28);

//  得到字体的高度
$textHeight = imagefontheight(28);

//  定义验证码的长度
$length = 4;
for($i=0;$i<$length;$i++){
    $randColor = getRandColor($image);
    $size = mt_rand(20,28);
    $angle = mt_rand(-15,15);
    $x = 20+40*$i;
    $y = 30;
    $fontFile = 'font/msyhl.ttc';
    $text = str_shuffle($string)[0];  //  打乱字符串取第一个
    imagettftext($image,$size,$angle,$x,$y,$randColor,$fontFile,$text);
}

//  添加干扰元素
//  添加像素当做干扰元素
for($i=1;$i<=50;$i++){
    imagesetpixel($image,mt_rand(0,$width),mt_rand(0,$height),getRandColor($image));
}

//  绘制线段当做干扰元素
for($i=1;$i<=3;$i++){
    imageline($image,mt_rand(0,$width),mt_rand(0,$height),mt_rand(0,$width),mt_rand(0,$height),getRandColor($image));
}
//  4.告诉浏览器以图片的形式来显示
header('content-type:image/png');

//  5.imagepng($image):输出图像
imagepng($image);

//  6.销毁资源
imagedestroy($image);
