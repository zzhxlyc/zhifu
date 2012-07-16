<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<form id="form" action="<?php echo FILE_HOME.'/upload'?>" method="post" enctype="multipart/form-data">
	<input name="file" type="file" />
	<input type="hidden" name="type" value="company"/>
	<input type="submit" value="上传"/>
</form>
</body>

<script type="text/javascript">
<!--

function upload_done(url){
	alert(url);
	//window.parent.upload_done(url);
}
<?php 
if($file_url){
	echo "upload_done('$file_url')";
}
?>
//-->
</script>

</html>