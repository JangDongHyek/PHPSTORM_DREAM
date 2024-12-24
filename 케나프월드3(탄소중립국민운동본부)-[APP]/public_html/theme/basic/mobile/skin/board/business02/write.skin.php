<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=<?php echo $config['cf_kakao_js_apikey']; ?>&libraries=services"></script>

<section id="bo_w">
    <h2 id="container_title">정보 등록</h2>

    <form name="fwrite" id="fwrite" action="<?php echo $action_url ?>"  method="post" enctype="multipart/form-data" autocomplete="off">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="wr_lat" id="wr_lat" value="<?php echo $wr_lat ?>">
    <input type="hidden" name="wr_lng" id="wr_lng" value="<?php echo $wr_lng ?>">
	<input type="hidden" name="wr_startdate" id="wr_startdate">
	<input type="hidden" name="wr_enddate" id="wr_enddate">
	<input type="hidden" name="period" id="period">

	<div class="div_form">
		<?php if ($is_category) { ?>
		<dl>
			<dd>
				<select name="ca_name" id="ca_name" required class="required" >
					<option value="">선택하세요</option>
					<?php echo $category_option ?>
				</select>
			</dd>
		</dl>
		<?php } ?>
		<dl>
			<dd>
				<input type="text" name="wr_subject" id="wr_subject" value="<?php echo $subject ?>" class="frm_input required" required placeholder="제목을 남기세요." style="width:100%;">
			</dd>
		</dl>
		<dl>
			<dd>
				<textarea id="wr_content" name="wr_content" placeholder="전달할 내용 남기기" class="frm_input required" required style="font-size:1em;"><?php echo $content;?></textarea>
			</dd>
		</dl>
		<dl>
			<dd class="text-center">
				<input type="text" name="wr_search1" id="wr_search1" value="<?php echo $wr_search1 ?>" class="frm_input" placeholder="상호입력" style="width:20%; text-align:center;"> <i class="fas fa-plus-circle"></i>
				<input type="text" name="wr_search2" id="wr_search2" value="<?php echo $wr_search2 ?>" class="frm_input" placeholder="가격대" style="width:20%; text-align:center;"> <i class="fas fa-plus-circle"></i>
				<input type="text" name="wr_search3" id="wr_search3" value="<?php echo $wr_search3 ?>" class="frm_input" placeholder="특징소개" style="width:20%; text-align:center;"> <i class="fas fa-plus-circle"></i>
				<input type="text" name="wr_search4" id="wr_search4" value="<?php echo $wr_search4 ?>" class="frm_input" placeholder="동면단위" style="width:20%; text-align:center;">
				<p style="padding:5px 10px; text-align:left; font-size:1.2em; color:#626262">
					※ 검색어를 남기세요! 빠른노출효과!
				</p>
			</dd>
		</dl>
		<dl class="row">
		<?php for ($i=0; $is_file && $i<$file_count; $i++) { ?>
			<dd class="col-xs-6">
				<label class="btn btn-default btn-file" style="display:inline-block;">
					파일선택 <input type="file" name="bf_file[]" title="파일첨부 <?php echo $i+1 ?> :  용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" class="frm_file frm_input" style="display:none;">
				</label>
				<p id="file_font_<?php echo $i;?>" class="file_font">
				<?php if($w == 'u' && $file[$i]['file']) { ?>
					<input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i; ?>]" value="1"> 
					<label for="bf_file_del<?php echo $i ?>" style="height:auto; margin-bottom: 0;">파일 삭제</label>
				<?php } ?>
				</p>
			</dd>
		<?php } ?>
		</dl>
		<dl>
			<dd class="row">
				<p class="col-xs-6" style="font-size:1.25em; line-height:33px; color:#333;">캐시백하기</p>
				<p class="col-xs-4"><input type="tel" name="wr_cash" id="wr_cash" class="frm_input" value="<?php echo $wr_cash ?>" placeholder="0" style="width:100%;height:33px !important;" onkeyup="this.value = number_only(this.value)" ></p>
				<p class="col-xs-2" style="font-size:1.25em; line-height:33px; color:#333; padding-left:5px;"> <span class="sc-line">w</span></p>
			</dd>
		</dl>
		<dl>
			<dd>
				<div id="daum_map" style="width:100%; height:250px;"></div>
				<input type="button" class="btn btn-danger btn-sm" onclick="daumPostcode();" value="주소검색" style="width:100%; font-weight:bold; font-size:1.25em;">
				<div id="daum_wrap" style="display:none;border:1px solid;width:100%;height:200px;margin:5px 0;position:relative">
					<img src="//t1.daumcdn.net/localimg/localimages/07/postcode/320/close.png" id="btnFoldWrap" style="cursor:pointer;position:absolute;right:0px;top:-1px;z-index:1" onclick="foldDaumPostcode()" alt="접기 버튼">
				</div>
				<input type="text" name="wr_2" id="wr_2" class="frm_input" value="<?php echo $wr_2 ?>" placeholder="주소검색을 이용해주세요." readonly onclick="daumPostcode();" style="width:100%;">
				<input type="text" name="wr_3" id="wr_3" class="frm_input" value="<?php echo $wr_3 ?>" placeholder="상세주소를 입력해주세요." style="width:100%;">
			</dd>
		</dl>
		<dl>
			<dd>
				<input type="number" name="wr_10" id="wr_10" value="<?php echo $wr_10 ?>" class="frm_input" placeholder="전화번호" style="width:100%;font-size:12px;" onkeyup="this.value = number_only(this.value)" maxlength="12">
			</dd>
		</dl>
		<dl>
			<dd>
				<input type="text" name="wr_5" id="wr_5" value="<?php echo $wr_5 ?>" class="frm_input" placeholder="블로그 주소" style="width:100%;">
				<input type="text" name="wr_6" id="wr_6" value="<?php echo $wr_6 ?>" class="frm_input" placeholder="홈페이지 주소" style="width:100%;">
			</dd>
		</dl>
		<dl>
			<dd>
				<input type="text" name="wr_7" id="wr_7" value="<?php echo $wr_7 ?>" class="frm_input" placeholder="유튜브 링크" style="width:100%;">
				<input type="text" name="wr_8" id="wr_8" value="<?php echo $wr_8 ?>" class="frm_input" placeholder="아프리카 TV 링크" style="width:100%;">
			</dd>
		</dl>
	</div>
	
	<?php if ($is_guest) { //자동등록방지 ?>
	<?php echo $captcha_html ?>
	<?php } ?>
    


    <div id="charge">
    
    	<h2>정보등록 요금선택</h2>
    
    	<table width="100%" border="0" cellspacing="0" cellpadding="1">
        <thead>
          <tr>
            <th scope="col">이용 요금 선택</th>
            <th scope="col">캐시결제</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th>무한 550,000 캐시쿠폰</th>
            <td onclick="buy(88)"><a id="buy_88" href="javascript:void(0);" class="check btn">구매결제</a></td>
          </tr>
          <tr>
            <th>1년간 90,000 캐시쿠폰</th>
            <td  onclick="buy(12)"><a id="buy_12" href="javascript:void(0);" class="check btn">구매결제</a></td>
          </tr>
          <tr>
            <th>6개월 50,000 캐시쿠폰</th>
            <td  onclick="buy(6)"><a id="buy_6" href="javascript:void(0);" class="check btn">구매결제</a></td>
          </tr>
          <tr>
            <th>3개월 30,000 캐시쿠폰</th>
            <td onclick="buy(3)"><a id="buy_3" href="javascript:void(0);" class="check btn">구매결제</a></td>
          </tr>
          <tr>
            <th>1개월 10,000 캐시쿠폰</th>
            <td onclick="buy(1)"><a id="buy_1" href="javascript:void(0);" class="check btn">구매결제</a></td>
          </tr>
          <tr>
            <th>적립이용 100 캐시쿠폰</th>
            <td onclick="buy(0)"><a id="buy_0" href="javascript:void(0);" class="check btn">구매결제</a></td>
          </tr>
        </tbody>
        </table>
    </div>
    



