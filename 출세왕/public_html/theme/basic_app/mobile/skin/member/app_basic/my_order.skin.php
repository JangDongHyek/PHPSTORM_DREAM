<?php
include_once(G5_PATH."/jl/JlConfig.php");
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: Thu, 01 Jan 1970 00:00:00 GMT");

/*// 현재 시간을 타임스탬프로 저장
$current_time = time();

// 현재 URL의 기존 쿼리 스트링을 가져옴
$query_params = $_GET;

// 기존에 timestamp가 없거나 1초 이상 차이가 나면 갱신
if (!isset($query_params['timestamp']) || abs($current_time - intval($query_params['timestamp'])) > 1) {
    // timestamp 값을 현재 시간으로 업데이트
    $query_params['timestamp'] = $current_time;

    // 새로운 URL 생성 (기존 파라미터 유지 + timestamp 추가)
    $new_url = strtok($_SERVER["REQUEST_URI"], '?') . '?' . http_build_query($query_params);

    // 새 URL로 리디렉트
    header("Location: $new_url");
    exit;
}*/

?>

<!-- 모달팝업 -->
<div id="basic_modal">
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <input type="hidden" id="complete_idx">
    <input type="hidden" id="rw_idx">
    <input type="hidden" name="is_re_car_wash">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times-circle"></i></button>
        <h4 class="modal-title" id="myModalLabel">작업완료</h4>
      </div>
      <div class="modal-body">
          해당작업을 완료처리 하시겠습니까?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default"  onclick="service_step('complete');">확인</button>
      </div>
    </div>
  </div>
</div>
</div><!--basic_modal-->
<!-- 모달팝업 -->



