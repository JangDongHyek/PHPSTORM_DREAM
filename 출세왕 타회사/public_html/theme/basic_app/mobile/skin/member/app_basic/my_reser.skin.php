<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
?>

<!-- 예약취소 모달팝업 -->
<div id="basic_modal">
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <input type="hidden" id="modal_idx">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times-circle"></i></button>
        <h4 class="modal-title" id="myModalLabel">예약취소</h4>
      </div>
      <div class="modal-body">
          해당 예약을 정말 취소하시겠습니까?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" onclick="car_wash_cancel()">확인</button>
      </div>
    </div>
  </div>
</div>
</div><!--basic_modal-->
<!-- 예약취소 모달팝업 -->

<!-- 매니저정보 모달팝업 -->
<div id="basic_modal">
<!-- Modal -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times-circle"></i></button>
        <h4 class="modal-title" id="myModalLabel">매니저 정보</h4>
      </div>
      <div class="modal-body">
            <div class="manager_info">
                <div class="img"><span><i class="fas fa-user"></i></span></div>
                <div class="name"><span id="ma_modal_name"></span> 매니저 <strong class="call"><i class="fas fa-phone-alt"></i> <a id="ma_modal_a_hp" href="tel:010-4399-5562"><span style="color: #000!important;" id="ma_modal_hp" >010-4399-5562</span></a></strong>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">확인</button>
      </div>
    </div>
  </div>
</div>
</div><!--basic_modal-->
<!-- 매니저정보 모달팝업 -->


<!-- 출장세차 예약현황 -->