<div class="text-center" style="padding:10px;">
		<input type="button" value="완료" id="btn_submit" class="btn btn-primary btn-sm" accesskey="s" onclick="fwrite_submit()">
    </div>
    </form>
</section>

<script>
	var value=0;

	function buy(period){
		
	var id = '<?=$member['mb_id']?>';

	switch(period){
		case 88: value = 550000; break;
		case 12: value = 90000; break;
		case 6: value = 50000; break;
		case 3: value = 30000; break;
		case 1: value = 10000; break;		
		case 0: value = 100; break;
	}

	if(id !=''){

	$.ajax({
			url:"./ajax.check_point.php",
			type: "POST",
			data: {
				"mbid": id,
				"value": value,
				"period": period
			},
			dataType: "json",
			success: function(data) {

				if(data.chkflag ==0){
					$(".check").removeClass("on");
					$("#buy_"+period).addClass("on");
					$("#period").val(period);
					$("#wr_startdate").val(data.startdate);
					$("#wr_enddate").val(data.enddate);					
					}
				else{
					$(".check").removeClass("on");	
					alert("캐시가 부족합니다");					
					$("#period").val('');
					$("#wr_startdate").val('');
					$("#wr_enddate").val('');					
					location.href="./mywallet.php";
				}
			}
		});
	
	}
}

