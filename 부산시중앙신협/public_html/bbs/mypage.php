<? 
include_once("./_common.php");

if(!$is_member){
//	goto_url(G5_URL."/bbs/login.php");
	alert("로그인 후 이용가능합니다.",G5_BBS_URL."/login.php?url=".$_SERVER["REQUEST_URI"]);
}

$g5['title'] = '마이페이지';
$pid = "mypage";
include_once('./_head.php');
$view = $_REQUEST["view"];

$sql = "select (select COUNT(*) from new_golf_reserve where mb_id = '{$member["mb_id"]}')+(select COUNT(*) from new_private_reserve where mb_id = '{$member["mb_id"]}')+(select COUNT(*) from new_enrolment where mb_id = '{$member["mb_id"]}') as cnt";
$reserve_cnt  = sql_fetch($sql)["cnt"];
$sql = "";


$sql[0] = "select * from new_private_reserve where mb_id = '{$member["mb_id"]}' order by pr_date desc, pr_time asc ";
$sql[1] = "select * from new_golf_reserve where mb_id = '{$member["mb_id"]}' order by gr_date desc, gr_time asc  ";
$sql[2] = "select cu.*,e_is_wait,e_proc from new_enrolment e left join g5_write_cucenter cu on e.wr_id = cu.wr_id where e.mb_id = '{$member["mb_id"]}' order by e_idx desc  ";

$what_sql = "";
$arr = [];
if ($view == "private") {
    $what_sql = $sql[0];
}elseif ($view == "golf"){
    $what_sql = $sql[1];
}elseif ($view == "cu"){
    $what_sql = $sql[2];
}else{
    for ($i = 0; $i < 3; $i++) {
        $result = sql_query($sql[$i]);
        for ($a = 0; $row = sql_fetch_array($result); $a++) {
            if ($i == 0){
                $row["view"] = "private";
            }elseif ($i == 1){
                $row["view"] = "golf";
            }else{
                $row["view"] = "cu";
            }
            $arr[] = $row;
        }
    }
}
if ($what_sql != "" ) {
    $result = sql_query($what_sql);
    for ($i = 0; $row = sql_fetch_array($result); $i++) {
        $arr[] = $row;
    }
}

?>
<link rel="stylesheet" href="<?=G5_BBS_URL?>/style.css?v=<?=G5_CSS_VER?>">
<style>
	.modal-dialog{
		width: auto;
	}
	.modal-title{
		font-size: 1.2em;
		font-weight: 600;
	}
	.modal-body{
		padding: 20px;
	}
	.modal.in .modal-dialog{
		position: absolute;
		left: 50%;
		top: 50%;
		transform: translate(-50%,-50%);
		-webkit-transform: translate(-50%,-50%);
	}
@media (max-width:768px){
    .btm_nav_box .link_title.ver2{
        margin-bottom: 20px;
    }
	.modal-body{
		padding: 15px;
	}
}
</style>

