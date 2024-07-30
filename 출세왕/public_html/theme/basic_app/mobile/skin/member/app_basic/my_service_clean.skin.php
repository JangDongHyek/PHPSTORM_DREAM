<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
add_javascript('<script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>', 0);

//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
?>

<style>
    .required_no{border: 2px  dashed #ee4e47!important}
</style>

<!-- 입주청소 신청하기 폼 -->
<form id="fservice" name="fservice" action = "<?=G5_BBS_URL?>/ajax.controller.php" onsubmit="return fservice_submit(this);">
    <input type="hidden" name="mode" value="cu_service_form">
    <input type="hidden" name="cu_building" value="<?= $_REQUEST['cub']?>">
    <input type="hidden" name="cu_type" value="<?= $_REQUEST['ct']?>">

<div id="my_service" class="clean">
    <?php if ( $req['ct'] == 1  &&  $req['cub'] != 4){ ?>
	<h1 id="top_cate">
    	입주청소<span class="size"><?= $cub_list[$_REQUEST["cub"]]?></span><strong class="price">* 20평이하 300,000원<br />
            * 21평~29평까지 350,000원<br />
            * 30평 이상 (평당 <?= number_format($cu_money_list[$_REQUEST['cub']."".$_REQUEST['ct']])?>원)</strong>
        <div class="scale cf">
        	<div class="how"><input onkeyup="pay_result(this.value)" type="number" name="cu_width" value="" id="cu_width" placeholder="평수입력" class="frm"></div>
            <span class="unit">평</span>
            <div class="result"><strong id="pay_result">0</strong><span>원</span></div><!--1평당 기본가 10,000원 / 평수 넣으면 기본가격에서 변동 될 것임-->
        </div><!--scale-->
    </h1>
    <?php } ?>
    <?php if ( $req['ct'] == 2 &&  $req['cub'] != 4){ ?>
	<h1 id="top_cate">
    	이사청소<span class="size"><?= $cub_list[$_REQUEST["cub"]]?></span><strong class="price">* 20평이하 300,000원<br />
                * 21평~25평까지 350,000원<br />
                * 36평 이상 (평당 <?= number_format($cu_money_list[$_REQUEST['cub']."".$_REQUEST['ct']])?>원)</strong>
        <div class="scale cf">
        	<div class="how"><input onkeyup="pay_result(this.value)" type="number" name="cu_width" value="" id="cu_width" placeholder="평수입력" class="frm"></div>
            <span class="unit">평</span>
            <div class="result"><strong id="pay_result">0</strong><span>원</span></div><!--1평당 기본가 11,000원 / 평수 넣으면 기본가격에서 변동 될 것임-->
        </div><!--scale-->
    </h1>
    <?php } ?>
    <?php if ( $req['cub'] == 4){ ?>
	<h1 id="top_cate">
    	특수청소<span class="size">공장/상가</span><strong class="price">* 평당 <?= number_format($cu_money_list[$_REQUEST['cub']."".$_REQUEST['ct']])?>원입니다.</strong>
        <div class="scale cf">
        	<div class="how"><input onkeyup="pay_result(this.value)" type="number" name="cu_width" value="" id="cu_width" placeholder="평수입력" class="frm"></div>
            <span class="unit">평</span>
            <div class="result"><strong id="pay_result">0</strong><span>원</span></div><!--1평당 기본가 11,000원 / 평수 넣으면 기본가격에서 변동 될 것임-->
        </div><!--scale-->
    </h1>
    <?php } ?>
    
    <div id="area_bg"></div>
	<div class="bx">
    	<h2 class="big_title">원하시는 날짜를 선택해 주세요.</h2>
        <div class="select">
            <div class="visit reser cf">
            	<div class="date"><a href="javascript:;"><span class="ico"><i class="far fa-calendar-alt"></i></span>청소요청일</a></div>
<!--                <div class="date result">2020년 11월 12일/09:00</div>-->
                <div class="date result">
                <span><i class="fas fa-calendar-day"></i></span><input type="date" name="cu_date"  id="cu_date" min="<?= date("Y-m-d", strtotime(G5_TIME_YMD." +1 weeks")); ?>" value="<?= date("Y-m-d", strtotime(G5_TIME_YMD." +1 weeks")); ?>">&nbsp;&nbsp;
                    <!--
                    <span><i class="fas fa-alarm-clock"></i></span><input type="time" name="cu_time" id="cu_time">
                    -->
                </div>
            </div>
        </div><!--select-->
    </div><!--bx-->
    
    
    <div id="area_bg"></div>
	<div class="bx">
    	<h2 class="big_title">청소하실 주소를 선택해 주세요.</h2>
        <div class="my_addr">
			<div class="form">
                <label for="addr">주소 불러오기</label>
                <input type="text" onclick="sample2_execDaumPostcode()" name="cu_addr1" autocomplete="off" value="" id="cu_addr1" placeholder="주소 불러오기" class="frm">
                <button type="button" class="sbtn" onclick=""><i class="far fa-search" onclick="sample2_execDaumPostcode()" ></i></button>
            </div>
			<div class="form">
                <label for="addr2">상세주소 입력</label>
                <input type="text" name="cu_addr2" id="no_requ_cu_addr2" placeholder="상세주소 입력" class="frm">
            </div>
        </div><!--my_addr-->
		
    </div><!--bx-->
    
    
    <div id="area_bg"></div>
	<div class="bx">
    	<h2 class="big_title">고객요청사항</h2>
        <div class="form"><textarea cols="30" rows="10" id="no_requ_cu_memo" name="cu_memo" class="my_req" placeholder="요청사항을 입력해 주세요"></textarea></div><!--form-->
    </div><!--bx-->
    
    
    <div id="area_bg"></div>
    <div class="bx" style="">
        <h2 class="big_title">참고할 사진을 등록해 주세요. <span class="coms">* 최대 10장까지 등록가능</span></h2>
        <div class="my_place">
            <div class="form photo_in cf">

                <div id = "prev_area"></div>
                <!--                   -->
                <div name="photo_box_0" class="photo"  onclick="file_add()" >
                    <label for="image"><span class="pbtn"><i class="fas fa-camera-alt"></i></span></label>
                </div>                
                <div id="file_input"></div>
                <div class="memo"><textarea cols="30" rows="10" id="picture_memo" name="cu_picture_memo" class="my_req" placeholder="사진에 대한 추가설명이 있다면 입력해 주세요"></textarea></div>
            </div>
        </div><!--my_place-->
    </div><!--bx-->
        
    
    <div id="area_bg"></div>
	<div class="bx">
    	<h2 class="big_title">연락처를 입력해 주세요</h2>
        <div class="my_info">
            <div class="min_ch">
                <label>
                    <input onclick="mem_info_setting();" type="checkbox" class="" id="ch_01" value="">
                    <em></em>회원정보와 동일
                </label>	    
            </div>	
			<div class="form">
                <label for="my_name">성함</label>
                <input type="text" name="cu_mb_name" value="" id="cu_mb_name" placeholder="성함" class="frm">
            </div>
			<div class="form">
                <label for="my_tel">휴대폰 번호입력</label>
                <input type="tel" name="cu_mb_hp" value="" id="cu_mb_hp" placeholder="휴대폰 번호입력(-없이 숫자만 입력해 주세요)" class="frm">
            </div>
        </div><!--my_info-->
    </div><!--bx-->
     <dl class="atten_wrap">
     	<dt>주의사항</dt>
     	<dd>1. 세금계산서 발행시 vat 별도입니다.</dd>
     	<dd>2. 입주청소 같은 경우 옵션 이외에 추가가구나 과도한 인테리어 설치시 추가요금 발생할 수 있습니다.</dd>
     	<dd>3. 이사청소같은 경우 내부상태에따라 추가 요금 발생할 수 있습니다.</dd>
     	<dd>4. 공장 상태에따라 별도의 추가요금이 발생할수 있습니다.</dd>
     </dl>
    
    <div class="normal_btn"><input type="submit" class="btn" value="예약신청하기"></div>
    <!--<div class="normal_btn"><input type="submit" value="예약신청하기" id="" class="btn"></div>-->   

</div><!--my_service-->
</form>
<!--주소팝업-->
<div id="layer" style="display:none;position:fixed;overflow:hidden;z-index:3;-webkit-overflow-scrolling:touch;">
    <i class="fas fa-times-square" id="btnCloseLayer" style="width:40px; height:40px; color:#000; cursor:pointer;position:absolute;right:-5px;bottom:-5px;z-index:1" onclick="closeDaumPostcode()" alt="닫기 버튼"></i>
</div>

<!-- 입주청소 신청하기 폼 -->
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
                document.getElementById("cu_addr1").value = addr +' '+extraAddr;
                // 커서를 상세주소 필드로 이동한다.
                document.getElementById("no_requ_cu_addr2").focus();

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

    //회원정보와 동일 체크 시 셋팅
    function mem_info_setting(){

        if($('#ch_01').is(":checked") == true) {
            $('#cu_mb_name').val('<?php echo $member['mb_name']?>');
            $('#cu_mb_hp').val('<?php echo str_replace('-','',$member['mb_hp']);?>');
        }else{
            $('#cu_mb_name').val('');
            $('#cu_mb_hp').val('');
        }

    }

    function fservice_submit(f) {
        var required_data = $("[id^='cu_']"),
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

        if (required_chk == 'Y'){
            return true;
        }

    }

    function pay_result(val) {

        var basic = '<?= $cu_money_list[$_REQUEST['cub']."".$_REQUEST['ct']] ?>';
        var pay = val * basic,
            cub = $('[name="cu_building"]').val(),
            ct = $('[name="cu_type"]').val();

            if (cub != 4 && val <= 20) {
                pay = '300000';
            }else if (cub != 4 && ct == 1 && val > 20 && val <= 29){
                pay = '350000';

            }else if (cub != 4 && ct == 2 && val > 20 && val <= 25){
                pay = '350000';

            }else{
                pay = basic * val;
            }

        $("#pay_result").text(numberWithCommas(pay));

    }

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }


    var box_idx = 0; //고유 idx,해당 idx로 photo div를 읽어와 미리보기 사진을 없앰
    //이미지 미리보기
    function getImgPrev(input) {
        var reg_ext = /(.*?)\.(jpg|jpeg|png)$/;
        var leng = $(".btn_del").size();
        var files = input.files;
        var files_arr = Array.prototype.slice.call(files);
        if (leng+input.files.length > 10  ){
            alert('최대 10개까지 등록 가능 합니다.');
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

    var file_idx = 0;
    function file_add() {
        var leng = $(".btn_del").size();

        upload = $('<input type="file" name="image[]" class="frm_file" id="image' + file_idx + '" multiple onchange="getImgPrev(this)" accept="image/*" >');

        if (leng < 10) {
            $("#file_input").after(upload);
            upload.trigger('click');
            // file_idx++;

        } else {
            alert("최대 10장까지 등록 가능합니다.");
            return false;
        }
    }

</script>