<div id="my_reser">
	<!--상단카테고리-->
    <ul class="cate02 cf">
        <li class="active"><a href="<?php echo G5_BBS_URL ?>/my_reser.php">예약내역</a></li>
        <li><a href="<?php echo G5_BBS_URL ?>/my_reser_cancel.php">예약취소</a></li>
        <li><a href="<?php echo G5_BBS_URL ?>/my_reser_end.php">완료내역</a></li>

    </ul>

    <?php if (sql_num_rows($reser_result) > 0){?>
    <!--내용부분-->
    <div class="in">
		<div class="cslist">
            <?php for ($i = 0; $row = sql_fetch_array($reser_result); $i++){?>

                <?php
                    //23.06.21 정기,실내 결제안했으면 안보이게
                    if($row['is_payment']  != 'Y' && ($row['car_date_type'] == 3 || $row['car_date_type'] == 5)){
                        continue;
                    }
                    //echo $row['car_date_type'].$row['is_payment'];
                ?>

			<div class="bx">
            	<h2 class="tit">
                    <?= $cdt_list[$row['car_date_type']]?><strong class="size"><?= $cs_list[$row['car_size']]?></strong>
                    <?php if($re_result['cw_idx'] == $view['cw_idx']){ ?>
                        <strong style='background: #f1f1f1'>재작업 요청건</strong>
                    <?php   }   ?>
                </h2>
                <div class="tx">
                    <dl class="tx_m">
                        <dt>접수일</dt>
                        <dd><?php
                            $date = explode(" ",$row['cw_datetime']);
                            $day = explode('-',$date[0]);
                            echo $day[0] . "년 " . $day[1] . "월 " . $day[2] . "일  ". date('H:i',strtotime($date[1])) ?></dd>
                    </dl>
                    <dl class="tx_m">
                        <dt>차량정보</dt>
                        <dd><?= $row['car_no'] ?> / <?= $row['car_type'] ?> / <?= $row['car_color'] ?></dd>
                    </dl>
                    <dl class="tx_m">
                        <dt><?php if ($row['car_date_type'] == 3){ echo '세차일정'; }else{ echo '주차가능일자'; } ?></dt>
                        <dd>
                            <?php
                            successking_date($row['car_w_date'],$row['car_w_date2']);
                            ?>
                        </dd>

                    </dl>

                    <? if($row['car_date_type'] ==2 or$row['car_date_type'] ==1) { ?>
                        <dl class="tx_m">
                            <dt>작업완료횟수</dt>
                            <dd><a data-toggle="modal" data-target="#myModal_end" class="doneListA"><?=$row["complete_cnt"]?>회</a></dd>
                        </dl>
                        <dl class="tx_m">
                            <dt>작업완료일</dt>
                            <dd><a data-toggle="modal" data-target="#myModal_end" class="doneListA"><?=$row["complete_datetime"]?></a></dd>
                        </dl>
                    <? } ?>

                    <dl class="tx_m">
                        <dt>사용포인트</dt>
                        <dd><a data-toggle="modal" data-target="#myModal_end" class="doneListA"><?=number_format($row["cp_price"]);?></a></dd>
                    </dl>

                    <!-- 23.04.17  가리기 내부세차 따로 빼줌 wc -->
                    <dl class="tx_m" style="display: none">
                        <dt>내부세차</dt>
                        <dd class="ins"><span> <?= $row['car_in_yn'] == 'Y' ? "<i class=\"far fa-check-circle\"></i> 포함" : "<i class=\"far fa-times-circle\"></i> 포함안함"; ?></span></dd>
                    </dl>
                    <dl class="tx_m">
                        <?php if ($row['cw_step'] == "0"){ ?>
                        <dt>예상이용금액</dt>
                        <dd><span class="price">-+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                       <?php }else{ ?>
                    <dl class="tx_m">
                        <dt>누적결제금액</dt>
                        <dd class="ins"><span> <? echo number_format($total_price);?> 원</span></dd>
                    </dl>
                        <dt>최종이용금액</dt>
                        <dd><span class="price">
                        <?php } ?>

                        <!-- date_type 2는 정기세차 -->
                        <?
                        if($row['car_date_type'] ==2)
                        {
                            //여기는 정기세차 횟수만큼 계산해서 뿌려줌
                            echo number_format(($row["complete_cnt"]*12375) - $row['cp_price']);
                        }
                        else
                        {
                            //여기에 최종 결제 금액을 뿌려줌
                            echo number_format($row['final_pay']);
                        }
                        ?>

                        </span>원
                            <!-- 쿠폰있으면 아이콘 표시 -->
                            <!--
                            <?php if($row['cp_id'] != ""){ ?>
                                <span class="ico">POINT 사용</span>
                            <?php } ?>
                            -->
                        </dd>
                    </dl>
                    <?php if ($row['ma_id'] != ""){
                        $manager = get_member($row['ma_id']); ?>
                    <dl class="tx_m manager"><!--관리자가 담당매니저 정해주면 고객쪽에 뜨게 됨-->
                        <dt>담당매니저</dt>
                        <dd><?= $manager['mb_name'] ?> <span class="info"><a data-toggle="modal" data-target="#myModal2" data-name = "<?= $manager['mb_name'] ?>" data-hp = "<?= hyphen_hp_number($manager['mb_hp']) ?>" class="info"><i class="fas fa-user-circle"></i> 매니저 정보</a></span></dd>
                    </dl>
                    <?php } ?>
                </div><!--tx-->
                <div class="mini_btn cf">

                    <?php if ($row['cw_step'] == "0"){
                        $cancel = '<a data-toggle="modal" data-target="#myModal" data-idx = "'.$row['cw_idx'].'" class="bt cancel">예약취소</a>';
                        $all = '';
                    }else{
                        $all = 'all';
                        $cancel = '';
                    }?>
                    <a href="<?php echo G5_BBS_URL ?>/my_reser_view.php?idx=<?=$row['cw_idx']?>" class="bt view <?= $all ?>">자세히보기</a><!--해당 예약의 상세뷰 화면으로 바로 이동-->
                    <?= $cancel ?>
                    <!--모든 페이지의 예약취소("해당 예약을 정말 취소하시겠습니까?"경고창 필요)시 현재 목록에서 사라지고 예약취소 목록으로 이동-->
                </div>
            </div><!--bx-->
            <?php } ?>

        </div>
    </div><!--in-->
</div><!--my_reser-->
<?php }else{

    echo '<div class="service_none" style="margin-top: 20px"><span><i class="fas fa-smile"></i></span>예약된 서비스가 없습니다.</div>';

}?>
<!-- 출장세차 예약현황 -->
<script>
    $(document).ready(function() {
        //취소모달
        $('#myModal').on('show.bs.modal', function(event) {
            idx = $(event.relatedTarget).data('idx');
            $('#modal_idx').val(idx);
        });
        //매니저정보
        $('#myModal2').on('show.bs.modal', function(event) {
            ma_name = $(event.relatedTarget).data('name');
            hp = $(event.relatedTarget).data('hp');
            $('#ma_modal_name').text(ma_name);
            $('#ma_modal_hp').text(hp);
			$('#ma_modal_a_hp').attr('href', 'tel:'+hp);
        });
    });


    function car_wash_cancel() {
        var idx = $('#modal_idx').val();

        $.ajax({
            url : g5_bbs_url + "/ajax.controller.php",
            data: {'idx': idx, 'mode':'car_wash_cancel'},
            type: 'POST',
            // datatype : 'json',
            success : function(data) {
                if(data == 1){
                    window.location.href = g5_bbs_url+'/my_reser_cancel.php';
                }else{
                    alert("통신에 실패했습니다.");
                }

            },
            err : function(err) {
                alert(err.status);
            }
        });

    }
</script>