function number_only(num) {
	num = num + "";
	num = num.replace(/[^0-9]/gi, ""); 
	return num ;
}

$(document).on('change', ':file', function() {
    var input = $(this),
        numFiles = input.get(0).files ? input.get(0).files.length : 1,
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [numFiles, label]);
});

$('[name="bf_file[]"]').on('fileselect', function(e, f, l) {
	console.log(l);
	$(this).parents("dd.col-xs-6").find("p.file_font").html(l);
});

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
function html_auto_br(obj)
{
    if (obj.checked) {
        result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
        if (result)
            obj.value = "html2";
        else
            obj.value = "html1";
    }
    else
        obj.value = "";
}

function fwrite_submit()
{
	var f=document.fwrite;
    <?php //echo $editor_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>

    var subject = "";
    var content = "";
    $.ajax({
        url: g5_bbs_url+"/ajax.filter.php",
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
        alert("제목에 금지단어('"+subject+"')가 포함되어있습니다");
        f.wr_subject.focus();
        return;
    }

    if (content) {
        alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
        if (typeof(ed_wr_content) != "undefined")
            ed_wr_content.returnFalse();
        else
            f.wr_content.focus();
        return;
    }

    if (document.getElementById("char_count")) {
        if (char_min > 0 || char_max > 0) {
            var cnt = parseInt(check_byte("wr_content", "char_count"));
            if (char_min > 0 && char_min > cnt) {
                alert("내용은 "+char_min+"글자 이상 쓰셔야 합니다.");
                return;
            }
            else if (char_max > 0 && char_max < cnt) {
                alert("내용은 "+char_max+"글자 이하로 쓰셔야 합니다.");
                return;
            }
        }
    }
	
	<?php if($w==""){ ?>
	var fi = $("[name='bf_file[]']").eq(0).val();
	console.log($("[name='bf_file[]']").eq(0));
	if(!fi){
		alert("첫번째 파일은 필수입니다.");
		return;
	}
	<?php } ?>

    document.getElementById("btn_submit").disabled = "disabled";
	
	var mbid = '<?=$member['mb_id']?>';
	if(mbid != '' && value != 0){
	
	var enddate  = $("#wr_enddate").val();

	$.ajax({
        url: g5_bbs_url+"/ajax.pay_point.php",
        type: "POST",
        data: {
            "mbid": mbid,
            "value": value,
			"enddate": enddate
        },
        dataType: "text",
        success: function(data) {
				f.submit();
        }
    });
	}

    
}

//###################### 다음지도 str ######################//
var mapContainer = document.getElementById('daum_map'), // 지도를 표시할 div 
	mapOption = {
		center: new daum.maps.LatLng("<?php echo $wr_lat; ?>", "<?php echo $wr_lng; ?>"), // 지도의 중심좌표
		level: 4 // 지도의 확대 레벨
	};  

// 지도를 생성합니다    
var map = new daum.maps.Map(mapContainer, mapOption); 

// 주소-좌표 변환 객체를 생성합니다
var geocoder = new daum.maps.services.Geocoder();

var marker = new daum.maps.Marker({ // 클릭한 위치를 표시할 마커입니다
	position: new daum.maps.LatLng('<?php echo $wr_lat; ?>', '<?php echo $wr_lng; ?>'),
	map: map
});
//###################### 다음지도 end ######################//

//###################### 주소검색 str ######################//
// 우편번호 찾기 찾기 화면을 넣을 element
var element_wrap = document.getElementById('daum_wrap');

function foldDaumPostcode() {
	// iframe을 넣은 element를 안보이게 한다.
	element_wrap.style.display = 'none';
}

function daumPostcode() {
	// 현재 scroll 위치를 저장해놓는다.
	var currentScroll = Math.max(document.body.scrollTop, document.documentElement.scrollTop);

	new daum.Postcode({
		oncomplete: function(data) {
                // 도로명 주소의 노출 규칙에 따라 주소를 조합한다.
                // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                var fullRoadAddr = data.roadAddress; // 도로명 주소 변수
                var extraRoadAddr = ''; // 도로명 조합형 주소 변수

                // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                    extraRoadAddr += data.bname;
                }
                // 건물명이 있고, 공동주택일 경우 추가한다.
                if(data.buildingName !== '' && data.apartment === 'Y'){
                   extraRoadAddr += (extraRoadAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                }
                // 도로명, 지번 조합형 주소가 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                if(extraRoadAddr !== ''){
                    extraRoadAddr = ' (' + extraRoadAddr + ')';
                }
                // 도로명, 지번 주소의 유무에 따라 해당 조합형 주소를 추가한다.
                if(fullRoadAddr !== ''){
                    fullRoadAddr += extraRoadAddr;
                }

			// 우편번호와 주소 정보를 해당 필드에 넣는다.
			document.getElementById('wr_2').value = fullRoadAddr;

			// iframe을 넣은 element를 안보이게 한다.
			// (autoClose:false 기능을 이용한다면, 아래 코드를 제거해야 화면에서 사라지지 않는다.)
			element_wrap.style.display = 'none';

			// 우편번호 찾기 화면이 보이기 이전으로 scroll 위치를 되돌린다.
			document.body.scrollTop = currentScroll;

			// 커서를 상세주소 필드로 이동한다.
			document.getElementById('wr_3').focus();

			// ################### 다음지도 api 연동 str ###################//
			// 주소로 상세 정보를 검색
			geocoder.addressSearch(data.address, function(results, status) {
				// 정상적으로 검색이 완료됐으면
				if (status === daum.maps.services.Status.OK) {

					var result = results[0]; //첫번째 결과의 값을 활용

					// 해당 주소에 대한 좌표를 받아서
					var coords = new daum.maps.LatLng(result.y, result.x);
					
					var wr_lat = result.y;
					var wr_lng = result.x;

					// 지도를 보여준다.
					map.relayout();
					// 지도 중심을 변경한다.
					map.setCenter(coords);
					// 마커를 결과값으로 받은 위치로 옮긴다.
					marker.setPosition(coords)
				}
				document.getElementById('wr_lat').value = wr_lat;
				document.getElementById('wr_lng').value = wr_lng;
				//console.log('lat: ' + wr_lat);
				//console.log('lng: ' + wr_lng);
			});

			// ################### 다음지도 api 연동 end ###################//
		},
		// 우편번호 찾기 화면 크기가 조정되었을때 실행할 코드를 작성하는 부분. iframe을 넣은 element의 높이값을 조정한다.
		onresize : function(size) {
			element_wrap.style.height = size.height+'px';
		},
		width : '100%',
		height : '100%'
	}).embed(element_wrap);

	// iframe을 넣은 element를 보이게 한다.
	element_wrap.style.display = 'block';
}
//###################### 주소검색 end ######################//

