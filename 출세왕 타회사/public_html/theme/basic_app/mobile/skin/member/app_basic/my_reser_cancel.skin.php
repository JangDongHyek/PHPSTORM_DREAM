<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
?>


<!-- 출장세차 취소현황 -->

<div id="my_reser">
	<!--상단카테고리-->
    <ul class="cate02 cf">
        <li><a href="<?php echo G5_BBS_URL ?>/my_reser.php">예약내역</a></li>
        <li class="active"><a href="<?php echo G5_BBS_URL ?>/my_reser_cancel.php">예약취소</a></li>
        <li><a href="<?php echo G5_BBS_URL ?>/my_reser_end.php">완료내역</a></li>
    </ul>
    
    <!--내용부분--> 
    <div class="in">
		<div class="cslist cancel">
            <?php if (sql_num_rows($cancel_result) > 0){
                for ($i = 0; $row = sql_fetch_array($cancel_result); $i++){?>
                <div class="bx">
                    <h2 class="tit"><?= $cdt_list[$row['car_date_type']]?><strong class="size"><?= $cs_list[$row['car_size']]?></strong></h2>
                    <div class="tx">
                        <dl class="tx_m">
                            <dt>접수일</dt>
                            <dd><?php
                                $date = explode(" ",$row['wr_datetime']);
                                $day = explode('-',$date[0]);
                                echo $day[0] . "년 " . $day[1] . "월 " . $day[2] . "일  ". date('H:i',strtotime($date[1])) ?></dd>
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
                                if ($row['car_date_type'] == 3){
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
                        <!-- 23.04.17  가리기 내부세차 따로 빼줌 wc -->
                        <dl class="tx_m" style="display:none;">
                            <dt>내부세차</dt>
                            <dd class="ins"><span><?= $row['car_in_yn'] == 'Y' ? "<i class=\"far fa-check-circle\"></i> 포함" : "<i class=\"far fa-times-circle\"></i> 포함안함"; ?></span></dd>
                        </dl>
                        <dl class="tx_m">
                            <?php if ($row['final_pay'] == ""){ ?>
                            <dt>예상이용금액</dt>
                            <dd><span class="price">

                       <?php $pay = $money_list[$row['car_date_type']."".$row['car_size']];
                       $in_pay = $row['car_in_yn'] == 'Y' ? '10000': "";
                       $final_pay = $pay + $in_pay;
                       echo number_format($final_pay);
                       }else{ ?>
                            <dt>최종이용금액</dt>
                            <dd><span class="price">
                        <?php echo number_format($row['final_pay']);
                        }?>
                            </span>원
                                <!-- 쿠폰있으면 아이콘 표시 -->
                                <?php if($row['cp_id'] != ""){ ?>
                                    <span class="ico"><i class="fa-solid fa-ticket"></i></span>
                                <?php } ?>
                            </dd>
                        </dl>
                        <?php if ($row['ma_id'] != ""){
                            $manager = get_member($row['ma_id']); ?>
                            <dl class="tx_m manager"><!--관리자가 담당매니저 정해주면 고객쪽에 뜨게 됨-->
                                <dt>담당매니저</dt>
                                <dd><?= $manager['mb_name'] ?> <span class="info"><a data-toggle="modal" data-target="#myModal2" class="info"><i class="fas fa-user-circle"></i> 매니저 정보</a></span></dd>
                            </dl>
                        <?php } ?>
                    </div><!--tx-->
                    <div class="date_cancel">* 예약취소일 : <?php
                        $date = explode(" ",$row['up_datetime']);
                        $day = explode('-',$date[0]);
                        echo $day[0] . "년 " . $day[1] . "월 " . $day[2] . "일  ". date('H:i',strtotime($date[1])) ?></div>
                </div><!--bx-->
            <?php }
            }else{
               echo "<div class=\"service_none\"><span><i class=\"fas fa-smile\"></i></span>취소된 서비스가 없습니다.</div>";
            }?>
            
        </div><!--cslist-->
    </div><!--in-->
    
</div><!--my_reser-->

<!-- 출장세차 취소현황 -->
