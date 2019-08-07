<?php
/*
The function library is developed by Muntasir Mamun Joarder and is FREE to use. 
In case you are using the library please update me to svo97_12@yahoo.com so that 
I can keep you in the loop to let you update about the next versions.
Thanks to them who will find bug and report to svo97_12@yahoo.com.
*/

require_once('wurfl_config.php');  //--->Adaptacion a Wall4PHP...
require_once(WURFL_CLASS_FILE);

function getmicrotime() 
{ 
list($usec, $sec) = explode(" ", microtime()); 
return ((float)$usec + (float)$sec); 
} 

function convertImage($imagepath)
{
$ua=$_SERVER['HTTP_USER_AGENT'];
$uri=convertImageUA($imagepath,$ua);
return $uri;
} 

function convertImageUA($imagepath,$ua)
{
//******************** ***

include('DBConfig.php');
//---> Original con mysql...
/*$DBHandle=mysql_connect ($DBServer,$DBUser,$DBPass);
mysql_select_db ( $DBase );

$queryCount="Select count(*) as cnt from capability where ua='".$ua."'";
$result = mysql_query ($queryCount);
$totalcnt=mysql_result ( $result,0, "cnt");
mysql_free_result($result);  */

//---> Cambio a postgreSQL...
$cadena_conexion = 'host='.$DBServer.' port='.$Port.' dbname='.$DBase.' user='.$DBUser.' password='.$DBPass.'';
$conexion = pg_connect($cadena_conexion);
$queryCount = "Select count(*) as cnt from capability where ua='".$ua."'";
$result = pg_query($conexion, $queryCount);
$totalcnt = pg_result($result, 0, "cnt");
pg_free_result($result);

if ($totalcnt==0) // Not existed in the database
{
list($format,$devwidth,$devheight)= getCAP($ua);
/*
 if ($devwidth==0)// Not in WURFL
 {
 $sqlInsert="insert into errorprobability values ('".$ua."',0,0,0,0,0,0,0,0,1)";
 mysql_query($sqlInsert,$DBHandle) or die(mysql_error());
 }
 */

$sqlInsert="insert into capability values ('".$ua."','".$format."',".$devwidth.",".$devheight.")";


//mysql_query($sqlInsert,$DBHandle) or die(mysql_error());  //---> como estaba con mysql...
pg_query($conexion, $sqlInsert) /*or die(pg_errormessage($conexion))*/;
}
else // The user-agent is in the database
{
$querysql="Select * from capability where ua='".$ua."'";
/*$sql = mysql_query($querysql) or die(mysql_error());    //---> como estaba con mysql...
$row_sql =mysql_fetch_assoc($sql);*/
$sql = pg_query($conexion, $querysql);
$row_sql = pg_fetch_assoc($sql);
$DBua=$row_sql['ua'];
$DBFormat=$row_sql['format'];
$DBWi=$row_sql['devwidth'];
$DBHi=$row_sql['devheight'];
$info=array ($DBFormat,$DBWi,$DBHi);
//mysql_free_result($sql);                               //---> como estaba con mysql...
pg_free_result($sql);
list($format,$devwidth,$devheight)=$info;
}
//mysql_close($DBHandle);                                //---> como estaba con mysql...
pg_close($conexion);
if ($devwidth==0)
   return '';
// **********************************
list ($imwidth,$imheight)= getimagesize($imagepath);
list($Rwidth,$Rheight)=setImageDimension($imwidth,$imheight,$devwidth,$devheight);
$convD=$Rwidth."X".$Rheight;
$InputPathArr=explode("/",$imagepath);
$InputPathArrSize=count($InputPathArr);
$InputImageFileName=$InputPathArr[$InputPathArrSize-1];
$farray=explode(".",$InputImageFileName);
$InputImageName=strtolower($farray[0]);
$outputImageName=$InputImageName."_".$Rwidth."x".$Rheight;
$outputFileFullpath="";

$OutputImageDir="";
   for ($i=0; $i < ($InputPathArrSize-1); $i++ )
   {
   $OutputImageDir=$OutputImageDir.$InputPathArr[$i]."/";	
   }
$outputFileFullpath=$OutputImageDir."Resized/".$outputImageName;
$outputImageFull=$outputFileFullpath.".".$format;

$uri="";

if (file_exists($outputImageFull))// So no need to resize again
   {
   return $outputImageFull;
   }

if (($imwidth<= $devwidth)&&($imheight <= $devheight))// Image is shorter than screen  
  $uri=$imagepath;
else
  $uri=resizeImage($imagepath,$format,$outputImageName,$Rwidth,$Rheight); 

return $uri;
} 

