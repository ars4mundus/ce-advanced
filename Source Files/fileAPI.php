<?php  

	//��ɾ� ����
	$cmd 			= $_POST['cmd'];
		
	if($cmd == "GetFileList"){			//���� ��� ��������
		GetFileList();
	}elseif($cmd == "DeleteFile"){		//������ ���� ����
		DeleteFile();
	}

	//���� ����
	function DeleteFile() {
		
		$uploads_dir = './uploads';
		$fileName = $_POST['fileName'];
		$filePath = "$uploads_dir/$fileName";
		
		unlink($filePath);
		$result['success']	= true;
		
		echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
		
	}

	
	//���� ��� ��������
	function GetFileList() {
	
		// ������ ����  
		$dir = "./uploads";  
		$filePath = "";
		  
		// �ڵ� ȹ��  
		$handle  = opendir($dir);  
		  
		$files = array();  
		$exts = array();  
		
		
		// ���͸��� ���Ե� ������ �����Ѵ�.  
		$fileItems = array();
		while (false !== ($filename = readdir($handle))) {  
			
			if($filename == "." || $filename == ".." || $filename == "Thumbs.db"){  
				continue;  
			}  
		
			$filePath = $dir . "/" . $filename;
		
			// ������ ��츸 ��Ͽ� �߰��Ѵ�.  
			if(is_file($filePath)){  
				array_push($fileItems,[
					'filenNme' => pathinfo($filePath, PATHINFO_BASENAME),
					'updateDate' => date ("Y-m-d H:i", filemtime($filePath)),
					'fileExt' => pathinfo($filePath, PATHINFO_EXTENSION),
					'mimeType' => mime_content_type($filePath),
					'fileSize' => number_format(filesize($filePath)/1024)
				]);
			}  
		}  
		$result['data']	= $fileItems;
		$result['success']	= true;
		// �ڵ� ����  
		closedir($handle);  
		  
		// ����, �������� �����Ϸ��� rsort ���  
		sort($files);  
		  
		echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
		
	}
?>  