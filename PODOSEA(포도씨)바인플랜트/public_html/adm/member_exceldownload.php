<?php
include_once('./_common.php');
/**
 * 기업회원 엑셀다운로드 (내부용)
 */

header( "Content-type: application/vnd.ms-excel; charset=utf-8");
header( "Content-Disposition: attachment; filename = 기업회원.xls" );     //filename = 저장되는 파일명을 설정합니다.
header( "Content-Description: PHP4 Generated Data" );

$sql = " SELECT * FROM g5_member WHERE mb_level = 3 AND mb_id NOT IN ('com01', 'test03', 'testcompany') ORDER BY mb_datetime DESC ";
$rlt = sql_query($sql);

$excel = "
<table border='1'>
    <tr>
        <td>ID</td>
        <td>이메일</td>
        <td>휴대번호</td>
        <td>회사명</td>
        <td>회사주소</td>
        <td>상세주소</td>
        <td>회사명(영문)</td>
        <td>회사로고</td>
        <td>설립일</td>
        <td>지역</td>
        <td>기업홈페이지</td>
        <td>업종분류</td>
        <td>상세업종</td>
        <td>회사소개</td>
        <td>회사전화</td>
        <td>회사팩스</td>
        <td>사업자등록번호</td>
        <td>대표명</td>
        <td>보유인증,특허</td>
        <td>카달로그</td>
        <td>회사소개영상</td>
        <td>취급제품 및 서비스</td>
        <td>브랜드</td>
        <td>해시태그</td>
    </tr>
";

for($i=0; $row=sql_fetch_array($rlt); $i++) {
    // 로고
    $logoFile = sql_fetch(" select * from g5_member_img where mb_id = '{$row['mb_id']}' and category = '로고'; ")['img_file'];
    if(!empty($logoFile)) {
        $logoImg = '<img src="'.G5_DATA_URL.'/file/company/'.$logoFile.'" width="100" height="100">';
    } else {
        $logoFile = "-";
    }

    // 카달로그
    $sql2 = " select * from g5_member_img where mb_id = '{$row['mb_id']}' and category = '카달로그' order by idx ";
    $rlt2 = sql_query($sql2);

    for($k=0; $file=sql_fetch_array($rlt2); $k++) {
        $catalogFile = $file['img_file'];
        $coverFile = sql_fetch(" select * from g5_member_img where mb_id = '{$row['mb_id']}' and category = '카달로그커버' and p_idx = {$file['idx']} order by idx ")['img_file'];

        if($coverFile && $catalogFile) {
            $catalog = '커버이미지: '.$coverFile.' / 파일명: '.$catalogFile.'<br>';
        } else if(!$coverFile && $catalogFile) {
            $catalog = '커버이미지: - / 파일명: '.$catalogFile.'<br>';
        }
    }

    $excel .= "
    <tr>
       <td>".$row['mb_id']."</td> <!--ID-->
       <td>".$row['mb_email']."</td> <!--이메일-->
       <td>".$row['mb_hp']."</td> <!--휴대번호-->
       <td>".$row['mb_company_name']."</td> <!--회사명-->
       <td>".$row['mb_addr1']."</td> <!--회사주소-->
       <td>".$row['mb_addr2']."</td> <!--상세주소-->
       <td>".$row['mb_company_name_eng']."</td> <!--회사명(영문)-->
       <td>파일명: $logoFile</td></td> <!--회사로고-->
       <td>".$row['mb_company_establish_date']."</td> <!--설립일-->
       <td>".$row['mb_company_si']."</td> <!--지역-->
       <td>".$row['mb_company_homepage']."</td> <!--기업홈페이지-->
       <td>".$company_sectors[$row['mb_company_sector']]."</td> <!--업종분류-->
       <td>".str_replace('|', '<br>', $row['mb_company_sector_detail'])."</td> <!--상세업종-->
       <td>".$row['mb_company_introduce']."</td> <!--회사소개-->
       <td>".$row['mb_company_tel']."</td> <!--회사전화-->
       <td>".$row['mb_company_fax']."</td> <!--회사팩스-->
       <td>".$row['mb_company_num']."</td> <!--사업자등록번호-->
       <td>".$row['mb_ceo']."</td> <!--대표명-->
       <td>".str_replace('|', '<br>', $row['mb_patent'])."</td> <!--보유인증,특허-->
       <td>".$catalog."</td> <!--카달로그-->
       <td>".$row['mb_video_link']."</td> <!--회사소개영상-->
       <td>".str_replace('|', '<br>', $row['mb_goods_service'])."</td> <!--취급제품 및 서비스-->
       <td>".str_replace('|', '<br>', $row['mb_brand'])."</td> <!--브랜드-->
       <td>".$row['mb_hashtag']."</td> <!--해시태그-->
   </tr>
    ";
}


$excel .= "</table>";

echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
echo $excel;