//###################### 주소클릭 str ######################//
// 지도를 클릭했을 때 클릭 위치 좌표에 대한 주소정보를 표시하도록 이벤트를 등록합니다
daum.maps.event.addListener(map, 'click', function(mouseEvent) {
	searchDetailAddrFromCoords(mouseEvent.latLng, function(result, status) {
		if (status === daum.maps.services.Status.OK) {
			
			marker.setPosition(mouseEvent.latLng);
			marker.setMap(map);
			map.panTo(mouseEvent.latLng);

			document.getElementById("wr_lat").value = mouseEvent.latLng.jb;
			document.getElementById("wr_lng").value = mouseEvent.latLng.ib;
			document.getElementById('wr_2').value = result[0].road_address?result[0].road_address.address_name:result[0].address.address_name;
		}  
	});
});
function searchAddrFromCoords(coords, callback) {
    // 좌표로 행정동 주소 정보를 요청합니다
    geocoder.coord2RegionCode(coords.getLng(), coords.getLat(), callback);         
}

function searchDetailAddrFromCoords(coords, callback) {
	// 좌표로 법정동 상세 주소 정보를 요청합니다
	geocoder.coord2Address(coords.getLng(), coords.getLat(), callback);
}

//###################### 주소클릭 end ######################//

</script>