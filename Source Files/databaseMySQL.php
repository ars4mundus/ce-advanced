<?php
	header('Content-Type: text/html; charset=UTF-8');
	

	//��ɾ� ����
	$cmd 			= $_POST['cmd'];
		
	if($cmd == "DBConnection"){			//DB���� �׽�Ʈ
		DBConnection();
	}elseif($cmd == "SaveDBTicket"){		//DB���� ���� Session ����
		SaveDBTicket();
	}elseif($cmd == "GetListMovies"){		//Movie ��ü ������ ��������
		GetListMovies();
	}elseif($cmd == "DeleteMovie"){			//������ Movie ����
		DeleteMovie();
	}elseif($cmd == "CreateMovie"){			//�ű� Movie ���
		CreateMovie();
	}elseif($cmd == "InitDatabase"){		//�����ͺ��̽� ���̺� �ʱ�ȭ
		InitDatabase();
	}elseif($cmd == "DropDatabaseTable"){	//���̺� Drop
		DropDatabaseTable();
	}
	
	
	//Table Drop
	function DropDatabaseTable() {
		
		try {
			session_start();
			$connect = mysqli_connect($_SESSION['db_addr'], $_SESSION['db_userId'], $_SESSION['db_userPw'], $_SESSION['db_name'], $_SESSION['db_port']) or die("DB connection Failed.");

			$sql = "DROP TABLE movies";
			
			$result['success']	= mysqli_query($connect, $sql);
			$result['msg']		= "Database table droped.";
		
			mysqli_close($connect);
			
		} catch(exception $e) {
		
			$result['success']	= false;
			$result['msg']		= $e->getMessage();

		} finally {
			echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
		}
			
	}
	
	
	//�����ͺ��̽� ���̺� �ʱ�ȭ
	function InitDatabase() {
		
		try {
			session_start();
			$connect = mysqli_connect($_SESSION['db_addr'], $_SESSION['db_userId'], $_SESSION['db_userPw'], $_SESSION['db_name'], $_SESSION['db_port']) or die("DB connection Failed.");

			$sql = "CREATE TABLE temp_test.`movies` ("
				  ."`ID` 	  varchar(7) NOT NULL,"
				  ."`TITLE_KO` varchar(256) NOT NULL,"
				  ."`TITLE_EN` varchar(256) NOT NULL,"
				  ."`GENRE` varchar(256) DEFAULT NULL,"
				  ."`DIRECTOR` varchar(128) DEFAULT NULL,"
				  ."`RELEASE_YEAR` varchar(4) DEFAULT NULL,"
				  ."PRIMARY KEY (`ID`)"
				.") ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;";
			$pResult = mysqli_query($connect, $sql);
			
			$sql  = iconv("EUC-KR", "UTF-8", "INSERT INTO `temp_test`.`movies` (`ID`,`TITLE_KO`,`TITLE_EN`,`GENRE`,`DIRECTOR`,`RELEASE_YEAR`)VALUES('DYXZBUH','�߰���','The Chaser','����','��ȫ��','2008');");
			$sql .= iconv("EUC-KR", "UTF-8", "INSERT INTO `temp_test`.`movies` (`ID`,`TITLE_KO`,`TITLE_EN`,`GENRE`,`DIRECTOR`,`RELEASE_YEAR`)VALUES('FNZS7SB','��Ǫ�Ҵ�','Kung Fu Panda','�ִϸ��̼�','���ο�','2008');");
			$sql .= iconv("EUC-KR", "UTF-8", "INSERT INTO `temp_test`.`movies` (`ID`,`TITLE_KO`,`TITLE_EN`,`GENRE`,`DIRECTOR`,`RELEASE_YEAR`)VALUES('U6FHF7A','���� ��, ���� ��, �̻��� ��','The Good, the Bad, and the Weird','�׼�','������','2008');");
			$sql .= iconv("EUC-KR", "UTF-8", "INSERT INTO `temp_test`.`movies` (`ID`,`TITLE_KO`,`TITLE_EN`,`GENRE`,`DIRECTOR`,`RELEASE_YEAR`)VALUES('JY0H2O0','���̾��','Iron Man','SF','�� �ĺ��','2008');");
			$sql .= iconv("EUC-KR", "UTF-8", "INSERT INTO `temp_test`.`movies` (`ID`,`TITLE_KO`,`TITLE_EN`,`GENRE`,`DIRECTOR`,`RELEASE_YEAR`)VALUES('AW4IAI8','��ö��','Public Enemy Returns','����','���켮','2008');");
			$sql .= iconv("EUC-KR", "UTF-8", "INSERT INTO `temp_test`.`movies` (`ID`,`TITLE_KO`,`TITLE_EN`,`GENRE`,`DIRECTOR`,`RELEASE_YEAR`)VALUES('VHQ4D3K','�츮 ���� �ְ��� ����','Forever the Moment','���','�Ӽ���','2008');");
			$sql .= iconv("EUC-KR", "UTF-8", "INSERT INTO `temp_test`.`movies` (`ID`,`TITLE_KO`,`TITLE_EN`,`GENRE`,`DIRECTOR`,`RELEASE_YEAR`)VALUES('47TZCJO','��Ƽ��','Wanted','�׼�','Ƽ����','2008');");
			$sql .= iconv("EUC-KR", "UTF-8", "INSERT INTO `temp_test`.`movies` (`ID`,`TITLE_KO`,`TITLE_EN`,`GENRE`,`DIRECTOR`,`RELEASE_YEAR`)VALUES('VC2FLAF','����','Hancock','�׼�','���� ����','2008');");
			$sql .= iconv("EUC-KR", "UTF-8", "INSERT INTO `temp_test`.`movies` (`ID`,`TITLE_KO`,`TITLE_EN`,`GENRE`,`DIRECTOR`,`RELEASE_YEAR`)VALUES('38ABE4Q','����ū','Taken','������','�ǿ��� ��','2008');");
			
			$result['success']	= mysqli_multi_query($connect, $sql);
			$result['msg']		= "Database initialize.";
		
			mysqli_close($connect);
			
		} catch(exception $e) {
		
			$result['success']	= false;
			$result['msg']		= $e->getMessage();

		} finally {
			echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
		}
			
	}
	
	
	//�ű� Movew ���
	function CreateMovie() {
		
		try {
			session_start();
			$connect = mysqli_connect($_SESSION['db_addr'], $_SESSION['db_userId'], $_SESSION['db_userPw'], $_SESSION['db_name'], $_SESSION['db_port']) or die("DB connection Failed.");
			
			$genId = generateRandomString();
			
			$title_ko = $_POST['title_ko'];
			$title_en = $_POST['title_en'];
			$genre = $_POST['genre'];
			$director = $_POST['director'];
			$release_year = $_POST['release_year'];
			
			$sql = "INSERT INTO `temp_test`.`movies` (`ID`,`TITLE_KO`,`TITLE_EN`,`GENRE`,`DIRECTOR`,`RELEASE_YEAR`)VALUES('$genId','$title_ko','$title_en','$genre','$director','$release_year')";
			
			error_log($sql);
			
			$result['success'] = mysqli_query($connect, $sql);
			$result['id'] = $genId;
			$result['title_ko'] = $title_ko;
			$result['title_en'] = $title_en;
			$result['genre'] = $genre;
			$result['director'] = $director;
			$result['release_year'] = $release_year;
			$result['msg']     = "Movie created.";
			
			mysqli_close($connect);
			
		} catch(exception $e) {
		
			$result['success']	= false;
			$result['msg']		= $e->getMessage();

		} finally {
			echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
		}
			
	}

	
	


	//������ Movie ����
	function DeleteMovie() {
		
		try {
			session_start();
			$connect = mysqli_connect($_SESSION['db_addr'], $_SESSION['db_userId'], $_SESSION['db_userPw'], $_SESSION['db_name'], $_SESSION['db_port']) or die("DB connection Failed.");
			
			$result['success'] = mysqli_query($connect, "delete from movies where id = '{$_POST['movieId']}'");
			$result['msg']     = "The selected movie has been deleted.";
			
			mysqli_close($connect);
			
		} catch(exception $e) {
		
			$result['success']	= false;
			$result['msg']		= $e->getMessage();

		} finally {
			echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
		}
			
	}

	//Movie ��ü ������ ��������
	function GetListMovies() {
		
		try {
			session_start();
			$connect = mysqli_connect($_SESSION['db_addr'], $_SESSION['db_userId'], $_SESSION['db_userPw'], $_SESSION['db_name'], $_SESSION['db_port']) or die("DB connection Failed.");
			
			$query = mysqli_query($connect, "select * from movies order by TITLE_KO");
			
			$Movies = array();
			while($ls = mysqli_fetch_array($query)){
				array_push($Movies,[
					'ID' => $ls['ID'],
					'TITLE_KO' => $ls['TITLE_KO'],
					'TITLE_EN' => $ls['TITLE_EN'],
					'GENRE' => $ls['GENRE'],
					'DIRECTOR' => $ls['DIRECTOR'],
					'RELEASE_YEAR' => $ls['RELEASE_YEAR']
				]);  
			}
			$result['data']	= $Movies;
			$result['success']	= true;
			
			mysqli_close($connect);
			
		} catch(exception $e) {
		
			$result['success']	= false;
			$result['msg']		= $e->getMessage();

		} finally {
			echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
			
		}
			
	}
	
	
	//DB���� ���� ��������
	function getDBConnection() {
		
		session_start();
		
		return mysqli_connect($_SESSION['db_addr'], $_SESSION['db_userId'], $_SESSION['db_userPw'], $_SESSION['db_name'], $_SESSION['db_port']) or die("DB connection Failed.");
					
	}
	
	
	//DB���� ���� Session ����
	function SaveDBTicket() {
		
		session_start();
			
		//DB ���� �׽�Ʈ
		$_SESSION['db_addr'] = 		$_POST['db_addr'];
		$_SESSION['db_userId'] = 	$_POST['db_userId']; 
		$_SESSION['db_userPw'] = 	$_POST['db_userPw'];
		$_SESSION['db_name'] =		$_POST['db_name'];
		$_SESSION['db_port'] =		$_POST['db_port'];
		
		$result['success']	= true;
		
		echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
			
	}
	
	//DB���� �׽�Ʈ
	function DBConnection() {

		//DB ���� �׽�Ʈ
		$db_addr = 		$_POST['db_addr'];
		$db_userId = 	$_POST['db_userId']; 
		$db_userPw = 	$_POST['db_userPw'];
		$db_name =		$_POST['db_name'];
		$db_port =		$_POST['db_port'];

		try {

			$connect = mysqli_connect($db_addr, $db_userId, $db_userPw, $db_name, $db_port) or die("DB connection Failed.");
			
			// Check connection
			if (mysqli_connect_error()){
			   throw new Exception();
			}else{
				$result['success']	= true;
				$result['msg']		= "DB connection successful.";
				mysqli_close($connect);
			}
			
		} catch(exception $e) {
		
			$result['success']	= false;
			$result['msg']		= $e->getMessage();

		} finally {
			
			echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
			
		}
	}
	
	//���� ID �����
	function generateRandomString($length = 7) {
		
		$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';

		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[mt_rand(0, $charactersLength - 1)];
		}
		
		return $randomString;
	}
	
	

?>