<!-- 출장세차 예약현황 -->
<div id="my_reser">
	<!--상단카테고리-->
    <ul class="cate mng cf">
        <li class="active"><a href="<?php echo G5_BBS_URL ?>/my_order.php">진행작업</a></li>
        <li><a href="<?php echo G5_BBS_URL ?>/my_order_end.php">완료작업</a></li>
    </ul>


    <div class="flex justB">
        <!-- 23.04.13  검색추가 wc -->
        <fieldset id="bo_sch">
            <legend>게시물 검색</legend>
            <form name="fsearch" method="get">
                <input type="hidden" name="filter" value="<?=$_GET['filter']?>">
                <input type="hidden" name="rw_idx_check" value="<?=$_GET['rw_idx_check']?>">
                <label for="sfl" class="sound_only">검색대상</label>
                <select name="sfl">
                    <option value="car_no"<?php echo get_selected($sfl, 'car_no', true); ?>>차량번호</option>
                    <option value="car_w_addr1"<?php echo get_selected($sfl, 'car_w_addr1'); ?>>지역</option>
                </select>
                <input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" placeholder="검색어" required id="stx" class="required frm_input" size="15" maxlength="20">
                <button type="submit" class="sbtn btn_submit"><i class="far fa-search"></i></button>
            </form>
        </fieldset>
    </div>

    <!-- 필터추가 04.22 -->
    <ul class="filter">

    </ul>
    <?
    $model = new jlModel("new_car_wash");
    $model2 = new jlModel("new_company_car_wash");

    $model->where('ma_id',$member['mb_id']);
    $first = $model->where('car_date_type',3)->where('is_payment','Y')->where('cw_step',1)->count();

    $model->where('ma_id',$member['mb_id'])->where('cw_step',1)->where('car_date_type',2);;
    $model->groupStart();
    $model->where("complete_datetime","0000-00-00 00:00:00")->addSql(' OR now() >= date_add(complete_datetime, interval +5 day) ');
    $model->groupEnd();
    $second = $model->count();

    $model->where('ma_id',$member['mb_id'])->where('cw_step',1)->where('car_date_type',5);
    $model->where('is_payment','Y');
    $third = $model->count();

    $fourth = $model2->where('ma_id',$member['mb_id'])->count();

    $model->join("new_re_car_wash","cw_idx","cw_idx","LEFT");
    $model->where('ma_id',$member['mb_id'])->where('is_turn_yn',"N","AND","new_re_car_wash");
    $model->where('car_date_type',"5","AND","","<=");
    $model->where('rw_idx',"0","AND NOT");
    $fifth = $model->count();

    //rw_step = 1
    //is_turn_yn = 'N'
    //and car_date_type <= 5 and ( cw.rw_idx <> 0 )
    ?>

    <ul class="filter">
        <li class="<? if ($filter == "3") echo "active"; ?>"><a href="<?=G5_BBS_URL.'/my_order.php?filter=3'?>">외부세차</a><p><?=$first?>건</p></li>
        <li class="<? if ($filter < 3) echo "active"; ?>"><a href="<?=G5_BBS_URL.'/my_order.php?filter=1'?>">정기세차</a><p><?=$second?>건</p></li>
        <li class="<? if ($filter == "5") echo "active"; ?>"><a href="<?=G5_BBS_URL.'/my_order.php?filter=5'?>">실내세차</a><p><?=$third?>건</p></li>
        <li class="<? if ($filter == "6") echo "active"; ?>"><a href="<?=G5_BBS_URL.'/my_order.php?filter=6'?>">기업세차</a><p>0건</p></li>
        <li class="<? if ($rw_idx_check == "true") echo "active"; ?>"><a href="<?=G5_BBS_URL.'/my_order.php?rw_idx_check=true'?>">재작업</a><p><?=$fifth?>건</p></li>
    </ul>
    
    <!--내용부분-->
    <? if($filter==6) { ?>
    <div class="in">
		<div class="cslist">
            <?php if (sql_num_rows($order_result) >0 ){
            for ($i = 0; $row = sql_fetch_array($order_result); $i++){
                ?>
			<div class="bx">
            	<h2 class="tit">

				</h2>
                <div class="tx">

                    <dl class="tx_m">
                        <dt>신청회사</dt>
                        <dd><?=$row['cc_company']?></dd>
                    </dl>
                    <dl class="tx_m">
                        <dt>신청관리자</dt>
                        <dd><?= $row['cc_manager'] ?></dd>
                    </dl>
                    <dl class="tx_m">
                        <dt>e-mail</dt>
                        <dd><?= $row['cc_email'] ?></dd>
                    </dl>
                    <dl class="tx_m">
                        <dt>휴대폰</dt>
                        <dd><?= $row['cc_hp'] ?></dd>
                    </dl>

                    <dl class="tx_m">
                        <dt>fax</dt>
                        <dd><?= $row['cc_fax'] ?></dd>
                    </dl>

                <dl class="tx_m">
                    <dt>주소1</dt>
                    <dd><?= $row['cc_w_addr1'] ?></dd>
                </dl>
                <dl class="tx_m">
                    <dt>주소2</dt>
                    <dd><?= $row['cc_w_addr2'] ?></dd>
                </dl>
                <dl class="tx_m">
                    <dt>연락처</dt>
                    <dd><?= $row['cc_number'] ?></dd>
                </dl>
                <dl class="tx_m">
                    <dt>실내세차</dt>
                    <dd><?= $row['cc_in_yn'] ?></dd>
                </dl>
                <dl class="tx_m">
                    <dt>신청일자</dt>
                    <dd><?= $row['wr_datetime'] ?></dd>
                </dl>
            <?php } ?>
                </div><!--tx-->
            </div><!--bx-->
            <?php
                }else{
                    echo "<div class=\"service_none\"><span><i class=\"fas fa-smile\"></i></span>진행예정 작업이 없습니다.</div>";
                }
                ?>
        </div>
    </div><!--in-->
<? } else { ?>
    <div class="in">
        <div class="cslist">
            <?php if (sql_num_rows($order_result) >0 ){
                for ($i = 0; $row = sql_fetch_array($order_result); $i++){
                    $add_strong = "";
                    $is_re_car_wash = "N";
                    //재작업건
                    if ($row['rw_idx'] != "" &&$row["is_turn_yn"] == "N") {
                        $add_strong = "<strong style='background: #f1f1f1'>재작업 요청건</strong>";
                        $is_re_car_wash = "Y";
                    }
                    $pass_days = 0;
                    //완료 일자에서 5일 지난 후 경과일 확인
                    if ($row['cw_complete_datetime'] != "0000-00-00 00:00:00"){
                        $cw_complete_datetime = strtotime(date('Y-m-d', strtotime($row['cw_complete_datetime'])) . "+5 days");
                        $now = strtotime(date("Y-m-d"));

                        $time_check = $now - $cw_complete_datetime;
                        $pass_days = floor($time_check / 86400);
                    }


                    ?>
                    <div class="bx">
                        <h2 class="tit">
                            <?php if($row["car_date_type"] < 3 && $pass_days > 0){ ?>
                                <!-- 경과일추가 04.22 --><p class="dateOver" onclick="complete_filter()"><span>+ <?=$pass_days?>일 경과</span></p>
                            <?php } ?>
                            <?= $cdt_list[$row['car_date_type']]?><strong class="size"><?= $cs_list[$row['car_size']]?></strong><?=$add_strong?>
                        </h2>
                        <div class="tx">
                            <!--                    <dl class="tx_m">-->
                            <!--                        <dt>신청일</dt>-->
                            <!--                        <dd>--><?php
                            //                            $date = explode(" ",$row['cw_datetime']);
                            //                            $day = explode('-',$date[0]);
                            //                            echo $day[0] . "년 " . $day[1] . "월 " . $day[2] . "일  ". date('H:i',strtotime($date[1])) ?><!--</dd>-->
                            <!--                    </dl>-->
                            <dl class="tx_m">
                                <dt>신청고객</dt>
                                <dd><?= $row['mb_name'].' / '.hyphen_hp_number($row['mb_hp']) ?> <span class="call"><a href='tel:<?=$row['mb_hp']?>' target="_parent"><i class="fas fa-phone-alt"></i></a></span></dd><!--전화아이콘 누르면 전화연결되게 가능한가요~~-->
                            </dl>
                            <dl class="tx_m">
                                <dt>차량정보</dt>
                                <dd><?= $row['car_no'] ?> / <?= $row['car_type'] ?> / <?= $row['car_color'] ?></dd>
                            </dl>
                            <dl class="tx_m">
                                <dt>세차일정</dt>
                                <dd>
                                    <?php
                                    successking_date($row['car_w_date'],$row['car_w_date2']);
                                    ?>
                                </dd>
                            </dl>
                            <dl class="tx_m">
                                <dt>세차장소</dt>
                                <dd><?=$row['car_w_addr1']." ".$row['car_w_addr2']?><br /><?=$row['car_place']?></dd>
                            </dl>

                            <!-- 23.04.17 내부세차 다 가림 -->
                            <dl class="tx_m" style="display: none">
                                <dt>내부세차</dt>
                                <dd class="ins"><span> <?= $row['car_in_yn'] == 'Y' ? "<i class=\"far fa-check-circle\"></i> 포함" : "<i class=\"far fa-times-circle\"></i> 포함안함"; ?></span></dd>
                            </dl>

                            <?php if($member['mb_level'] != 3){ ?>
                                <!-- 23.04.13 매니저만 못봄 wc -->
                                <dl class="tx_m">
                                    <dt>이용금액</dt>
                                    <dd><span class="price"><?= number_format($row['final_pay']) ?></span>원</dd>
                                </dl>
                            <?php } ?>
                        </div><!--tx-->
                        <div class="mini_btn cf">
                            <a href="<?php echo G5_BBS_URL ?>/my_order_view.php?idx=<?=$row['cw_idx']?>" class="bt view a2">자세히보기</a><!--해당 예약의 상세뷰 화면으로 바로 이동-->
                            <a data-toggle="modal" data-target="#myModal" data-idx = "<?=$row['cw_idx']?>" data-rw_idx = "<?=$row['rw_idx']?>" data-is = "<?=$is_re_car_wash?>" class="bt ok a2">작업완료</a><!--작업완료하면 완료작업으로 옮겨짐-->
                            <?php if ($row["rw_idx"] == ""){?>
                                <?php /* <a data-toggle="modal" data-target="#myModal2" data-idx = "<?=$row['cw_idx']?>" data-is = "<?=$is_re_car_wash?>" class="bt cancel a3">작업취소</a><!--작업취소하면 취소작업으로 옮겨짐--> */?>
                            <?php } ?>
                        </div>
                    </div><!--bx-->
                <?php }
            }else{
                echo "<div class=\"service_none\"><span><i class=\"fas fa-smile\"></i></span>진행예정 작업이 없습니다.</div>";
            } ?>
        </div>
    </div><!--in-->
<? }  ?>
</div><!--my_reser-->

