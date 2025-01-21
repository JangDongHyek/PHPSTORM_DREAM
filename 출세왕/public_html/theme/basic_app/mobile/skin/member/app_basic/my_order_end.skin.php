<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
?>

<!-- 완료 취소모달팝업 -->
<div id="basic_modal">
    <!-- Modal -->
    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <input type="hidden" id="ing_idx">
        <input type="hidden" name="is_re_car_wash">
        <input type="hidden" name="date_type">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times-circle"></i></button>
                    <h4 class="modal-title" id="myModalLabel">완료취소</h4>
                </div>
                <div class="modal-body">
                    해당작업을 진행작업으로 돌리시겠습니까?<br />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"  onclick="service_step('ing');">확인</button>
                </div>
            </div>
        </div>
    </div>
</div><!--basic_modal-->
<!-- 모달팝업 -->



<!-- 완료된서비스 -->

<div id="my_reser">
	<!--상단카테고리-->
    <ul class="cate mng cf">
        <li><a href="<?php echo G5_BBS_URL ?>/my_order.php">진행작업</a></li>
        <li class="active"><a href="<?php echo G5_BBS_URL ?>/my_order_end.php">완료작업</a></li>
    </ul>

    <!-- 필터추가 04.22 -->
    <ul class="filter">
        <li class="<? if ($filter == "3") echo "active"; ?>"><a href="<?=G5_BBS_URL.'/my_order_end.php?filter=3'?>">외부세차 1회</a></li>
        <li class="<? if ($filter < 3) echo "active"; ?>"><a href="<?=G5_BBS_URL.'/my_order_end.php?filter=1'?>">정기세차</a></li>
        <li class="<? if ($filter == "5") echo "active"; ?>"><a href="<?=G5_BBS_URL.'/my_order_end.php?filter=5'?>">실내세차 1회</a></li>
        <!--
        <li class="<? if ($rw_idx_check == "true") echo "active"; ?>"><a href="<?=G5_BBS_URL.'/my_order_end.php?rw_idx_check=true'?>">재작업</a></li>
        -->
    </ul>

    <!--내용부분--> 
    <div class="in">
		<div class="cslist">
            <?php  if (sql_num_rows($order_result) >0 ){
            for ($i = 0; $row = sql_fetch_array($order_result); $i++){

                //재작업 요청건 뱃지
                $add_strong = "";
                //재작업 진행중일 경우 완료취소 안보이게끔
                //$re_width = "";
                $re_width = "100%";
                $display = "block";

                $is_re_car_wash = "N";

                //재작업 일 경우
                if ($row['rw_idx'] != "" && ($row['rw_step'] > 0 && $row['rw_step'] != 3) && $row["rw_complete_cnt"] == $row["complete_cnt"]) {
                    $complete = "";
                    if ($row['rw_step'] == 2 ){
                        $complete = "완료";
                    }else{
                        $display = "none";
                        $re_width = "100%";
                    }
                    $add_strong = "<strong style='background: #f1f1f1'>".$row["rw_complete_cnt"]."회차 재작업 요청건 ".$complete."</strong>";
                    $is_re_car_wash = "Y";
                }else{

                    //완료취소는 오늘만 가능
                    if(date("Y-m-d", strtotime($row["cw_complete_date"])) != G5_TIME_YMD ){
                        $display = "none";
                        $re_width = "100%";
                    }

                }


                ?>
			<div class="bx">
            	<h2 class="tit"><?= $cdt_list[$row['car_date_type']]?><strong class="size"><?= $cs_list[$row['car_size']]?></strong><?=$add_strong?></h2>
                <div class="tx">
                    <dl class="tx_m">
                        <dt>작업완료일</dt>
                        <dd><?php
                            $date = explode(" ",$row['cw_complete_date']);
                            $day = explode('-',$date[0]);
                            echo $day[0] . "년 " . $day[1] . "월 " . $day[2] . "일  ". date('H:i',strtotime($date[1])) ?></dd>
                    </dl>

					<!-- /완료횟수추가 -->
                    <?php if ($row["complete_cnt"] > 0){ ?>
                    <dl class="tx_m">
                        <dt>작업완료</dt>
                        <dd><a data-toggle="modal" data-target="#myModal_end" class="doneListA"><?=$row["complete_cnt"]?>회</a></dd>
                    </dl>
                    <?php } ?>
                    <dl class="tx_m">
                        <dt>신청고객</dt>
                         <dd><?= $row['mb_name'].' / '.hyphen_hp_number($row['mb_hp']) ?> <span class="call"><a href="tel:<?=$row['mb_hp']?>"><i class="fas fa-phone-alt"></i></a></span></dd><!--전화아이콘 누르면 전화연결되게 가능한가요~~-->
                    </dl>
                    <dl class="tx_m">
                        <dt>차량정보</dt>
                        <dd><?= $row['car_no'] ?> / <?= $row['car_type'] ?> / <?= $row['car_color'] ?></dd>
                    </dl>
                    <dl class="tx_m">
                        <dt>세차장소</dt>
                        <dd><?=$row['car_w_addr1']." ".$row['car_w_addr2']?><br /><?=$row['car_place']?></dd>
                    </dl>
                    <?php if ($row['car_date_type'] < 3){ ?>
                        <!-- 23.04.17 내부세차 다 가림 -->
                    <dl class="tx_m" style="display: none">
                        <dt>내부세차</dt>
                        <dd class="ins"><span> <?= $row['car_in_yn'] == 'Y' ? "<i class=\"far fa-check-circle\"></i> 포함" : "<i class=\"far fa-times-circle\"></i> 포함안함"; ?></span></dd>
                    </dl>
                    <?php } ?>
                    <?php if($member['mb_level'] != 3){ ?>
                    <!-- 23.04.13 매니저만 못봄 wc -->
                    <dl class="tx_m">
                        <dt>이용금액</dt>
                        <dd><span class="price"><?= number_format($row['final_pay']) ?></span>원</dd>
                    </dl>
                    <?php } ?>
                </div><!--tx-->
                <div class="mini_btn cf">
                    <a href="<?php echo G5_BBS_URL ?>/my_order_end_view.php?idx=<?=$row['cw_idx']?>"  style="width: <?=$re_width?>" class="bt view a2">자세히보기</a><!--해당 예약의 상세뷰 화면으로 바로 이동-->

                    <!--<a data-toggle="modal" data-target="#myModal2" data-idx = "<?=$row['cw_idx']?>" data-is = "<?=$is_re_car_wash?>"  data-type = "<?=$row['car_date_type']?>" style="display: <?=$display?>" class="bt cancel a2">완료취소</a>      완료취소하면 진행작업으로 옮겨짐-->
                </div>
            </div><!--bx-->
            
			<?php }
            }else{
                echo "<div class=\"service_none\"><span><i class=\"fas fa-smile\"></i></span>완료된 작업이 없습니다.</div>";
            }?>
        </div><!--cslist-->
    </div><!--in-->
</div><!--my_reser-->

<!-- 완료된서비스 -->
<script>
    $(document).ready(function() {
        $('#myModal2').on('show.bs.modal', function(event) {
            idx = $(event.relatedTarget).data('idx');
            type = $(event.relatedTarget).data('type');
            is_re_car_wash = $(event.relatedTarget).data('is');
            $('#ing_idx').val(idx);
            $('[name = is_re_car_wash]').val(is_re_car_wash);
            $('[name = date_type]').val(type);
        });
    });

    function service_step(type) {
        var idx = "";
        if(type == 'ing'){
            idx = $("#ing_idx").val();
        }

        $.ajax({
            url: g5_bbs_url+"/ajax.controller.php",
            type: "POST",
            data: {
                "mode": "service_step",
                "type": type,
                "is_car_wash" :  $('[name = is_re_car_wash]').val(),
                "idx" : idx
            },
            dataType: "json",
            success: function(data) {
                if (data["result"] == 1) {
                    window.location.href = g5_bbs_url + data["url"];
                }else{
                    swal_func("작업요청에 실패했습니다.");
                }
            }
        });

    }

    function swal_func(text) {

        swal({
            title: "경고창",
            text: text,
            icon: "error",
            button: "확인",
        });

    }

</script>