<?
include_once("./_common.php");
include_once("../jl/JlConfig.php");
include_once('../lib/PHPExcel/Classes/PHPExcel/IOFactory.php');

$model = new JlModel(array("table" => "meal_plan"));

$file = new JlFile("/jl/jl_resource/excel");

$objPHPExcel = PHPExcel_IOFactory::load($jl->ROOT."/jl/jl_resource/test.xlsx");
$sheetCount = $objPHPExcel->getSheetCount();

//셀값이 병합인지 단일인지 확인후 병합일경우 병합의 값을 가져오게 하는 함수
function getMergedCellValue($sheet, $cellAddress) {
    $cell = $sheet->getCell($cellAddress);
    if ($cell->isInMergeRange()) {
        // 병합된 셀 범위의 첫 번째 셀 가져오기
        $mergeRange = $cell->getMergeRange();
        $rangeArray = explode(':', $mergeRange); // 배열로 분리
        $firstCellAddress = $rangeArray[0]; // 첫 번째 셀 주소 가져오기
        $firstCell = $sheet->getCell($firstCellAddress); // 첫 번째 셀 가져오기
        return $firstCell->getValue();
    }
    return cellConfirm($cell->getValue()); // 병합되지 않은 경우 원래 값 반환
}

//셀값이 객체일때 텍스트값만 가져오는 함수
function cellConfirm($cell) {
    if ($cell instanceof PHPExcel_RichText) {
        return $cellValue = $cell->getPlainText(); // 순수 텍스트만 가져오기
    } else {
        return $cellValue = $cell; // 일반 텍스트일 경우 그대로 사용
    }
}

$first_test = false;
if($first_test) {
    // 첫 번째 시트 가져오기
    $sheet = $objPHPExcel->getSheet(0);
    $sheetName = $sheet->getTitle();
    $page = 0;
    $page_roop = 35;
    for ($i = 1; $i <= 6; $i++) {
        $date   = $page + 2;     //요일

        $page_start = 3;
        $page_end = 35;



        $range = "E{$date}:J{$date}"; // 요일 가져오는 특이성이 강한 일요일은 제외
        $dates = $sheet->rangeToArray($range, NULL, TRUE, TRUE, TRUE);
        $arrays = array();
        //요일만큼 반복
        foreach ($dates as $index => $date) {
            //데이터의 구조가 2중이라 한번더 파고들기
            foreach ($date as $position => $d) {
                $dd = $jl->stringDateToDate($d);
                if($dd) $dd = $dd->format('Y-m-d');

                for($j = $page_start; $j <= $page_end; $j++) {
                    $target = $page + $j;
                    $times = getMergedCellValue($sheet,"B{$target}"); // 조식,중식,석식
                    $category = getMergedCellValue($sheet,"C{$target}"); // 한식,디저트,중식
                    $type = getMergedCellValue($sheet,"D{$target}"); // 밥,메인,김치,
                    $name = getMergedCellValue($sheet,"$position{$target}"); // 메뉴명
                    $obj = array(
                        "sheet" => $sheetName,
                        "times" => $times,
                        "category" => $category,
                        "type" => $type,
                        "name" => $name,
                        "day" => $dd
                    );

                    if($name) {
                        //시트명,제공시간,요리카레고리,요리타입,날짜 가 있는경우 요리명만 바뀌어서 업데이트
                        $where_obj = array(
                            "sheet" => $sheetName,
                            "times" => $times,
                            "category" => $category,
                            "type" => $type,
                            "day" => $dd
                        );
                        $data = $model->where($where_obj)->get();
                        $data = $data['data'][0];
                        if($data) {
                            $model->update($data);
                        }else {
                            $model->insert($obj);
                        }
                    }
                }
            }
        }

        $page += $page_roop;
    }
// 첫 번째 시트 종료
}

$second_test = false;
if($second_test) {
// 두 번째 시트 가져오기
    $sheet = $objPHPExcel->getSheet(1);
    $sheetName = $sheet->getTitle();
    $page = 0;
    $page_roop = 18;
    for ($i = 1; $i <= 5; $i++) {
        $date = $page + 2;     //요일

        $page_start = 3;
        $page_end = 18;


        $range = "D{$date}:H{$date}"; // 요일 가져오는 특이성이 강한 일요일은 제외
        $dates = $sheet->rangeToArray($range, NULL, TRUE, TRUE, TRUE);
        $arrays = array();
        //요일만큼 반복
        foreach ($dates as $index => $date) {
            //데이터의 구조가 2중이라 한번더 파고들기
            foreach ($date as $position => $d) {
                $dd = $jl->stringDateToDate($d);
                if ($dd) $dd = $dd->format('Y-m-d');

                for ($j = $page_start; $j <= $page_end; $j++) {
                    $target = $page + $j;
                    $times = getMergedCellValue($sheet, "A{$target}"); // 조식,중식,석식
                    $category = getMergedCellValue($sheet, "B{$target}"); // 한식,디저트,중식
                    $type = getMergedCellValue($sheet, "C{$target}"); // 밥,메인,김치,
                    $name = getMergedCellValue($sheet, "$position{$target}"); // 메뉴명
                    $obj = array(
                        "sheet" => $sheetName,
                        "times" => $times,
                        "category" => $category,
                        "type" => $type,
                        "name" => $name,
                        "day" => $dd
                    );

                    if ($name) {
                        //시트명,제공시간,요리카레고리,요리타입,날짜 가 있는경우 요리명만 바뀌어서 업데이트
                        $where_obj = array(
                            "sheet" => $sheetName,
                            "times" => $times,
                            "category" => $category,
                            "type" => $type,
                            "day" => $dd
                        );
                        $data = $model->where($where_obj)->get();
                        $data = $data['data'][0];
                        if ($data) {
                            $model->update($data);
                        } else {
                            $model->insert($obj);
                        }
                    }
                }
            }
        }

        $page += $page_roop;
    }
// 두 번째 시트 종료
}

?>