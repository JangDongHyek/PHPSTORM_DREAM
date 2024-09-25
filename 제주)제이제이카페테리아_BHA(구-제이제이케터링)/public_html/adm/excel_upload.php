<?
include_once("./_common.php");
include_once("../jl/JlConfig.php");
include_once('../lib/PHPExcel/Classes/PHPExcel/IOFactory.php');

$response = array("message" => "");

$model = new JlModel(array("table" => "meal_plan"));
$info = new JlModel(array("table" => "meal_plan_info"));
$log = new JlModel(array("table" => "excel_upload_log"));


$file = new JlFile("/jl/jl_resource/excel");

$obj = $model->jsonDecode($_POST['obj']);
if(!count($_FILES)) $model->error("파일이 존재하지않습니다.");

foreach ($_FILES as $key => $file_data) {
    $file_result = $file->bindGate($file_data);
    $obj[$key] = $file_result;
}

$obj['ip'] = $model->getClientIP();
$log->insert($obj);

$file = json_decode($file_result,true);
$file = $file[0];

$objPHPExcel = PHPExcel_IOFactory::load($jl->ROOT.$file['src']);
//$objPHPExcel = PHPExcel_IOFactory::load($jl->ROOT."/jl/jl_resource/test2.xlsx");
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
        $data = cellConfirm($firstCell->getValue());
    }else {
        $data = cellConfirm($cell->getValue()); // 병합되지 않은 경우 원래 값 반환
    }

    $data = str_replace(array("\r\n", "\r", "\n"), '', $data);
    return $data;
}

//셀값이 객체일때 텍스트값만 가져오는 함수
function cellConfirm($cell) {
    if ($cell instanceof PHPExcel_RichText) {
        return $cellValue = $cell->getPlainText(); // 순수 텍스트만 가져오기
    } else {
        return $cellValue = $cell; // 일반 텍스트일 경우 그대로 사용
    }
}

