<?
include_once("./_common.php");

$g5['title'] = '마이페이지';
$pid = "mypage";
include_once('./_head.php');

$view = $_REQUEST["view"];

$sql = "select (select COUNT(*) from new_golf_reserve where mb_id = '{$member["mb_id"]}')+(select COUNT(*) from new_private_reserve where mb_id = '{$member["mb_id"]}')+(select COUNT(*) from new_enrolment where mb_id = '{$member["mb_id"]}') as cnt";
$reserve_cnt  = sql_fetch($sql)["cnt"];
$sql = "";


$sql[0] = "select * from new_private_reserve where mb_id = '{$member["mb_id"]}' order by pr_date desc, pr_time asc ";
$sql[1] = "select * from new_golf_reserve where mb_id = '{$member["mb_id"]}' order by gr_date desc, gr_time asc  ";
$sql[2] = "select cu.*,e_idx,e_proc,e_is_wait from new_enrolment e left join g5_write_cucenter cu on e.wr_id = cu.wr_id where e.mb_id = '{$member["mb_id"]}' order by e_idx desc  ";

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


    @media (max-width:768px){
        .btm_nav_box .link_title.ver2{
            margin-bottom: 20px;
        }
    }
</style>

<div class="autoW bdpd">
    <div id="mypage_wrap" class="">
        <?php include_once('./mypage_left_menu.php'); ?>
        <div class="con_wrap">

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
                            $place = "VIP창구 ".$row[$i]["pr_window"];
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
                            $title = "CU문화센터<div class=\"price\">".number_format($row[$i]["wr_6"])."</div>";
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
<!--                                <a href="./rev_view.php">-->
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

<script>

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

        location.href = g5_bbs_url + "/rev_list.php" + params;
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