<!-- 출장세차 예약현황 -->
<script>
    $(document).ready(function() {
        $('#myModal').on('show.bs.modal', function(event) {
            idx = $(event.relatedTarget).data('idx');
            is_re_car_wash = $(event.relatedTarget).data('is');
            rw_idx = $(event.relatedTarget).data('rw_idx');
            $('#rw_idx').val(rw_idx);
            $('#complete_idx').val(idx);
            $('[name = is_re_car_wash]').val(is_re_car_wash);
        });

    });

    let flag = false;


    function service_step(type) {
        var idx = "";
        if(type == 'complete'){
            idx = $("#complete_idx").val();
        }

        if(flag) {
            return false;
        }else {
            flag = true;
        }


        $.ajax({
            url: g5_bbs_url+"/ajax.controller.php",
            type: "POST",
            data: {
                "mode": "service_step",
                "type": type,
                "rw_idx" :  rw_idx,
                "is_car_wash" :  $('[name = is_re_car_wash]').val(),
                "idx" : idx
            },
            dataType: "json",
            success: function(data) {
                if (data["result"] == 1) {
                    //alert(g5_bbs_url + data["url"]);
                    window.location.href = g5_bbs_url + data["url"];
                }else{
                    swal_func("작업요청에 실패했습니다.");
                    flag = false;
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

    // 23.04.13 완료시간으로 오름차순 내림차순 wc
    function complete_filter(){
        var newURL = document.location.href;
        //해당문자열 있는지
        if(newURL.includes('&complete_datetime_order=ASC')){
            //있으면 필터삭제 &
            newURL = newURL.replace('&complete_datetime_order=ASC','');
        }else if(newURL.includes('?complete_datetime_order=ASC')){
            //있으면 필터삭제 ?
            newURL = newURL.replace('?complete_datetime_order=ASC','');
        }else{
            //없으면 필터추가
            newURL = newURL + '&complete_datetime_order=ASC';
        }
        location.href = newURL;
    }

    window.addEventListener("pageshow", function(event) {
        if (event.persisted) {
            location.reload();
        }
    });

    window.addEventListener("popstate", function(event) {
        location.reload(); // 뒤로가기가 감지되면 새로고침
    });

</script>