$test = true;
if($test) {
    // 첫 번째 시트 가져오기
    $sheet = $objPHPExcel->getSheet(0);
    $en_sheet = $objPHPExcel->getSheet(4);
    $sheetName = $sheet->getTitle();
    $sheetName = str_replace('&', ',', $sheetName);
    $page = 0;
    $page_roop = 35;

    $info_date = "";

    for ($i = 1; $i <= 6; $i++) {
        $date   = $page + 2;     //요일

        $page_start = 3;
        $page_end = 35;

        $k_target = $page + 12; // 특식 카테고리


        $range = "E{$date}:K{$date}"; // 요일 가져오는 특이성이 강한 일요일은 제외
        $dates = $sheet->rangeToArray($range, NULL, TRUE, TRUE, TRUE);
        $arrays = array();
        //요일만큼 반복
        foreach ($dates as $index => $date) {
            //데이터의 구조가 2중이라 한번더 파고들기
            foreach ($date as $position => $d) {
                $dd = $jl->stringDateToDate($d);
                if($dd) {
                    $dd = $dd->format('Y-m-d');
                    if(!$info_date) {
                        $info_date = $dd;
                        $info_date = substr($info_date, 0, 7);
                    }
                }


                for($j = $page_start; $j <= $page_end; $j++) {
                    $target = $page + $j;
                    $times = getMergedCellValue($sheet,"B{$target}"); // 조식,중식,석식
                    $category = getMergedCellValue($sheet,"C{$target}"); // 한식,디저트,중식
                    $type = getMergedCellValue($sheet,"D{$target}"); // 밥,메인,김치,
                    $name = getMergedCellValue($sheet,"$position{$target}"); // 메뉴명
                    $times_en = getMergedCellValue($en_sheet,"B{$target}"); // 조식,중식,석식 en
                    $category_en = getMergedCellValue($en_sheet,"C{$target}"); // 한식,디저트,중식 en
                    $type_en = getMergedCellValue($en_sheet,"D{$target}"); // 밥,메인,김치, en
                    $name_en = getMergedCellValue($en_sheet,"$position{$target}"); // 메뉴명 en

                    // 특이성이 강한 일요일 특식 조건문
                    if($position == "K" && $times == "중식") {
                        $category = getMergedCellValue($sheet,"K{$k_target}"); // 특식 카테고리
                        $type = "$target";
                        if($category == $name) continue; // 카테고리일경우 패스
                    }

                    $obj = array(
                        "sheet" => $sheetName,
                        "times" => $times,
                        "times_en" => $times_en,
                        "category" => $category,
                        "category_en" => $category_en,
                        "type" => $type,
                        "type_en" => $type_en,
                        "name" => $name,
                        "name_en" => $name_en,
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
                            $data['name'] = $name;
                            $data['name_en'] = $name_en;
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

    //첫번째 시트 인포 내용
    for ($i = $page+1; $i <= $page+6; $i++) {
        $title = getMergedCellValue($sheet,"A{$i}");
        $title_en = getMergedCellValue($en_sheet,"A{$i}");
        $content = getMergedCellValue($sheet,"E{$i}");
        $content_en = getMergedCellValue($en_sheet,"E{$i}");

        if($title) {
            $obj = array(
                "month" => $info_date,
                "sheet" => $sheetName,
                "title" => $title,
                "content" => $content,
                "title_en" => $title_en,
                "content_en" => $content_en,
            );

            $search_obj = array(
                "month" => $info_date,
                "sheet" => $sheetName,
                "title" => $title,
            );

            $data = $info->where($search_obj)->get();
            $data = $data['data'][0];

            if ($data) {
                $data['content'] = $content;
                $data['content_en'] = $content_en;
                $info->update($data);
            } else {
                $info->insert($obj);
            }
        }
    }

// 첫 번째 시트 종료
}

$test = true;
if($test) {
// 두 번째 시트 가져오기
    $sheet = $objPHPExcel->getSheet(1);
    $en_sheet = $objPHPExcel->getSheet(5);
    $sheetName = $sheet->getTitle();
    $page = 0;
    $page_roop = 18;
    for ($i = 1; $i <= 6; $i++) {
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

                    $times_en = getMergedCellValue($en_sheet, "A{$target}"); // 조식,중식,석식
                    $category_en = getMergedCellValue($en_sheet, "B{$target}"); // 한식,디저트,중식
                    $type_en = getMergedCellValue($en_sheet, "C{$target}"); // 밥,메인,김치,
                    $name_en = getMergedCellValue($en_sheet, "$position{$target}"); // 메뉴명

                    $obj = array(
                        "sheet" => $sheetName,
                        "times" => $times,
                        "category" => $category,
                        "type" => $type,
                        "name" => $name,
                        "times_en" => $times_en,
                        "category_en" => $category_en,
                        "type_en" => $type_en,
                        "name_en" => $name_en,
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
                            $data['name'] = $name;
                            $data['name_en'] = $name_en;
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

    //두번째 시트 인포 내용
    for ($i = $page+1; $i <= $page+6; $i++) {
        $title = getMergedCellValue($sheet,"A{$i}");
        $content = getMergedCellValue($sheet,"D{$i}");
        $title_en = getMergedCellValue($en_sheet,"A{$i}");
        $content_en = getMergedCellValue($en_sheet,"D{$i}");

        if($title) {
            $obj = array(
                "month" => $info_date,
                "sheet" => $sheetName,
                "title" => $title,
                "content" => $content,
                "title_en" => $title_en,
                "content_en" => $content_en,
            );

            $search_obj = array(
                "month" => $info_date,
                "sheet" => $sheetName,
                "title" => $title,
            );

            $data = $info->where($search_obj)->get();
            $data = $data['data'][0];

            if ($data) {
                $data['content'] = $content;
                $data['content_en'] = $content_en;
                $info->update($data);
            } else {
                $info->insert($obj);
            }
        }

    }
// 두 번째 시트 종료
}

$test = true;
if($test) {
// 세 번째 시트 가져오기
    $sheet = $objPHPExcel->getSheet(2);
    $en_sheet = $objPHPExcel->getSheet(6);
    $sheetName = $sheet->getTitle();
    $page = 0;
    $page_roop = 10;
    for ($i = 1; $i <= 6; $i++) {
        $date = $page + 2;     //요일

        $page_start = 3;
        $page_end = $page_roop;


        $range = "B{$date}:F{$date}"; // 요일 가져오는 특이성이 강한 일요일은 제외
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
                    $times = "중식";
                    $category = getMergedCellValue($sheet, "A{$target}"); // 한식,디저트,중식
                    $type = getMergedCellValue($sheet, "A{$target}"); // 밥,메인,김치,
                    $name = getMergedCellValue($sheet, "$position{$target}"); // 메뉴명

                    $times_en = "LUNCH";
                    $category_en = getMergedCellValue($en_sheet, "A{$target}"); // 한식,디저트,중식
                    $type_en = getMergedCellValue($en_sheet, "A{$target}"); // 밥,메인,김치,
                    $name_en = getMergedCellValue($en_sheet, "$position{$target}"); // 메뉴명
                    $obj = array(
                        "sheet" => $sheetName,
                        "times" => $times,
                        "category" => $category,
                        "type" => $type,
                        "name" => $name,
                        "times_en" => $times_en,
                        "category_en" => $category_en,
                        "type_en" => $type_en,
                        "name_en" => $name_en,
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
                            $data['name'] = $name;
                            $data['name_en'] = $name_en;
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

    //세번째 시트 인포 내용
    for ($i = $page+1; $i <= $page+6; $i++) {
        $title = getMergedCellValue($sheet,"A{$i}");
        $content = getMergedCellValue($sheet,"B{$i}");
        $title_en = getMergedCellValue($en_sheet,"A{$i}");
        $content_en = getMergedCellValue($en_sheet,"B{$i}");

        if($title) {
            $obj = array(
                "month" => $info_date,
                "sheet" => $sheetName,
                "title" => $title,
                "content" => $content,
                "title_en" => $title_en,
                "content_en" => $content_en,
            );

            $search_obj = array(
                "month" => $info_date,
                "sheet" => $sheetName,
                "title" => $title,
            );

            $data = $info->where($search_obj)->get();
            $data = $data['data'][0];

            if ($data) {
                $data['content'] = $content;
                $data['content_en'] = $content_en;
                $info->update($data);
            } else {
                $info->insert($obj);
            }
        }

    }

    //세번째 시트 인포 내용
    for ($i = $page+1; $i <= $page+6; $i++) {
        $title = getMergedCellValue($sheet,"A{$i}");
        $content = getMergedCellValue($sheet,"B{$i}");
        $title_en = getMergedCellValue($en_sheet,"A{$i}");
        $content_en = getMergedCellValue($en_sheet,"B{$i}");

        if($title) {
            $obj = array(
                "month" => $info_date,
                "sheet" => $sheetName,
                "title" => $title,
                "content" => $content,
                "title_en" => $title_en,
                "content_en" => $content_en,
            );

            $data = $info->where($obj)->get();
            $data = $data['data'][0];

            if(!$data) {
                $info->insert($obj);
            }
        }

    }
// 세 번째 시트 종료
}

$test = true;
if($test) {
// 네 번째 시트 가져오기
    $sheet = $objPHPExcel->getSheet(3);
    $en_sheet = $objPHPExcel->getSheet(7);
    $sheetName = $sheet->getTitle();
    $page = 0;
    $page_roop = 4;
    for ($i = 1; $i <= 6; $i++) {
        $date = $page + 4;     //요일

        $page_start = 5;
        $page_end = 6;


        $dates = array("B","D","F","H","J","L","N");
        $arrays = array();
        //요일만큼 반복
        foreach ($dates as $index => $cell) {
            $d = getMergedCellValue($sheet,"$cell{$date}");

            $dd = ($d - 25569) * 86400;
            if ($dd) $dd = date("Y-m-d", $dd);

            for ($j = $page_start; $j <= $page_end; $j++) {
                $target = $page + $j;

                $times = "간식";
                $category = "간식"; // 한식,디저트,중식
                $type = "간식"; // 밥,메인,김치,
                $name = getMergedCellValue($sheet, "$cell{$target}"); // 메뉴명

                $times_en = "snacks";
                $category_en = "snacks"; // 한식,디저트,중식
                $type_en = "snacks"; // 밥,메인,김치,
                $name_en = getMergedCellValue($en_sheet, "$cell{$target}"); // 메뉴명

                $obj = array(
                    "sheet" => $sheetName,
                    "times" => $times,
                    "category" => $category,
                    "type" => $type,
                    "name" => $name,
                    "times_en" => $times_en,
                    "category_en" => $category_en,
                    "type_en" => $type_en,
                    "name_en" => $name_en,
                    "day" => $dd
                );

                if ($name) {
                    //시트명,제공시간,요리카레고리,요리타입,날짜 가 있는경우 요리명만 바뀌어서 업데이트
                    $where_obj = array(
                        "sheet" => $sheetName,
                        "times" => $times,
                        "category" => $category,
                        "type" => $type,
                        "day" => $dd,
                        "name" => $name
                    );
                    $data = $model->where($where_obj)->get();
                    $data = $data['data'][0];
                    if ($data) {
                        $data['name'] = $name;
                        $data['name_en'] = $name_en;
                        $model->update($data);
                    } else {
                        $model->insert($obj);
                    }
                }
            }
        }

        $page += $page_roop;
    }
// 네 번째 시트 종료
}

$response['success'] = true;

echo json_encode($response);

?>