function setImageDimension($imageWidth,$imageHeight,$deviceWidth,$deviceHeight)
{
$imageAspect=$imageWidth/$imageHeight;
$deviceAspect=$deviceWidth/$deviceHeight;
$imageAspectRatio=$imageAspect;

if (($imageWidth>$deviceWidth)&&($imageHeight>$deviceHeight))// Image larger than the screen
{
if (($imageAspect< 1) && ($deviceAspect< 1)) // both case Height is bigger than the width
  {
  	$device2imageratio=$deviceHeight/$imageHeight;
        $imageDimensionHeight=(integer)($imageHeight*$device2imageratio);
        $imageDimensionWidth=(integer) ($imageDimensionHeight*$imageAspectRatio);
  }
else if (($imageAspect > 1) && ($deviceAspect > 1)) // both case Width is bigger than the width
 { 
         $device2imageratio=$deviceWidth/$imageWidth;
         $imageDimensionWidth=(integer)($imageWidth*$device2imageratio);
         $imageDimensionHeight=(integer) ($imageDimensionWidth/$imageAspectRatio);	
 }
else if (($imageAspect < 1) && ($deviceAspect > 1)) // So fit to Height
  {
  	$device2imageratio=$deviceHeight/$imageHeight;
        $imageDimensionHeight=(integer)($imageHeight*$device2imageratio);
        $imageDimensionWidth=(integer) ($imageDimensionHeight*$imageAspectRatio);
  }
else if (($imageAspect > 1) && ($deviceAspect< 1)) // So fit to Width
 { 
         $device2imageratio=$deviceWidth/$imageWidth;
         $imageDimensionWidth=(integer)($imageWidth*$device2imageratio);
         $imageDimensionHeight=(integer) ($imageDimensionWidth/$imageAspectRatio);	
 }
else // Fit to anything
 { 
         $device2imageratio=$deviceWidth/$imageWidth;
         $imageDimensionWidth=(integer)($imageWidth*$device2imageratio);
         $imageDimensionHeight=(integer) ($imageDimensionWidth/$imageAspectRatio);	
 } 
}
else if (($imageWidth< $deviceWidth)&&($imageHeight < $deviceHeight)) // Image smaller than the screen
{
       $imageDimensionHeight=$imageHeight;
       $imageDimensionWidth=$imageWidth;
}
else // Any one portion of the image is outside the screen
{
 if ($imageWidth> $deviceWidth)	// So fit width
  {
         $device2imageratio=$deviceWidth/$imageWidth;
         $imageDimensionWidth=(integer)($imageWidth*$device2imageratio);
         $imageDimensionHeight=(integer) ($imageDimensionWidth/$imageAspectRatio);
  }
 else // So fit Height
 {
  	$device2imageratio=$deviceHeight/$imageHeight;
        $imageDimensionHeight=(integer)($imageHeight*$device2imageratio);
        $imageDimensionWidth=(integer) ($imageDimensionHeight*$imageAspectRatio);
 }
 
}
$dimensionArray=array ($imageDimensionWidth,$imageDimensionHeight);
$widthError=0;
$heightError=0;

if($deviceWidth< $imageDimensionWidth)
  {
  $widthError=1;
}

if($deviceHeight< $imageDimensionHeight){
  $heightError=1;
}

// Database Function...
/*
include('DBConfig.php');
$ua=$_SERVER['HTTP_USER_AGENT'];
$DBHandle=mysql_connect ($DBServer,$DBUser,$DBPass);
mysql_select_db ( $DBase );
$sqlInsert="insert into errorProbability values ('".$ua."',".$deviceWidth.",".$deviceHeight.",".$imageWidth.",".$imageHeight.",".$imageDimensionWidth.",".$imageDimensionHeight.",".$widthError.",".$heightError.",0)";
mysql_query($sqlInsert,$DBHandle) or die(mysql_error());
mysql_close($DBHandle);
*/
return $dimensionArray;
}


function getImageDimension($imagepath)
{

$InputPathArr=explode("/",$InputImage);
$InputPathArrSize=count($InputPathArr);
$InputImageFileName=$InputPathArr[$InputPathArrSize-1];
$farray=split(".",$InputImageFileName);
$InputImageFileExtension=strtolower($farray[1]);


switch ($InputImageFileExtension)
   {
   case 'jpg':
   case 'jpeg':
   		$SRC_IMAGE = ImageCreateFromJPEG($OutputImageFullPath);
   		break;
   case 'gif':
   		$SRC_IMAGE = ImageCreateFromgif($OutputImageFullPath);
   		break;
   case 'wbmp':
   		$SRC_IMAGE = ImageCreateFromwbmp($OutputImageFullPath);
   		break;
   case 'png':
   		$SRC_IMAGE = ImageCreateFrompng($OutputImageFullPath);
   		break;
   }
$imageWidth=imagesx($SRC_IMAGE);
$imageHeight=imagesy($SRC_IMAGE);
$imginf=array ($imageWidth,$imageHeight);
return $imginf;
}

