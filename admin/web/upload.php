<?php
require '../../conf/log.class.php';
if(!isset($_SESSION[USER])){
	header("Location:../login/login.php");exit;
}else{
	$error = "";
	$fileElementName = 'file';
	$name=$_FILES[$fileElementName]['name'];
	$typearr=array("gif","jpg","jpeg","png","bmp","pjpeg","JPG","JPEG");
	$uploadDir = '../../htmleditor/attached/image/mainpic/';
	$pictype=substr($name,strrpos($name,".")+1);
	$namepic = '';
	if(!empty($_FILES[$fileElementName]['error']))
	{
		$response['success'] = 0;
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
		$error='图片格式错误!';
	}
	elseif($_FILES[$fileElementName]['size']>307200){
		$error='图片不能超过300KB';
	}else{	
			$namefile=date("Ymd", time()).rand(1,10000).".".$pictype;
			$namepic=$namefile;
			$response = array ();
			if(move_uploaded_file($_FILES[$fileElementName]['tmp_name'], PATH_IMG.$namepic)){
				$response['success'] = 1;
				foreach ($_POST as $key => $value){
					$response[$key] = $value;
				}
			}else{
				$error = 'file upload failed';
			}
	}	
	if($error){
		$response['error'] = $error;
	}else{	
		$response['src'] = $namepic;	
	}
	exit(json_encode($response, JSON_UNESCAPED_UNICODE));
}
?>