<?php
include_once("./jl/JlConfig.php");
include_once("./plugin/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php");
include_once("./common.php");

$g5_member = new JlModel(array("table" => "g5_member"));

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

$objPHPExcel = PHPExcel_IOFactory::load($jl->ROOT."/jl/jl_resource/upload.xlsx");
$sheetCount = $objPHPExcel->getSheetCount();

// 첫 번째 시트 가져오기
$sheet = $objPHPExcel->getSheet(0);
$sheetName = $sheet->getTitle();

for ($i = 237 ; $i <= 496; $i++) {

    $mb_id = getMergedCellValue($sheet,"B{$i}");
    $mb_password = get_encrypt_string(getMergedCellValue($sheet,"C{$i}"));
    $mb_nick_date = "2024-10-17";
    $mb_email = getMergedCellValue($sheet,"H{$i}");
    $mb_level = "3";
    $mb_hp = getMergedCellValue($sheet,"F{$i}");
    $mb_addr1 = getMergedCellValue($sheet,"G{$i}");
    $mb_email_certify = "now()";
    $mb_open_date = "2024-10-17";
    $mb_category = "기업";
    $mb_company_sector_detail = getMergedCellValue($sheet,"D{$i}");
    $mb_company_name = getMergedCellValue($sheet,"E{$i}");
    $mb_company_homepage = getMergedCellValue($sheet,"I{$i}");
    $mb_company_introduce = getMergedCellValue($sheet,"J{$i}");

    $mb_grade = "Basic";
    $seller = "N";
    $always_use = "N";
    $podosea_certify = "N";

    $data = array(
        "mb_id" => $mb_id,
        "mb_password" => $mb_password,
        "mb_nick_date" => $mb_nick_date,
        "mb_email" => $mb_email,
        "mb_level" => $mb_level,
        "mb_hp" => $mb_hp,
        "mb_addr1" => $mb_addr1,
        "mb_email_certify" => $mb_email_certify,
        "mb_open_date" => $mb_open_date,
        "mb_category" =>$mb_category,
        "mb_company_sector_detail" => $mb_company_sector_detail,
        "mb_company_name" => $mb_company_name,
        "mb_company_homepage" => $mb_company_homepage,
        "mb_company_introduce" => $mb_company_introduce,
        "mb_grade" => $mb_grade,
        "seller" => $seller,
        "always_use" => $always_use,
        "podosea_certify" => $podosea_certify
    );

    //$g5_member->insert($data);

}

?>