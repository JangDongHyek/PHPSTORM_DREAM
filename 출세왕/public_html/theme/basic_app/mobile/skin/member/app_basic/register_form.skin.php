<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
//include_once($member_skin_path.'/mb.head.php');
add_javascript('<script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>', 0);

$fcm_token = get_session("fcm_token");

$sql = "select * from `member_gcm` where `mb_id` = '$member[mb_id]'";

$fcm_row = sql_fetch($sql);

if($fcm_row == null) $fcm_row['push_yn'] = "Y";

?>
<style>
body{background: #fff;}
.box-body.modal-open .Upmodal {top: 0;}
.Upmodal{background: #fff;width: 100%;height: 100%;margin: 0;padding: 0;transition: all 600ms cubic-bezier(0.86, 0, 0.07, 1);top:100%;position:fixed;left:0; text-align:left; z-index:1000; overflow-y: scroll;}
.js-close-modal{ position:fixed; right:0px; top:0px; opacity:0; width:50px; height:50px; background:#1a7cff; color:#fff; line-height:50px; text-align:center; z-index:11; transition: transform 1s;}
.js-close-modal svg{ font-size:1.3em}
#Area_setting .modal-dialog{ position:fixed; width:94%; margin:0 3% !important; top:50%; transform:translateY(-50%);}
#Area_setting .modal-body{ padding:0 !important;}
#Area_setting .modal-content{ border-radius:10px !important}
#category_list:after{ clear: both; content: ""; display: block;}
#category_list .left{ float:left; width:25%}
#category_list .left li{ text-align:center !important}
#category_list .left li.check{ background:#fff !important; border-right:0px;}
#category_list .right{ float:left; width:75%}
#category_list .right li{ background:#fff !important; font-size:.95em !important; font-weight:400 !important; border-bottom:0px}
#category_list li{font-size:1.10em; padding:17px 25px; border-bottom:1px solid #ddd; border-right:1px solid #ddd; position:relative; font-weight:500; width:100%; position:relative; background:#eef1f5}
#category_list li:last-child{border-bottom:0;}
/*#category_list li:after{
	display:block;
	font-family: "Font Awesome 5 Pro";
	color: #333;
	content:"\f111";
	position:absolute;
	top:50%; right:26px; transform:translateY(-50%);
	font-weight:300;
	font-size:1.2em;
}*/
#Area_setting li.active:after{content:"\f192";color:#372de4;font-weight:900;font-size: 1.3em;right:25px;}
</style>


<!-- 회원가입시작 { -->
<div class="mbskin">
    <script src="<?php echo G5_JS_URL ?>/jquery.register_form.js"></script>
    <?php if($config['cf_cert_use'] && ($config['cf_cert_ipin'] || $config['cf_cert_hp'])) { ?>
    <script src="<?php echo G5_JS_URL ?>/certify.js"></script>
    <?php } ?>

    <form name="fregisterform" id="fregisterform" action="<?php echo $register_action_url ?>" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
    <input type="hidden" name="w" value="<?php echo $w;?>">
    <input type="hidden" name="url" value="<?php echo $urlencode ?>">
	<input type="hidden" name="mb_level" id="mb_level" value="<? if($w == '') { echo $mb_level; } else { echo $member[mb_level]; } ?>">
    <?php if (isset($member['mb_sex'])) { ?><input type="hidden" name="mb_sex" value="<?php echo $member['mb_sex'] ?>"><?php } ?>
    <input type="hidden" name="mb_1" id="mb_1" value="<? if($w == '') { echo 'N'; } else { echo $member['mb_1']; } ?>">

        <article class="box-article">
    	<div id="join_info">
            <?php if($w == ""){ ?>
            <div class="join_part cf">
					<div class="part">
                        <a href="./register_form.php" class="on">고객 가입</a>
                    </div>
                    <div class="part">
                        <a href="./register_form_manager.php">매니저 가입</a>
                    </div>
                </div>
            <?php }else{ ?>

            <?php } ?>


            <div class="box-body">
                <dl class="row">
                	<dd class="col-xs-1 req">*</dd>
                    <dd class="col-xs-11">
                        <label for="reg_mb_id">아이디</label>
                        <input type="text" name="mb_id" value="<?php echo $member['mb_id'] ?>" id="reg_mb_id" class="regist-input   <?php if($w=="u") echo "readonly";?>" minlength="4" maxlength="20"   placeholder="아이디" <?php if($w=="u") echo "readonly";?>>
                    </dd>
                    <dd class="status_ico"><i class="fas fa-check"></i></dd>
                    <dd class="error col-xs-12"></dd>
                </dl>
    
                <dl class="row">
                	<dd class="col-xs-1 req">*</dd>
                    <dd class="col-xs-11">
                        <label for="reg_mb_password">비밀번호</label>
                        <input type="password" name="mb_password" id="reg_mb_password" class="regist-input  " minlength="4" maxlength="20"   placeholder="비밀번호">
                    </dd>
                    <dd class="status_ico lock_ico1"><i class="fas fa-lock-open"></i></dd>
                    <dd class="error col-xs-12"></dd>
                </dl>
    
                <dl class="row">
                	<dd class="col-xs-1 req">*</dd>
                    <dd class="col-xs-11">
                        <label for="mb_password_re">비밀번호확인</label>
                        <input type="password" name="mb_password_re" id="reg_mb_password_re" class="regist-input  " minlength="4" maxlength="20"   placeholder="비밀번호확인">
                    </dd>
                    <dd class="status_ico lock_ico2"><i class="fas fa-lock"></i></dd>
                    <dd class="error col-xs-12"></dd>
                </dl>
    
                <dl class="row">
                	<dd class="col-xs-1 req">*</dd>
                    <dd class="col-xs-11">
                        <label for="reg_mb_name">이름</label>
                        <input type="text" name="mb_name" value="<?php echo $member['mb_name'] ?>" id="reg_mb_name" class="regist-input  "   placeholder="이름" <?php if($w=="u") echo "readonly";?>>
                    </dd>
                    <dd class="status_ico"><i class="fas fa-check"></i></dd>
                    <dd class="error col-xs-12"></dd>
                </dl>
                
                <dl class="row">
                	<dd class="col-xs-1 req">*</dd>
                    <dd class="col-xs-11">
                        <label for="reg_mb_hp">휴대폰번호</label>
                        <input type="tel" name="mb_hp" value="<?php echo preg_replace("/[^0-9]*/s", "", $member['mb_hp']); ?>" id="reg_mb_hp" class="regist-input  "   placeholder="휴대폰번호" style="font-size:0.95em;" minlength="10" maxlength="13" >
                    </dd>
                    <dd class="status_ico"><i class="fas fa-check"></i></dd>
                    <dd class="error col-xs-12"></dd>
                </dl>
    
                <!--
                <dl class="row">
                	<dd class="col-xs-1 req">*</dd>
                    <dd class="col-xs-11">
                        <label for="reg_mb_nick">닉네임</label>
                        <input type="text" name="mb_nick" id="reg_mb_nick" class="regist-input   <?php if($w=="u") echo "readonly";?>" minlength="2" maxlength="20"   placeholder="닉네임" value="<?php echo $member['mb_nick']; ?>">
                    </dd>
                    <dd class="status_ico"><i class="fas fa-check"></i></dd>
                    <dd class="error col-xs-12"></dd>
                </dl>
    
                <dl class="row">
                	<dd class="col-xs-1 req">*</dd>
                    <dd class="col-xs-11">
                        <label for="reg_mb_email">E-mail</label>
                        <input type="text" name="mb_email" id="reg_mb_email" class="regist-input  " minlength="3" maxlength="50"   placeholder="E-mail" value="<?php echo $member['mb_email']; ?>">
                    </dd>
                    <dd class="status_ico"><i class="fas fa-check"></i></dd>
                    <dd class="error col-xs-12"></dd>
                </dl>-->
				
                
                <!--<dl class="row">
                    <dd class="col-xs-1 req">*</dd>
                    <dd class="col-xs-11">
                        <label for="reg_mb_name">주소</label>
                        <input type="text" name="mb_addr1" readonly onclick="sample2_execDaumPostcode()" value="<?php echo $member['mb_addr1'] ?>" id="reg_mb_addr1" class="regist-input" placeholder="주소">
                    </dd>
                    <dd class="status_ico"><i class="fas fa-check"></i></dd>
                    <dd class="error col-xs-12"></dd>
                </dl>
                <dl class="row">
                        <dd class="col-xs-1 req">*</dd>
                        <dd class="col-xs-11">
                            <label for="reg_mb_name">상세주소</label>
                            <input type="text" name="mb_addr2" value="<?php echo $member['mb_addr2'] ?>" id="reg_mb_addr2" class="regist-input" placeholder="상세주소">
                        </dd>
                        <dd class="status_ico"><i class="fas fa-check"></i></dd>
                        <dd class="error col-xs-12"></dd>
                </dl>-->
<!--                <div class="add_con"><i class="fas fa-map-marker-smile"></i> 서비스가 <span>가능</span>한 지역입니다.</div>-->
                <div style="position:relative">
<!--                    <a class="js-click-modal"><div class="" style="position:absolute; right:0; top:0; width:19%; text-align:center; line-height:50px; background:#1a7cff; color:#fff">설정</div></a>-->
                    <dl class="row">
                        <dd class="col-xs-1 req">*</dd>
                        <dd class="col-xs-11">
                            <label for="reg_mb_area">지역선택</label>
                            <input onclick="sample2_execDaumPostcode()" type="text" name="mb_addr1" value="<?php echo $member['mb_addr1'] ?>" id="reg_mb_addr1" class="regist-input" placeholder="지역선택" readonly >
                            <input type="text" name="mb_addr2" value="<?php echo $member['mb_addr2'] ?>" id="reg_mb_addr2" class="regist-input" placeholder="상세주소" >

                        </dd>
                        <dd class="status_ico"><i class="fas fa-check"></i></dd>
                        <dd class="error col-xs-12"></dd>
                    </dl>
                </div>
                
                <!--지역선택 modal-->
                <div class="Upmodal">
                        <div class="body">
                                <div id="category_list">
                                    <div class="left">
                                        <ul>
                                            <li class="check">서울 </li>
                                            <li>인천</li>
                                            <li>경기</li>
                                            <li>대전</li>
                                            <li>대구</li>
                                            <li>부산</li>
                                            <li>강원</li>
                                            <li>광주</li>
                                            <li>울산</li>
                                            <li>경남</li>
                                            <li>경북</li>
                                            <li>전남</li>
                                            <li>전북</li>
                                            <li>제주</li>
                                        </ul>
                                    </div>
                                    <div class="right">
                                        <ul>
                                            <li>강남/역삼/삼성/논현</li>
                                            <li>서초/신사/방배</li>
                                            <li>잠실/신천</li>
                                            <li>천호/길동/둔촌</li>
                                            <li>구로/영등포/여의도/목동</li>
                                            <li>신림/사당/금천/동작</li>
                                            <li>신촌/홍대/합정</li>
                                            <li>연신내/불광/응암</li>
                                            <li>종로/대학로</li>
                                            <li>건대/군자/군의</li>
                                            <li>성북/월곡/성신여대</li>
                                            <li>이태원/용산/서울역/명동</li>
                                       </ul>
                                    </div>
                                </div>
                          <a class="js-close-modal"><i class="fal fa-times"></i></a>
                        </div>
                </div>
                <!--//지역선택 modal-->
				<script>
                $('.js-click-modal').click(function(){
                  $('.box-body').addClass('modal-open');
				  $('.js-close-modal').css('opacity','1');
                });
                
                $('.js-close-modal').click(function(){
                  $('.box-body').removeClass('modal-open');
				  $('.js-close-modal').css('opacity','0');
                });
                </script>

                <?php if($member['mb_level'] == 2 || $w == ''  ){ ?>
                <dl class="row">
                	<dd class="col-xs-1 req">*</dd>
                    <dd class="col-xs-11">
                        <label for="reg_mb_recomm_code">추천인</label>
                        <?php if($w == ''){ ?>
                        <input type="text" name="mb_2" id="reg_mb_2" class="regist-input "   placeholder="추천인 아이디" >
                        <?php }else{ ?>
                         <input type="text" name="mb_2" id="reg_mb_2" class="regist-input " value="<?=$member['mb_2']?>"   placeholder="추천인 아이디" <?php if($w=="u") echo "readonly";?>>
                         <!--
                        <input type="text" name="mb_recommend" id="reg_mb_recommend" class="regist-input "  value="<?=$member['mb_recommend']?>" placeholder="추천인 아이디" <?php if($w=="u") echo "readonly";?>>
                         -->
                        <?php } ?>
                    </dd>
                    <dd class="status_ico"><i class="fas fa-check"></i></dd>
                    <dd class="error col-xs-12"></dd>
                </dl>
                <?php } ?>
                <div class="sche">
                    <h3><i class="far fa-clock"></i>근무형태</h3>
                    <div class="row">
                        <dd class="col-xs-12">
                            <select name="go_work" id="go_work" class="sch_sel" >
                                <option value="">근무형태 선택</option>
                                <option value="주간">주간</option>
                                <option value="야간">야간</option>
                                <option value="교대근무">교대근무</option>
                            </select>
                        </dd>
                    </div>

                    <h3><i class="far fa-clock"></i>자택주차가능시간/주차가능요일</h3>
                    <dl class="row">
                        <dd class="col-xs-3">
                            <select name="go_time1" id="go_time1" class="sch_sel" >
                                <option value="오전">오전</option>
                                <option value="오후">오후</option>
                            </select>
                        </dd>
                        <dd class="col-xs-4">
                            <select name="go_time2" id="go_time2" class="sch_sel" >
                                <option value="">시간 선택</option>
                                <option value="01시">01시</option>
                                <option value="02시">02시</option>
                                <option value="03시">03시</option>
                                <option value="04시">04시</option>
                                <option value="05시">05시</option>
                                <option value="06시">06시</option>
                                <option value="07시">07시</option>
                                <option value="08시">08시</option>
                                <option value="09시">09시</option>
                                <option value="10시">10시</option>
                                <option value="11시">11시</option>
                                <option value="12시">12시</option>
                            </select>
                        </dd>
                    </dl>
                    <dl class="row">

                        <div class="date result" id="w_date_view">

                                <!-- <span class="day">1.</span> -->
                                <?php $go_day = explode(",",$member['go_day']);?>
                                <input type="checkbox" name="go_day[]" id="w_date_0" value="매일" onchange="date_check('매일')" <?=in_array('매일',$go_day) ? 'checked':''?>>
                                <label for="w_date_0" style="display: inline-block">
                                    매일
                                </label>
                                <br>
                                <!-- <span class="day">2.</span> -->
                                <input type="checkbox" name="go_day[]" id="w_date_1" value="월" onchange="date_check()" <?=in_array('월',$go_day)?'checked':''?>>
                                <label for="w_date_1" style="display: inline-block">
                                    월
                                </label>
                                <input type="checkbox" name="go_day[]" id="w_date_2" value="화" onchange="date_check()" <?=in_array('화',$go_day)?'checked':''?>>
                                <label for="w_date_2" style="display: inline-block">
                                    화
                                </label>
                                <input type="checkbox" name="go_day[]" id="w_date_3" value="수" onchange="date_check()" <?=in_array('수',$go_day)?'checked':''?>>
                                <label for="w_date_3" style="display: inline-block">
                                    수
                                </label>
                                <input type="checkbox" name="go_day[]" id="w_date_4" value="목" onchange="date_check()" <?=in_array('목',$go_day)?'checked':''?>>
                                <label for="w_date_4" style="display: inline-block">
                                    목
                                </label>
                                <input type="checkbox" name="go_day[]" id="w_date_5" value="금" onchange="date_check()" <?=in_array('금',$go_day)?'checked':''?>>
                                <label for="w_date_5" style="display: inline-block">
                                    금
                                </label>
                                <input type="checkbox" name="go_day[]" id="w_date_6" value="토" onchange="date_check()" <?=in_array('토',$go_day)?'checked':''?>>
                                <label for="w_date_6" style="display: inline-block">
                                    토
                                </label>
                                <input type="checkbox" name="go_day[]" id="w_date_7" value="일" onchange="date_check()" <?=in_array('일',$go_day)?'checked':''?>>
                                <label for="w_date_7" style="display: inline-block">
                                    일
                                </label>
                        </div>
                            <script>
                                function date_check(status){
                                    if(status=='매일'){
                                        //매일이 체크됬는지 확인해서 안됬을때 누른거면 매일빼고 다른요일 해제해줌
                                        if($('#w_date_0').is(':checked')){
                                            //다른거 다 해제 매일 체크
                                            $("input:checkbox[name='go_day[]']").prop("checked", false);
                                            $("input:checkbox[id='w_date_0']").prop("checked", true);
                                        }else{
                                            //매일 체크해주고 다른거 다 해제
                                            $("input:checkbox[id='w_date_0']").prop("checked", true);
                                            $("input:checkbox[name='go_day[]']").prop("checked", false);
                                        }
                                    }else{
                                        //다른요일 눌렀을때 매일 체크되어있으면 그거해제해줌
                                        if($('#w_date_0').is(':checked')){
                                            $("input:checkbox[id='w_date_0']").prop("checked", false);
                                        }
                                        //요일 하나씩 다체크하면 매일을 체크되게
                                        if($("input:checkbox[name='go_day[]']:checked").length >= 7){
                                            $("input:checkbox[name='go_day[]']").prop("checked", false);
                                            $("input:checkbox[id='w_date_0']").prop("checked", true);
                                        }
                                    }
                                }
                            </script>


                    </dl>
                </div><!--sche-->

				<div class="sche">
                    <h3><i class="far fa-clock"></i> 푸시알림</h3>
                    <dl class="row exp">
                        <dd class="col-xs-1 req">*</dd>
                        <dd class="col-xs-6">
                            <input type="radio" value="Y" id="push_Y" name="push_yn" <? if($fcm_row['push_yn'] == "Y") { echo 'checked';}?>>
                            <label for="push_Y">ON</label>
                        </dd>
                        <dd class="col-xs-6">
                            <input type="radio" value="N" id="push_N" name="push_yn" <? if($fcm_row['push_yn'] == "N") { echo 'checked';}?>>
                            <label for="push_N">OFF</label>
                        </dd>
                    </dl>
                </div><!--sche-->



                <?php if($w == ""){ ?>
                <div class="car_info">
                	<span class="car"><i class="far fa-car"></i></span> <strong class="title">내 차량 정보</strong>
                    <div class="sc">대표차량 1대 등록하신 후, <br />마이페이지에서 추가차량등록이 가능합니다.</div>
                    <dl class="row">
                            <dd class="col-xs-12">
                                <label for="reg_car_no">차량번호 입력</label>
                                <input type="text"  name="car_no" value="<?php echo $member['car_no'] ?>" id="reg_car_no" class="regist-input" placeholder="차량번호 입력 (예:12가1234)">
                            </dd>
                    </dl>
                    <dl class="row">
                            <dd class="col-xs-12">
                                <label for="reg_car_type">차량종류 입력</label>
                                <input type="text"  name="car_type" value="<?php echo $member['car_type'] ?>" id="reg_car_type" class="regist-input" placeholder="차량종류 입력 (예:아반떼XD)">
                            </dd>
                    </dl>
                    <dl class="row">
                            <dd class="col-xs-12">
                                <label for="reg_car_color">차량색상 입력</label>
                                <input type="text"  name="car_color" value="<?php echo $member['car_color'] ?>" id="reg_car_color" class="regist-input" placeholder="차량색상 입력 (예:흰색)">
                            </dd>
                    </dl>
                    <dl class="row filebox">
                            <dd class="col-xs-12">
                                <label for="bf_file" id="back-image">자동차 사진(정면사진 첨부)</label>
                                <input type="file" name="bf_file" value="" id="bf_file" class="regist-input" placeholder="자동차 사진(정면사진 첨부)">
                            </dd>
                    </dl>
                </div><!--car_info-->
                <?php } ?>
    
            </div>
        </div><!--//join_info-->
		
		<?php if($w == ""){ ?>
        <div id="join_agr">
        <h2 class="hide">약관동의</h2>
            <div class="box-body agree allcheck">
                <dl class="row agree-row all">
                    <dd class="col-xs-12 chk_ico" data-for="reg_all">
                        <input type="checkbox" name="reg_all" id="reg_all" value="0" onclick="ag_check(this)">
                        <label for="reg_all" class="title">약관전체동의</label>
                      	<!-- <i></i> 이용약관 동의 (필수) -->
                    </dd>

                </dl>
				<dl class="row agree-row">
                    <dd class="col-xs-8 chk_ico" data-for="reg_req1">
                        <input type="checkbox" name="reg_req[]" id="reg_req1" value="0" onclick="ag_check(this)">
                        <label for="reg_req1">서비스 이용약관 동의 (필수)</label>
                      	<!-- <i></i> 이용약관 동의 (필수) -->
                    </dd>
                    <dd class="col-xs-4 text-right"><input type="button" value="보기" class="btn btn-agr"></dd>
                    <dd class="col-xs-12 agr_textarea"><textarea readonly><?php echo get_text($config['cf_stipulation']) ?></textarea></dd>
                </dl>
                
                <dl class="row agree-row">
                    <dd class="col-xs-9 chk_ico" data-for="reg_req2">
                        <input type="checkbox" name="reg_req[]" id="reg_req2" value="0" onclick="ag_check(this)">
                        <label for="reg_req2">개인정보처리방침 동의 (필수)</label>
                        <!--<i></i> 개인정보처리방침 동의 (필수) -->
                    </dd>
                    <dd class="col-xs-3 text-right"><input type="button" value="보기" class="btn btn-agr"></dd>
                    <dd class="col-xs-12 agr_textarea"><textarea readonly><?php echo get_text($config['cf_privacy']) ?></textarea></dd>
                </dl>
                
                <!--<dl class="agree-row">
                    <dd class=" chk_ico" data-for="reg_chk1">
                        <input type="checkbox" name="reg_chk[]" id="reg_chk1" value="">
                        <label for="reg_chk1">선택 동의 (선택)</label>
                        <i></i> 선택 동의 (선택) 
                    </dd>
                </dl>-->
            </div>
        </div><!--//join_chk-->
		<?php } ?>

		<input type="submit" class="btn_submit ft_btn" style="margin-top:15px " value="<?php echo $w==''?'회원가입':'정보수정'; ?>" accesskey="s">
        <?php /*?><a class="logout_btn" href="<?php echo G5_BBS_URL ?>/point.php">코인내역</a>
        <?php if(!$w == ""){ ?><a class="logout_btn" href="<?php echo G5_BBS_URL ?>/logout.php">로그아웃</a><?php } ?><?php */?>
	</article>
    </form>
</div>


<!--주소팝업-->
<div id="layer" style="display:none;position:fixed;overflow:hidden;z-index:3;-webkit-overflow-scrolling:touch;">
    <i class="fas fa-times-square" id="btnCloseLayer" style="width:40px; height:40px; color:#000; cursor:pointer;position:absolute;right:-5px;bottom:-5px;z-index:1" onclick="closeDaumPostcode()" alt="닫기 버튼"></i>
</div>


<script type="text/javascript">
	var back_image = "";
	var custom=0;
	var theme="";
	$(function(){
		$("#bf_file").change(handleImgFileSelect);
	});
	var sel_file;
	function handleImgFileSelect(e){
		var files = e.target.files;
		var filesArr = Array.prototype.slice.call(files);
		filesArr.forEach(function(f){
			if(!f.type.match("image.*")){
				alert("no Image");
				return;
			}
			sel_file=f;
			
			var reader = new FileReader();
			reader.onload = function(e){
				//var strHtml='<li<img src='+e.target.result+'>';
				
				var strHtml='<img src="'+e.target.result+'" alt="" width="100%" height="auto">';
				$("#back-image").html(strHtml);
				for(var i=0;i<8;i++){
					$("#clock-chk li").eq(i).removeClass("check");
				}
				var form = $("#form")[0];
				var formData= new FormData(form);
				formData.append("photo",$("input[name=photo]")[0].files[0]);;
			}
			reader.readAsDataURL(f);
		});
	}
</script>
<script>
var element_layer = document.getElementById('layer');

function closeDaumPostcode() {
    // iframe을 넣은 element를 안보이게 한다.
    element_layer.style.display = 'none';
}

function sample2_execDaumPostcode() {
    new daum.Postcode({
        oncomplete: function(data) {
            // 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

            // 각 주소의 노출 규칙에 따라 주소를 조합한다.
            // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
            var addr = ''; // 주소 변수
            var extraAddr = ''; // 참고항목 변수

            //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
            if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                addr = data.roadAddress;
            } else { // 사용자가 지번 주소를 선택했을 경우(J)
                addr = data.jibunAddress;
            }

            // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
            if(data.userSelectedType === 'R'){
                // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                    extraAddr += data.bname;
                }
                // 건물명이 있고, 공동주택일 경우 추가한다.
                if(data.buildingName !== '' && data.apartment === 'Y'){
                    extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                }
                // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                if(extraAddr !== ''){
                    extraAddr = ' (' + extraAddr + ')';
                }
                // 조합된 참고항목을 해당 필드에 넣는다.
                // document.getElementById("sample2_extraAddress").value = extraAddr;

            } else {
                // document.getElementById("sample2_extraAddress").value = '';
            }

            // 우편번호와 주소 정보를 해당 필드에 넣는다.
            // document.getElementById('sample2_postcode').value = data.zonecode;
            document.getElementById("reg_mb_addr1").value = addr +' '+extraAddr;
            // 커서를 상세주소 필드로 이동한다.
            document.getElementById("reg_mb_addr2").focus();

            // iframe을 넣은 element를 안보이게 한다.
            // (autoClose:false 기능을 이용한다면, 아래 코드를 제거해야 화면에서 사라지지 않는다.)
            element_layer.style.display = 'none';
        },
        width : '100%',
        height : '100%',
        maxSuggestItems : 5
    }).embed(element_layer);

    // iframe을 넣은 element를 보이게 한다.
    element_layer.style.display = 'block';

    // iframe을 넣은 element의 위치를 화면의 가운데로 이동시킨다.
    initLayerPosition();
}

// 브라우저의 크기 변경에 따라 레이어를 가운데로 이동시키고자 하실때에는
// resize이벤트나, orientationchange이벤트를 이용하여 값이 변경될때마다 아래 함수를 실행 시켜 주시거나,
// 직접 element_layer의 top,left값을 수정해 주시면 됩니다.
function initLayerPosition(){
    var width = "350"; //우편번호서비스가 들어갈 element의 width 350
    var height = "400"; //우편번호서비스가 들어갈 element의 height 400
    var borderWidth = 2; //샘플에서 사용하는 border의 두께

    // 위에서 선언한 값들을 실제 element에 넣는다.
    element_layer.style.width = width + 'px';
    element_layer.style.height = height + 'px';
    element_layer.style.border = borderWidth + 'px solid';
    // 실행되는 순간의 화면 너비와 높이 값을 가져와서 중앙에 뜰 수 있도록 위치를 계산한다.
    element_layer.style.left = (((window.innerWidth || document.documentElement.clientWidth) - width)/2 - borderWidth) + 'px';
    element_layer.style.top = (((window.innerHeight || document.documentElement.clientHeight) - height)/2 - borderWidth) + 'px';
}


function ag_check(obj){
	if(obj.value == "0"){
		obj.value = "1";
	}else{
		obj.value = "0";
	}
}
var name_chk = "Y";
$(function (){
	//전체동의 체크 클릭시
	$("#reg_all").click(function(){
		$("#reg_req1").prop("checked",$(this).prop("checked"));
		$("#reg_req2").prop("checked",$(this).prop("checked"));
	});
	// 아이디 체크
	
	$("#reg_mb_id").keyup(function (){
		var mb_id = $(this).val();
		var reg_mb_id = $(this);

		// 아이디 정규표현식
		var regId = /^[a-z0-9]{4,12}$/;
		/*
		if (regId.test(mb_id)){ 
			$(this).parents(".row").find(".status_ico").removeClass("err").addClass("pas");
			$(this).parents(".row").find(".error").html("");
		}else{
			$(this).parents(".row").find(".status_ico").removeClass("pas").addClass("err");
			$(this).parents(".row").find(".error").addClass("on").html("아이디는 영문과 숫자, 4 ~ 12자리까지 가능합니다.");
			
			return false;
		}*/
		
		// 아작스로 중복 아이디가 있는지 체크 1
        // 23.04.21 여기 파일없어.. 근데작동하네.. ;; wc
		/*$.post(g5_bbs_url+"/ajax.mb_register.php", {"type":"mb_id", "val":mb_id}, function (result){
			if(result == "0"){  // ajax.mb_register.php 의 echo $row['cnt']; 값을 가져옴
				reg_mb_id.parents(".row").find(".status_ico").removeClass("err").addClass("pas"); //될때 초록색 박스 i 는 icon 의 약자
				reg_mb_id.parents(".row").find(".error").html(""); // 마지막 dd 의 css 스타일 사용
			}else{
				reg_mb_id.parents(".row").find(".status_ico").removeClass("pas").addClass("err");
				reg_mb_id.parents(".row").find(".error").addClass("on").html("사용중인 아이디입니다.");
			}
		});*/
	});

	$("#reg_mb_password").keyup(function (){
		var mb_password = $(this).val();
		var reg_mb_password = $(this);
		/*
		// 바뀌면 무조건 틀렸다로 표시.
		if($("#reg_mb_password_re").val() != mb_password){
			$("#reg_mb_password_re").parents(".row").find(".status_ico").removeClass("pas").addClass("err");
			$("#reg_mb_password_re").parents(".row").find(".error").addClass("on").html("비밀번호가 다릅니다.");	
		}else{
			$("#reg_mb_password_re").parents(".row").find(".status_ico").removeClass("err").addClass("pas");
			$("#reg_mb_password_re").parents(".row").find(".error").html("");
		}*/
		/*
		// 비밀번호 정규표현식
		var regPassword = /^.*(?=^.{8,15}$)(?=.*\d)(?=.*[a-zA-Z])(?=.*[!@#$%^&+=]).*$/;

		if (regPassword.test(mb_password)){ 
			$(this).parents(".row").find(".status_ico").removeClass("err").addClass("pas");
			$(this).parents(".row").find(".error").html("");
		}else{
			$(this).parents(".row").find(".status_ico").removeClass("pas").addClass("err");
			$(this).parents(".row").find(".error").addClass("on").html("비밀번호는 8자~15자 영문,숫자,특수문자가 포함 되어야 합니다.");
		}*/
	});

	$("#reg_mb_password_re").keyup(function (){
		var mb_password_re = $(this).val();
		var mb_password = $("#reg_mb_password").val();

		// 비밀번호 정규표현식
		var regPassword = /^.*(?=^.{8,15}$)(?=.*\d)(?=.*[a-zA-Z])(?=.*[!@#$%^&+=]).*$/;
		
		if(mb_password == mb_password_re){
			$(this).parents(".row").find(".status_ico").removeClass("err").addClass("pas");
			$(this).parents(".row").find(".error").html("");
		}else{
			$(this).parents(".row").find(".status_ico").removeClass("pas").addClass("err");
			$(this).parents(".row").find(".error").addClass("on").html("비밀번호가 다릅니다.");	
		}
	});


	$("#reg_mb_name").keyup(function (){
		var mb_name = $(this).val();
		var reg_mb_name = $(this);

		// 이름 정규표현식
		var regName = /^[가-힣]{2,4}|[a-zA-Z]{2,10}\s[a-zA-Z]{2,10}$/;

		if (regName.test(mb_name)){ 
			$(this).parents(".row").find(".status_ico").removeClass("err").addClass("pas");
			$(this).parents(".row").find(".error").html("");
            name_chk = "Y";
        }else{
			$(this).parents(".row").find(".status_ico").removeClass("pas").addClass("err");
			$(this).parents(".row").find(".error").addClass("on").html("2글자 이상 한글만 입력해주세요.");
			name_chk = "N";
		}
	});

	$("#reg_mb_hp").keyup(function (){
		var mb_hp = $(this).val();
		var reg_mb_hp = $(this);

		// 휴대폰 정규표현식
		// /^01([0|1|6|7|8|9]?)-?([0-9]{3,4})-?([0-9]{4})$/
		//var regHp = /^\d{10,12}$/;
        var regHp = /^([0-9]{3,4})-?([0-9]{3,4})-?([0-9]{4})$/;

		if (regHp.test(mb_hp)){
			$(this).parents(".row").find(".status_ico").removeClass("err").addClass("pas");
			$(this).parents(".row").find(".error").html("");
		}else{
			$(this).parents(".row").find(".status_ico").removeClass("pas").addClass("err");
			$(this).parents(".row").find(".error").addClass("on").html("휴대폰 번호는 10 ~ 12자리 숫자만 입력하세요.");
		}
	});
	
	

	$("#reg_mb_nick").keyup(function (){
		var mb_nick = $(this).val();
		var reg_mb_nick = $(this);

		// 닉네임 정규표현식
		var regNick = /^[\w\Wㄱ-ㅎㅏ-ㅣ가-힣]{2,20}$/;
		
		if (regNick.test(mb_nick)){ 
			$(this).parents(".row").find(".status_ico").removeClass("err").addClass("pas");
			$(this).parents(".row").find(".error").html("");
		}else{
			$(this).parents(".row").find(".status_ico").removeClass("pas").addClass("err");
			$(this).parents(".row").find(".error").addClass("on").html("2글자 이상 입력해주세요.")		
			return false;
		}

		// 23.04.21 여기 파일없어.. 근데작동하네.. ;; wc
		/*$.post(g5_bbs_url+"/ajax.mb_register.php", {"type2":"mb_nick", "val2":mb_nick}, function (result){
			if(result == "0"){  
				reg_mb_nick.parents(".row").find(".status_ico").removeClass("err").addClass("pas"); 
				reg_mb_nick.parents(".row").find(".error").html("");
			}else{
				reg_mb_nick.parents(".row").find(".status_ico").removeClass("pas").addClass("err");
				reg_mb_nick.parents(".row").find(".error").addClass("on").html("사용중인 닉네임 입니다.");
			}
		});*/
	});
	
	$("#reg_mb_email").keyup(function (){
		var mb_email = $(this).val();
		var reg_mb_email = $(this);

		// 이메일 정규표현식
		var regEmail = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/;
		
		if (regEmail.test(mb_email)){ 
			$(this).parents(".row").find(".status_ico").removeClass("err").addClass("pas");
			$(this).parents(".row").find(".error").html("");
		}else{
			$(this).parents(".row").find(".status_ico").removeClass("pas").addClass("err");
			$(this).parents(".row").find(".error").addClass("on").html("올바른 E-mail 형식으로 입력해주십시오.")		
			return false;
		}
	});
	
	$("#reg_mb_level").click(function (){
		var mb_level = $(this).val();
		var reg_mb_level = $(this);

		// 이메일 정규표현식

		var regEmail = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/;
		
		if (regEmail.test(mb_email)){ 
			$(this).parents(".row").find(".status_ico").removeClass("err").addClass("pas");
			$(this).parents(".row").find(".error").html("");
		}else{
			$(this).parents(".row").find(".status_ico").removeClass("pas").addClass("err");
			$(this).parents(".row").find(".error").addClass("on").html("올바른 E-mail 형식으로 입력해주십시오.")		
			return false;
		}
	});
	
	// 라디오 버튼
	$("#dd_type p").click(function (){
		var v = $(this).data("val");
		$("#mb_type").val(v);
		$("#dd_type p").find("i").removeClass("fa-check-circle-o").addClass("fa-circle-o");
		$(this).find("i").removeClass("fa-circle-o").addClass("fa-check-circle-o");
	});

	// 내용보기 
	$(".btn-agr").click(function (){
		var dis = $(this).parents(".row").find(".agr_textarea").css("display");
		if(dis == "none")
			$(this).parents(".row").find(".agr_textarea").slideDown(100);
		else
			$(this).parents(".row").find(".agr_textarea").slideUp(100);
	});
	// 약관동의
	
	$(".agree-row dd:first-child").click(function (){
		var ford = $(this).data("for");
		var targ = $("#" + ford);
		
		if(targ.val() == "1"){			
			$(this).find("i").removeClass("nochk").addClass("chk");
			//targ.val("0");
		}else{			
			$(this).find("i").removeClass("chk").addClass("nochk");
			//targ.val("1");
		}
	});

	// 가입경로선택
	//$("#reg_mb_1").on("change", function() {
//		if ($(this).val() == "기타") {
//			$("#reg_mb_2").show().focus();
//		} else {
//			$("#reg_mb_2").hide().val("");
//		}
//	});

});

function only_number(num){
	num = num + "";
	num = num.replace(/[^0-9]/gi, "");
	return num;
}

var mb_2_chk = function() {


    var result = "";
    $.ajax({
        type: "POST",
        url: g5_bbs_url+"/ajax.controller.php",
        data: {
            "mode": 'mb_2_chk',
            "val": $('#reg_mb_2').val()
        },
        cache: false,
        async: false,
        success: function(data) {
            result = data;
        }
    });

    return result;
}

// submit 최종 폼체크
function fregisterform_submit(f)
{
	// 필수 체크박스
	// 조건들 확인

	// 회원아이디 검사
	if (f.w.value == "") {
		var msg = reg_mb_id_check();
		if (msg) {
			swal_func(msg);
			f.mb_id.select();
			return false;
		}
	}

	if (f.w.value == '') {
		if (f.mb_password.value.length < 3) {
			swal_func('비밀번호를 3글자 이상 입력하십시오.');
			f.mb_password.focus();
			return false;
		}
	}

	if (f.mb_password.value != f.mb_password_re.value) {
		swal_func('비밀번호가 같지 않습니다.');
		f.mb_password_re.focus();
		return false;
	}

	if (f.mb_password.value.length > 0) {
		if (f.mb_password_re.value.length < 3) {
			swal_func('비밀번호를 3글자 이상 입력하십시오.');
			f.mb_password_re.focus();
			return false;
		}
	}

	// 이름 검사
	if (f.w.value=='') {
		if (f.mb_name.value.length < 1 ) {
			swal_func('이름은 필수값입니다.');
			f.mb_name.focus();
			return false;
		}

		if(name_chk == "N"){
            swal_func('이름은 2글자 이상 한글만 입력해주세요.');
            f.mb_name.focus();
            return false;
        }
        if (f.mb_hp.value.length < 1 ) {
            swal_func('휴대폰 번호는 필수값입니다.');
            f.mb_name.focus();
            return false;
        }
        if (f.reg_mb_addr1.value.length < 1 ) {
            swal_func('지역은 필수값입니다.');
            f.mb_name.focus();
            return false;
        }
	}

    var required_data = $("[id^='go_']"),
        required_chk = "Y",
        text = "";

    for (var i = 0; i < required_data.length; i++) {
        if (required_data[i].value == "") {
            if ($(required_data[i]).attr('id') == "go_work"){
                text = "근무형태"
            }else if ($(required_data[i]).attr('id') == "go_time2"){
                text = "자택주차가능시간"
            }else{
                text = $(required_data[i]).attr('placeholder');
            }
            swal_func(text +'은(는) 필수값입니다.');
            $('#'+$(required_data[i]).attr('id')).focus();
            required_chk = 'N';
            return false;
        }
    }

    if($('input[name="go_day[]"]:checked').length == 0){
        swal_func('주차가능요일을 선택해주세요.');
        return false;
    }


    var required_data2 = $("[id^='reg_car_']"),
        required_chk2 = "Y";

    for (var i = 0; i < required_data2.length; i++) {
        if (required_data2[i].value == "") {
            swal_func($(required_data2[i]).attr('placeholder') +'은(는) 필수값입니다.');
            $('#'+$(required_data2[i]).attr('id')).focus();
            required_chk2 = 'N';
            return false;
        }
    }


    /*
        // 닉네임 검사
        if ((f.w.value == "") || (f.w.value == "u" && f.mb_nick.defaultValue != f.mb_nick.value)) {
            var msg = reg_mb_nick_check();
            if (msg) {
                alert(msg);
                f.reg_mb_nick.select();
                return false;
            }
        }*/
/*
	// E-mail 검사
	if ((f.w.value == "") || (f.w.value == "u" && f.mb_email.defaultValue != f.mb_email.value)) {
		var msg = reg_mb_email_check();
		if (msg) {
			alert(msg);
			f.reg_mb_email.select();
			return false;
		}
	}*/

	// 가입경로확인
	//if ($("select#reg_mb_1 option:selected").val() == "기타" && $("input#reg_mb_2").val() == "") {
//		alert("가입경로를 입력하세요.");
//		$("input#reg_mb_2").focus();
//		return false;
//	}

	<?php if($w == ""){ ?>

    if ( $('#reg_mb_2').val() != ""  ){

        var msg = mb_2_chk();
        if (msg == 'not_member') {
            swal_func('해당 추천인 코드의 회원이 없습니다.');
            return false;
        }

    }


    if(f.car_no.value != ""){
        if (f.bf_file.value == ""){
            swal_func("차량등록을 원하실 경우 차량사진을 등록해주세요.");
            return false;
        }
    }

	if($("#reg_req1").prop("checked")==false){
		swal_func("이용약관 동의(필수)를 체크하십시오");
		return false;
	}
	if($("#reg_req2").prop("checked")==false){
		swal_func("개인정보처리방침 동의(필수)를 체크하십시오");
		return false;
	}

	<?php } ?>



    if (required_chk == 'Y' && required_chk2 == 'Y'){
        return true;
    }
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

<script>
$(document).ready(function () {

    <?php if ($w == 'u'){ ?>
        $('[name="go_work"]').val('<?=$member['go_work']?>');
        $('[name="go_time1"]').val('<?=$member['go_time1']?>');
        $('[name="go_time2"]').val('<?=$member['go_time2']?>');
        <?php } ?>

   $(function () {
            
            $('#reg_mb_hp').keydown(function (event) {
             var key = event.charCode || event.keyCode || 0;
             $text = $(this); 
             if (key !== 8 && key !== 9) {
                 if ($text.val().length === 3) {
                     $text.val($text.val() + '-');
                 }
                 if ($text.val().length === 8) {
                     $text.val($text.val() + '-');
                 }
             }

             return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
			 // Key 8번 백스페이스, Key 9번 탭, Key 46번 Delete 부터 0 ~ 9까지, Key 96 ~ 105까지 넘버패트
			 // 한마디로 JQuery 0 ~~~ 9 숫자 백스페이스, 탭, Delete 키 넘버패드외에는 입력못함
         })
   });

});

</script>