<div class="autoW bdpd">
    <div id="mypage_wrap" class="">
       <?php include_once('./mypage_left_menu.php'); ?> 
        <div class="con_wrap">
            <ul class="top_con">
                <li class="info">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/sub/ic_myinfo.svg" class="menu_ic">
                    <div class="profile_wrap">
                       <!--
						  vvip:.level04
						  vip:.level03
						  조합원:.level02
						  일반:.level01
                       -->
                        <span class="rating level0<?=$member["mb_level"]-1?>"><strong><?=$level_arr[$member["mb_level"]-1]?></strong> 등급</span>
                        <!--끝-->
                        
                        <h1><span class="user_name"><?=$member["mb_name"]?></span> 님 반갑습니다!</h1>
                        
                        <a href="./modify_info.php" class="btn_menu">회원정보수정<img src="<?php echo G5_THEME_IMG_URL ?>/common/ic_right.svg" class="ic_right"></a>
                    </div>
                </li>
                <li>
                	<img src="<?php echo G5_THEME_IMG_URL ?>/common/ic_qr.svg" class="menu_ic">
                	<a onclick="show_qrcode()" class="info_tit btn_pop">나의<br class="visible-xs"> QR코드</a>
                	<a onclick="show_qrcode()" class="btn_count btn_pop">열기<img src="<?php echo G5_THEME_IMG_URL ?>/common/ic_right.svg" class="ic_right"></a>
                </li>
                <li>
                    <a href="./rev_list.php">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/ic_rev.svg" class="menu_ic">
                        <a href="./rev_list.php" class="info_tit">나의<br class="visible-xs"> 예약 현황</a>
                        <a href="./rev_list.php" class="btn_count"><?=$reserve_cnt?><span class="em">건</span><img src="<?php echo G5_THEME_IMG_URL ?>/common/ic_right.svg" class="ic_right"></a>
                    </a>
                </li>
                <li>
                    <a href="./point_list.php">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/ic_point.svg" class="menu_ic">
                        <a href="./point_list.php" class="info_tit">포인트<br class="visible-xs"> 현황</a>
                        <a href="./point_list.php" class="btn_count"><?=number_format($member[mb_point])?><span class="em">P</span><img src="<?php echo G5_THEME_IMG_URL ?>/common/ic_right.svg" class="ic_right"></a>
                    </a>
                <li class="info_notice">
                    <strong>공지사항</strong>
                    <ul class="swiper-container slide_notice">
                        <li class="swiper-wrapper">
                           <div class="swiper-slide">
								<a class="notice_tit" href="<?php echo G5_BBS_URL ?>/board.php?bo_table=notice">
									안녕하세요 부산시중앙신협 멤버스 홈페이지를 새단장했습니다. 앞으로도 많은 이용 부탁드립니다!
								</a>  
                            <a class="btn_more" href="<?php echo G5_BBS_URL ?>/board.php?bo_table=notice"></a> 
							</div>
                        </li>
                        <li class="swiper-wrapper">
                           <div class="swiper-slide">
								<a class="notice_tit" href="<?php echo G5_BBS_URL ?>/board.php?bo_table=notice">
									안녕하세요 부산시중앙신협 멤버스 홈페이지를 새단장했습니다. 앞으로도 많은 이용 부탁드립니다!
								</a>   
                            <a class="btn_more" href="<?php echo G5_BBS_URL ?>/board.php?bo_table=notice"></a>
							</div>
                        </li>
                        <li class="swiper-wrapper">
                           <div class="swiper-slide">
								<a class="notice_tit" href="<?php echo G5_BBS_URL ?>/board.php?bo_table=notice">
									안녕하세요 부산시중앙신협 멤버스 홈페이지를 새단장했습니다. 앞으로도 많은 이용 부탁드립니다!
								</a>   
                            <a class="btn_more" href="<?php echo G5_BBS_URL ?>/board.php?bo_table=notice"></a>
							</div>
                        </li>
                    </ul>
                </li>
            </ul>

            <div class="rev_wrap">
                <h2>나의 예약 현황</h2>
                <ul class="rev_tab_wrap">
                    <li data-view = "" class="rev_tab <?php  if ($view == '') echo "on" ?>">전체</li>
                    <li data-view = "private" class="rev_tab <?php  if ($view == 'private') echo "on" ?>">프라이빗 센터</li>
                    <li data-view = "golf" class="rev_tab <?php  if ($view == 'golf') echo "on" ?>">더 스크린골프</li>
                    <li data-view = "cu" class="rev_tab <?php  if ($view == 'cu') echo "on" ?>">CU문화센터</li>
                </ul>
                <table class="rev_board">
                    <tr>
