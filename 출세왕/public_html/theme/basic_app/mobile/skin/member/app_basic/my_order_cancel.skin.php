<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
?>


<!-- 출장세차 취소현황 -->

<div id="my_reser">
	<!--상단카테고리-->
    <ul class="cate mng cf">
        <li><a href="<?php echo G5_BBS_URL ?>/my_order.php">진행작업</a></li>
        <li><a href="<?php echo G5_BBS_URL ?>/my_order_end.php">완료작업</a></li>
        <li class="active"><a href="<?php echo G5_BBS_URL ?>/my_order_cancel.php">취소작업</a></li>
    </ul>
    
    <!--내용부분--> 
    <div class="in">
		<div class="cslist cancel">
            <?php  if (sql_num_rows($order_result) >0 ){
            for ($i = 0; $row = sql_fetch_array($cancel_result); $i++){?>

            <div class="bx">
            	<h2 class="tit">월 세차<strong class="size">소형/중형</strong></h2>
                <div class="tx">
                    <dl class="tx_m">
                        <dt>신청일</dt>
                        <dd><?php
                            $date = explode(" ",$row['wr_datetime']);
                            $day = explode('-',$date[0]);
                            echo $day[0] . "년 " . $day[1] . "월 " . $day[2] . "일  ". date('H:i',strtotime($date[1])) ?></dd>
                    </dl>
                    <dl class="tx_m">
                        <dt>신청고객</dt>
                        <dd><?= $row['mb_name'].' / '.hyphen_hp_number($row['mb_hp']) ?></dd>
                    </dl>
                    <dl class="tx_m">
                        <dt>차량정보</dt>
                        <dd><?= $row['car_no'] ?> / <?= $row['car_type'] ?> / <?= $row['car_color'] ?></dd>
                    </dl>
                    <dl class="tx_m">
                        <dt>세차일정</dt>
                        <dd><?php
                            $date = $row['car_w_date'];
                            //정기세차가 아닐경우
                            if ($row['car_date_type'] != 2){
                                $yoil = array("일","월","화","수","목","금","토");

                                $day = explode('-',$date);
                                echo $day[0] . "년 " . $day[1] . "월 " . $day[2] . "일  ".'('.$yoil[date('w', strtotime($date))].') '.$row['car_w_date2'];

                            }else{
                                if($date == '매일'){
                                    echo $date;
                                }else{
                                    echo '매주 '.$date.'요일';
                                }

                            }

                            ?></dd>
                    </dl>
                    <dl class="tx_m">
                        <dt>세차장소</dt>
                        <dd><?=$row['car_w_addr1']." ".$row['car_w_addr2']?><br /><?=$row['car_place']?></dd>
                    </dl>
                    <dl class="tx_m">
                        <dt>내부세차</dt>
                        <dd class="ins"><span><?= $row['car_in_yn'] == 'Y' ? "<i class=\"far fa-check-circle\"></i> 포함" : "<i class=\"far fa-times-circle\"></i> 포함안함"; ?></span></dd>
                    </dl>
                    <dl class="tx_m">
                        <dt>이용금액</dt>
                        <dd><span class="price"><?= number_format($row['final_pay']) ?></span>원</dd>
                    </dl>
                </div><!--tx-->
            	<div class="date_cancel">* 작업취소일 : <?php
                    $date = explode(" ",$row['up_datetime']);
                    $day = explode('-',$date[0]);
                    echo $day[0] . "년 " . $day[1] . "월 " . $day[2] . "일  ". date('H:i',strtotime($date[1])) ?></div>
            </div><!--bx-->
            <?php }
            }else{
                echo "<div class=\"service_none\"><span><i class=\"fas fa-smile\"></i></span>취소된 작업이 없습니다.</div>";
            }?>


        </div><!--cslist-->
    </div><!--in-->
    
</div><!--my_reser-->

<!-- 출장세차 취소현황 -->
