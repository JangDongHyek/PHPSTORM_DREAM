<? 
include_once("./_common.php");

$g5['title'] = '주문하기';
$pid = "order_form";
include_once('./_head.php');
$idx = $_REQUEST["idx"];

if (!$is_member){
    alert("로그인 후 이용해주세요",G5_BBS_URL."/login.php?url=".$_SERVER["REQUEST_URI"]);
}

if ($member["mb_level"] < 3){
    alert('조합원전용서비스입니다. \n관리자가 조합원 확인 후 이용하실 수 있습니다.',G5_BBS_URL."/board.php?bo_table=cucenter&wr_id=".$idx);
}
$sql = "select * from g5_write_cucenter where wr_id = '{$idx}' ";
$cu = sql_fetch($sql);

$text = "";
if ($cu["wr_proc"] == 3 || G5_TIME_YMD > $cu["wr_4"]) {
    alert("접수마감 되었습니다.");
} elseif (G5_TIME_YMD < $cu["wr_3"]) {
    alert("접수대기 중 입니다.");
}



include_once(G5_LIB_PATH.'/thumbnail.lib.php');

?>

<link rel="stylesheet" href="<?=G5_BBS_URL?>/style.css?v=<?=G5_CSS_VER?>">
<style>
.sub_title:before{ content:"Order"; display:block;  font-size:18px; font-weight:600; color:#3e59a8;}
#ft_copy{ display:none;}
    .product_list > li {
        padding: 0;
        margin: 0 0 20px;
    }
@media screen and (min-width:767px) {
	.sub_title:before{  font-size:22px; margin-bottom:10px;}
	#ft_copy{ display:block;}
	#ft{ display:none;}
}
</style>

<div class="autoW bdpd">
    <form method="post" action="./ajax.controller.php">
        <input type="hidden" name="wr_id" value="<?=$idx?>">
        <input type="hidden" name="mode" value="cucenter_payment">
        <input type="hidden" name="wr_9" value="<?=$cu["wr_9"]?>">
		<input type="hidden" name="title" value="<?=$cu["wr_subject"]?>">
		<input type="hidden" name="cost" value="<?=number_format($cu["wr_6"])?>">
        <div id="order_form">
            <table class="area_product">
              <tr>
                   <th class="top_info">강좌정보</th>
                    <td class="item">
                        <a class="program_img" href="http://itforone.com/~busancu/bbs/board.php?bo_table=cucenter&wr_id=<?=$idx?>">

                            <?php
                            $sql = "select * from g5_board_file where bo_table = 'cucenter' and wr_id = '{$idx}' ";
                            $thumb = sql_fetch($sql)["bf_file"];
                            $thumb_path = G5_DATA_PATH."/file/cucenter/".$thumb;
                            $thumb_url = G5_DATA_URL."/file/cucenter/".$thumb;
                            if(file_exists($thumb_path) && $thumb != "" ) {
                                $img_content = '<img src="'.$thumb_url.'" >';
                            } else {
                                $img_content = '<span style="width:'.$board['bo_gallery_width'].'px;line-height:'.$board['bo_gallery_height'].'px" class="noimg">no image</span>';
                            } ?>
                            <?=$img_content?>
                        </a>
                        <div class="program_info">
                              <dt class="title"><?=$cu["wr_subject"]?></dt>
                              <dd><?=$cu["wr_1"]?>~<?=$cu["wr_2"]?></dd>
                              <dd><?=$cu["wr_5"]?></dd>
                        </div>
                    </td>
              </tr>
              <tr>
                   <th class="top_info">신청자명</th>
                    <td>
                        <div class="name">
                            <?=$member["mb_name"]?>
                        </div>
                    </td>
              </tr>
              <tr>
                   <th class="top_info">수강료</th>
                   <td>
                        <div class="price01">
                            <span><?=number_format($cu["wr_6"])?></span> 원
                        </div>
                    </td>
              </tr>
              <tr>
                   <th class="top_info">결제금액</th>
                   <td>
                        <div class="price02">
                            <span class="point"><?=number_format($cu["wr_6"])?></span> 원
                        </div>
                    </td>
              </tr>
              
            </table>
            
            
            <div class="agree_wrap">
                
                <section id="fregister_term">
                    <h4>CU문화센터 규정</h4>
                    <textarea readonly>규정내용이 들어갑니다.</textarea>
                    <fieldset class="fregister_agree">
                        <label for="agree11">CU문화센터 규정의 내용에 동의합니다.</label>
                        <input type="checkbox" name="agree" value="1" id="agree11">
                    </fieldset>
                </section>

                <section id="fregister_private">
                    <h4>개인정보처리방침안내</h4>
                    <div class="tbl_head01 tbl_wrap">
                        <table>
                            <caption>개인정보처리방침안내</caption>
                            <thead>
                            <tr>
                                <th>목적</th>
                                <th>항목</th>
                                <th>보유기간</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>이용자 식별 및 본인여부 확인</td>
                                <td>아이디, 이름, 비밀번호</td>
                                <td>회원 탈퇴 시까지</td>
                            </tr>
                            <tr>
                                <td>고객서비스 이용에 관한 통지,<br>CS대응을 위한 이용자 식별</td>
                                <td>연락처 (이메일, 휴대전화번호)</td>
                                <td>회원 탈퇴 시까지</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <fieldset class="fregister_agree">
                        <label for="agree21">개인정보처리방침안내의 내용에 동의합니다.</label>
                        <input type="checkbox" name="agree2" value="1" id="agree21">
                    </fieldset>
                </section>
            </div>
        </div>
        
        <a href="javascript:payment()" class="btn_payment">수강 신청하기</a>
    </form>

</div>
<?php
include_once('./_tail.php');
?>
<script>
    function payment() {
        if ($("#agree11:checked").val() == undefined){
            swal("cu문화센터 규정의 내용에 동의해주셔야 결제가 가능합니다.");
            return false;
        }
        if ($("#agree21:checked").val() == undefined){
            swal("개인정보처리방침 동의 후 결제가 가능합니다.");
            return false;
        }

        $("form")[0].submit();
    }
</script>