<!--                        <th>상태</th>-->
                        <th>구분</th>
                        <th>내용</th>
                        <th>기간</th>
                        <th>상태</th>
                        <th>비고</th>
                    </tr>
                    <?php for ($i = 0; $i < count($arr); $i++){
                        $row = $arr;
                        if (isset($row[$i]["view"])){
                            $view = $row[$i]["view"];
                        }
                        if ($view == "private"){
                            $title = "프라이빗 센터";
                            $place = $pr_window_arr[$row[$i]["pr_window"]];
                            $date = $row[$i]["pr_date"];
                            $time = $row[$i]["pr_time"];

                            $text = "pr";

                        }elseif ($view == "golf"){
                            $title = "더 스크린골프";
                            $place = $gr_room_arr[$row[$i]["gr_room"]];
                            $date = $row[$i]["gr_date"];
                            $time = ($row[$i]["gr_room"] > 3) ? ($row[$i]["gr_time"] == 1) ? "오전(9시~13시)": "오후(13시~18시)" : $reserve_time_arr[$row[$i]["gr_time"]];

                            $text = "gr";

                        }elseif ($view == "cu"){
                            $title = "CU문화센터";
                            $place = $row[$i]["wr_subject"];
                            $date = "수강기간 : ".$row[$i]["wr_1"]."~".$row[$i]["wr_2"];

                            $text = "e";

                        }

                        $idx = $row[$i][$text."_idx"];
                        $proc = $row[$i][$text."_proc"];
                        $proc_code = ($view =="cu") ? $row[$i]["e_is_wait"] : $row[$i][$text."_proc"];
                        ?>
                    <tr>
<!--                        <td><span class="st01">이용완료</span></td>-->
						<td><a href="javascript:void(0)"><?=$title?></a></td>
                        <td><a href="javascript:void(0)"><?=$place?></a></td>
                        <td>
                           <a href="javascript:void(0)">
                           <?=$date?>
                            <span class="line"></span>
                           <?=$time?>
                            </a>
                        </td>
                        <td><a href="javascript:void(0)"><?php if ($proc != "cancel" ) echo $proc_arr[$proc_code] ?></a></td>
                        <td>
                            <?php if ($proc == "comp" ){ ?>
                                <?php if ($view != "cu" ){ ?>
                                    <?php if ($date > G5_TIME_YMD){ ?>
                                        <button class="btn_color" onclick="reser_cancel('<?=$view?>','<?=$idx?>','<?=$row[$i]['gr_room']?>')">취소하기</button>
                                    <?php } ?>
                                <?php }else{ ?>
                                    <?php //문화센터 접수기간 전일 경우 예약 취소가능
                                    if ($row[$i]["wr_4"] > G5_TIME_YMD){ ?>
                                        <button class="btn_color" onclick="reser_cancel('<?=$view?>','<?=$idx?>','<?=$row[$i]['gr_room']?>')">취소하기</button>
                                    <?php } ?>
                                <?php } ?>
                            <?php }else{ ?>
								<a >취소완료</a>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php } ?>
                    <?php if ($i == 0){ ?>
                    <tr>
                        <td class="no_rev" colspan="4">
                            <a href="javascript:void(0)">예약정보가 없습니다.</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="modal" id="btn_pop_qr" tabindex="-1" role="dialog" aria-labelledby="btn_pop_qrLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h2 class="modal-title">나의 QR코드</h2>
      </div>
		<div class="modal-body" id="qr_span">
			<img src="<?=G5_URL?>/bbs/my_qrcode.php" alt="">
		</div>
    </div>
  </div>
</div>


<script>
	// btn_pop_qr
	function show_qrcode(){
		var time = Math.floor(new Date().getTime() / 1000);
		$("#qr_span").html("<img src='<?=G5_URL?>/bbs/my_qrcode.php?time="+time+"' alt=''>");
		$("#btn_pop_qr").modal("show");
	}

	$('#btn_pop_qr').on('shown.bs.modal', function () {
	  $('.btn_pop').focus()
	})
	
	  var swiper = new Swiper(".slide_notice", {
		  direction: 'vertical',
			slidesPerView :'1',
			spaceBetween:0,
			loop:true,
			autoplay: {
              delay: 6000,
              disableOnInteraction: false,
			},
//		   navigation: {
//			  nextEl: ".noti_slide .swiper-button-next",
//			  prevEl: ".noti_slide .swiper-button-prev",
//			},

	  });

      $("ul.rev_tab_wrap li").on("click", function() {
          var level = $(this).data("view"),
              params = "";

          if (level != "") {
              params += "?view=" + level;
          }

          location.href = g5_bbs_url + "/mypage.php" + params;
      });

    function reser_cancel(type,idx,gr_room) {

        if (!confirm("예약취소 하시겠습니까? 예약취소하실 경우 다시 예약을 잡으셔야 합니다.")) {
            return false;
        }

        $.ajax({
            url: g5_bbs_url+"/ajax.controller.php",
            type: "POST",
            data: {
                "idx": idx,
                "type" : type,
                "mode": "reser_cancel",
				"gr_room":gr_room
            },
            success: function(data) {
                if (data != 1){
                    alert("실패했습니다. 새로고침 후 다시 시도해주세요.");
                }else{
                    swal("예약취소가 완료되었습니다.")
                        // => 익스플로어 사용 불가능
                        .then(function(){
                            location.href = location.href;
                        });
                }

            }
        });
    }

</script>

<?php
include_once('./_tail.php');
?>
