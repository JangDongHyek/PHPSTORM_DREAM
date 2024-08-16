<?php
// 제휴회원(SK) 엑셀업로드
include_once('../common.php');
include_once('../plugin/excel/PHPExcel.php');

error_reporting(E_ALL);
ini_set("display_errors", 1);

//echo get_encrypt_string('1234');

if (empty($_POST['flag'])) {
?>
<form action="?" method="post" enctype='multipart/form-data'>
	<input type="hidden" name="flag" value="1">
	<input type="file" name="excelFile">
	<input type="submit" value="업로드">
</form>
<?
} else {

	////////////////////////////////
	die("start");
	////////////////////////////////

	$objPHPExcel = new PHPExcel();

	// 엑셀 데이터를 담을 배열을 선언한다.
	$allData = array();

	// 파일의 저장형식이 utf-8일 경우 한글파일 이름은 깨지므로 euc-kr로 변환해준다.
	$filename = iconv("UTF-8", "EUC-KR", $_FILES['excelFile']['tmp_name']);

	// 회원정보 담을배열
	$mb_data[] = array();

	try {
		// 업로드한 PHP 파일을 읽어온다.
		$objPHPExcel = PHPExcel_IOFactory::load($filename);

		$extension = strtoupper(pathinfo($filename, PATHINFO_EXTENSION));
		$sheetsCount = $objPHPExcel -> getSheetCount();

		// 시트Sheet별로 읽기 하려면 for돌리기
		//for($sheet = 0; $sheet < $sheetsCount; $sheet++) { ... }
		$sheet = 0;

		$objPHPExcel -> setActiveSheetIndex($sheet);
		$activesheet = $objPHPExcel -> getActiveSheet();
		$highestRow = $activesheet -> getHighestRow();			// 마지막 행
		$highestColumn = $activesheet -> getHighestColumn();	// 마지막 컬럼

		$mb_data = array();

		// 한줄읽기
		for($row = 2; $row <= $highestRow; $row++) {
			// $rowData가 한줄의 데이터를 셀별로 배열처리 된다.
			$rowData = $activesheet -> rangeToArray("A" . $row . ":" . $highestColumn . $row, NULL, TRUE, FALSE);

			// $rowData에 들어가는 값은 계속 초기화 되기때문에 값을 담을 새로운 배열을 선안하고 담는다.
			//if ($row == 1) continue;
			$allData[$row] = $rowData[0];

			$tmp = array();

			/*
			// SK매직
			//$birth = "19".$rowData[0][4];
			$tmp['mb_id'] = $rowData[0][1];
			$tmp['mb_name'] = $rowData[0][2];
			$tmp['mb_hp'] = $rowData[0][3];
			$tmp['mb_birth'] = substr($birth, 0, 4)."-".substr($birth, 4, 2)."-".substr($birth, 6, 2);
			$tmp['mb_addr1'] = $rowData[0][5];
			$tmp['mb_sex'] = $rowData[0][6];
			*/

			// 201020. 한화손해보험
			// 210216. KNN
			//$tmp['mb_id'] = preg_replace("/\s+/","", trim($rowData[0][1]));
			//$tmp['mb_name'] = preg_replace("/\s+/","", trim($rowData[0][0]));

			// 210311. SK매직
			//$tmp['mb_id'] = preg_replace("/\s+/","", trim($rowData[0][1]));
			//$tmp['mb_name'] = preg_replace("/\s+/","", trim($rowData[0][2]));
			//$tmp['mb_hp'] = trim($rowData[0][5]);
			//$tmp['mb_addr1'] = trim($rowData[0][6]);

			// 210513. 기영물류
			//$tmp['mb_name'] = preg_replace("/\s+/","", trim($rowData[0][1]));
			//$tmp['mb_hp'] = trim($rowData[0][2]);
			//$tmp['mb_addr1'] = trim($rowData[0][3]);
			//$tmp['mb_id'] = preg_replace("/[^0-9]*/s", "", $tmp['mb_hp']);

			// 210621. SK렌터카
			//$tmp['mb_id'] = preg_replace("/[^0-9]*/s", "", trim($rowData[0][2]));
			//$tmp['mb_name'] = trim($rowData[0][0]);
			//$exp = explode("SKR", trim($rowData[0][1]));
			//$tmp['mb_name'] .= $exp[0];

			// 210624. SK매직노동조합
			//$tmp['mb_id'] = trim($rowData[0][1]);
			//$tmp['mb_name'] = trim($rowData[0][2]);
			//$tmp['mb_hp'] = trim($rowData[0][4]);
			//$tmp['mb_addr1'] = trim($rowData[0][5]);

			// 220125. SK해운연합노동조합
			//$tmp['mb_id'] = trim($rowData[0][1]);
			//$tmp['mb_name'] = trim($rowData[0][2]);

			// 220401. 한화손해보험
			//$tmp['mb_id'] = preg_replace("/[^0-9]*/s", "", trim($rowData[0][1]));
			//$tmp['mb_name'] = trim($rowData[0][0]);
			//$tmp['mb_hp'] = trim($rowData[0][1]);
			//if ($tmp['mb_id'] == "") continue;

			// 220426. SK해운
			//$tmp['mb_id'] = preg_replace("/[^0-9]*/s", "", trim($rowData[0][2]));
			//$tmp['mb_name'] = trim($rowData[0][1]);
			//$tmp['mb_hp'] = trim($rowData[0][2]);
			//if ($tmp['mb_id'] == "") continue;

			// 221031. HLB에너지(주)
			//$tmp['mb_id'] = preg_replace("/[^0-9]*/s", "", trim($rowData[0][3]));
			//$tmp['mb_name'] = trim($rowData[0][1]);
			//$tmp['mb_hp'] = trim($rowData[0][3]);
			//if ($tmp['mb_id'] == "") continue;

			// 230517. 사하소방서 의용소방대
			$tmp['mb_id'] = preg_replace("/[^0-9]*/s", "", trim($rowData[0][1]));
			$tmp['mb_name'] = trim($rowData[0][0]);
			$tmp['mb_hp'] = trim($rowData[0][1]);


			$mb_data[] = $tmp;
		}

	} catch(exception $exception) {
		//echo $exception;
		die("ERROR");
	}

	
	echo "<pre>";
	//print_r($allData);
	//echo "총 ".count($mb_data)."건<br>";
	//print_r($mb_data);
	die();

	foreach ($mb_data as $key=>$val) {
		//if ($key < 3) continue;	// 3행부터 출력

		$mb_password = '1234';
		$mb_id = $val['mb_id'];
		$mb_route_input = "사하소방서 의용소방대";
		$mb_bank_amt = 100000;
		$mb_hp = $val['mb_hp'];

		$sql = "INSERT INTO g5_member SET
				mb_id = '{$mb_id}',
				mb_group = '1',
				mb_password = '".get_encrypt_string($mb_password)."',
				mb_name = '{$val['mb_name']}',
				mb_level = '2',
				mb_sex = '',
				mb_birth = '',
				mb_hp = '{$mb_hp}',
				mb_addr1 = '',
				mb_datetime = '".G5_TIME_YMDHIS."',
				mb_route = '직접입력',
				mb_route_input = '{$mb_route_input}',
				mb_bank_amt = {$mb_bank_amt}
				";
		//echo $sql."<br>";
		
		// ID중복체크
		$jungbok = sql_fetch("SELECT COUNT(*) AS cnt FROM g5_member WHERE mb_id = '{$mb_id}'");
		echo $mb_id." // ";
		echo ((int)$jungbok['cnt'] == 0)? "ok" : "★아이디중복★";
		echo " // ";

		//echo (sql_query($sql))? "완료" : "실패";
		echo "<br>";
	}
	
	echo "</pre>";
	
}

?>