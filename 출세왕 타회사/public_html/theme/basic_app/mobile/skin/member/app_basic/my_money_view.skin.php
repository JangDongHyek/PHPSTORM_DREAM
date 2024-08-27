<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);

if(!$is_member){
    alert("회원만 사용가능한 페이지입니다. 로그인 후 다시 이용해주세요",G5_URL);
}
?>
<style>

</style>

<!-- 완료횟수 조회 모달 -->
<div id="basic_modal">
    <!-- Modal -->
    <div class="modal fade" id="myModal_end" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <input type="hidden" id="ing_idx">
        <input type="hidden" name="is_re_car_wash">
        <input type="hidden" name="date_type">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times-circle"></i></button>
                    <h4 class="modal-title" id="myModalLabel">작업완료 내역</h4>
                </div>
                <div class="modal-body ordDone">
                    <?php for ($i = 0; $row = sql_fetch_array($complete_result); $i++){ ?>
                        <p><span><?=($i +1)?>회</span><?=date("Y년 m월 d일 H:i",strtotime($row["ch_datetime"]))?></p>
                    <?php } ?>

                    <?php for ($j = 0; $rowj = sql_fetch_array($re_result_array); $j++){ ?>
                        <?php if($j==0){ ?>
                            <br>재작업
                        <?php } ?>
                        <?php if($rowj["complete_datetime"]){ ?>
                            <p><span><?=($rowj['rw_complete_cnt'])?>회</span><?=date("Y년 m월 d일 H:i",strtotime($rowj["complete_datetime"]))?></p>
                        <?php } ?>
                    <?php } ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"data-dismiss="modal" aria-label="Close">확인</button>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="my_reser" class="view">
    <div class="view_txt">
		<h2 class="title"><?= $cdt_list[$view['car_date_type']] ?><strong class="size"><?= $cs_list[$view['car_size']] ?>
            </strong><span class="date">
                작업날짜 :
                <?php
                $date = explode(" ",$view['complete_datetime']);
                $day = explode('-',$date[0]);
                echo $day[0] . "년 " . $day[1] . "월 " . $day[2] . "일  ". date('H:i',strtotime($date[1])) ?>
            </span>
            <?php if (sql_num_rows($complete_result) > 0){ ?>
                <a href="#" class="dataMore" data-toggle="modal" data-target="#myModal_end">작업완료 내역확인</a>
            <?php } ?>
        </h2>
        <div class="serv">

            <dl class="tx_m cf">
                <dt>차량정보</dt>
                <dd>
                    <?= $view['car_no'] ?> / <?= $view['car_type'] ?> / <?= $view['car_color'] ?>
                </dd>
            </dl>

            <dl class="tx_m cf" >
                <dt>고객명/연락처</dt>

                <dd><?= $view['mb_name'] ?> / <?= hyphen_hp_number($view['mb_hp']) ?><span class="call"><a href="#"  onclick="window.location.href = 'tel:<?$view['mb_hp']?>';"><i class="fas fa-phone-alt"></i></a></span></dd>
                <script>
                    function tel_phone(){
                        window.location.href = 'tel:+82<?=mb_substr($view['mb_hp'],1)?>';
                        //window.open('tel:+82<?=mb_substr($view['mb_hp'],1)?>', '_system');
                    }
                    function test(){
                        alert('테스트');
                        //setTimeout(function(){window.location.href = "tel:+82 <?=mb_substr($view['mb_hp'],1)?>";},250);
                        //window.open('tel:<?=$view['mb_hp']?>', '_blank');
                        //location.href = '127.0.0.1';
                        //window.location.href = 'tel:+82<?=mb_substr($view['mb_hp'],1)?>';
                        //window.open('tel:+82<?=mb_substr($view['mb_hp'],1)?>', '_system');
                    }
                </script>
            </dl>

            <?php if($view['complete_cnt']){ ?>
                <dl class="tx_m cf">
                    <dt>작업횟수</dt>
                    <dd><?=$view['complete_cnt']?></dd>
                </dl>
            <?php } ?>

            <?php if(substr($view['ma_payment_datetime'],2,8) != '00-00-00'){ ?>
                <dl class="tx_m cf">
                    <dt>정산일</dt>
                    <dd><?= substr($view['ma_payment_datetime'],2,8) != '00-00-00' ? substr($view['ma_payment_datetime'],2,8) : '' ?></dd>
                </dl>
            <?php } ?>

            <?php if($view['ma_step']){ ?>
                <dl class="tx_m cf">
                    <dt>정산현황</dt>
                    <dd><?= $step_list[$view['ma_step']] ?></dd>
                </dl>
            <?php } ?>

            <dl class="tx_m cf">
                <dt>예상금액</dt>
                <?php if ($view['complete_cnt'] == 0) { $view['complete_cnt'] = 1; } ?>
                <dd>
                    <span class="price">
                        <?= number_format($view['complete_cnt'] * $ma_money_list[$view["car_date_type"]]) ?>
                    </span>원
                    <?= $view["cp_id"] ? '<i class="fa-solid fa-ticket"></i>' : '' ?>
                </dd>
            </dl>
            <dl class="tx_m cf">
                <dt>총 정산금액</dt>
                <dd><span class="price">
                        <?= number_format($view['ma_payment'] * 1) ?>
                        </span>원
                </dd>
            </dl>
        </div>
    </div><!--view_txt-->
    <div class="bt_reser cf"><a href="<?php echo G5_BBS_URL ?>/my_money.php?<?php echo $qstr ?>" class="list all">목록</a></div>
</div><!--my_reser-->



<script>
</script>
