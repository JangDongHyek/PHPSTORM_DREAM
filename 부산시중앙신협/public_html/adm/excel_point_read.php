
<?

require_once "../PHPExcel/Classes/PHPExcel.php"; // PHPExcel.php을 불러와야 하며, 경로는 사용자의 설정에 맞게 수정해야 한다.

$objPHPExcel = new PHPExcel();

require_once "../PHPExcel/Classes/PHPExcel/IOFactory.php"; // IOFactory.php을 불러와야 하며, 경로는 사용자의 설정에 맞게 수정해야 한다.

include_once('./_common.php');


//$filename = './file.xlsx'; // 서버에 올려진 파일을 직접 지정할 경우



// excel_upload.php 파일을 이용해 업로드 한 경우

$filename = $_FILES['excelFile']['tmp_name'];
$arr = [];
try {

    // 업로드 된 엑셀 형식에 맞는 Reader객체를 만든다.

    $objReader = PHPExcel_IOFactory::createReaderForFile($filename);



    // 읽기전용으로 설정

    $objReader->setReadDataOnly(true);



    // 엑셀파일을 읽는다

    $objExcel = $objReader->load($filename);



    // 첫번째 시트를 선택

    $objExcel->setActiveSheetIndex(0);

    $objWorksheet = $objExcel->getActiveSheet();

    $rowIterator = $objWorksheet->getRowIterator();

    foreach ($rowIterator as $row) { // 모든 행에 대해서

        $cellIterator = $row->getCellIterator();

        $cellIterator->setIterateOnlyExistingCells(false);

    }



    $maxRow = $objWorksheet->getHighestRow();


    $expire = preg_replace('/[^0-9]/', '', $config['cf_point_term']);

    for ($i = 1 ; $i <= $maxRow ; $i++) {


        $number = $objWorksheet->getCell('A' . $i)->getValue(); // C열
        $name = $objWorksheet->getCell('B' . $i)->getValue(); // C열
        $point = $objWorksheet->getCell('C' . $i)->getValue(); // C열
        $content = $objWorksheet->getCell('D' . $i)->getValue(); // D열

        if ($number != "" && $name != "") {
            $sql = "select mb_id from g5_member where mb_1 = '{$number}' and mb_name = '{$name}' ";
            $mb_id = sql_fetch($sql)["mb_id"];

            $point = str_replace(",", "", $point);
            if ($mb_id != "") {
                $result = insert_point($mb_id, $point, $content, '@passive', $mb_id, $mb_id . '-' . uniqid(''), $expire);
                if ($result != 1) {
                    die("fail");
                }
            }

        }

    }


}



catch (exception $e) {

    echo "엑셀 파일을 읽는 도중 오류가 발생 하였습니다.";

}

?>

