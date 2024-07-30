<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
add_javascript('<script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>', 0);
if(!$is_member){
    alert("회원만 사용가능한 페이지입니다. 로그인 후 다시 이용해주세요");
}
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
?>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">
<script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
<style>
    .required_no{border: 2px  dashed #ee4e47!important}
    #my_service .form .sbtn{
        right:0;
        top:0;
        width:50px;
        height:50px;
        border-radius:0;
    }

    /*테스트하려고*/
    #my_service .select .date.result input {
        -webkit-appearance: auto;
    }
</style>



<!-- 등록된차량 불러오기 모달팝업 -->
<div id="basic_modal">
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times-circle"></i></button>
                    <h4 class="modal-title" id="myModalLabel">내 차량 리스트</h4>
                </div>
                <div class="modal-body">
                    <?php if (!sql_num_rows($car_result) > 0){ ?>
                    <!--등록된 차량이 없을때는 아래 부분이 뜨도록-->
                    <div class="service_none"><span><i class="fas fa-smile"></i></span>등록된 차량이 없습니다.<br />마이페이지에서 차량등록하세요.</div>
                    
                </div>
                <?php }else{ ?>
                <ul class="mcar_list">
                    <?php for($i = 0; $car_row = mysqli_fetch_array($car_result); $i++){ ?>
                        <li id="idx_<?=$car_row['gc_idx']?>" onclick="car_select(this)"><span class="ico"><i class="fas fa-car"></i></span>
                            <span name="modal_car_no"> <?= $car_row['car_no'] ?></span> /
                            <span name="modal_car_type"> <?= $car_row['car_type']?></span> /
                            <span name="modal_car_color"> <?= $car_row['car_color'] ?></span>
                        </li>
                    <?php } ?>
                    <!--                <li class="select"><span class="ico"><i class="fas fa-car"></i></span>12가1234 / 제네시스 G80 / 검정색</li>-->
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="modal_sel()">선택완료</button>
            </div>
            <?php } ?>

        </div>
    </div>
</div>
</div><!--basic_modal-->
<!-- 등록된차량 불러오기 모달팝업 -->



<!-- 쿠폰 불러오기 모달팝업 wc-->
<div id="basic_modal_coupon">
    <!-- Modal -->
    <div class="modal fade" id="myModal_coupon" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times-circle"></i></button>
                    <h4 class="modal-title" id="myModalLabel">내 쿠폰</h4>
                </div>
                <div class="modal-body">
                    <?php if ($coupon_cnt <= 0){ ?>
                    <!--등록된 차량이 없을때는 아래 부분이 뜨도록-->
                    <div class="service_none"><span><i class="fas fa-smile"></i></span>사용 가능한 쿠폰이 없습니다.</div>
                </div>
                <?php }else{ ?>
                <ul class="mcar_list">
                    <?php
                        for($k = 0; $cp = sql_fetch_array($coupon_result); $k++){

                            //사용 가능한 쿠폰인지 체크
                            if (is_used_coupon($member['mb_id'], $cp['cp_id']))
                                continue;

                            $price = $money_list[$cdt . "" . $cs];
                            $dc = 0;

                            if ($cp['cp_maximum'] && $dc > $cp['cp_maximum'])
                                $dc = $cp['cp_maximum'];

                            if($cp['cp_type'])
                                $cp_price = $cp['cp_price'].'%';
                            else
                                $cp_price = number_format($cp['cp_price']).'원';

                        ?>


                        <li id="idx_<?=$cp['cp_id']?>" onclick="coupon_select(this)">
                            <h4 class="color-blue"><span class="ico"><i class="fa-solid fa-ticket"></i></span><span name="modal_cp_price_view"> <?= $cp_price ?></span></h4>
                            <p class="color-blue"><span name="modal_cp_subject"> <?= $cp['cp_subject']?></span> </p>
                            <p class="color-gray"><span name="modal_cp_id"> <?= $cp['cp_id'] ?></span> </p>
                            <span name="modal_cp_price" style="display: none"> <?= $cp['cp_price']?></span>
                            <span name="modal_cp_type" style="display: none"> <?= $cp['cp_type']?></span>
                        </li>
                    <?php } ?>
                    <!--                <li class="select"><span class="ico"><i class="fas fa-car"></i></span>12가1234 / 제네시스 G80 / 검정색</li>-->
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancel" data-dismiss="modal" onclick="coupon_modal_del()">선택취소</button>
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="coupon_modal_sel()">선택완료</button>
            </div>
            <?php } ?>

        </div>
    </div>
</div>
</div><!--basic_modal-->
<!-- 쿠폰 불러오기 모달팝업 -->




