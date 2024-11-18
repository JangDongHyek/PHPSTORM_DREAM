<?php
include_once('./_common.php');

$sql = "SELECT *,
       (6371 * acos(cos(radians(`wr_7`)) 
                    * cos(radians($lat)) 
                    * cos(radians($lon) - radians(`wr_8`)) 
                    + sin(radians(`wr_7`)) 
                    * sin(radians($lat)))) AS distance
FROM `g5_write_store`
HAVING distance < 3
ORDER BY distance;";
$re = sql_query($sql);
$count = sql_num_rows($re);

$html = "";
while($row = sql_fetch_array($re)){
    $cctv_url = $row['cctv_url'];
    $distance = $row['distance'];
    if (strpos($cctv_url, 'http://') === 0) {
        $cctv_url = str_replace('http://', 'https://', $cctv_url);
    }

    $html .= '<li>';
    $html .= '    <dl>';
    $html .= '        <dd>';
    $html .= '            <p><i class="fa fa-map-marker"></i><a href="'.G5_URL.'/bbs/board.php?bo_table=store&wr_id='.$row['wr_id'].'">'.$row['wr_subject'].'<span>('.round($distance, 2).'km)</span></a></p>';
    $html .= '            <a href="tel:'.$row['wr_3'].'" class="btn order"><i class="fa fa-phone"></i> 주문</a>';
    if(!empty($cctv_url)){
        $html .= '            <button type="button" onclick="checkLoginAndRedirect(\''.$cctv_url.'\')" class="btn cctv"><i class="fa fa-video-camera"></i> CCTV</button>';
    } else {
        $html .= '            <button type="button" class="btn cctv"><i class="fa fa-video-camera"></i> 준비중</button>';
    }

    $html .= '        </dd>';
    $html .= '    </dl>';
    $html .= '</li>';

}

if($count == 0){
    $html = "<li>인근에 매장이 없습니다.</li>";
}

if($member['mb_id'] == ""){
    $html = "<li><a href='".G5_BBS_URL."/login2.php'>로그인 후 이용 가능합니다.</a></li>";
}

$print['code'] = "200";
$print['msg'] = "";
$print['html'] = $html;

echo json_encode($print);

?>