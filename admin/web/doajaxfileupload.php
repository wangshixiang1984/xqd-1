<?php
require '../../conf/log.class.php';
if(!isset($_SESSION[USER])){
	header("Location:../login/login.php");exit;
}else{
	$error = "";
	$msg = "";
	$fileElementName = empty($_GET['inputname']) ? 'keypic' : htmlentities($_GET['inputname']);
	$name=$_FILES[$fileElementName]['name'];
	// exit(json_encode(['a' => $_FILES]));

	$typearr=array("gif","jpg","jpeg","png","bmp","pjpeg","JPG","JPEG",'3gp','rmvb','flv','wmv','avi','mkv','mp4','mp3','wav');
	$picArr = array("gif","jpg","jpeg","png","bmp","pjpeg","JPG","JPEG");
	$pictype=substr($name,strrpos($name,".")+1);
	$type = 'pic';
	$namefile = "";
	if(!empty($_FILES[$fileElementName]['error']))
	{
		switch($_FILES[$fileElementName]['error'])
		{

			case '1':
				$error = 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
				break;
			case '2':
				$error = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
				break;
			case '3':
				$error = 'The uploaded file was only partially uploaded';
				break;
			case '4':
				$error = '没有文件上传';
				break;

			case '6':
				$error = 'Missing a temporary folder';
				break;
			case '7':
				$error = 'Failed to write file to disk';
				break;
			case '8':
				$error = 'File upload stopped by extension';
				break;
			case '999':
			default:
				$error = 'No error code avaiable';
		}
	}elseif(empty($_FILES[$fileElementName]['tmp_name']) || $_FILES[$fileElementName]['tmp_name'] == 'none')
	{
		$error = '没有文件上传..';
	}elseif(!in_array($pictype,$typearr)){
		$error='图片或视频格式错误!';
	}
	else{	
		$type = in_array($pictype,$picArr) ? 'pic' : 'video';
		if(in_array($pictype,$picArr) && $_FILES[$fileElementName]['size']>307200){
			$error='图片不能超过300KB';
		} else if( $_FILES[$fileElementName]['size'] > 512000000) {
			$error= '文件大于500M,超过服务器容量';
		} else {
			$namefile=date("Ymd", time()).rand(1,10000).".".$pictype;
			if($type === 'pic') {
				$namepic=PATH_IMG.$namefile;	
			} else {
				if(!is_dir(PATH_IMG.'video/')){
					mkdir(PATH_IMG.'video/');
				}
				
				$namepic=$_SERVER['DOCUMENT_ROOT'].'/htmleditor/attached/image/mainpic/video/'.$namefile;	
			}
			if(move_uploaded_file($_FILES[$fileElementName]['tmp_name'], $namepic)){
				$msg=$namepic;
			}
		}
	}		
	$res = ['error' => $error, 'msg' => $msg, 'filename' => $namefile ,'filetype' => $type ];	
	exit(json_encode($res, JSON_UNESCAPED_UNICODE));
}
?>