<?php

/**
 * 默认产生4位的验证码
 * @param string  $fontFile 字体文件
 * @param int $type 验证码类型 1：数字 2：字母 3：数字+字母 4：汉字
 * @param int $length  验证码长度
 * @param int $width 验证码宽度
 * @param int $height 验证码高度
 * @param int $pixel 验证码点数
 * @param int $line 验证码横线条数
 * @param string  $codeName 存入session的名字
 */
function getVerify($fontFile,$type=3,$length=4,$width=200,$height=50,$pixel=50,$line=3,$codeName='verifyCode'){
    $image = imagecreatetruecolor($width,$height);
    $white = imagecolorallocate($image,255,255,255);
    imagefilledrectangle($image,0,0,$width,$height,$white);

//  获取随机颜色
    function getRandColor($image){
        return imagecolorallocate($image,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
    }

    /*
     * 默认是4位的数字和验证码
     * 1-数字
     * 2-字母
     * 3-数字+字母
     * 4-汉字
     * */


    switch ($type){
        case 1:
            //  $string = '1234567890'  数字
            $string = join('',array_rand(range(0,9),$length));
            break;
        case 2:
            //  字母
            $string = join('',array_rand(array_flip(array_merge(range('a','z'),range('A','Z'))),$length));
            break;
        case 3:
            //  数字+字母
            $string = join('',array_rand(array_flip(array_merge(range(0,9),range('a','z'),range('A','Z'))),$length));
            break;
        case 4:
            //  汉字
            $str = "除,此,之,外,新,版,本,的,Q,Q,还,将,增,加,Q,,Q,看,点,未,读,消,息,一,键,提,取,多,端,收,发,红,包,以,及,集,成,式,聊,天,窗,口,等,功,能,上,述,这,些,新,功,能,也,将,进,一,步,的,提,升,用,户,体,验";
            $arr = explode(',',$str);
            $string = join('',array_rand(array_flip($arr),$length));
            break;
        default :
            exit('非法参数');
            break;
    }
    //  将验证码存入session
    session_start();
    $_SESSION[$codeName] = $string;
    for($i=0;$i<$length;$i++){
        $randColor = getRandColor($image);
        $size = mt_rand(20,28);
        $angle = mt_rand(-15,15);
        $x = 10+ceil($width/$length)*$i;
        $y = mt_rand(ceil($height/2),$height-10);
        $text = mb_substr($string,$i,1,'utf-8');
        imagettftext($image,$size,$angle,$x,$y,$randColor,$fontFile,$text);
    }

//  添加干扰元素
//  添加像素当做干扰元素
    for($i=1;$i<=$pixel;$i++){
        imagesetpixel($image,mt_rand(0,$width),mt_rand(0,$height),getRandColor($image));
    }

//  绘制线段当做干扰元素
    for($i=1;$i<=$line;$i++){
        imageline($image,mt_rand(0,$width),mt_rand(0,$height),mt_rand(0,$width),mt_rand(0,$height),getRandColor($image));
    }

    header('content-type:image/png');

    imagepng($image);

    imagedestroy($image);
}

getVerify();

