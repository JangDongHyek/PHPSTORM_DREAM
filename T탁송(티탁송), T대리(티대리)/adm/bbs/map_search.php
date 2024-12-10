<?php
include_once('./_common.php');

if (!$is_member) {
	goto_url(G5_BBS_URL."/login.php");
}

if ($mode != "start" && $start_place == "") {
	alert("출발지를 먼저 선택하세요.", G5_URL."/index.php");
}
if ($mode == "") {
	goto_url(G5_URL."/index.php");
}

$g5['title'] = '주소검색';
include_once(G5_THEME_PATH.'/head.php');
?>
<style>
.map-list{float:left; border-radius:6px; width:31.6%; height:104px; overflow:hidden; text-overflow:hidden; border:1px solid #e6e6e6; font-weight:bold; background-color:#fff; font-weight:400; letter-spacing:-1px; line-height:16px; font-size:1.15em; margin:0.8%!important; padding:8px!important;}
body {background-color: #f2f2f2;}
</style>

<script>
function postCodeView() {
	srchAddr();
}
</script>

<div id="map_sch">
    <fieldset>
        <legend>사이트 내 전체검색</legend>
        <form onsubmit="return false" autocomplete="off">
        <input type="text" name="" id="sch_stx" maxlength="100" placeholder="장소, 주소 검색" onkeyup="searchPlaces()" onfocus="searchPlaces()">
        <!--<input type="submit" id="sch_submit" value="검색">-->
        </form>
    </fieldset>
</div>

<!-- 상세주소로 검색하기 -->
<!-- iOS에서는 position:fixed 버그가 있음, 적용하는 사이트에 맞게 position:absolute 등을 이용하여 top,left값 조정 필요 -->
<div id="layer" style="display:none; position:absolute; overflow:hidden;z-index:1;-webkit-overflow-scrolling:touch;width:100%;height:100%; border:5px solid #fff;background-color:#fff; border-radius:4px">
	<img src="//t1.daumcdn.net/postcode/resource/images/close.png" id="btnFoldWrap" style="cursor:pointer;position:absolute;right:0px;top:-1px;z-index:1" onclick="foldDaumPostcode()" alt="접기 버튼">
</div>

<div id="map_sch2" style="background-color:#5ac11c; padding: 0 5% 10px 5%; padding-top:10px; margin-bottom:6px; " class="text-center" onclick="postCodeView()">
	<a href="javascript:void(0)" onclick="postCodeView()" style="color:#ffff00;font-size:16px; font-weight:700; width:100%">상세주소로 검색하기</a>
</div>
<!-- // 상세주소로 검색하기 -->

<!-- 주소검색결과 & 북마크 히스토리 영역 -->
<div id="sch_result" style="padding:0% 2%"></div>

<!-- 페이징 -->
<div id="pagination" class="text-center"></div>

<script>
var page_mode = "<?=$mode?>";

$(function() {
	$("#sch_stx").focus();

	if (g5_is_member) {
		getBookmark();
	}
});

// 검색 히스토리
function getBookmark() {
	$.ajax({  
		type : "get",  
		url : g5_bbs_url + "/ajax.map_bookmark.php",
		data : {"page_mode" : page_mode, "params" : location.search},
		dataType : "html",  
		success : function(html) {  
			$("#sch_result").html(html);
		},  
		error : function(xhr,status,error) {
		}
	});
}

// 검색 즐겨찾기등록/해제
function setBookmark(idx, val) {
	$.ajax({  
		type : "get",  
		url : g5_bbs_url + "/ajax.map_bookmark_update.php",
		data : {"mode" : "favorite", "idx" : idx, "cur_val" : val},
		dataType : "text",  
		success : function(data) {  
			getBookmark();
		},  
		error : function(xhr,status,error) {
		}
	});

}

//================================================================
// 주소검색
//----------------------------------------------------------------
var element_layer = document.getElementById('layer');

function foldDaumPostcode() {
	element_layer.style.display = 'none';
}

function srchAddr() {
	new daum.Postcode({
		oncomplete: function(data) {
			var addr = ''; // 주소 변수
			if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
				addr = data.roadAddress;
			} else { // 사용자가 지번 주소를 선택했을 경우(J)
				addr = data.jibunAddress;
			}
			// 주소-좌표 변환 객체를 생성합니다
			var geocoder = new kakao.maps.services.Geocoder();

			// 주소로 좌표를 검색합니다
			geocoder.addressSearch(addr, function(result, status) {
				console.log(result);

				// 정상적으로 검색이 완료됐으면 
				if (status === kakao.maps.services.Status.OK) {
					var coords = new kakao.maps.LatLng(result[0].y, result[0].x);
					var url = g5_url + "/index.php?",
						start_params = "start_place=<?=$start_place?>&start_lat=<?=$start_lat?>&start_lng=<?=$start_lng?>",
						pass_chk = "<?=$pass_place?>";

					switch (page_mode) {
					case "start" : 
						url += "start_place="+ addr +"&start_lat="+ result[0].y +"&start_lng="+ result[0].x;
						break;
					case "pass" :
						url += start_params + "&pass_place="+ addr +"&pass_lat="+ result[0].y +"&pass_lng="+ result[0].x;
						break;
					case "end" :
						// 호출 페이지 이동
						url = g5_bbs_url + "/call.php?";
						if (pass_chk != "")	start_params += "&pass_place=<?=$pass_place?>&pass_lat=<?=$pass_lat?>&pass_lng=<?=$pass_lng?>";
						url += start_params + "&end_place="+ addr +"&end_lat="+ result[0].y +"&end_lng="+ result[0].x;
						break;
					}
					location.href = url;

					/*
					var pass_chk = "<?=$pass_place?>";
					var url = g5_url + "/index.php?";

					if (page_mode == "start") {
						url += "start_place="+ addr +"&start_lat="+ result[0].y +"&start_lng="+ result[0].x;
						if (pass_chk != '') {
							url += '&pass_place=<?=$pass_place?>&pass_lat=<?=$pass_lat?>&pass_lng=<?=$pass_lng?>';
						}
					} else if (page_mode == "pass") {
						url += 'start_place=<?=$start_place?>&start_lat=<?=$start_lat?>&start_lng=<?=$start_lng?>';
						url += "pass_place="+ addr +"&pass_lat="+ result[0].y +"&pass_lng="+ result[0].x;
					} else {
						getNoti(1, "결과페이지 준비중입니다.");
						return false;
					}
					location.href = url;
					*/

				} else {
					getNoti(1, '주소 검색에 실패했습니다. 다시 시도해 주세요.');
				}
			});   
			element_layer.style.display = 'none';
		},
		width : '100%',
		height : '100%',
		maxSuggestItems : 5
	}).embed(element_layer);

	element_layer.style.display = 'block';
	initLayerPosition();
}

function initLayerPosition(){
	var width = 300;
	var height = 400;
	var borderWidth = 1;

	// 위에서 선언한 값들을 실제 element에 넣는다.
	element_layer.style.width = '94%';
	//element_layer.style.height =  '98%';
	element_layer.style.border = borderWidth + 'px solid';
	// 실행되는 순간의 화면 너비와 높이 값을 가져와서 중앙에 뜰 수 있도록 위치를 계산한다.
	element_layer.style.left = '3%';
	element_layer.style.top = '0px';

	$(element_layer).css("height", $(window).height() * 0.8 + "px");
}


//================================================================
//장소검색
//----------------------------------------------------------------
var ps = new daum.maps.services.Places();

// 검색
function searchPlaces() {
	var keyword = document.getElementById('sch_stx').value;

	if (!keyword.replace(/^\s+|\s+$/g, '')) {
		 // alert('키워드를 입력해주세요!');
		return false;
	}
	
	// 장소검색 객체를 통해 키워드로 장소검색을	요청합니다
	ps.keywordSearch( keyword, placesSearchCB); 
}

// 장소검색이 완료됐을 때 호출되는 콜백함수 입니다
function placesSearchCB(data, status, pagination) {
    if (status === daum.maps.services.Status.OK) {
        // 정상적으로 검색이 완료됐으면
        // 검색 목록과 마커를 표출합니다
        displayPlaces(data);

        // 페이지 번호를 표출합니다
        displayPagination(pagination);

    } else if (status === daum.maps.services.Status.ZERO_RESULT) {
		// alert('검색 결과가 존재하지 않습니다.');
        return;

    } else if (status === daum.maps.services.Status.ERROR) {
		// alert('검색 결과 중 오류가 발생했습니다.');
        return;
    }
}

// 검색 결과 목록과 마커를 표출하는 함수입니다
function displayPlaces(places) {
	var listEl = document.getElementById('sch_result'), 
		//menuEl = document.getElementById('menu_wrap'),
		fragment = document.createDocumentFragment(), 
		listStr = '';

    // 검색 결과 목록에 추가된 항목들을 제거합니다
    removeAllChildNods(listEl);
	for ( var i=0; i<places.length; i++ ) {
		// 마커를 생성하고 지도에 표시합니다
		var placePosition = new daum.maps.LatLng(places[i].y, places[i].x),
			itemEl = getListItem(i, places[i]); // 검색 결과 항목 Element를 생성합니다

		// 검색된 장소 위치를 기준으로 지도 범위를 재설정하기위해
		// LatLngBounds 객체에 좌표를 추가합니다

		fragment.appendChild(itemEl);
	}

    // 검색결과 항목들을 검색결과 목록 Elemnet에 추가합니다
    listEl.appendChild(fragment);
    //menuEl.scrollTop = 0;
}

// 검색결과 항목을 Element로 반환하는 함수입니다
function getListItem(index, places) {
	var place_name=places.place_name.replace('"','');
	var el = document.createElement('div'),
		strHtml = "<li onclick=positionChoice('"+index+"','"+places.x+"','"+places.y+"') style='cursor:pointer'>";

	strHtml+='<div class="addr">';
	strHtml+='<p id="place'+index+'">'+places.place_name+'</p>';
	strHtml+='<span>'+places.address_name+'</span>';
	strHtml+='</div>';
	strHtml+='</li>';

	el.innerHTML = strHtml;
	el.className = 'item';

	return el;
}

// 주소검색결과 선택시 (리스트검색, 주소직접검색)
function positionChoice(index, lng, lat) {
	var url = g5_url + "/index.php?",
		start_params = "start_place=<?=$start_place?>&start_lat=<?=$start_lat?>&start_lng=<?=$start_lng?>",
		pass_chk = "<?=$pass_place?>";

	switch (page_mode) {
	case "start" : 
		url += "start_place="+$("#place"+index).html()+"&start_lat="+lat+"&start_lng="+lng;
		break;
	case "pass" :
		url += start_params + "&pass_place="+$("#place"+index).html()+"&pass_lat="+lat+"&pass_lng="+lng;
		break;
	case "end" :
		// 호출 페이지 이동
		url = g5_bbs_url + "/call.php?";
		if (pass_chk != "")	start_params += "&pass_place=<?=$pass_place?>&pass_lat=<?=$pass_lat?>&pass_lng=<?=$pass_lng?>";
		url += start_params + "&end_place="+$("#place"+index).html()+"&end_lat="+lat+"&end_lng="+lng;
		break;
	}
	location.href = url;
}

// 검색결과 목록 하단에 페이지번호를 표시는 함수입니다
function displayPagination(pagination) {
    var paginationEl = document.getElementById('pagination'),
        fragment = document.createDocumentFragment(),
        i; 

    // 기존에 추가된 페이지번호를 삭제합니다
    while (paginationEl.hasChildNodes()) {
        paginationEl.removeChild (paginationEl.lastChild);
    }
		
    for (i=1; i<=pagination.last; i++) {
        var el = document.createElement('a');
        el.href = "#";
        el.innerHTML = i;

        if (i===pagination.current) {
            el.className = 'on';
        } else {
            el.onclick = (function(i) {
                return function() {
                    pagination.gotoPage(i);
                }
            })(i);
        }

        fragment.appendChild(el);
    }
    paginationEl.appendChild(fragment);
}

// 검색결과 목록의 자식 Element를 제거하는 함수입니다
function removeAllChildNods(el) {   
    while (el.hasChildNodes()) {
        el.removeChild (el.lastChild);
    }
}
//================================================================
</script>


<?php
include_once('./_tail.sub.php');
//include_once(G5_THEME_PATH.'/tail.php');
?>