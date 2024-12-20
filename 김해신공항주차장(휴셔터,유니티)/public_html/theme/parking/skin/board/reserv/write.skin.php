<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/default.js"></script>', 100);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/ui.js"></script>', 100);
if($w=="u"){
	$wr_1=explode(" ",$write[wr_1]);
	$wr_1_time=explode(":",$wr_1[1]);
	$wr_1_hour=$wr_1_time[0].":";
	$wr_1_min=$wr_1_time[1];

	$wr_2=explode(" ",$write[wr_2]);
	$wr_2_time=explode(":",$wr_2[1]);
	$wr_2_hour=$wr_2_time[0].":";
	$wr_2_min=$wr_2_time[1];
}else{
	$wr_1_hour=$wr_1[1];
	$wr_1_min=$wr_1[2];
	$wr_2_hour=$wr_2[1];
	$wr_2_min=$wr_2[2];
	//$wr_1=explode(" ",$wr_1[0]);
	
}
$sql="select price from g5_price";
$price=sql_fetch($sql);

?>
<link rel="stylesheet" href="<?=G5_CSS_URL?>/datepicker.css" />
<script>
    var isParkcheck = false; 
	<?
    if ($wr_subject) {
        ?>
        parkCheck('<?=$wr_subject?>'); <?
    }?>
    $(function() {

        $("#btn-cal").click(function() {
            var startDate = $("input[name='wr_1[0]']").val();
            var startTime = $("#wr_1_1").val() + $("#wr_1_2").val();
            var endDate = $("input[name='wr_2[0]']").val();
            var endTime = $("#wr_2_1").val() + $("#wr_2_2").val();
            $.ajax({
                url: "./ajax.date.cal.php",
                data: {
                    "startdate": startDate,
                    "enddate": endDate,
                    "startTime": startTime,
                    "endTime": endTime
                },
                dataType: "json",
                type: "POST",
                success: function(data) {
                    var json = JSON.parse(JSON.stringify(data));
                    console.log(json);
                    var day = json.day;
                    var price = json.price;
                    $("#start_date").html(startDate + ' ' + startTime);
                    $("#end_date").html(endDate + ' ' + endTime);
                    $("#price").html(price);
                    $("#day").html(day);
                    $("#wr_8").val(json.wr_8);
                    $("#myModal").modal('show');

                }
            });
        });
        //주차장 선택할 때...
        $(".parkname input[type=radio]").click(function() {
            var parkname = $(this).val();
            parkCheck(parkname);
        });
        //자동하이픈 넣기
        $(document).on("keyup", "#wr_3", function() {
            $(this).val($(this).val().replace(/[^0-9]/g, "").replace(/(^02|^0505|^1[0-9]{3}|^0[0-9]{2})([0-9]+)?([0-9]{4})/, "$1-$2-$3").replace("--", "-"));
        });


    });

    function parkCheck(val) {
        $.ajax({
            url: "<?=G5_BBS_URL?>/ajax.full.check.php",
            type: 'POST',
            data: {
                "parkname": val
            },
            dataType: "html",
            success: function(data) {

                if (data == "1") {
                    $("#parkcheck").html(val + " 주차가 가능합니다.");
                    isParkcheck = true;
                    $(".mailform input").attr("disabled", false);
                    $(".mailform textarea").attr("disabled", false);
					$("#start").val(val);
                } else {
                    $("#parkcheck").html(val + " 주차가 <font style='color:red;font-weight'>불가능</font>합니다.");
                    $("#modal-parkcheck").html(val + " 주차가 <font style='color:red;font-weight'>불가능</font>합니다.");
                    $("#full_setting").modal("show");
                    isParkcheck = false;
                    $(".mailform input").attr("disabled", true);
                    $(".mailform textarea").attr("disabled", true);
					$("#start").val("");
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert(textStatus); /* Handle error */
            },
        });
    }
    //주차기간 시간을 선택할 시에 마지막 이용시간 select box 변경이 되게
    function timeChange() {
        if ($("#wr_1").val() == $("#wr_2").val()) {
            var strHtml = "";
            for (var i = parseInt($("#wr_1_1").val().substring(0, 2)) + 1; i <= 23; i++) {
                var hour = i < 10 ? "0" + i : i;
                strHtml += '<option value="' + hour + ':">' + hour + '시</option>';
            }
            $("#wr_2_1").html(strHtml);
        }
    }

</script>

<!-- 가격 모달창 시작 -->
<div class="modal fade" id="myModal" role="dialog">
    <!-- 사용자 지정 부분① : id명 -->
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">예상금액 계산하기</h4> <!-- 사용자 지정 부분② : 타이틀 -->
            </div>

            <div class="modal-body">
                <dl>
                    <dt>총예상 결제금액</dt>
                    <dd>
                        <!--<ul>
                            <li>전차종 1일 5,000원 입니다 - 평일,주말,공휴일 상관없이 일괄 적용됩니다 </li>
                            <li>시간당 요금은 1시간 2,000원 입니다 30분 이상은 1시간 요금이 적용됩니다 </li>
                            <li>차량을 맡기는 시점부터 계산되어 집니다 </li>
                        </ul>-->
                    </dd>
                    <dd>
                        <div class="tbl">
                            <table summary="주차비결제금액">
                                <colgroup>
                                    <col style="width:30%" />
                                    <col style="width:*" />
                                </colgroup>
                                <tbody>
                                    <tr>
                                        <th>주차비결제금액</th>
                                        <td id="price"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </dd>
                </dl>

                <dl>
                    <dt>날짜범위</dt>
                    <dd>
                        <div class="tbl">
                            <table summary="날짜범위">
                                <colgroup>
                                    <col style="width:30%" />
                                    <col style="width:*" />
                                </colgroup>
                                <tbody>
                                    <tr>
                                        <th>접수예정시간</th>
                                        <td id="start_date"></td>
                                    </tr>
                                    <tr>
                                        <th>도착시간</th>
                                        <td id="end_date"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </dd>
                </dl>

                <dl>
                    <dt>일수</dt>
                    <dd>
                        <div class="tbl">
                            <table summary="일수">
                                <colgroup>
                                    <col style="width:30%" />
                                    <col style="width:*" />
                                </colgroup>
                                <tbody>
                                    <tr>
                                        <th>일수(시간)</th>
                                        <td id="day"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </dd>
                </dl>

                <dl>
                    <dt>명절,성수기</dt>
                    <dd>
                        <ul>
                            <li>명절,성수기는 요금이 변동될수 있습니다.</li>
                            <li>명절,성수기는 요금은 따로 문의를 해주시기 바랍니다.</li>
                        </ul>
                    </dd>
                </dl>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">창닫기</button>
            </div>
        </div>
    </div>
</div>
<!-- //가격 모달창 -->

<!-- 주차장 만차 설정 시 모달 -->
<div class="modal fade" id="full_setting" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">주차 가능 여부 안내</h4> <!-- 사용자 지정 부분② : 타이틀 -->
            </div>

            <div class="modal-body" id="modal-parkcheck">
                <p>명성주차장은 만차로 예약이 불가합니다.</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">창닫기</button>
            </div>
        </div>
    </div>
</div>
<!-- //주차장 만차 설정 시 모달 -->

<section id="bo_w">
    <!--<h2 id="container_title"><?php echo $g5['title'] ?></h2> -->

    <!-- 게시물 작성/수정 시작 { -->
    <form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onSubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:<?php echo $width; ?>">
        <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
        <input type="hidden" name="w" value="<?php echo $w ?>">
        <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
        <input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
        <input type="hidden" name="sca" value="<?php echo $sca ?>">
        <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
        <input type="hidden" name="stx" value="<?php echo $stx ?>">
        <input type="hidden" name="spt" value="<?php echo $spt ?>">
        <input type="hidden" name="sst" value="<?php echo $sst ?>">
        <input type="hidden" name="sod" value="<?php echo $sod ?>">
        <input type="hidden" name="wr_subject" value="주차장 예약이 접수되었습니다.">
        <input type="hidden" name="page" value="<?php echo $page ?>">
        <!--신규 예약폼-->
        <input type="hidden" name="wr_8" id="wr_8" value="<?=$write[wr_8]?>">
        <?php
    $option = '';
    $option_hidden = '';
    if ($is_notice || $is_html || $is_secret || $is_mail) {
        $option = '';
        if ($is_notice) {
            $option .= "\n".'<input type="checkbox" id="notice" name="notice" value="1" '.$notice_checked.'>'."\n".'<label for="notice">공지</label>';
        }

        if ($is_html) {
            if ($is_dhtml_editor) {
                $option_hidden .= '<input type="hidden" value="html1" name="html">';
            } else {
                $option .= "\n".'<input type="checkbox" id="html" name="html" onclick="html_auto_br(this);" value="'.$html_value.'" '.$html_checked.'>'."\n".'<label for="html">html</label>';
            }
        }

        if ($is_secret) {
            if ($is_admin || $is_secret==1) {
                $option .= "\n".'<input type="checkbox" id="secret" name="secret" value="secret" '.$secret_checked.'>'."\n".'<label for="secret">비밀글</label>';
            } else {
                $option_hidden .= '<input type="hidden" name="secret" value="secret">';
            }
        }

        if ($is_mail) {
            $option .= "\n".'<input type="checkbox" id="mail" name="mail" value="mail" '.$recv_email_checked.'>'."\n".'<label for="mail">답변메일받기</label>';
        }
    }

    echo $option_hidden;
    ?>





        <!--<h2 class="tit1 wow fadeInUp" data-wow-delay="0.1s">차량 렌탈 계약 유상 운송</h2>
        <p class="tit2 wow fadeInUp" data-wow-delay="0.1s">운전자는 (주)휴셔터의 소속 운전자를 알선 하고 있습니다.<br>차량은 유니티 렌트카의 PICK UP 차량으로 운행중입니다.</p>-->
        <h3 class="contT_line wow fadeInUp" data-wow-delay="0.1s">주차기간</h3>

        <!--예약필드-->
        <div class="reserv_wrap wow fadeInUp" data-wow-delay='0.5s'>
            <ul>
                <li><input name="wr_1[0]" id="wr_1" type="text" placeholder="이용예정일시" required readonly value="<?=$wr_1[0]?>">
                    <!--<a class="btn_pin" href="#none" title="이용예정일시 캘린더 열림">날짜 선택</a>-->
                </li>
                <li>
                    <select name="wr_1[1]" class="select" id="wr_1_1" style="">
                        <? for($i=6;$i<21;$i++){
										$hour=$i<10?"0".$i:$i;
										if($i!=0&&$i<6){
										}else{
									?>
                        <option value="<?=$hour?>:" <?php echo $hour==$wr_1[1]?" selected":"";?>><?=$hour?>시</option>
                        <? }}?>
                    </select>
                </li>
                <li>
                    <select name="wr_1[2]" class="select" id="wr_1_2" style="">
                        <? for($i=0;$i<60;$i++){
											$min=$i<10?"0".$i:$i;
									 ?>
                        <option value="<?=$min?>" <?php echo $min==$wr_1[2]?" selected":"";?>><?=$min?>분</option>
                        <? }?>
                    </select>
                </li>
                <li><input name="wr_2[0]" id="wr_2" type="text" placeholder="도착예정일시" required readonly value="<?=$wr_2[0]?>">
                    <!--<a class="btn_pin" href="#none" title="도착예정일시 캘린더 열림">날짜 선택</a>-->
                </li>
                <li>
                    <select name="wr_2[1]" class="select" id="wr_2_1" style="">
                        <? for($i=6;$i<21;$i++){
										$hour=$i<10?"0".$i:$i;
									?>
                        <option value="<?=$hour?>:" <?php echo $hour==$wr_2[1]?" selected":"";?>><?=$hour?>시</option>
                        <? }?>
                    </select>
                </li>
                <li>
                    <select name="wr_2[2]" class="select" id="wr_2_2" style="">
                        <? for($i=0;$i<60;$i++){
											$min=$i<10?"0".$i:$i;
									 ?>
                        <option value="<?=$min?>" <?php echo $min==$wr_2[2]?" selected":"";?>><?=$min?>분</option>
                        <? }?>
                    </select>
                </li>
                <!--<li><input type="button" id="btn-cal" value="계산하기" class="btn_reserv"></li>-->
            </ul>
        </div>
        <!--//예약필드-->
        <div class="cl"></div>

        <!--<h3 class="contT_line wow fadeInUp t_padding20" data-wow-delay="0.1s">주차장 선택<span id="parkcheck">주차장을 선택하십시오.</span></h3>
        <div class="radio_group parkname">
            <span><input type="radio" name="" id="01" value="명성주차장" required="" <?php echo $wr_subject=="명성주차장"?" checked":"";?>>
                <label for="01">명성주차장</label></span>
            <span><input type="radio" name="" id="02" value="유니티주차장" required="" <?php echo $wr_subject=="유니티주차장"?" checked":"";?>>
                <label for="02">유니티주차장</label></span>
            <br class="hidden-lg hidden-md hidden-sm" />
            <span><input type="radio" name="" id="03" value="유카주차장" required="" <?php echo $wr_subject=="유카주차장"?" checked":"";?>>
                <label for="03">유카주차장</label></span>
            <span><input type="radio" name="" id="04" value="신공항주차장" required="" <?php echo $wr_subject=="신공항주차장"?" checked":"";?>>
                <label for="04">신공항주차장</label></span>
        </div>-->

        <h3 class="contT_line t_margin50 wow fadeInUp" data-wow-delay="0.1s">예약정보<!--<span><i class="fas fa-exclamation-triangle"></i>익일 오전 06:00(입차)부터 22:00(출차)까지만 예약이 가능합니다. 양해 부탁드립니다.</span>--></h3>
        <div class="mailform">
            <table>
                <caption>예약정보</caption>
                <colgroup>
                    <col style="width:18%">
                    <col style="width:82%">
                </colgroup>
                <tbody>
                    <tr>
                        <th scope="row"><label for="name">이름</label></th>
                        <td>
                            <input type="text" name="wr_name" id="wr_name" class="input" style="width:100%;" value="<?=$write[wr_name]?>" required="">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="tel">연락처(핸드폰번호)</label></th>
                        <td>
                            <input type="tel" name="wr_3" id="wr_3" class="input" style="width:100%;" value="<?=$write[wr_3]?>" required placeholder="정확한 핸드폰번호를 입력해주세요. 예약확인 및 주차기사님과 연락시 필요합니다.">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label>구분</label></th>
                        <td>
                            <input type="radio" name="wr_4" id="wr_41" value="국내선" onclick="document.getElementById('end').value=this.value" required="" <?php echo !$write[wr_4]?"checked":"";?>> <label for="wr_41">국내선</label> <span class="bar"></span>
                            <input type="radio" name="wr_4" id="wr_42" value="국제선" onclick="document.getElementById('end').value=this.value" required="" <?php echo $write[wr_4]=="국제선"?"checked":"";?>> <label for="wr_42">국제선</label>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label>탑승인원</label></th>
                        <td>
                            <input type="text" class="input" style="width:100%;" placeholder="ex)2명" id="wr_23" name="wr_23" value="<?php echo $write[wr_23]?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label>수하물</label></th>
                        <td>
                            <input type="text" class="input" style="width:100%;" placeholder="ex)캐리어 2개" id="wr_24" name="wr_24" value="<?php echo $write[wr_24]?>">
                        </td>
                    </tr>
                    <!--<tr>
                        <th scope="row"><label>출발지역</label></th>
                        <td>
                            <input type="text" readonly id="start" value="<?php echo $write[wr_subject]?>" class="input" style="width:100%;" placeholder="ex)명성주차장">
                        </td>
                    </tr>-->
                    <!--<tr>
                        <th scope="row"><label>도착지역</label></th>
                        <td>
                            <input type="text" readonly id="end" value="<?php echo $write[wr_4]!=""?$write[wr_4]:"국내선";?>"  class="input" style="width:100%;" placeholder="ex)김해공항 국내선">
                        </td>
                    </tr>-->
                    <!--<tr>
                        <th scope="row"><label for="">이용요금</label></th>
                        <td>
                            <input type="text" class="input" style="width:100%" id="wr_25" name="wr_25" value="<?php echo $write[wr_25]!=""?$write[wr_25]:number_format($price[price])?>원" readonly>
                        </td>
                    </tr>-->
                    <tr>
                        <th scope="row"><label for="wr_5">차량기종</label></th>
                        <td>
                            <input type="text" name="wr_5" id="wr_5" class="input" style="width:100%;" value="<?php echo $write[wr_5]?>" required="">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="wr_6">차량번호</label></th>
                        <td>
                            <input type="text" name="wr_6" id="wr_6" class="input" style="width:100%;" value="<?php echo $write[wr_6]?>" required="" maxlength="4" placeholder="차량번호 끝 4자리를 입력해주세요. 예약확인 및 예약변경 시 필요합니다." onkeypress="return numkeyCheck(event)">
                        </td>
                    </tr>
                    <!--<tr>
				<th scope="row"><label for="wr_7">차량색깔</label></th>
				<td>
					<input type="text" name="wr_7" id="wr_7" class="input" style="width:100%;" value="<?php echo $write[wr_7]?>" required="">
				</td>
			</tr>-->
                    <tr style="display:none">
                        <th scope="row"><label for="car_price">예상견적</label></th>
                        <td>
                            <input type="text" name="etc_10" id="car_price" class="input" style="width:100%;" value="">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="wr_content">특이사항</label></th>
                        <td>
                            <textarea name="wr_content" id="wr_content" class="textarea" style="width:100%;height:160px;" placeholder="특이사항을 남겨주세요"><?php echo $write[wr_content]?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="wr_password">비밀번호</label></th>
                        <td>
                            <input type="password" name="wr_password" id="wr_password" class="input" style="width:100%;" placeholder="숫자 4자리를 입력해주세요. 예약확인 및 예약변경 시 필요합니다." value="" required="" maxlength="4">
                            <input type="hidden" id="uselock" name="uselock" value="Y">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="wr_password2">비밀번호확인</label></th>
                        <td>
                            <input type="password" name="wr_password2" id="wr_password2" class="input" style="width:100%;" required="" maxlength="4">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>


        <div class="form-agree">
            <dl>
                <dt>기사알선포함 승합자동차 대여서비스 이용약관</dt>
                <dd>
                    <div class="scroll-box" tabindex="0">
                        
<p>
    제 1 조 (목적)<br>
    본 약관은 대여사업용 승합자동차를 임대하는 회사와 임차인 사이의 기사 알선 포함 승합자동차 대여 계약상의 권리와 의무 및 책임사항을 규정함을 목적으로 합니다.<br>
     <br>
    제 2 조 (용어의 정의)<br>
    1. “계약”이라 함은 회사와 임차인 사이에 체결되는 11인승 이상 15인승 이하의 승합자동차 임대계약 및 이에 부수하여 행하여지는 운전기사 알선을 의미합니다. 동 계약은 여객자동차운수사업법 제34조상의 2항의 1호에 의한 기사 알선이 허용되는 관광을 목적으로 승차정원 11인승 이상 15인승 이하인 승합자동차를 임차하는 사람. 이 경우 대여시간이 6시간 이상이거나, 대여 또는 반납 장소가 공항 또는 항만인 경우로 한정한다. 해당하는 임차인과의 사이에서만 체결 가능합니다.<br>

    2. “이용자”라 함은 임차인과 그 동행자를 의미합니다. 이를 제외한 다른 사람은 회사의 승합자동차를 이용할 수 없습니다.<br>

    3. “임차인”이라 함은 회원으로서 회사의 홈페이지 또는 모바일 앱을 통해 회사와 계약을 체결한(하는) 사람을 의미합니다.<br>

    4. “제휴사”라 함은 회사와의 중개계약을 통하여 기사 알선 포함 승합자동차 대여차량의 운전용역서비스를 제공하는 (주)휴셔터를 의미합니다.<br>

    5. “회사” 라 함은 임차인에게 대여사업용 승합자동차를 대여하며 운전기사를 알선하는 유니티자산개발(주)를 의미합니다.<br>

    6. “회원”이라 함은 제휴사나 회사의 홈페이지 또는 모바일 앱을 통해 개인정보를 제공하고 회원 가입 계약을 체결함으로써 회원 등록을 마친 사람을 의미합니다.<br>

    7. "알선”이라 함은 여객자동차운수사업법상 회사의 승합자동차에 제휴사의 운전용역서비스에 따라 배차되는 운전기사와 “이용자” 관계를 의미합니다. 알선의 순서는 호출상품의 경우 운전기사가, 예약상품의 경우 “이용자”가 선행함을 원칙으로 합니다.<br>
     <br>
    제 3 조 (계약 체결의 절차 및 계약 내용의 변경)<br>
    1. 임차인은 회사의 홈페이지 또는 모바일 앱을 통해 대여차종, 대여요금, 대여 및 반납 일시, 대여 및 반납지점, 이용자 수, 그리고 취소시 부과되는 수수료 등(이하 “계약사항”)을 미리 확인하고 계약을 체결할 수 있습니다. 계약 체결 후 특정 시점에 고객의 사정으로 취소하는 경우 취소 수수료가 부과될 수 있습니다.<br>
    2. 회사는 기사 알선 포함 대여 서비스의 특성상 대여 및 반납 일시, 대여 및 반납장소에 대해 조건을 설정할 수 있습니다. 대여 조건은 모바일 앱 및 회사 홈페이지 등을 통해 “회원”에게 사전에 공지됩니다.<br>
    3. 서비스 플랫폼의 특성상 임차인의 이용요금은 등록된 카드를 통해 결제되며, 실시간 호출 상품의 경우 하차 시, 예약상품의 경우 예약 확정시에 결제가 진행됩니다.<br>
    4. 임차인이 계약내용을 변경하고자 할 때에는 회사의 홈페이지 또는 모바일 앱을 통하여 사전에 회사와 합의하여야 합니다.<br>
    5. 기사 알선 포함 승합자동차 대여서비스의 특성상 대여와 반납은 실시간 호출 상품의 경우 임차인과 이용자가 렌터카에 탑승하고 하차하는 것을 기사가 모바일 앱을 통해 확인하는 것을 기준으로 합니다. 예약상품의 경우에는 대절한 시간에 따른 기준거리 및 대여와 반납 시간이 미리 설정되며 반납시간 또는 기준거리가 초과된 경우에는 부득이하게 요금이 추가되기도 합니다.<br>
     <br>
    제 4 조 (계약의 체결과 서비스 이용)<br>
    1. 대여약관 동의 등의 절차를 거쳐 회사나 제휴사의 홈페이지 또는 모바일 앱에 회원 등록을 마친 임차인이 회사의 모바일 앱을 통해 계약사항을 입력 및 확인하여 배차를 요청하고 회사가 이를 승낙하면 회사와 임차인 간의 계약이 체결됩니다. 회사는 대여 당일 계약 사항에 맞춰 회사가 알선한 기사와 임차인 사이의 운전용역계약의 체결을 대행하고 해당 정보를 미리 기사에게 제공하여 대여 차량을 운전하도록 배차하며, 제5조에 따라 계약이 취소되지 아니하는 한 배차된 차량정보, 기사정보, 이용약관에 관한 사항 등을 포함하여 계약 사항이 명시된 계약서 및 영수증을 대여 및 반납이 종료된 뒤 임차인이 등록한 이메일 또는 임차인이 선택한 방식으로 발송합니다.<br>

    2. 회사는 제1항의 계약서 및 영수증을 제휴사를 대행하여 임차인에게 발송합니다.<br>

    3. 서비스 이용은 임차인이 이용일시에 대여 장소에서 차량 및 기사 정보를 확인한 후 탑승하고 반납일시에 반납장소에서 하차하는 방법으로 이루어지고, 임차인이 예약화면을 기사에게 제시하면 기사가 임차인의 탑승과 하차를 확인합니다. 기사는 임차인을 대신하여 임차 차량을 차고지에 반환합니다.<br>
      <br>
    제 5 조 (계약의 취소) <br>
    1. 임차인이 차량 호출 상품의 계약을 취소하는 경우에는 아래와 같이 취소수수료가 발생합니다.<br>
    ① 차량 실시간 호출 상품의 경우에는 다음과 같이 취소수수료가 발생합니다.<br>
    - 도착 후 미탑승 수수료: 차량이 출발지 도착후 5분내 미탑승 시 취소 수수료가 부과됩니다. 취소 수수료는 상품에 따라 상이하며 호출 시점마다 앱 내에 안내되며 앱 내 도움말에서도 확인이 가능합니다.<br>
    - 배차 후 취소 수수료: 차량 매칭 후 5분후 취소 시 취소수수료가 부과됩니다. 취소수수료는 상품에 따라 상이하며 호출 시점마다 앱 내에 안내되며 앱 내 도움말에서도 확인이 가능합니다. 단, 호출 시 표시된 도착 예정 시간과 취소 시점에 표시된 도착 예정 시간을 비교하여 도착 예정 시간이 5분 이상 늦어진 경우에는 위약금이 청구되지 않습니다. 위약금 미청구 시간은 도움말에서 확인이 가능합니다.<br>

    ② 차량예약 호출 상품의 경우 기사 배정 여부 및 취소 시간에 따라 발생하는 취소수수료가 상이합니다. 단, 회사 측의 사정이 관여된 경우 아래 3.에 따릅니다.<br>
    - 예약 상품의 취소 수수료 정책은 기본적으로 아래 구분에 따르나 VIP VAN의 경우에는 당일 취소시 시간에 관계 없이 요금의 100%로 책정됩니다.
</p>

<table>
    <tr>
        <th style="width:50%;">구분</th>
        <th style="width:50%;">취소 수수료</th>
    </tr>
    <tr>
        <td>출발 전일 12시까지</td>
        <td>수수료 없음</td>
    </tr>
    <tr>
        <td>출발 전일 12시~자정</td>
        <td>요금의 50%</td>
    </tr>
    <tr>
        <td>출발 당일 탑승 4시간 전 이전</td>
        <td>요금의 80%</td>
    </tr>
    <tr>
        <td>출발 당일 탑승 4시간 전 이후</td>
        <td rowspan="2">요금의 100%</td>
    </tr>
    <tr>
        <td>No-show(탑승 예약시간 30분 초과시)로 인한 취소시</td>
    </tr>
</table>
<p>
    2. 실시간 호출 상품의 경우 기사가 임차인이 요청한 출발지에 도착하여 회원에게 전화 통화, 메세지 전송, 앱 내 알림 등의 방법으로 도착을 안내하였음에도 임차인이 사전 연락 없이 5분 이내 탑승을 하지 아니하거나 계약을 취소하는 경우 사전 고지된 취소수수료가 회원에게 청구되며, 차량예약 상품의 경우 30분 이내 탑승을 하지 아니하거나 계약을 취소하는 경우 사전 예약요금 전액이 회원에게 청구됩니다. 단, 출발지에 도착하여 30분이 경과하기 전까지 회원에게 전화 통화, 메세지 전송 등의 방법으로 연락을 취하며, 비행편 연착 등 회원에게 귀책이 없는 사유가 확인될 경우 사전 예약요금을 청구하지 않습니다.<br>
    3. 회사가 회사 측의 사정(임차인이 계약한 차종의 렌터카를 대여할 수 없을 경우, 또는 무단 지연 등)으로 계약을 취소하는 경우 임차인에게 사유를 설명하고 이용요금 전액을 청구하지 아니합니다. 또한 차량예약 서비스의 경우에는 회사 측의 사정으로 계약이 취소될 경우, 상황에 따라 아래와 같이 임차인에게 배상이 이루어질 것입니다(예약 및 결제가 확정된 경우로써, 출발 전일 15시 이후에 한함)
</p>


<table>
    <tr>
        <th style="width:50%;" colspan="2" rowspan="2">
            <p>구분</p>
        </th>
        <th style="width:50%;" colspan="2">
            <p>배상내용</p>
        </th>
    </tr>
    <tr>
        <th>
            <p>결재요금</p>
        </th>
        <th>
            <p>추가배상</p>
        </th>
    </tr>
    <tr>
        <td rowspan="2">
            <p>출발 지연으로 회원이 취소할 경우</p>
        </td>
        <td>
            <p>30분 미만 지연</p>
        </td>
        <td rowspan="2">
            <p>100% 환불</p>
        </td>
        <td>
            <p>-</p>
        </td>
    </tr>
    <tr>
        <td>
            <p>30분 이상지연</p>
        </td>
        <td rowspan="2">
            <p>대체 이동시 초과 비용</p>
            <p>(결재요금의 100% 상한)</p>
            <p>*차량 2대 필요시 150% 상한</p>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <p>운전자 운행 불가에 따른 운행 취소</p>
        </td>
        <td>
            <p>100% 환불</p>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <p>고장/사고로 인한 운행의 미완수</p>
            <p>(운행 중단)</p>
        </td>
        <td>
            <p>100% 환불</p>
        </td>
        <td>
            <p>대체 이동시 초과 비용</p>
            <p>(결재요금의 100% 상한)</p>
            <p>*차량 2대 필요시 150% 상한</p>
            <p>회원이 입은 손해 배상</p>
            <p>* 단 귀책사유에 따른 통상손해에 한함.</p>
        </td>
    </tr>
</table>
<p>
    제6조 (계약의 해지)<br>
    1. 회사는 다음 각 호의 어느 하나에 해당하는 경우에는 대여계약을 해지할 수 있습니다.<br>
    ① 임차인이 계약의 중요한 사항을 위반하여 계약을 유지하기 어려운 객관적인 사정이 존재할 때<br>
    ② 계약 당시 임차인의 개인정보가 실명이 아닌 허위로 판명된 때<br>
    ③ 이용 요금을 지급하지 아니하거나 이용 요금을 결제함에 있어서 타인 명의 결제 도용, 전화번호 도용 등 불법적인 방법을 사용한 경우<br>
    ④ 임차인이 본 약관 9조에서 정한 임차인의 책임과 의무 위반 행위를 반복하거나 기타 본 약관에서 정한 의무사항을 위반한 경우<br>

    2. 제 1항의 경우 회사는 사전에 이를 회원에게 통지하거나 공지합니다. 다만 부득이한 경우 사후에 통지하거나 공지할 수 있습니다.<br>

    3. 임차인은 다음 각 호의 어느 하나에 해당하는 경우에는 계약을 해지할 수 있습니다. 이 경우 회사는 이용요금을 임차인에게 반환합니다.<br>
    ① 회사가 계약의 중요한 사항을 위반하여 계약을 유지하기 어려운 객관적인 사정이 존재할 때<br>
    ② 렌터카 임차기간 중 임차인의 책임 없는 사유로 사고가 발생한 경우<br>
     <br>
    제 7 조 (불가항력 사유로 인한 대여계약 해지)<br>
    1. 회사는 다음과 같은 사유가 발생한 경우 서비스의 일부 또는 전부를 중단할 수 있으며, 제휴사는 이를 회원들에게 통보해야 합니다.<br>
    ① 임차기간 중 천재지변, 전쟁, 내란, 사변, 폭동, 소요 등 기타 불가항력 사유로 인하여 회원이 렌터카를 사용할 수 없는 경우<br>
    ② 기간통신사업자로부터 전기통신서비스가 제공되지 않은 경우<br>
    ③ 회사 및 제휴사의 시스템을 포함한 정보통신설비의 보수점검, 교체 또는 고장, 통신의 두절 등의 사유가 발생한 경우<br>

    2. 제 1항의 경우 회사는 미이용 요금 전액을 회원에게 반환합니다.<br>
     <br>
    제 8 조 (보험가입 및 사고처리 등)<br>
    1. 회사는 임차인에게 자동차손해배상보장법 및 보험사와의 계약에 따라 책임보험과 자동차종합보험에 가입된 렌터카를 대여합니다. 이 경우 임차인은 자동차보험약관상 승낙피보험자가 됩니다.</p>

<table>
    <tr>
        <th style="width:50%">항목</th>
        <th style="width:50%">배상한도</th>
    </tr>
    <tr>
        <td>대인배상</td>
        <td>무한</td>
    </tr>
    <tr>
        <td>대물배상</td>
        <td>3억원</td>
    </tr>
</table>
<p>
    2. 임차인과 이용자는 사고발생시 회사가 체결한 제1항의 보험을 통해 손해를 보상받을 수 있습니다.<br>

    3. 사고 발생시 임차인에게 임차인 및 이용자의 개인정보(이름, 생년월일, 전화번호)를 요청하고, 회사는 이 정보를 보험사에 사고처리 및 손해 보상을 위해 전달합니다.<br>

    4. 임차기간 중 사고가 발생한 때에는 회사, 제휴사의 기사 및 임차인은 사고해결을 위해 노력하여야 하며, 협조를 태만히 하여 상대방에게 손해를 입힌 경우에는 귀책사유에 따라 그 손해를 배상할 책임을 집니다.<br>

    5. 계약당시 임차인이 제공한 개인정보가 허위로 판명되는 경우 임차인은 손해를 보상 받을 수 없습니다.<br>
     <br>
    제 9 조 (임차인의 책임과 의무)<br>
    1. 임차인은 임차기간 중 임차인의 책임 있는 사유로 인해 발생한 렌터카 내부의 모든 재산상의 손실이나 기사 및 제3자에게 끼친 인적ㆍ물적 손실에 대하여 배상할 책임이 있습니다.<br>

    2. 임차인 및 이용자는 본인 및 다른 회원들의 편의와 안전을 위해 차내 청결과 법령상 의무사항 등을 유지할 의무가 있습니다.<br>

    3. 회사는 서비스의 신뢰성을 제고하고 안전한 거래가 이뤄질 수 있도록 임차인에게 특정한 행위를 금지하며 이를 회사의 홈페이지에 게재하고 있습니다. 금지행위의 항목은 수시로 갱신될 수 있으며, 항목 추가 및 변경시마다 별도로 고지하지 않습니다.<br>

    4. 임차인이 서비스로 중개 받은 승합자동차 또는 기타 운송수단 탑승 중 고의 또는 과실로 차량, 운전용역 제공자 또는 제 3 자에 대하여 손해를 입혔을 경우, 임차인은 이를 배상해야 하며 구체적인 금액은 아래와 같습니다. 이에 관하여 회사의 기사 알선 포함 승합자동차 대여 서비스 이용약관에서 정한 사항이 있다면 그에 따릅니다.<br>
    ① 차내 구토 등 오물 투기 및 흡연, 또는 반려동물이나 유아 탑승으로 인해 차량을 오염시킨 경우: 20 만원 이내에서 세차 실비 및 영업 손실비용 <br>
    ② 차량 및 차내 기물 파손 비용: 원상 복구 비용 및 영업 손실비 <br>
    ③ 목적지 도착 후 하차 거부: 경찰서 등의 인계 시까지의 운임 및 영업 손실비<br>
    ④ 분실물 발견 후 배달 요청시 배차 중지후 분실물 배달을 위한 영업 손실비<br>

    5. 회사는 임차인이 본 조의 금지행위를 하는 경우 회사의 교통운송 서비스 일체를 거부 등 서비스 이용을 제한할 수 있으며, 이 경우 발생하는 모든 책임은 임차인이 부담합니다. 회사는 필요한 경우 임차인의 금지행위 사실을 관련 정부기관 또는 사법기관에 통지할 수 있습니다.<br>

    6. 회사는 임차인이 본 조의 금지행위나 드라이버로부터의 부정적인 평가가 누적되는 등 부적절하다고 판단되는 행위에 대하여 제휴사를 통해 경고를 취할 수 있으며, 경고는 회원 가입시 등록한 이메일과 휴대폰 번호로 발송됩니다. 경고가 3 회 누적될 경우 즉시 서비스 사용 중지 또는 회원자격을 박탈당할 수 있습니다. 본 규정은 본 약관의 계약 체결 및 해지 관련 규정에 우선합니다.<br>
     <br>
    제 10 조 (약관의 개정과 명시)<br>
    1. 본 약관은 수시로 개정 가능합니다.<br>
    2. 개정된 약관은 원칙적으로 그 효력 발생일로부터 장래에 향하여 유효합니다.<br>
    3. 기타, 본 약관에서 정하지 않은 사항은, 회사 또는 제휴사의 본 계약관련 일반 약관의 정함에 따릅니다.<br>
     <br>
    제 11 조 (준거법 및 합의관할)<br>
    1. 회사와 회원 간 제기된 소송은 대한민국법을 준거법으로 합니다.<br>
    2. 회사와 회원 간 발생한 분쟁에 관한 소송은 민사소송법상의 관할법원에 제소합니다. <br>
     <br>
    부칙<br>
    본 약관은 2021년 11월 01일부터 적용됩니다.

</p>

                    </div>
                </dd>
                <dd><input type="checkbox" name="agree" id="p_chk" required=""><label for="p_chk">기사알선포함 승합자동차 대여서비스 이용약관에 동의합니다.</label></dd>
            </dl>
        </div>

        <div class="form-agree">
            <a href="<?=G5_BBS_URL?>/content.php?co_id=privacy" class="pop_privacy">[<span>개인정보처리방침</span> 전문보기]</a>
            <dl>
                <dt>개인정보 수집 및 이용에 대한 안내</dt>
                <dd>
                    <div class="scroll-box" tabindex="0">
                        <p>김해신공항주차장은 기업/단체 및 개인의 정보 수집 및 이용 등 처리에 있어 아래의 사항을 관계법령에 따라 고지하고 안내해 드립니다.&nbsp;</p>
                        <p><br>1. 정보수집의 이용 목적 : 상담 및 진행<br>2. 수집/이용 항목 : 이름, 일반전화, 휴대전화, 이메일, 상담내용<br>3. 보유 및 이용기간 : 상담 종료후 6개월, 정보제공자의 삭제 요청시 즉시<br>4. 개인정보처리담당 : 전화 051-972-2277&nbsp;&nbsp;<br></p>
                        <p><br></p>
                    </div>
                </dd>
                <dd><input type="checkbox" name="agree2" id="p_chk2" required=""><label for="p_chk2">개인정보 수집 및 이용에 동의합니다.</label></dd>
            </dl>
        </div>

        <div class="form-agree">
            <dl>
                <dt>개인정보활용에 대한 안내</dt>
                <dd>
                    <div class="scroll-box" tabindex="0">
                        <p>김해신공항주차장은 기업/단체 및 개인의 정보 수집 및 이용 등 처리에 있어 아래의 사항을 관계법령에 따라 고지하고 안내해 드립니다.&nbsp;</p>
                        <p><br>1. 정보수집의 이용 목적 : 상담 및 진행<br>2. 수집/이용 항목 : 이름, 일반전화, 휴대전화, 이메일, 상담내용<br>3. 보유 및 이용기간 : 상담 종료후 6개월, 정보제공자의 삭제 요청시 즉시<br>4. 개인정보처리담당 : 전화 051-972-2277&nbsp;&nbsp;</p>
                    </div>
                </dd>
                <dd><input type="checkbox" name="agree3" id="p_chk3" required=""><label for="p_chk3">개인정보활용에 동의합니다.</label></dd>
            </dl>
        </div>

        <div class="text-center t_margin50">
            <div class="btn_group">
                <input type="submit" value="예약하기" class="submit">
                <input type="reset" value="취소하기" class="cancel">
            </div>
        </div>

        <!-- <div class="buttons">
	<div class="cen">
		<span class="btn_pack large"><input type="submit" value="확인" /></span>
    	<span class="btn_pack large"><a href="/sub/sub01_01.php?mNum=1&sNum=1&boardid=reserve&mode=list&category=&goPage=">취소</a></span>
    </div>
</div> -->
    </form>




    <? /*<div class="tbl_frm01 tbl_wrap">
        <table>
        <colgroup>
           <col style="width:15%" />
           <col style="width:auto" />
        </colgroup>
        <tbody>
        <? php if ($is_name) { ?>
    <tr>
        <th scope="row"><label for="wr_name">작성자<strong class="sound_only">필수</strong></label></th>
        <td><input type="text" name="wr_name" value="<?php echo $name ?>" id="wr_name" required class="frm_input required" size="10" maxlength="20"></td>
    </tr>
    <?php } ?>

    <?php if ($is_password) { ?>
    <tr>
        <th scope="row"><label for="wr_password">비밀번호<strong class="sound_only">필수</strong></label></th>
        <td><input type="password" name="wr_password" id="wr_password" <?php echo $password_required ?> class="frm_input <?php echo $password_required ?>" maxlength="20"></td>
    </tr>
    <?php } ?>

    <? /* php if ($is_email) { ?>
    <tr>
        <th scope="row"><label for="wr_email">이메일</label></th>
        <td><input type="text" name="wr_email" value="<?php echo $email ?>" id="wr_email" class="frm_input email" maxlength="100"></td>
    </tr>
    <?php } ?>

    <?php if ($is_homepage) { ?>
    <tr>
        <th scope="row"><label for="wr_homepage">홈페이지</label></th>
        <td><input type="text" name="wr_homepage" value="<?php echo $homepage ?>" id="wr_homepage" class="frm_input"></td>
    </tr>
    <?php } */ ?>

    <? /* php if ($option) { ?>
    <tr>
        <th scope="row">옵션</th>
        <td><?php echo $option ?></td>
    </tr>
    <?php } ?>

    <?php if ($is_category) { ?>
    <tr>
        <th scope="row"><label for="ca_name">분류<strong class="sound_only">필수</strong></label></th>
        <td>
            <select name="ca_name" id="ca_name" required class="required">
                <option value="">선택하세요</option>
                <?php echo $category_option ?>
            </select>
        </td>
    </tr>
    <?php } ?>

    <tr>
        <th scope="row"><label for="wr_subject">제목<strong class="sound_only">필수</strong></label></th>
        <td>
            <div id="autosave_wrapper">
                <input type="text" name="wr_subject" value="<?php echo $subject ?>" id="wr_subject" required class="frm_input required" maxlength="255">
                <?php if ($is_member) { // 임시 저장된 글 기능 ?>
                <script src="<?php echo G5_JS_URL; ?>/autosave.js"></script>
                <?php if($editor_content_js) echo $editor_content_js; ?>
                <button type="button" id="btn_autosave" class="btn_frmline">임시 저장된 글 (<span id="autosave_count"><?php echo $autosave_count; ?></span>)</button>
                <div id="autosave_pop">
                    <strong>임시 저장된 글 목록</strong>
                    <div><button type="button" class="autosave_close"><img src="<?php echo $board_skin_url; ?>/img/btn_close.gif" alt="닫기"></button></div>
                    <ul></ul>
                    <div><button type="button" class="autosave_close"><img src="<?php echo $board_skin_url; ?>/img/btn_close.gif" alt="닫기"></button></div>
                </div>
                <?php } ?>
            </div>
        </td>
    </tr>


    <?php for ($i=1; $is_link && $i<=G5_LINK_COUNT; $i++) { ?>
    <tr>
        <th scope="row"><label for="wr_link<?php echo $i ?>">링크 #<?php echo $i ?></label></th>
        <td><input type="text" name="wr_link<?php echo $i ?>" value="<?php if($w=="u"){echo$write['wr_link'.$i];} ?>" id="wr_link<?php echo $i ?>" class="frm_input"></td>
    </tr>
    <?php } ?>

    <?php for ($i=0; $is_file && $i<$file_count; $i++) { ?>
    <tr>
        <th scope="row">파일 #<?php echo $i+1 ?></th>
        <td>
            <input type="file" name="bf_file[]" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" class="frm_file frm_input">
            <?php if ($is_file_content) { ?>
            <input type="text" name="bf_content[]" value="<?php echo ($w == 'u') ? $file[$i]['bf_content'] : ''; ?>" title="파일 설명을 입력해주세요." class="frm_file frm_input">
            <?php } ?>
            <?php if($w == 'u' && $file[$i]['file']) { ?>
            <input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i;  ?>]" value="1"> <label for="bf_file_del<?php echo $i ?>"><?php echo $file[$i]['source'].'('.$file[$i]['size'].')';  ?> 파일 삭제</label>
            <?php } ?>
        </td>
    </tr>
    <?php } ?>

    <?php if ($is_guest) { //자동등록방지  ?>
    <tr>
        <th scope="row">자동등록방지</th>
        <td>
            <?php echo $captcha_html ?>
        </td>
    </tr>
    <?php } ?>

    <?php if ($is_orderby) { ?>
    <tr>
        <th scope="row"><label for="wr_orderby">우선순위</label></th>
        <td><input type="text" name="wr_orderby" value="<?php echo $wr_orderby ?>" id="wr_orderby" class="frm_input" size="4"></td>
    </tr>
    <?php } ?>

    </tbody>
    </table>
    </div>

    <div class="btn_confirm">
        <input type="submit" value="작성완료" id="btn_submit" accesskey="s" class="btn_submit">
        <a href="./board.php?bo_table=<?php echo $bo_table ?>" class="btn_cancel">취소</a>
    </div>
    </form> */ ?>

    <script>
        <?php if($write_min || $write_max) { ?>
        // 글자수 제한
        var char_min = parseInt(<?php echo $write_min; ?>); // 최소
        var char_max = parseInt(<?php echo $write_max; ?>); // 최대
        check_byte("wr_content", "char_count");

        $(function() {
            $("#wr_content").on("keyup", function() {
                check_byte("wr_content", "char_count");
            });

        });

        <?php } ?>

        function html_auto_br(obj) {
            if (obj.checked) {
                result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
                if (result)
                    obj.value = "html2";
                else
                    obj.value = "html1";
            } else
                obj.value = "";
        }

        function fwrite_submit(f) {
            //if (isParkcheck == false) {
                //alert("현재 선택하신 주차장에는 만차가 되었거나 주차할 수 없습니다. 다른 주차장을 선택하십시오");
                //return false;
            //}
            <?php// echo $editor_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>
            if (!f.agree.checked) {
                alert("기사알선포함 승합자동차 대여서비스에 대한 안내의 내용에 동의하셔야 예약 하실 수 있습니다.");
                f.agree.focus();
                return false;
            }

            if (!f.agree2.checked) {
                alert("개인정보 수집 및 활용에 대한 안내 내용에 동의하셔야 예약 하실 수 있습니다.");
                f.agree2.focus();
                return false;
            }
            if (!f.agree3.checked) {
                alert("개인정보활용에 대한 안내 내용에 동의하셔야 예약 하실 수 있습니다.");
                f.agree3.focus();
                return false;
            }
            //if (f.wr_8.value.length < 1) {
                //alert("주차기간 계산하기를 누르십시오");
                //return false;
            //}
            var subject = "";
            var content = "";
            $.ajax({
                url: g5_bbs_url + "/ajax.filter.php",
                type: "POST",
                data: {
                    "subject": f.wr_subject.value,
                    "content": f.wr_content.value
                },
                dataType: "json",
                async: false,
                cache: false,
                success: function(data, textStatus) {
                    subject = data.subject;
                    content = data.content;
                }
            });

            if (subject) {
                alert("제목에 금지단어('" + subject + "')가 포함되어있습니다");
                f.wr_subject.focus();
                return false;
            }

            if (content) {
                alert("내용에 금지단어('" + content + "')가 포함되어있습니다");
                if (typeof(ed_wr_content) != "undefined")
                    ed_wr_content.returnFalse();
                else
                    f.wr_content.focus();
                return false;
            }

            if (document.getElementById("char_count")) {
                if (char_min > 0 || char_max > 0) {
                    var cnt = parseInt(check_byte("wr_content", "char_count"));
                    if (char_min > 0 && char_min > cnt) {
                        alert("내용은 " + char_min + "글자 이상 쓰셔야 합니다.");
                        return false;
                    } else if (char_max > 0 && char_max < cnt) {
                        alert("내용은 " + char_max + "글자 이하로 쓰셔야 합니다.");
                        return false;
                    }
                }
            }

            <?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>

            document.getElementById("btn_submit").disabled = "disabled";

            return true;
        }

    </script>
</section>
<!-- } 게시물 작성/수정 끝 -->

<script>
    $(function() {
        //../img/common/icon_calendar.png
        <?
        if ($member[mb_level] != "10") {
            ?>
            $("#wr_1,#wr_2").datepicker({
                dateFormat: 'yy-mm-dd',
                buttonImage: "<?=G5_THEME_IMG_URL?>/common/icon_calendar.png",
                buttonImageOnly: true,
                showOn: 'both',
                prevText: '이전 달',
                nextText: '다음 달',
                monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
                monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
                dayNames: ['일', '월', '화', '수', '목', '금', '토'],
                dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
                dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
                showMonthAfterYear: true,
                yearSuffix: '년',
                minDate: 0
            }); 
				<?} else {?>
            $("#wr_1,#wr_2").datepicker({
                dateFormat: 'yy-mm-dd',
                buttonImage: "<?=G5_THEME_IMG_URL?>/common/icon_calendar.png",
                buttonImageOnly: true,
                showOn: 'both',
                prevText: '이전 달',
                nextText: '다음 달',

            }); <?} ?>

    });

</script>
