<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
?>
<style>
    #mem_list .love_none {
        text-align: center;
    }
    #mem_list .love_none span {
        margin-right: 4px;
        color: #F9C;
        font-size: 1.2em;
    }

    .noblur img {
        -webkit-filter: blur(0px) !important;
        -moz-filter: blur(0px) !important
        -o-filter: blur(0px) !important;
        -ms-filter: blur(0px) !important;
        filter: blur(0px) !important;
    }

    #mem_new #mem_sch input[type=text] {
        padding: 5px;
        border: 1px solid #fe8ea6 !important;
        background: #fff !important;
        height: 35px;
        width: calc(100% - 60px);
    }
    #mem_new #mem_sch input[type=button] {
        background: #fe8ea6;
        height: 35px;
        padding: 0 10px;
        font-size: 1em;
        font-weight: 600;
/*        width: 50px;*/
        border: none;
        color: #fff;
    }
.pg_wrap{
	width: 100%;
}
</style>

<!-- 관심있어요 모달팝업 -->
<div id="basic_modal">
<!-- Modal -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times-circle"></i></button>
        <h4 class="modal-title" id="myModalLabel">알림창</h4>
      </div>
      <div class="modal-body">
          <strong class="nick">닉네임</strong> 회원님을 결제전회원으로 등록하였습니다.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">확인</button>
      </div>
    </div>
  </div>
</div>
</div><!--basic_modal-->
<!-- 관심있어요 모달팝업 -->

<!-- 비노출 모달팝업 -->
<div id="basic_modal">
    <!-- Modal -->
    <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="member_noshow_close();"><i class="fas fa-times-circle"></i></button>
                    <h4 class="modal-title" id="myModalLabel">비노출</h4>
                </div>
                <div class="modal-body">
                    <strong class="nick">닉네임</strong> 회원님에게 비노출 처리하였습니다.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" onclick="member_noshow_close();">확인</button>
                </div>
            </div>
        </div>
    </div>
</div><!--basic_modal-->
<!-- 비노출 모달팝업 -->