<!-- 출장세차 신청하기 폼 -->
<form name="fservice" id="fservice" onsubmit="return fservice_submit(this);" method="post" enctype="multipart/form-data">
<div id="my_service">
	<input type="hidden" name="car_size" value="<?= $cs ?>">


    <? if($cdt != "4") { //단기 세차 일 때 ?>
    <input type="hidden" name="car_date_type" value="<?= $cdt ?>">
    <input type="hidden" name="mode" value="car_wash_form">

    <h1 id="top_cate"><?= $cdt_list[$cdt] ?><span class="size"><?=$cs_list[$cs]?></span>
        <strong class="price" id="Amt_show"><?=number_format($money_list[$cdt."".$cs])?><span>원</span><p class='txt-sm'>* VAT 별도</p></strong>
    </h1>
        <!-- 쿠폰관련 -->
        <?php if ($coupon_cnt > 0) { ?>
            <div class="coupon_wrap">

            <a data-toggle="modal" data-target="#myModal_coupon" class="coupon_btn">쿠폰 적용하기<i class="fa-solid fa-ticket"></i></a>
            <div id="coupone_box" style="display: none">
                <div class="form"><input type="text" name="cp_price_view" value="" id="cp_price_view" placeholder="할인율"
                                         class="frm" readonly></div>
                <div class="form"><input type="text" name="cp_id" value=""
                                         id="cp_id" placeholder="쿠폰번호" class="frm" readonly></div>
                <div class="form"><input type="text" name="cp_subject" value="" id="cp_subject" placeholder="쿠폰이름"
                                         class="frm" readonly></div>
                <div class="form" style="display: none"><input type="text" name="cp_price" value="" id="cp_price" placeholder="할인율"
                                         class="frm" readonly></div>
                <div class="form" style="display: none"><input type="text" name="cp_type" value="" id="cp_type" placeholder="종류" class="frm"
                                         readonly></div>
            </div>

            </div>
        <?php } ?>


        <div id="area_bg"></div>
	<div class="bx">
    	<h2 class="big_title">세차하실 차량정보를 입력해 주세요.</h2>
        <a data-toggle="modal" data-target="#myModal" class="car_btn">등록된 내 차량 불러오기 <i class="fas fa-car"></i></a>
        <div class="form"><input type="text" name="car_no" onkeyup="empty_replace(this.value)" value="" id="car_no" maxlength="8" placeholder="차량번호 입력 (예:12가1234)" class="frm"><span class="color-red">* 필수</span></div>
        <div class="form"><input type="text" name="car_type" value="" id="car_type" placeholder="차량종류 입력 (예:아반떼XD)" class="frm"><span class="color-red">* 필수</span></div>
        <div class="form"><input type="text" name="car_color" value="" id="car_color" placeholder="차량색상 입력 (예:흰색)" class="frm"><span class="color-red">* 필수</span></div>
    </div><!--bx-->

    <div id="area_bg"></div>
	<div class="bx">
        <h2 class="big_title">
            <span class="color-red">* 필수</span>
            <?php if ($cdt < 3){ ?>
                주차할 수 있는 요일/시간을 선택해주세요
            <?php }else{ ?>
                원하시는 세차일을 선택해 주세요.
            <?php } ?>
            <? if($cdt == "3" || $cdt == "5") {  ?>
                <p style="display:block; color:#aaa; font-size:0.6em; font-weight:400; line-height:1.3em;">날짜를 설정하실때 당일 예약은 불가합니다.<br>오후 6시까지 접수 받은 차량은 관리자가 승인후 다음날이후 작업이 가능합니다.<br>작업이 불가할경우 따로 연락드립니다.</p>
                <?php }else{ ?>
                    <? } ?>
            </h2>

        <div class="select">
            <div class="visit reser cf">
            	<!--<div class="date"><a href="javascript:;"><span class="ico"><i class="far fa-calendar-alt"></i></span>세차요청일/시간</a></div>-->
                <div class="date result" id="w_date_view">
                <?php if ($cdt < 3){ ?>
                    <div class="day_label_wrap">
                   <!-- <span class="day">1.</span> -->

                   <input type="checkbox" name="car_w_date[]" id="w_date_0" value="매일" onchange="date_check('매일')">
                   <label for="w_date_0">
                        매일
                    </label>

                    <!-- <span class="day">2.</span> -->
                    <input type="checkbox" name="car_w_date[]" id="w_date_1" value="월" onchange="date_check()">
                    <label for="w_date_1">
                        월
                    </label>
                    <input type="checkbox" name="car_w_date[]" id="w_date_2" value="화" onchange="date_check()">
                    <label for="w_date_2">
                        화
                    </label>
                    <input type="checkbox" name="car_w_date[]" id="w_date_3" value="수" onchange="date_check()">
                    <label for="w_date_3">
                        수
                    </label>
                    <input type="checkbox" name="car_w_date[]" id="w_date_4" value="목" onchange="date_check()">
                    <label for="w_date_4">
                        목
                    </label>
                    <input type="checkbox" name="car_w_date[]" id="w_date_5" value="금" onchange="date_check()">
                    <label for="w_date_5">
                        금
                    </label>
                    <input type="checkbox" name="car_w_date[]" id="w_date_6" value="토" onchange="date_check()">
                    <label for="w_date_6">
                        토
                    </label>
                    <input type="checkbox" name="car_w_date[]" id="w_date_7" value="일" onchange="date_check()">
                    <label for="w_date_7">
                        일
                    </label>
                </div>
                    <!--
                    <select name="car_w_date" id="car_car_w_date">
                        <option value="">요일선택</option>
                        <option value="월"> 월요일</option>
                        <option value="화"> 화요일</option>
                        <option value="수"> 수요일</option>
                        <option value="목"> 목요일</option>
                        <option value="금"> 금요일</option>
                        <option value="토"> 토요일</option>
                        <option value="일"> 일요일</option>
                    </select>&nbsp;&nbsp;
                    -->
                    <?php }else{ ?>
                    <div class="grid_tem">
                        <span><i class="fas fa-calendar-day"></i></span><input readonly name="car_w_date"  id="car_car_w_date" min="<?= date("Y-m-d", strtotime(G5_TIME_YMD." +2 days")); ?>">
                    </div>
                    <?php } ?>

                    <? if($cdt != "3" &&  $cdt != "5") { ?>
                    <div class="grid_tem">
                        <span><i class="fas fa-alarm-clock"></i></span><input type="time"  name="car_w_date2" id="car_w_date2">
                    </div>
                    <?php } ?>

                </div>
<!--                <div class="date result">2020년 11월 12일/18:30</div>-->
            </div>
            <? if($cdt != "3" && $cdt != "5") { //단기 세차 아닐 때 ?>
            <p>* 매니저가 참고하여 대표자가 설정값에의한 날 (5일)에서 (10일)사이 재방문하여 작업을 도와드립니다. </p>
            <p style="margin-top: 5px">* 평상시에 자주 주차할 수 있는 시간을 기록하세요.</p>
            <?php }else{ ?>
            <!-- 23.04.13 단기세차일때 문구 wc -->
            <p>* 매니저가 고객님께 연락드린후 작업을 도와드립니다. </p>
            <?php } ?>
        </div><!--select-->
    </div><!--bx-->


    <div id="area_bg"></div>
	<div class="bx">
    	<h2 class="big_title">
            <span class="color-red">* 필수</span>
            세차받을 장소를 선택해 주세요.
        </h2>
        <p style="margin-top: -10px; margin-bottom: 15px">
            매니저가 참고하여 작업을 도와드립니다.
            <span style="display:block; color:#aaa; font-size:0.8em; line-height:1.3em;">※주의※<br>지상 및 야외주차는 작업이 불가하므로 아파트 지하 주차차량만 작업 진행합니다.<br>지상및 야외주차로 예약을 하시더라도 승인이 불가합니다.</span>
        </p>
        <div class="min_ch">
            <label>
                <input onclick="addr_info_setting();" type="checkbox" class="" id="addr_01" value="">
                <em></em>최근주소입력
            </label>

        </div>
        <div class="my_addr">
			<div class="form">
                <label for="addr">세차받을 주소 불러오기</label>
                <input readonly type="text" name="car_w_addr1" value="" id="car_w_addr1" placeholder="세차받을 주소 불러오기" onclick="sample2_execDaumPostcode()" autocomplete="off" class="frm">
                <button type="button" class="sbtn" onclick="sample2_execDaumPostcode()"><i class="far fa-search"></i></button>
            </div>
			<div class="form">
                <label for="addr2">상세주소 입력</label>
                <input type="text" name="car_w_addr2" value="" id="car_w_addr2" placeholder="상세주소 입력" class="frm">
            </div>
            <!--<div class="form"><input type="text" name="car_place" value="" id="car_place" placeholder="주차된 차량위치 입력(예:지하2층/주차구역번호)" class="frm"></div>-->
            <div class="form">
            <select name="car_place">
                <option value="">퇴근 후 평소에 주차하는 층수를 선택해주세요</option>
                <!-- <option>지상</option> -->
                <option>지하1층</option>
                <option>지하2층</option>
                <option>지하3층</option>
                <option>지하4층</option>
                <option>지하5층</option>
            </select>
            </div>
            <!-- 23.04.13 필수가 아니라서 id에서 car_ 빼줌 xxx_로 변경 wc -->
            <div class="form"><input type="text" name="car_place2" value="" id="xxx_place2" placeholder="주차 기둥번호를 입력하세요. (예:A01)" class="frm"><span class="color-blue">* 선택</span></div><!--form-->
        </div><!--my_addr-->

    </div><!--bx-->


    <div id="area_bg"></div>
    <div class="bx">
        <?php if($cdt != "3") { //단기 세차 아닐 때 ?>
        <h2 class="big_title">자주 주차할 수 있는 구역사진을 등록해주세요. <span class="coms">* 최대 5장까지 등록가능</span></h2>
        <?php }else{ ?>
        <h2 class="big_title">주차된 구역 사진을 등록해 주세요. <span class="coms">* 최대 5장까지 등록가능</span></h2>
        <?php } ?>
        <div class="my_place">
            <div class="form photo_in cf">

                <div id = "prev_area"></div>
                <!--                   -->
                <div name="photo_box_0" class="photo"  onclick="file_add()" >
                    <label for="image"><span class="pbtn"><i class="fas fa-camera-alt"></i></span></label>
                </div>
                <div id="file_input"></div>
                <div class="memo"><textarea cols="30" rows="10" id="" name="car_picture_memo" class="my_req" placeholder="사진에 대한 추가설명이 있다면 입력해 주세요"></textarea></div>
            </div>
        </div><!--my_place-->
    </div><!--bx-->

        <!-- 23.04.17 내부세차 빼줌 wc -->
    <?php  if (0){ ?>
    <?php// if ($cdt < 3){ ?>
        <div id="area_bg"></div>
	<div class="bx">
    	<h2 class="big_title">내부세차를 추가하시겠습니까?</h2>
        <div class="select">
            <div class="btn-group" data-toggle="buttons">
              <label class="btn btn-primary active">
                <input type="radio" name="car_in_yn" value="Y" id="car_in_yn" autocomplete="off" checked>예
              </label>
              <label class="btn btn-primary">
                <input type="radio" name="car_in_yn" value="N" id="car_in_yn2" autocomplete="off">아니오
              </label>
            </div>
        </div>
		<span class="add_com">* 내부세차 추가요금은 <strong>10,000원</strong>입니다. <br />초강력 진공청소기로 깔끔한 이물질 제거와 바닥매트 세정, 가벼운 얼룩 제거, 틈새 먼지 제거 등으로 이루어집니다.</span>
    </div>
    <?php } ?>

    <div id="area_bg"></div>
	<div class="bx">
    	<h2 class="big_title">고객요청사항</h2>
        <div class="form"><textarea cols="30" rows="10" id="" name="car_memo" class="my_req" placeholder="세차시 요청사항을 입력해 주세요"></textarea></div><!--form-->
    </div><!--bx-->

    <? }else{ // 기업 세차 일 때 ?>
        <input type="hidden" name="mode" value="company_car_wash_form">
        <h1 id="top_cate"><? /* = $cdt_list[$cdt] */ ?>기업 세차</strong><span class="size"><?=$cs_list[$cs]?></span><p class='txt-sm'>* VAT 별도</p></h1>
        <div id="area_bg"></div>
        <div class="bx">
            <div class="big_title"><span class="color-red">* 필수</span>아래 정보를 입력해주세요</div>
            <div class="my_info">
                <div class="form">
                    <label for="car_cc_company">회사명</label>
                    <input type="text" name="cc_company" value="" id="car_cc_company" placeholder="회사명 입력" class="frm">
                </div>
                <div class="form">
                    <label for="car_cc_homepage">홈페이지</label>
                    <input type="text" name="cc_homepage" value="" id="car_cc_homepage" placeholder="홈페이지 입력" class="frm">
                </div>
                <div class="form">
                    <label for="car_cc_manager">담당자명</label>
                    <input type="text" name="cc_manager" value="" id="car_cc_manager" placeholder="담당자명 입력" class="frm">
                </div>
                <div class="form">
                    <label for="car_cc_email">이메일</label>
                    <input type="text" name="cc_email" value="" id="car_cc_email" placeholder="이메일 입력" class="frm">
                </div>
                <div class="form">
                    <label for="cc_tel">휴대폰 번호</label>
                    <input type="tel" name="cc_hp" value="" id="car_mb_hp" placeholder="휴대폰 번호입력(-없이 숫자만 입력해 주세요)" class="frm" maxlength="13">
                </div>
                <div class="form">
                    <label for="car_cc_fax">팩스번호</label>
                    <input type="text" name="cc_fax" value="" id="car_cc_fax" placeholder="팩스번호 입력" class="frm">
                </div>
                <div class="cc_addr">
                    <div class="form">
                        <label for="addr">주소 불러오기</label>
                        <input type="text" name="cc_w_addr1" value="" id="car_w_addr1" placeholder="주소 불러오기" onclick="sample2_execDaumPostcode()" autocomplete="off" class="frm">
                        <button type="button" class="sbtn" onclick="sample2_execDaumPostcode()"><i class="far fa-search"></i></button>
                    </div>
                    <div class="form">
                        <label for="addr2">상세주소 입력</label>
                        <input type="text" name="cc_w_addr2" value="" id="w_addr2" placeholder="상세주소 입력" class="frm">
                    </div>
                </div><!--cc_addr-->
                <div class="form">
                    <label for="car_cc_number">최소 신청 가능 대수</label>
                    <input type="number" name="cc_number" value="" id="car_cc_number" placeholder="최소 신청 가능 대수 입력" class="frm">
                </div>
                <div class="form">
                    <select name="cc_place">
                        <option>주차장 형태를 선택하세요.</option>
                        <?php for($i = 1; $i <= count($place_list); $i++){  ?>
                            <option value="<?=$i?>"><?=$place_list[$i]?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form"><textarea cols="30" rows="10" id="" name="cc_memo" class="my_req" placeholder="기타 요청사항을 입력해 주세요(선택)" maxlength="200"></textarea></div><!--form-->
            </div><!--my_info-->
        </div><!--bx-->


        <div id="area_bg" ></div>

        <div class="bx" >
            <h2 class="big_title"><span class="color-red">* 필수</span>실내세차를 추가하시겠습니까?</h2>
            <div class="select">
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-primary">
                        <input type="radio" name="cc_in_yn" value="1" id="car_in_yn" autocomplete="off" >일반
                    </label>
                    <label class="btn btn-primary">
                        <input type="radio" name="cc_in_yn" value="2" id="car_in_yn2" autocomplete="off">프리미엄
                    </label>
                </div>
            </div><
            <span class="add_com">* 내부세차 추가요금은 <strong>10,000원</strong>입니다. <br />초강력 진공청소기로 깔끔한 이물질 제거와 바닥매트 세정, 가벼운 얼룩 제거, 틈새 먼지 제거 등으로 이루어집니다.</span>
        </div>

        <div id="mb_service" style="padding:10px;">
            <div class="clean car" style="margin:0">
                <div class="bx cf" style="box-shadow:0; border-radius:0">
                    <div class="tx" style="margin:0"><i class="fas fa-car-wash"></i> 실내 세차시 작업 참고사항</div>
                </div>
            </div>
        </div>

    <? } ?>


    <!--공통사항-->
    <div id="area_bg"></div>
	<div class="bx">
    	<h2 class="big_title">연락처를 입력해 주세요
        <? if($cdt == "3" || $cdt == "5") {  ?>
            <p style="display:block; color:#aaa; font-size:0.6em; font-weight:400; line-height:1.3em;">매니저가 고객님께 연락드린후 작업을 도와드립니다.</p>
        <?php }else{ ?>
        <? } ?>
    </h2>

        <div class="my_info">
            <div class="min_ch">
                <label>
                    <input onclick="mem_info_setting();" type="checkbox" class="" id="ch_01" value="">
                    <em></em>회원정보와 동일
                </label>
            </div>
            <div class="form">
                <label for="my_name">성함</label>
                <input type="text" name="mb_name" value="" id="car_mb_name" placeholder="성함" class="frm">
                <span class="color-red">* 필수</span>
            </div>
			<div class="form">
                <label for="my_tel">휴대폰 번호입력</label>
                <input type="tel" name="mb_hp" value="" id="mb_hp" placeholder="휴대폰 번호입력(-없이 숫자만 입력해 주세요)" class="frm">
            </div>
        </div><!--my_info-->
    </div><!--bx-->

    <?php if ($cdt == 2) { ?>
        <div class="normal_btn"><input type="submit" class="btn" value="예약신청하기"></div>
    <?php }else{ ?>
        <div class="normal_btn"><input type="submit" id="pay_submit" class="btn" value="결제하기"></div>
    <?php } ?>
    <!--<div class="normal_btn"><input type="submit" value="예약신청하기" id="" class="btn"></div>-->


</div><!--my_service-->
</form>
<!--주소팝업-->
<div id="layer" style="display:none;position:fixed;overflow:hidden;z-index:3;-webkit-overflow-scrolling:touch;">
    <i class="fas fa-times-square" id="btnCloseLayer" style="width:40px; height:40px; color:#000; cursor:pointer;position:absolute;right:-5px;bottom:-5px;z-index:1" onclick="closeDaumPostcode()" alt="닫기 버튼"></i>
</div>



<script type="text/javascript" src="https://pg.innopay.co.kr/pay/js/Innopay.js"></script><!-- InnoPay 결제연동 스크립트(필수) -->
<form id="payfrm" name="payfrm" method="post">
    <!-- 이노페이 필수 카드결제 -->
    <input type="hidden" id="pm1" name="PayMethod" value="CARD" checked>

    <input type="hidden" name="Amt" id="Amt" value="<?=$money_list[$cdt."".$cs]?>">
    <!--    <input type="hidden" name="GoodsCnt" value="--><?//=$result_cnt?><!--">-->
    <input type="hidden" name="GoodsName" value="<?=$cdt_list[$cdt]?>">
    <!--<input type="hidden" name="Amt" value="--><?//=$total?><!--">-->
    <input type="hidden" name="Moid" id="Moid" value="">
    <input type="hidden" name="MID" id="MID" value="pgcnftp01m"> <!-- 테스트 : testpay01m -->
    <input type="hidden" name="MerchantKey" value="TtgLOwfT98KYi744xi9uhW5FAgOYls5qpVLvfnR1QQ21c1k/ZCo/t55IiEAIaydohwWEmcrSw0PTkvqrtKZUuQ=="> <!-- 테스트 : Ma29gyAFhvv/+e4/AHpV6pISQIvSKziLIbrNoXPbRS5nfTx2DOs8OJve+NzwyoaQ8p9Uy1AN4S1I0Um5v7oNUg== -->
    <input type="hidden" name="ReturnURL" value="<?=G5_BBS_URL?>/pay_result.php">
    <input type="hidden" name="RetryURL" value="<?=G5_BBS_URL?>/pay_result.php">
    <input type="hidden" name="ResultYN" value="N">

    <input type="hidden" name="mallUserID" value="<?=$member['mb_id']?>">
    <input type="hidden" name="BuyerName" value="<?=urldecode($member['mb_name'])?>">
    <input type="hidden" name="BuyerTel" value="<?=str_replace ('-','',$member['mb_hp'])?>">
    <input type="hidden" name="BuyerEmail" value="<?=$member['mb_email']?>">
    <input type="hidden" name="EncodingType" id="EncodingType" value="utf-8">
    <input type="hidden" name="FORWARD" id="FORWARD" value="Y"><!-- 팝업유무 Y,N -->

    <input type="hidden" name="ediDate" value=""><!-- 결제요청일시 제공된 js 내 setEdiDate 함수를 사용하거나 가맹점에서 설정 yyyyMMddHHmmss-->
    <input type="hidden" name="EncryptData" value=""><!-- 암호화데이터 -->
    <input type="hidden" name="MallIP" value="127.0.0.1"/>
    <input type="hidden" name="UserIP" value="127.0.0.1">
    <input type="hidden" name="MallResultFWD" value="N"><!-- Y 인 경우 PG결제결과창을 보이지 않음 -->
    <input type="hidden" name="device" value=""><!-- 자동셋팅 -->
</form>


<!-- 출장세차 신청하기 폼 -->
<script>
    $(document).ready(function () {

		//var picker = new Pikaday({ field: document.getElementById('car_car_w_date') });
		var minDateValue = "<?= date("Y-m-d", strtotime(G5_TIME_YMD." +2 days")); ?>";
		var picker = new Pikaday({
			field: document.getElementById('car_car_w_date'),
			minDate: new Date(minDateValue),
			toString(date) {
				// 직접 날짜 형식 지정
				return date.getFullYear() + '. ' + (date.getMonth() + 1) + '. ' + date.getDate();
			},
			parse(dateString) {
				// 직접 날짜 문자열 파싱
				var parts = dateString.split('. ');
				return new Date(parts[0], parts[1] - 1, parts[2]);
			}
		});

        $(function () {

            $('[name=cc_hp]').keydown(function (event) {
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
                document.getElementById("car_w_addr1").value = addr +' '+extraAddr;
                // 커서를 상세주소 필드로 이동한다.
                document.getElementById("w_addr2").focus();

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


    //차량 클릭 시 클래스 추가
    function car_select(f){
        var id = f.id;
        var now_class = $("#"+id).attr("class");
        if (now_class != 'select') {
            $('#' + id).addClass('select');
            $('#' + id).siblings().removeClass('select');
        }else{
            $('#' + id).removeClass('select');
        }
    }
    //모달 선택완료
    function modal_sel() {
        var select = $('#basic_modal .select');

        if (select.length != 0) {
            empty_replace(select.find('[name = modal_car_no]').text())

            $('[name = car_type]').val(select.find('[name = modal_car_type]').text());
            $('[name = car_color]').val(select.find('[name = modal_car_color]').text());

        }
    }


    //쿠폰 클릭 시 클래스 추가
    function coupon_select(f){
        var id = f.id;
        var now_class = $("#"+id).attr("class");
        if (now_class != 'select') {
            $('#' + id).addClass('select');
            $('#' + id).siblings().removeClass('select');
        }else{
            $('#' + id).removeClass('select');
        }
    }

    var Amt_real = <?=$money_list[$cdt."".$cs]?>
    //쿠폰 선택완료
    function coupon_modal_sel() {
        var select = $('#basic_modal_coupon .select');
        $('#coupone_box').show();
        if (select.length != 0) {

            $('[name = cp_id]').val(select.find('[name = modal_cp_id]').text());
            $('[name = cp_subject]').val(select.find('[name = modal_cp_subject]').text());
            $('[name = cp_price]').val(select.find('[name = modal_cp_price]').text());
            $('[name = cp_type]').val(select.find('[name = modal_cp_type]').text());
            $('[name = cp_price_view]').val(select.find('[name = modal_cp_price_view]').text());

            var price = Amt_real;
            var cp_type = $('[name = cp_type]').val();
            var cp_price = $('[name = cp_price]').val();

            var dc = 0;

            if(cp_type == 1) {
                var dc = Math.floor(price * ( cp_price / 100 ));
            } else {
                var dc =  cp_price;
            }


            $('#Amt_show').html((price - dc).toLocaleString()+'<span>원</span>');
            $('#Amt').val((price - dc)*1);

        }
    }

    //쿠폰사용 취소
    function coupon_modal_del() {
        var select = $('#basic_modal_coupon .select');
        select.removeClass('select');

        //$('#coupone_box').hide();
            $('[name = cp_id]').val('');
            $('[name = cp_subject]').val('');
            $('[name = cp_price]').val('');
            $('[name = cp_type]').val('');
            $('[name = cp_price_view]').val('');

            $('#Amt_show').html((Amt_real).toLocaleString()+'<span>원</span>');
            $('#Amt').val(Amt_real*1);
    }

    //회원정보와 동일 체크 시 셋팅
    function mem_info_setting(){

        if($('#ch_01').is(":checked") == true) {
            $('#car_mb_name').val('<?php echo $member['mb_name']?>');
            $('#mb_hp').val('<?php echo str_replace('-','',$member['mb_hp']);?>');
        }else{
            $('#car_mb_name').val('');
            $('#mb_hp').val('');
        }

    }

    //최근주소 가져오기
    function addr_info_setting(){

        if($('#addr_01').is(":checked") == true) {
            $('#car_w_addr1').val('<?php echo $car_wash['car_w_addr1']?>');
            $('#car_w_addr2').val('<?php echo $car_wash['car_w_addr2'] ?>');
        }else{
            $('#car_w_addr1').val('');
            $('#car_w_addr2').val('');
        }

    }

    var box_idx = 0; //고유 idx,해당 idx로 photo div를 읽어와 미리보기 사진을 없앰
    //이미지 미리보기
    function getImgPrev(input) {
        var reg_ext = /(.*?)\.(jpg|jpeg|png)$/;
        var leng = $(".btn_del").size();
        var files = input.files;
        var files_arr = Array.prototype.slice.call(files);
        if (leng+input.files.length > 5  ){
            alert('최대 5개까지 등록 가능 합니다.');
            return false
        }

        for (var i = 0; i<input.files.length; i++) {
            // img_idx++;

            var file_name = input.files[i].name.toLowerCase();
            if (!reg_ext.test(file_name)) {
                alert("이미지만 등록이 가능합니다. (jpg, jpeg, png)");
                return false;
            }
            filesTempArr.push(files_arr[i]);
            $('[name="placehold_img"]').css('display', 'none');
            //i가 이상하게 돌아서 a 설정함

            if (input.files && input.files[i]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    box_idx++;

                    var html = "<div class='photo' id ='p_box_"+box_idx+"'>";
                    html1 = "<button type='button' class='btn_del' id ='btn_del_"+(box_idx)+"' onclick=\"btn_image_del(this)\"><i class='fas fa-times'></i></button>";
                    html1 += "<img style='width:60px;height:60px' src='"+ e.target.result +"'></div>";
                    //확인 div는 이미지 크기 달라서 지정
                    html2 = "<img style='width:80px;height:80px' src='"+ e.target.result +"'></div>";

                    $('#prev_area').append(html+html1);
                    $('#prev_area_ok').append(html+html2);


                }

                reader.readAsDataURL(input.files[i]);
            }

        }
        // console.log(filesTempArr)

    }

    var file_idx = 0;
    function file_add() {
        var leng = $(".btn_del").size();

        upload = $('<input type="file" name="image[]" class="frm_file" id="image' + file_idx + '" multiple onchange="getImgPrev(this)" accept="image/*" >');

        if (leng < 5) {
            $("#file_input").after(upload);
            upload.trigger('click');
            // file_idx++;

        } else {
            alert("최대 5장까지 등록 가능합니다.");
            return false;
        }
    }


    var filesTempArr = [];
    function btn_image_del(f) {

        var btn_del = document.getElementById(f.id),
            div_del = btn_del.parentNode,
            file_idx = btn_del.id.split('_');

        $('#'+div_del.id).html('');
        $('#'+div_del.id).css('display','none');

        //서비스확인 div에도 이미지 넣어줌
        $("#prev_area_ok").find("#"+div_del.id).css('display','none');
        $("#prev_area_ok").find("#"+div_del.id).html('');
        //splice하면 index꼬여서 delete처리함.
        delete filesTempArr[(file_idx[2]-1)];
        console.log(filesTempArr);
        // filesTempArr.splice((file_idx[2]-1),1);
    }

    var is_post = false;
    function fservice_submit(f) {

        var is_dup = false;
        if (f.car_no.value != "") {
            is_dup = is_car_no_dup(f.car_no.value,'mb_id');
        }

        if (is_dup) {
            swal('중복된 차량번호가 존재합니다. 차량번호를 다시 확인해주세요.');
            return false;

        }

        // 23.04.13 매일, 요일하나씩 체크하는거 하나라도 체크할수있게 wc
        <?php if($cdt < 3){ ?>
        if($("input:checkbox[name='car_w_date[]']:checked").length <= 0){
            swal({
                title: "경고창",
                text: "필수값을 입력해주세요.",
                icon: "error",
                button: "확인",
            });
            $('#w_date_view').focus();
            $('#w_date_view').addClass("required_no");
            return false;
        }
        <?php } ?>



        var required_data = $("[id^='car_']"),
            required_chk = "Y";

        for (var i = 0; i < required_data.length; i++) {
            if (required_data[i].value == "") {
                swal({
                    title: "경고창",
                    text: "필수값을 입력해주세요.",
                    icon: "error",
                    button: "확인",
                });

                $('#'+required_data[i].id).focus();
                $('#'+required_data[i].id).addClass("required_no");
                required_chk = 'N';
                return false;
            }
            $('#'+required_data[i].id).removeClass("required_no");
        }
        //기업세차 아닐 경우
        <?if ($_REQUEST['cdt'] != 4){ ?>
            var reg = /^[가-힣\s]+$/
            if (!reg.test($('#car_color').val())){
                swal('차량 색상을 한글로 입력해주세요.');
                return false;
            }

            var reg2 =/^[0-9]{2,3}[가-힣\s]{1}[0-9]{4}$/
            if (!reg2.test($('#car_no').val())){
                swal('차량번호는 ex)12가3456 형식으로 입력해주세요.');
                return false;
            }
        <?php } ?>


        if(is_post) {
            swal("예약하기 진행 중입니다. 잠시만 기다려 주세요.");
            return false;
        }
        is_post = true;

        if (required_chk == 'Y'){
            form_ajax();
            return false;
        }


    }

    function empty_replace(val) {
        $('#car_no').val(val.replace(/ /g,""));
    }

    function form_ajax() {
        var form = $('form')[0];
        var formData = new FormData(form);

        //파일 배열로 담기
        for (var i = 0; i < filesTempArr.length; i++) {
            formData.append("bf_file[]", filesTempArr[i]);
        }


        $.ajax({
            url : g5_bbs_url + "/ajax.controller.php",
            processData: false,
            contentType: false,
            data: formData,
            type: 'POST',
            // datatype : 'json',
            success : function(data) {
                if (data != 0) {
                <?php if ($cdt == 2) { ?>
                    window.location.href = g5_bbs_url + '/my_service_ok.php?cdt=' + <?=$_REQUEST['cdt']?> +'&idx=' + data;
                <?php }else{ ?>
                        //정기세차 아니면 결제하기
                        payment(data);
                    <?php } ?>
                }else{
                    swal("이미 정기세차를 신청했습니다. 관리자에게 문의해주세요.").then((value) => {
                      window.location.href = g5_url;
                    })
                }

            },
            err : function(err) {
                alert(err.status);
            }
        });
    }

    //이노페이 금액 보내기
        function payment(idx) {

            $('#Moid').val("<?=$Moid?>-"+idx);


            if ($("input[name='car_in_yn']:checked").val() == "Y"){
                $('#Amt').val($('#Amt').val()*1 + 10000);
            }

            //23.08.25 부가세
            $('#Amt').val(parseInt($('#Amt').val()*1.1));

            //wc
            <?php if ($member["mb_id"] == "gogac" || $member["mb_id"] == "gogac2" || $member["mb_id"] == "gogac20"){ ?>
            //$('#Amt').val(10);
            //$('#MID').val('testpay01m');
            <?php } ?>

            // pc화면이면 팝업
            if (!mobilecheck()) {
                $('#FORWARD').val('Y');
            } else {
                $('#FORWARD').val('N');
            }

            goPay(document.payfrm);
        }

    function date_check(status){
        if(status=='매일'){
            //매일이 체크됬는지 확인해서 안됬을때 누른거면 매일빼고 다른요일 해제해줌
            if($('#w_date_0').is(':checked')){
                //다른거 다 해제 매일 체크
                $("input:checkbox[name='car_w_date[]']").prop("checked", false);
                $("input:checkbox[id='w_date_0']").prop("checked", true);
            }else{
                //매일 체크해주고 다른거 다 해제
                $("input:checkbox[id='w_date_0']").prop("checked", true);
                $("input:checkbox[name='car_w_date[]']").prop("checked", false);
            }
        }else{
            //다른요일 눌렀을때 매일 체크되어있으면 그거해제해줌
            if($('#w_date_0').is(':checked')){
                $("input:checkbox[id='w_date_0']").prop("checked", false);
            }
            //요일 하나씩 다체크하면 매일을 체크되게
            if($("input:checkbox[name='car_w_date[]']:checked").length >= 7){
                $("input:checkbox[name='car_w_date[]']").prop("checked", false);
                $("input:checkbox[id='w_date_0']").prop("checked", true);
            }
        }
    }
</script>