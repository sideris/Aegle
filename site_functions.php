<?php
require 'phpheaders.php';


function findage($user){
$year=$user['year'];
$month=$user['month'];
$day=$user['day'];
    $year_diff  = date("Y") - $year;
    $month_diff = date("m") - $month;
    $day_diff   = date("d") - $day;
    if ($month_diff < 0)
      $year_diff--;
	   elseif (($month_diff==0) && ($day_diff < 0)) $year_diff--;
    return $year_diff;
  }

function selheight($height){
	echo "<select name=\"height\">";
	echo "<option value=\"0\"";
	if ($height==0) echo "selected=\"selected\"";
	echo "></option>";
	for ($i=120;$i<250;$i++){	
			echo "<option value=\"$i\"";
			if ($height==$i) echo "selected=\"selected\"";
			echo ">$i</option>";
		}
	echo "</select>";	
}
function selweight($weight){
	echo "<select name=\"weight\">";
	echo "<option value=\"0\"";
	if ($weight==0) echo "selected=\"selected\"";
	echo "></option>";
	for ($i=1;$i<251;$i++){	
			echo "<option value=\"$i\"";
			if ($weight==$i) echo "selected=\"selected\"";
			echo ">$i</option>";
		}
	echo "</select>";	
}
function seldate($day,$month,$year){
	$months=array("","January","February","March","April","May","June","July","August","September","October","November","December");
	echo "<select style=\"width:85px;\" name=\"month\">";
	echo "<option value=\"0\"";
	if ($month==0) echo "selected=\"selected\"";
	echo "></option>";
	for ($i=1;$i<13;$i++){	
		echo "<option  value=\"$i\"";
		if ($month==$i) echo "selected=\"selected\"";
		echo ">$months[$i]</option>";
	}
	echo "</select>";
	echo "<select name=\"day\">";
	echo "<option value=\"0\"";
	if ($day==0) echo "selected=\"selected\"";
	echo "></option>";

	for ($i=1;$i<32;$i++){	
		echo "<option value=\"$i\"";
		if ($day==$i) echo "selected=\"selected\"";
		echo ">$i</option>";
	}
	echo "</select>";
	
	echo "<select name=\"year\">";
	echo "<option value=\"0\"";
	if ($year==0) echo "selected=\"selected\"";
	echo "></option>";
	for ($i=2011;$i>1919;$i--){	
		echo "<option value=\"$i\"";
		if ($year==$i) echo "selected=\"selected\"";
		echo ">$i</option>";
	}
	echo "</select>";
}

function createthumb($name,$src,$dst,$new_w,$new_h)
{
	if (preg_match('/\.(jpg|jpeg)$/i', $name)) $src_img=imagecreatefromjpeg($src);
	if (preg_match('/\.(png)$/i', $name)) $src_img=imagecreatefrompng($src);
	$old_x=imageSX($src_img);
	$old_y=imageSY($src_img);
	if ($old_x > $old_y) 
	{
		$thumb_w=$new_w;
		$thumb_h=$old_y*($new_h/$old_x);
	}
	if ($old_x < $old_y) 
	{
		$thumb_w=$old_x*($new_w/$old_y);
		$thumb_h=$new_h;
	}
	if ($old_x == $old_y) 
	{
		$thumb_w=$new_w;
		$thumb_h=$new_h;
	}
	$dst_img=ImageCreateTrueColor($thumb_w,$thumb_h);
	imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y); 
	if (preg_match("/png/",$system[1]))
	{
		imagepng($dst_img,$dst); 
	} else {
		imagejpeg($dst_img,$dst); 
	}
	imagedestroy($dst_img); 
	imagedestroy($src_img); 
}
?>
