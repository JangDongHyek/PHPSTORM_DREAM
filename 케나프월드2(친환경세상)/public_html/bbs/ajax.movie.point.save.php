<?php
include_once("./_common.php");
$sql="select * from g5_write_youtube where wr_id='$movie_id'";
$result=sql_query($sql);

$regdate=date("Ymd");
$isSave=false;

while($row=sql_fetch_array($result)){
    //지급 포인트 (절대값)
    $point=round($row[wr_1]);

    //오늘 해당 동영상 시청했는지 여부 파악
    $sql="select * from g5_movie_view_point where mb_id='$member[mb_id]' and regdate='$regdate' and movie_id = '$movie_id'";
    $row2=sql_fetch($sql);
    
    //총 2000번 가능
    $sql="select count(*) as cnt from g5_movie_view_point where mb_id='$member[mb_id]' and movie_id='$movie_id'";
    $row3=sql_fetch($sql);

    //조건에 맞을경우 포인트 부여
    if(!$row2[idx]&&$row3[cnt]<=2000){
        $sql="insert g5_movie_view_point set
                mb_id='$member[mb_id]',
                mp_idx='$row[po_id]',
                movie_id='$movie_id',
                point='$point',
                regdate='$regdate'";
        sql_query($sql);

        //성공시 0보다 큼 : 실패 => 0 또는 -1
        $result_int = insert_point_l($member[mb_id], $point, '동영상 시청', '@youtube', $member[mb_id], $member[mb_id].'-'.uniqid(''));
        if($result_int > 0){
            $isSave=true;
        }
    }
}

if($isSave){
	echo "포인트가 적립되었습니다.";
}else{
	echo "해당 동영상은 오늘 시청하셔서 더 이상 포인트 적립을 하실 수 없습니다. 다른 동영상을 시청하시거나, 내일 동영상을 시청하십시오.";
}
?>