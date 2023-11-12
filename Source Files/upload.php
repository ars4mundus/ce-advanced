<?php

// ����
$uploads_dir = './uploads';
$allowed_ext = array('jpg','jpeg','png','gif');
 
// ���� ����
$error = $_FILES['myfile']['error'];
$name = $_FILES['myfile']['name'];
//$ext = array_pop(explode('.', $name));

$ext = explode('.',$name); 
$ext = strtolower(array_pop($ext));






// ���� Ȯ��
if( $error != UPLOAD_ERR_OK ) {
	switch( $error ) {
		case UPLOAD_ERR_INI_SIZE:
		case UPLOAD_ERR_FORM_SIZE:
			echo "������ �ʹ� Ů�ϴ�. ($error)";
			break;
		case UPLOAD_ERR_NO_FILE:
			echo "������ ÷�ε��� �ʾҽ��ϴ�. ($error)";
			break;
		default:
			echo "������ ����� ���ε���� �ʾҽ��ϴ�. ($error)";
	}
	exit;
}
 
// Ȯ���� Ȯ��
/*
if( !in_array($ext, $allowed_ext) ) {
	echo "������ �ʴ� Ȯ�����Դϴ�.";
	exit;
}
*/



$newName = GetUniqFileName($name, "$uploads_dir/"); // ���� ȭ�� �̸��� �ִ��� �˻�


$filePath = "$uploads_dir/$newName";

// ���� �̵�
move_uploaded_file( $_FILES['myfile']['tmp_name'], $filePath);


$result['success']	= true;
$result['filenNme']	= $newName;
$result['updateDate']= date ("Y-m-d H:i", filemtime($filePath));
$result['fileExt']	= pathinfo($filePath, PATHINFO_EXTENSION);
$result['mimeType']	= mime_content_type($filePath);
$result['fileSize']	= number_format(filesize($filePath)/1024);

echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);


function GetUniqFileName($FN, $PN)
{
  $FileExt = substr(strrchr($FN, "."), 1); // Ȯ���� ����
  $FileName = substr($FN, 0, strlen($FN) - strlen($FileExt) - 1); // ȭ�ϸ� ����
 
  $FileCnt = 0;
  $ret = "$FileName.$FileExt";
  
  while(file_exists($PN.$ret)) // ȭ�ϸ��� �ߺ����� ������ ���� �ݺ�
  {
    $FileCnt++;
    $ret = $FileName."_".$FileCnt.".".$FileExt; // ȭ�ϸ�ڿ� (_1 ~ n)�� ���� �ٿ���....
  }
 
  return($ret); // �ߺ����� �ʴ� ȭ�ϸ� ����
}



?>