<!-- 메세지 모달팝업 -->
<div id="basic_modal">
    <!-- Modal -->
    <div class="modal fade" id="myModal6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times-circle"></i></button>
                    <h4 class="modal-title" id="myModalLabel">메세지 보내기</h4>
                </div>

                <!-- 7살막는꺼 아래로감 -->
                <?php if(0){ ?>
                    <div class="modal-body msg_con">
                        <div class="to_name"><strong class="nick"></strong>께 보내는<span class="ht"><i class="fas fa-heart"></i></span>메세지<span class="ht"><i class="fas fa-heart"></i></span></div>
                        <div class="cont">
                  <textarea class="form-control doc-text" rows="6" id="message" name="message"
                            placeholder="저희 어플은 7살이상 연상이나 연하에게는 메세지 강제제한합니다.&#13;&#10;7살이상 차이나는 분이 마음에 드실경우 관리자에게 문의하세요." readonly style="resize: unset;"></textarea>
                            <p id="counter">0 / 최대 200자</p>
                        </div>
                    </div><!--msg_con-->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" onclick="location.href='<?php echo G5_URL."/bbs/board.php?bo_table=qna" ?>'"><i class="fas fa-paper-plane"></i> 문의하러 가기</button>
                        <input type="hidden" id="receive_mb_no" name="receive_mb_no">
                    </div>
                <?php }else{ ?>
                    <div class="modal-body msg_con">
                        <div class="to_name"><strong class="nick"></strong>께 보내는<span class="ht"><i class="fas fa-heart"></i></span>메세지<span class="ht"><i class="fas fa-heart"></i></span></div>
                        <div class="cont">
                            <textarea class="form-control doc-text" rows="6" id="message" name="message" placeholder="200자 이내로 내용을 입력해 주세요." style="resize: unset;"></textarea>
                            <p id="counter">0 / 최대 200자</p>
                        </div>
                    </div><!--msg_con-->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" onclick="send_message();"><i class="fas fa-paper-plane"></i> 메세지 전송하기</button>
                        <input type="hidden" id="receive_mb_no" name="receive_mb_no">
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>
</div><!--basic_modal-->
<!-- 메세지 모달팝업 -->



<!--새로운 회원 리스트-->
<div id="mem_new">
    <form id="fmemsch" name="fmemsch" method="get" action="">
    <div id="mem_sch" class="cf">
        <div class="part cf st2">
            <!-- 23.04.04 남자는 여자만, 여자는 남자만때문에 가려줌 wc
            <div class="sel">
                <select name="sex" id="sex" class="sch_sel" onchange="changeOption();">
                    <option value="">성별</option>
                    <option value="">전체</option>
                    <option value="여">여성</option>
                    <option value="남">남성</option>
                </select>
            </div>
            -->
        	<div class="sel">
                <select name="age" id="age" class="sch_sel" onchange="changeOption();">
                    <option value="">나이별</option>
                    <!--<option value="">전체</option>-->
                    <option value="20~25" <?=$age == "20~25" ? "selected" : ""?>>20~25</option>
                    <option value="26~30" <?=$age == "26~30" ? "selected" : ""?>>26~30</option>
                    <option value="30~35" <?=$age == "30~35" ? "selected" : ""?>>30~35</option>
                    <option value="36~40" <?=$age == "36~40" ? "selected" : ""?>>36~40</option>
                    <option value="40~45" <?=$age == "40~45" ? "selected" : ""?>>40~45</option>
                    <option value="45~49" <?=$age == "45~49" ? "selected" : ""?>>45~49</option>
                    <option value="50~" <?=$age == "50~" ? "selected" : ""?>>50~</option>
                </select>
            </div>

        	<?php /*<div class="sel">
                <select name="type" id="type" class="sch_sel" onchange="changeOption();">
                    <option value="">유형별</option>
                    <!--<option value="">전체</option>-->
                    <option value="노아">노아</option>
                    <option value="요나단">요나단</option>
                    <option value="여호수아">여호수아</option>
                    <option value="바울">바울</option>
                </select>
            </div> */?>
            <?php if($member['mb_join_type'] != '장애인') { ?>
            <div class="sel">
                <select name="join_type" id="join_type" class="sch_sel" onchange="changeOption();">
                    <option value="">타입별</option>
                    <!--<option value="">전체</option>-->
                    <option value="초혼" <?=$join_type == "초혼" ? "selected" : ""?>>초혼</option>
                    <option value="재혼" <?=$join_type == "재혼" ? "selected" : ""?>>재혼</option>
                    <!--<option value="장애인">장애인</option>-->
                </select>
            </div>
            <?php } ?>
			<div class="selBBox">
				<div class="sel">
					<select name="si" id="si" class="sch_sel" onchange="changeCity();changeOption();">
						<option value="">지역별</option>
						<!--<option value="">전체</option>-->
						<option value="서울" <?=$si == "서울" ? "selected" : ""?>>서울</option>
						<option value="경기" <?=$si == "경기" ? "selected" : ""?>>경기</option>
						<option value="세종" <?=$si == "세종" ? "selected" : ""?>>세종</option>
						<option value="인천" <?=$si == "인천" ? "selected" : ""?>>인천</option>
						<option value="부산" <?=$si == "부산" ? "selected" : ""?>>부산</option>
						<option value="대구" <?=$si == "대구" ? "selected" : ""?>>대구</option>
						<option value="대전" <?=$si == "대전" ? "selected" : ""?>>대전</option>
						<option value="울산" <?=$si == "울산" ? "selected" : ""?>>울산</option>
						<option value="광주" <?=$si == "광주" ? "selected" : ""?>>광주</option>
						<option value="충남" <?=$si == "충남" ? "selected" : ""?>>충남</option>
						<option value="충북" <?=$si == "충북" ? "selected" : ""?>>충북</option>
						<option value="경남" <?=$si == "경남" ? "selected" : ""?>>경남</option>
						<option value="경북" <?=$si == "경북" ? "selected" : ""?>>경북</option>
						<option value="전남" <?=$si == "전남" ? "selected" : ""?>>전남</option>
						<option value="전북" <?=$si == "전북" ? "selected" : ""?>>전북</option>
						<option value="강원" <?=$si == "강원" ? "selected" : ""?>>강원</option>
						<option value="제주" <?=$si == "제주" ? "selected" : ""?>>제주</option>
					</select>
				</div>
				<div class="sel sel_gu" style="display: none;">
					<select name="gu" id="gu" class="sch_sel" onchange="changeOption();">
					</select>
				</div>
			</div>
            <div class="search_wrap">
                <span style="display: none;">닉네임</span>
                <input type="text" id="sch" alt="닉네임" placeholder="닉네임" name="sch" value="<?=$_GET['sch']?>">
                <input type="hidden" id="mysex" name="mysex" value="<?=$member['mb_sex']?>">
                <input type="hidden" id="mb_approval" name="mb_approval" value="<?=$mb_approval?>">
                <input type="button" value="검색" onclick="changeOption('nick');">
                <input type="button" value="초기화" onclick="location.href=g5_bbs_url+'/mem_new.php?mb_approval=<?=$mb_approval?>' " style="background:#ee6884;">
            </div>
        <!--<div class="part add"><a class="add_sch" data-toggle="modal" data-target="#myModal"><i class="fas fa-plus-circle"></i> 추가검색하기</a></div>-->
        </div><!--part-->
    </div><!--mem_sch-->
    </form>

    <div id="mem_list">
        <?php
        $bg = '';
        $default_img = '';
        for($i=0; $mb=sql_fetch_array($result); $i++) {
            // 성별에 따라 폰트 색상 및 디폴트 이미지 변경
            if($mb['mb_sex'] == '여')  $bg = 'fe'; else $bg = 'male';
            if($mb['mb_sex'] == '여')  $default_img = 'noimg.jpg'; else $default_img = 'noimg_male.jpg';
            if($mb['mb_sex'] == '여')  $cover_img = 'img_cover02.png'; else $cover_img = 'img_cover01.png';

            // 직업
            $sql = " select co_main_code_value from g5_code where co_code_name = '사회적 역할' and co_code = '{$mb['mb_social_role']}' ";
            $job = sql_fetch($sql)['co_main_code_value'];

            // 프로필 이미지 (첫번째 사진 한장)
            $sql = " select * from g5_member_img where mb_no = {$mb['mb_no']} order by thumb is null asc, idx limit 1";
            $file = sql_fetch($sql);

            // 생년월일로 나이 계산
            $birthyear = substr($mb['mb_birth'],0,4);
            $nowyear = date("Y");
            $age = $nowyear - $birthyear + 1;

            // 이름 첫글자 제외 O처리
            $name = iconv_substr($mb['mb_name'], 0, 1, "utf-8");
            for ($i = 0; $i < (mb_strlen($mb['mb_name'], "utf-8") -1); $i++) {
                if($i < 2) {
                    $name .= 'O';
                }
            }

            // 본인은 관심있어요/대화신청 숨김
            if($member['mb_no'] == $mb['mb_no'] || $mb["mb_8"] == 2 || $mb_approval == 'N') { $hide = 'hide'; } else { $hide = ''; }

            // 21.05.04 본인에게 메세지 보낸 사람은 블러 처리 하지 않음, 1,000포인트 차감으로 프로필 사진 조회한 사람은 블러 처리 하지 않음
            $blur = 'blur';
            $message = sql_fetch(" select count(*) as count from g5_message where send_mb_no = {$mb['mb_no']} and receive_mb_no = {$member['mb_no']}; ")['count'];
            $profile_view = sql_fetch( " select count(*) as count from g5_member_point where mb_id = '{$member['mb_id']}' and rel_mb_id = '{$mb['mb_id']}'; ")['count'];
            if($message > 0 || $profile_view > 0 || $member['mb_no'] == $mb['mb_no']) {
                $blur = 'noblur';
            }
            $sql = "select count(*) cnt from g5_member_love where mb_no = '{$member["mb_no"]}' and love_mb_no = '{$mb['mb_no']}' ";
            $zzim_cnt = sql_fetch($sql)["cnt"];
            $zzim = ($zzim_cnt > 0) ? "co_zzim_on" : "co_zzim";
            $zzim_text = ($zzim_cnt > 0) ? "결제전회원 등록중" : "결제전회원 담기";

            if ($mb["mb_8"] == 2){
                $mb["mb_nick"] = "탈퇴한 회원";
                $name = "OOO";
                $href = "javascript:void(0)";
            }else{
                $href = G5_BBS_URL."/mem_view.php?mb_no=".$mb['mb_no'];
            }

            //23.05.30 승인안된사람보이고 클릭하면 대기중뜨게
            if($mb["mb_approval"] != 'Y'){
                $href = "javascript:swal('승인대기중입니다.')";
            }

        ?>
        <div class="memb">
			<a href="<?=$href?>">
                <div class="face"><span class="new_ico">N</span>               
					<div class="mg <?=$blur?>">
                        <?php if(isset($file['img_file'])) { ?>
                        <img src="<?php echo G5_THEME_IMG_URL; ?>/app/<?=$cover_img?>" />
                        <?php } else { ?>
                        <img src="<?php echo G5_THEME_IMG_URL; ?>/app/<?=$default_img?>" />
                        <?php } ?>
                    </div>
<!--                    <div class="name"><?=$name?></div> -->
                </div>
                <div class="info">
                    <?php if($mb['secret_member'] == 'Y') { ?><i class="secret"></i><? } ?> <!-- 시크릿 회원 -->
                    <h2 class="nick <?=$bg?>"><?=$mb['mb_nick']?></h2>
                    <!--여성회원일때 색상--><!-- 닉네임 -->
                    <h3 class="simp_info">
<!--                    <span><?=$mb['mb_live_si']?> <?=$mb['mb_live_gu']?></span>/<span><?=$age?>세</span>/<span><?=$job?></span>/-->
                    <span><?=$name?></span><!-- 이름 --> /
                    <span><?=$mb['mb_sex']?></span><!-- 나이 -->
                        <?php
                        if($mb['mb_birth']){
                            // 생년월일로 나이 계산
                            $birthyear_mb = substr($mb['mb_birth'],0,4);
                            $nowyear_mb = date("Y");
                            $age_mb = $nowyear_mb - $birthyear_mb + 1;
                        }else{
                            $age_mb = "-";
                        }
                        ?>
                        <!-- /
                        <span><?=$age_mb?>살</span>
                        -->
                    </h3>
					<!-- 사는곳/나이/직업/성별 -->
                    <div class="con"><?=$mb['mb_introduce']?></div><!--나의 신앙고백 내용이 추출될예정/최대 3줄까지만 표현되도록 ==> 자기소개글로 변경-->
                </div>
            </a>
            <div class="love_btn cf <?=$hide?>">
                <?php
                //23.04.04 어래이없을때 오류나던거 막아줌 wc
                if($noshow_arr){
                    if(in_array($mb['mb_no'], $noshow_arr)) {
                        ?>
                        <!-- 비노출 중일 때-->
                        <a class="private" href="javascript:void(0);" onclick="member_show('<?=$mb['mb_no']?>', '<?=$mb['mb_nick']?>');">
                            <div class="on">
                                <img src="<?php echo G5_THEME_IMG_URL; ?>/app/icon_private_on.svg" />
                                <span>비노출중</span>
                            </div>
                        </a>
                        <!-- //비노출 중일 때-->
                        <?php
                    } else {
                        ?>
                        <a class="private" href="javascript:void(0);" onclick="member_noshow('<?=$mb['mb_no']?>', '<?=$mb['mb_nick']?>');">
                            <div class="on">
                                <img src="<?php echo G5_THEME_IMG_URL; ?>/app/icon_private.svg" />
                                <span>노출중</span>
                            </div>
                        </a>
                        <?php
                    }
                }else{
                    ?>
                    <a class="private" href="javascript:void(0);" onclick="member_noshow('<?=$mb['mb_no']?>', '<?=$mb['mb_nick']?>');">
                        <div class="on">
                            <img src="<?php echo G5_THEME_IMG_URL; ?>/app/icon_private.svg" />
                            <span>노출중</span>
                        </div>
                    </a>
                    <?php
                }
                ?>
                <?php

                    $member_year    =   substr($member["mb_birth"],0,4);
                    $mb_year        =   substr($mb["mb_birth"],0,4);
                    $age_dif        =   abs($member_year-$mb_year);
                    $sql = "select * from g5_member_hope where mb_id = '{$member['mb_id']}' ";
                    $member_mh = sql_fetch($sql);
                    // 7살차이 AND 7살차이 제한이 아니오일때 가능
                ?>
				<a class="zzim" href="javascript:void(0);" onclick="member_love('<?=$mb['mb_no']?>', '<?=$mb['mb_nick']?>');"><img src="<?php echo G5_THEME_IMG_URL; ?>/app/<?=$zzim?>.png" /><span id="zzim_text_<?=$mb['mb_no']?>"><?=$zzim_text?></span></a><!--관심있어요 누르면 확인창이 뜨게 되고, 회원닉네임을 추출함 / 확인 버튼 누르면 해당회원이 내관심회원 리스트에 올라감-->
                <?php if($age_dif >= 7 && $member_mh['mh_ten'] !='N'){ ?>
                    <a onclick="swal('저희 어플은 7살이상 연상이나 연하에게는 메세지 강제제한합니다.\n 7살이상 차이나는 분이 마음에 드실경우 관리자에게 문의하세요.');">
                        <img src="<?php echo G5_THEME_IMG_URL; ?>/app/co_talk.png" /><span>메세지</span>
                    </a><!--메세지 클릭하면 메세지 보내기 창이 뜨게 됨. 회원닉네임을 추출. 전송하기 하면 내 메시지함의 보낸메세지함에 쌓임-->
                <?php }else{ ?>
                    <a href="javascript:void(0);" onclick="send_message_modal('<?=$mb['mb_no']?>', '<?=$mb['mb_nick']?>');"><img src="<?php echo G5_THEME_IMG_URL; ?>/app/co_talk.png" /><span>메세지</span></a><!--메세지 클릭하면 메세지 보내기 창이 뜨게 됨. 회원닉네임을 추출. 전송하기 하면 내 메시지함의 보낸메세지함에 쌓임-->
                <?php } ?>

                <a href="javascript:cart_in(<?=$mb['mb_no']?>,'<?=$mb['mb_nick']?>')">
           			<img src="<?php echo G5_THEME_IMG_URL; ?>/app/co_cart.png" alt="">
           			<span>결제후회원 담기</span>
           		</a>
            </div>
        </div><!--memb-->
        <?php
        }
        if($i==0) {
        ?>
        <div class="love_none"><span><i class="fas fa-leaf-heart"></i></span>결제후회원님이 없습니다.</div>
        <?php
        }
        ?>
        <?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>

    </div><!--mem_list-->
</div><!--mem_new-->
<!--새로운 회원 리스트-->

<script>
//textarea 글자 수 제한
$('.doc-text').keyup(function (e) {
    var content = $("textarea#message").val();
    $('#counter').html("" + content.length + " / 최대 200자");    //글자수 실시간 카운팅

    if (content.length > 200) {
        alert("최대 200자까지 입력 가능합니다.");
        $(this).val(content.substring(0, 200));
        $('#counter').html("200 / 최대 200자");
    }
});

function cart_in(no,mb_nick) {
    $.ajax({
        url: g5_bbs_url + '/ajax.controller.php',
        data: {
            mb_no : no,
            mode : "cart_in"
        },
        type: 'POST',
        success: function(data) {

            if(data == 'success') {
                $('#myModal2 .nick').text(mb_nick);
                $('#myModal2 .modal-body').html('<strong class="nick">'+mb_nick+'</strong> 회원님을 결제후회원에 담았습니다.');
            } else {
                $('#myModal2 .modal-body').text('이미 결제후회원에 담은 회원입니다.');
            }
            $('#myModal2').modal('show');
        }
    });
}
// 검색
function changeOption(type) {

    if (type == "nick" && $("#sch").val() == ""){
        swal("검색어를 입력해주세요.");
        return false;
    }

    //23.10.20 ajax로 보내던거 바꿈 wc
    $('#fmemsch').submit();
    /*

    $.ajax({
        url: g5_bbs_url + '/ajax.change_option.php',
        data: {
            mysex : $('#mysex').val(),
            sex : $('#sex').val(),
            age : $('#age').val(),
            si : $('#si').val(),
            gu : $('#gu').val(),
            type : $('#type').val(),
            join_type : $('#join_type').val(),
            sch : $('#sch').val(),
        },
        type: 'GET',
        success: function(data) {
            $('#mem_list').html(data);
        }
    });
     */
}

// 관심있어요
function member_love(mb_no, mb_nick) {
    $.ajax({
        type: 'POST',
        url: g5_bbs_url + "/ajax.reg_member_love.php",
        data: {mb_no: mb_no},
        success: function (data) {
            if(data == 'success') {
                $('#myModal2 .nick').text(mb_nick);
                $('#myModal2 .modal-body').html('<strong class="nick">'+mb_nick+'</strong> 결제전회원으로 등록하였습니다.');
                $('#zzim_text_'+mb_no).html('결제전회원 등록중');
            } else {
                $('#myModal2 .modal-body').text('이미 결제전회원입니다.');
            }
            $('#myModal2').modal('show');
        }
    });
}

// 메세지 모달
function send_message_modal(mb_no, mb_nick) {
    // 초기화
    $('textarea#message').val('');
    $('#counter').html("0 / 최대 200자");
    $('#myModal6 .nick').text(mb_nick); // 닉네임
    $('#receive_mb_no').val(mb_no); // 받는사람
    $('#myModal6').modal('show');
}

// 메시지 전송하기

var is_post = false;
function send_message() {
    console.log(is_post);
    if(is_post) {
        return false;
    }
    is_post = true;

    if($.trim($('#message').val()).length == 0) {
        swal('메세지를 입력해주세요.');
        is_post = false;
        return false;
    }
    var text = "\n<?=$manna_arr['message']?>만나가 차감됩니다.";
    <?php if ($ios_payment_test || $member["mb_level"] == 10){ ?>
    text = "";
    <?php } ?>
    swal({
        text: "메세지를 보내시겠습니까?"+text,
        icon: "warning",
        buttons: {
            cancel: "취소",
            defeat: "확인",
        }
    }).then((value) => {
        switch (value) {
            case "defeat":
                $.ajax({
                    type: 'POST',
                    url: g5_bbs_url + "/ajax.send_message.php",
                    data: {mb_no: $('#receive_mb_no').val(), message:  $('textarea#message').val() },
                    success: function (data) {
                        if(data == 'success') {
                            swal('메세지를 전송하였습니다.')
                                .then(() => {
                                    $('#myModal6').modal('hide');
                                });
                        }else {
                            swal('메세지를 보낼 만나가 부족합니다.')
                                .then(() => {
                                    $('#myModal6').modal('hide');
                                    location.href = g5_bbs_url + "/user_level.php"

                                });
                        }
                    }
                });

        }
        is_post = false;

    });

}

// 비노출 회원 설정
function member_noshow(mb_no, mb_nick) {
    $.ajax({
        type: 'POST',
        url: g5_bbs_url + "/ajax.reg_member_noshow.php",
        data: {mb_no: mb_no},
        success: function (data) {
            if(data == 'success') {
                $('#myModal3 #myModalLabel').text('비노출');
                $('#myModal3 .nick').text(mb_nick);
                $('#myModal3 .modal-body').html('<strong class="nick">'+mb_nick+'</strong> 회원님에게 비노출 처리되었습니다.');
            } else {
                $('#myModal3 .modal-body').text('이미 비노출회원으로 등록된 회원입니다.');
            }
            $('#myModal3').modal('show');
        }
    });
}

// 노출 회원 설정 (비노출 변경 후 다시 노출로 변경 시)
function member_show(mb_no, mb_nick) {
    $.ajax({
        type: 'POST',
        url: g5_bbs_url + "/ajax.reg_member_show.php",
        data: {mb_no: mb_no},
        success: function (data) {
            if(data == 'success') {
                $('#myModal3 #myModalLabel').text('노출');
                $('#myModal3 .nick').text(mb_nick);
                $('#myModal3 .modal-body').html('<strong class="nick">'+mb_nick+'</strong> 회원님에게 노출 처리되었습니다.');
            }
            $('#myModal3').modal('show');
        }
    });
}

// 비노출 회원 모달 종료
function member_noshow_close() {
    location.replace(g5_bbs_url + '/mem_new.php');
}

// 모달창 닫힐 때
$('#myModal3').on('hide.bs.modal', function(e){
    location.reload();
});

// 시/도 변경 -> 구/군 호출, 구/군 변경 -> 동/면 호출
function changeCity() {
    $('.sel_gu').show();

    var si = $("#si").val();
    if (!si) {
        $('.sel_gu').hide();
        return false;
    }
    $("#gu").find("option").remove();

    $.ajax({
        type: "GET",
        url: "<?php echo G5_PLUGIN_URL?>/address/address.php",
        dataType: "json",
        data: {"si": si},
        success: function (datas) {
            var opt_select = "", opt = "";
            var cur_gu = $("#cur_gu").val();

            opt += "<option value=''>지역상세</option>";
            for (var i = 0; i < datas.length; i++) {
                opt_select = (cur_gu == datas[i]) ? "selected" : "";
                opt += "<option value='" + datas[i] + "' " + opt_select + ">" + datas[i] + "</option>";
            }

            $("#gu").html(opt);
        },
        error: function (request, status, error) {
            console.log("code:" + request.status + "\n" + "message:" + request.responseText + "\n" + "error:" + error);
        }, complete: function () {
        }
    });
}
</script>