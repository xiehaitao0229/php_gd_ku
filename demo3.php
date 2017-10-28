<?php
/*
 * 制作6位的数字+字母的验证码
 * */

//  创建画布
$image = imagecreatetruecolor(400,50);

//  创建颜色
$white = imagecolorallocate($image,255,255,255);
imagefilledrectangle($image,0,0,400,50,$white);
//  创建一个画笔颜色
$randColor = imagecolorallocate($image,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));

//  开始绘制
$size = mt_rand(20,28);
$angle = mt_rand(-15,15);
$x = 50;
$y = 30;
$fontFile = 'font/msyhl.ttc';
$text = getRandomString(6);
imagettftext($image,$size,$angle,$x,$y,$randColor,$fontFile,$text);

//  4.告诉浏览器以图片的形式来显示
header('content-type:image/png');

//  5.imagepng($image):输出图像
imagepng($image);

//  6.销毁资源
imagedestroy($image);

function getRandomString($len,$chars=null){
    if(is_null($chars)){
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    }

    mt_srand(10000000*(double)microtime());
    for ($i = 0, $str = '', $lc = strlen($chars)-1; $i < $len; $i++){
        $str .= $chars[mt_rand(0, $lc)];
    }
    return $str;
}
