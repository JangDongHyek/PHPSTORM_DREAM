<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
?>



<!-- 청소서비스 신청내역 -->

<div id="my_reser">
    <!--내용부분--> 
    <div class="in">
    	<!--<div class="service_none"><span><i class="fas fa-smile"></i></span>신청하신 청소서비스가 없습니다.</div>--><!--신청하신 청소서비스가 없을때 띄움-->
		<div class="cslist clean">
            <?php for ($i = 0; $row = sql_fetch_array($result); $i++){
                if ($row["cu_step"] == 1 ){
                    $class = "start";
                }elseif ($row["cu_step"] == 2){
                    $class = "end";
                }elseif ($row["cu_step"] == 3){
                    $class = "cancel";
                }
                ?>
			<div class="bx">
            	<span class="state <?=$class?>"><?= $step_list[$row["cu_step"]]?></span><!--신청(기본값)/진행(상담후 청소가 진행될때)/완료(청소가 완료되면)/취소(상담 후 진행불발)로 분류됨-->
            	<h2 class="tit"><?= $ct_list[$row["cu_type"]] ?><strong class="size"><?= $cub_list[$row["cu_building"]] ?></strong></h2>
                <div class="tx">
                    <dl class="tx_m">
                        <dt>접수일</dt>
                        <dd><?php
                            $date = explode(" ",$row['wr_datetime']);
                            $day = explode('-',$date[0]);
                            echo $day[0] . "년 " . $day[1] . "월 " . $day[2] . "일  ". date('H:i',strtotime($date[1])) ?></dd>
                    </dl>
                    <dl class="tx_m">
                        <dt>평수</dt>
                        <dd><?= $row['cu_width']?>평</dd>
                    </dl>
                    <dl class="tx_m">
                        <dt>청소일정</dt>
                        <dd><?php
                            $date = $row['cu_date'];
                            $yoil = array("일","월","화","수","목","금","토");

                            $day = explode('-',$date);
                            echo $day[0] . "년 " . $day[1] . "월 " . $day[2] . "일  ".'('.$yoil[date('w', strtotime($date))].') '.$row['cu_time']; ?></dd>
                    </dl>
                    <dl class="tx_m">
                        <dt>주소</dt>
                        <dd><?=$row['cu_addr1']." ".$row['cu_addr2']?></dd>
                    </dl>
                    <dl class="tx_m">
                        <dt>요청사항</dt>
                        <dd><?= $row['cu_memmo']!= "" ? $row['cu_memmo']: "없음";?></dd>
                    </dl>
                    <dl class="tx_m">
                        <dt>이용금액</dt>
                        <dd><span class="price"><?= number_format($row['final_pay']) ?></span>원</dd>
                    </dl>
                </div><!--tx-->
            </div><!--bx-->
            <?php } ?>
        </div>
    </div><!--in-->
</div><!--my_reser-->

<!-- 청소서비스 신청내역 -->