function getCAP($ua)
{
$wurflObj = new wurfl_class();
$wurflObj->GetDeviceCapabilitiesFromAgent($ua);
$devcap=$wurflObj->capabilities;
//print_r($devcap);
$bestFormat='';
if ($devcap['image_format']['jpg'] == 1)
  $bestFormat='jpg';
else if ($devcap['image_format']['gif'] == 1)
  $bestFormat='gif';
else if ($devcap['image_format']['png'] == 1)
  $bestFormat='png';
else  
  $bestFormat='wbmp';
$maxWidth=$devcap['display']['max_image_width'];
$maxHeight=$devcap['display']['max_image_height'];
$capinfo=array($bestFormat,$maxWidth,$maxHeight);

//print_r($maxWidth);
return $capinfo;
}



function resizeImage($InputImage,$OutputFormat,$outputFileName,$Out_X,$Out_Y)
{
/*
How it works: In the folder where the main image resides, this function will Create a new folder named 'Resized' into it and copy the resized image into this folder. So at the end the main image will be unchanged.

Return : In the return the function will provide the final URL of the resized image in specific format. 

Capability: This function can work with four types of images: JPG, GIF, PNG and WBMP 

Parameters:

$InputImage= Full path of Input Image which is to be resized. Example: 'testImage/test.jpg'
$OutputFormat= What is the output format.Example: 'gif'
$outputFileName= What will be the name of the output file. Must remember that there will be no file extension with this name.Example: file0000. So then in the final version of the resized file the name will be : file0000.gif
$Out_X= Length of the X asis of the resized image.
$Out_Y= Length of the Y asis of the resized image.

Author: Muntasir Mamun (svo97_12@yahoo.com). If anyone find any bug please inform me by mail.
*/
//echo $Out_X."X".$Out_Y;

$URL="";
$InputPathArr=explode("/",$InputImage);
$InputPathArrSize=count($InputPathArr);
$InputImageFileName=$InputPathArr[$InputPathArrSize-1];
$InputImageFileExtension=strtolower(substr("$InputImageFileName",-3));
$OutputImageDir="";
   for ($i=0; $i < ($InputPathArrSize-1); $i++ )
   {
   $OutputImageDir=$OutputImageDir.$InputPathArr[$i]."/";	
   }
   
   if (!file_exists($OutputImageDir."Resized/"))
   	mkdir($OutputImageDir."Resized/");
   
   $OutputImageFullPath=$OutputImageDir."Resized/".$outputFileName.".".$InputImageFileExtension;
   if (!copy($InputImage,$OutputImageFullPath))
      echo 'Failed to copy';
   
   switch ($InputImageFileExtension)
   {
   case "jpg":
   		$SRC_IMAGE = ImageCreateFromJPEG($OutputImageFullPath);
   		break;
   case "gif":
   		$SRC_IMAGE = ImageCreateFromgif($OutputImageFullPath);
   		break;
   case "wbmp":
   		$SRC_IMAGE = ImageCreateFromwbmp($OutputImageFullPath);
   		break;
   case "png":
   		$SRC_IMAGE = ImageCreateFrompng($OutputImageFullPath);
   		break;
   }
   $SRC_X = ImageSX($SRC_IMAGE);
   $SRC_Y = ImageSY($SRC_IMAGE);
   $DEST_IMAGE = imagecreatetruecolor($Out_X, $Out_Y);
   unlink($OutputImageFullPath);
   $OUTPUT_FILE=$OutputImageDir."Resized/".$outputFileName.".".$OutputFormat;
      if (!imagecopyresized($DEST_IMAGE, $SRC_IMAGE, 0, 0, 0, 0, $Out_X, $Out_Y, $SRC_X, $SRC_Y)) {
     imagedestroy($SRC_IMAGE);
     imagedestroy($DEST_IMAGE);
     return(0);
   } else {
     imagedestroy($SRC_IMAGE);
   
   switch(strtolower($OutputFormat))
        {
   case "jpg":
   		$I = ImageJPEG($DEST_IMAGE,$OUTPUT_FILE);
   		break;
   case "gif":
   		$I = Imagegif($DEST_IMAGE,$OUTPUT_FILE);
   		break;
   case "wbmp":
   		$I = Imagewbmp($DEST_IMAGE,$OUTPUT_FILE);
   		break;
   case "png":
   		$I = Imagepng($DEST_IMAGE,$OUTPUT_FILE);
   		break;
   }
   if ($I) {
       imagedestroy($DEST_IMAGE);
       }
     //imagedestroy($DEST_IMAGE);
   }
     $URL=$OUTPUT_FILE;
     return ($URL);
}
?>
