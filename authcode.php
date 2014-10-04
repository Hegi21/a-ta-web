<?php
session_start();

Header("Content-type: image/PNG");
$str = "45125489456140848489156489456184854189451564894456489751564846";
$imgWidth = 140;
$imgHeight = 40;
$authimg = imagecreate($imgWidth,$imgHeight);
$bgColor = ImageColorAllocate($authimg,255,255,255);
$fontfile = "authcode/authcode/includes/font/heiti.ttf";
$white=imagecolorallocate($authimg,234,185,95);
imagearc($authimg, 150, 8, 20, 20, 75, 170, $white);
imagearc($authimg, 180, 7,50, 30, 75, 175, $white);
imageline($authimg,20,20,180,30,$white);
imageline($authimg,20,18,170,50,$white);
imageline($authimg,25,50,80,50,$white);
$noise_num = 800;
$line_num = 20;
imagecolorallocate($authimg,0xff,0xff,0xff);
$rectangle_color=imagecolorallocate($authimg,0xAA,0xAA,0xAA);
$noise_color=imagecolorallocate($authimg,0x00,0x00,0x00);
$font_color=imagecolorallocate($authimg,0x00,0x00,0x00);
$line_color=imagecolorallocate($authimg,0x00,0x00,0x00);
for($i=0;$i<$noise_num;$i++){
	imagesetpixel($authimg,mt_rand(0,$imgWidth),mt_rand(0,$imgHeight),$noise_color);
}
for($i=0;$i<$line_num;$i++){
	imageline($authimg,mt_rand(0,$imgWidth),mt_rand(0,$imgHeight),mt_rand(0,$imgWidth),mt_rand(0,$imgHeight),$line_color);
}
$randnum=rand(0,strlen($str)-4);
if($randnum%2)$randnum+=1;
$str = substr($str,$randnum,6);
$_SESSION['code']=$str;
$str = iconv("windows-1250","UTF-8",$str);
ImageTTFText($authimg, 20, 0, 16, 30, $font_color, $fontfile, $str);
ImagePNG($authimg);
ImageDestroy($authimg);
?>