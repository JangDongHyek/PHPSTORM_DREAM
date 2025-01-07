<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

$si_arr = array("서울","경기","인천","부산","대구","대전","울산","광주","충남","충북","경남","경북","전남","전북","강원","제주");

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<script src="<?php echo G5_JS_URL?>/address.js"></script>
<? /*
<!-- 게시판 목록 시작 { -->
<!-- 우리 아이피일 때 -->
<div id="guidemap">
    <div class="arear_list">
        <h3 data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            매장찾기 <i class="fas fa-chevron-circle-down"></i>
        </h3>
        <div class="collapse in" id="collapseExample">
            <div role="tabpanel">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#search" aria-controls="search" role="tab" data-toggle="tab">검색</a></li>
                    <li role="presentation">
                        <a href="#area" aria-controls="area" role="tab" data-toggle="tab" onclick="$('#count').css('display','none');$('#store-list2').css('display','none');$('#sido-search').css('display','')">지역검색</a>
                        <!-- 					<a href="#area" aria-controls="area" role="tab" data-toggle="tab">지역검색</a> -->
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="search">
                        <div class="sch">
                            <div class="box">
                                <input type="search" placeholder="매장명 또는 주소" id="sch" onkeyup="ajaxStoreEnter()">
                                <button type="button" onclick="ajaxStoreSearch()"><i class="far fa-search"></i></button>
                            </div>
                        </div>
                        <div class="list">
                            <div class="result">(검색결과 <span id="total-count">0</span>개)</div>
                            <ul id="store-list">
                                <li class="empty_list" style="display:none">
                                    검색 결과가 없습니다.
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="area">
                        <div class="title">시/도를 선택해주세요</div>
                        <ul id="sido-search">
                            <li onclick="ajaxStoreSearch('서울')">서울특별시</li>
                            <li onclick="ajaxStoreSearch('경기')">경기도</li>
                            <li onclick="ajaxStoreSearch('인천')">인천광역시</li>
                            <li onclick="ajaxStoreSearch('강원')">강원도</li>
                            <li onclick="ajaxStoreSearch('충북')">충청북도</li>
                            <li onclick="ajaxStoreSearch('충남')">충청남도</li>
                            <li onclick="ajaxStoreSearch('대전')">대전광역시</li>
                            <li onclick="ajaxStoreSearch('세종특별')">세종특별자치시</li>
                            <li onclick="ajaxStoreSearch('광주')">광주광역시</li>
                            <li onclick="ajaxStoreSearch('전북')">전라북도</li>
                            <li onclick="ajaxStoreSearch('전남')">전라남도</li>
                            <li onclick="ajaxStoreSearch('경북')">경상북도</li>
                            <li onclick="ajaxStoreSearch('경남')">경상남도</li>
                            <li onclick="ajaxStoreSearch('대구')">대구광역시</li>
                            <li onclick="ajaxStoreSearch('부산')">부산광역시</li>
                            <li onclick="ajaxStoreSearch('울산')">울산광역시</li>
                            <li onclick="ajaxStoreSearch('제주특별')">제주특별자치도</li>
                        </ul>
                        <div class="list">
                            <div class="result" id="count" style="display:none">(검색결과 <span id="total-count2">0</span>개)</div>
                            <ul id="store-list2">
                                <li onclick="setCenter('35.1879159911743','129.053475139401')">
                                    <div class="text">
                                        <p>사직 골프랜드점</p>
                                        <span>부산 연제구 경기장로 21 (거제동)</span>
                                    </div>
                                    <div class="img"><img src="https://www.blushaak.co.kr:443/theme/blushaak/img/common/sitemap_logo.png"></div>
                                </li>
                                <!--                                <li class="empty_list">
                                                                    검색 결과가 없습니다.
                                                                </li>-->
                            </ul>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="arear_map">
        <!-- * 카카오맵 - 지도퍼가기 -->
        <!-- 1. 지도 노드 -->
        <div id="map" class="root_daum_roughmap root_daum_roughmap_landing" style="width: 100%; height: 100%;"></div>

        <!--
            2. 설치 스크립트
            * 지도 퍼가기 서비스를 2개 이상 넣을 경우, 설치 스크립트는 하나만 삽입합니다.
        -->
        <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=e944edcfaa9b69202b74651ae14ce1a7"></script>
        <!--            <script charset="UTF-8" class="daum_roughmap_loader_script" src="https://ssl.daumcdn.net/dmaps/map_js_init/roughmapLoader.js"></script>-->

        <!-- 3. 실행 스크립트 -->
        <script charset="UTF-8">
            let myLat=0.0;
            let myLng=0.0;
            let tempMyLat=0.0;
            let tempMyLng=0.0;
            //위치 잡기 성공할 때
            function success({ coords, timestamp }) {
                myLat = coords.latitude;   // 위도
                myLng = coords.longitude; // 경도
                tempMyLat = myLat;
                tempMyLng = myLng;
                setCenter(myLat,myLng);
                ajaxMapList();
            }
            //위치권한
            function getUserLocation() {
                try{
                    myLat=35.179665;
                    myLng=129.0747635;
                    setCenter(myLat,myLng);
                    ajaxMapList();

                    navigator.geolocation.getCurrentPosition(success);
                }catch(error){


                }
            }
            function ajaxStoreEnter(){
                if(event.keyCode==13){
                    ajaxStoreSearch();
                }
            }
            //매장 검색어로 검색
            function ajaxStoreSearch(search){
                let sch = "";
                if(search!=undefined){
                    sch=search;
                }else{
                    sch=$("#sch").val();
                }


                if(sch){
                    $.ajax({
                        url:g5_bbs_url+"/ajax.map.storelist.php",
                        data:{sch:sch,myLng:myLng,myLat:myLat},
                        dataType:"json",
                        type:"GET",
                        success:function(data){
                            let strHtml="";
                            for (var i = 0; i < data.length; i ++) {

                                strHtml+=`<li onclick="setCenter('${data[i].lat}','${data[i].lng}')">
											<div class="text">
												<p>${data[i].title}</p>
												<span>${data[i].addr}</span>
											</div>
											<div class="img"><img src="<?php echo G5_THEME_IMG_URL ?>/common/sitemap_logo.png"></div>
										</li>`;
                            }
                            if(search!=undefined){
                                $("#store-list2").html(strHtml);
                                $('#count').css('display','');
                                $('#store-list2').css('display','');
                                $('#sido-search').css('display','none');
                                $("#total-count2").html(data.length);

                            }else{
                                $("#store-list").html(strHtml);
                                $("#total-count").html(data.length);
                            }

                            setCenter(data[0].lat, data[0].lng);
                            if(i==0){
                                $("#store-list").html('<li class="empty_list">검색 결과가 없습니다.</li>');
                                $("#store-list2").html('<li class="empty_list">검색 결과가 없습니다.</li>');
                            }
                        }

                    });

                }else{
                    $("#total-count").html(tempPositionLength);
                    let positions=tempPositionArr;
                    let strHtml="";
                    for (var i = 0; i < positions.length; i ++) {

                        strHtml+=`<li onclick="setCenter('${positions[i].lat}','${positions[i].lng}')">
										<div class="text">
											<p>${positions[i].title}</p>
											<span>${positions[i].addr}</span>
										</div>
										<div class="img"><img src="<?php echo G5_THEME_IMG_URL ?>/common/sitemap_logo.png"></div>
									</li>`;


                    }


                    $("#store-list").html(strHtml);
                    setCenter(myLat,myLng);
                }
            }
            var mapContainer = document.getElementById('map'), // 지도를 표시할 div
                mapOption = {
                    center: new kakao.maps.LatLng(35.179665, 129.0747635), // 지도의 중심좌표
                    level: 3 // 지도의 확대 레벨
                };

            var map = new kakao.maps.Map(mapContainer, mapOption); // 지도를 생성합니다
            //지동 이동하기
            function setCenter(lat,lng) {
                // 이동할 위도 경도 위치를 생성합니다
                var moveLatLon = new kakao.maps.LatLng(lat,lng);

                // 지도 중심을 이동 시킵니다
                map.setCenter(moveLatLon);
                map.setLevel(3);
            }



            getUserLocation();
            let tempPositionLength=0;
            let tempPositionArr=new Array();
            function ajaxMapList(){
                $.ajax({
                    url:g5_bbs_url+"/ajax.maplist.php",
                    data:{myLng:myLng,myLat:myLat},
                    dataType:"json",
                    type:"GET",
                    success:function(data){

                        console.log(data);
                        // 마커를 표시할 위치와 title 객체 배열입니다
                        var positionsArr=new Array();

                        // 마커 이미지의 이미지 주소입니다
                        var imageSrc = "https://www.blushaak.co.kr/theme/blushaak/skin/board/guidemap/img/map_icon.png";

                        for (var i = 0; i < data.length; i ++) {
                            var datas = new Object();
                            datas.title=data[i].title;
                            datas.latlng = new kakao.maps.LatLng(data[i].lat, data[i].lng);
                            datas.addr = data[i].addr;
                            datas.lat=data[i].lat;
                            datas.lng=data[i].lng;
                            datas.wr_id=data[i].wr_id;
                            datas.content=`<div style="padding:15px;">
													<a href="<?php echo G5_BBS_URL?>/board.php?bo_table=<?php echo $bo_table?>&wr_id=${data[i].wr_id}">${data[i].title}<br/>[상세보기]</a>
												</div>`;
                            console.log(datas.latlng);
                            positionsArr.push(datas);
                        }
                        positions = positionsArr;
                        tempPositionArr=positionsArr;
                        tempPositionLength=positionsArr.length;
                        $("#total-count").html(positions.length);
                        let strHtml="";
                        for (var i = 0; i < positions.length; i ++) {

                            strHtml+=`<li onclick="setCenter('${positions[i].lat}','${positions[i].lng}')">
										<div class="text">
											<p>${positions[i].title}</p>
											<span>${positions[i].addr}</span>
										</div>
										<div class="img"><img src="<?php echo G5_THEME_IMG_URL ?>/common/sitemap_logo.png"></div>
									</li>`;

                            // 마커 이미지의 이미지 크기 입니다
                            var imageSize = new kakao.maps.Size(50, 50);

                            // 마커 이미지를 생성합니다
                            var markerImage = new kakao.maps.MarkerImage(imageSrc, imageSize);

                            // 마커를 생성합니다
                            var marker = new kakao.maps.Marker({
                                map: map, // 마커를 표시할 지도
                                position: positions[i].latlng, // 마커를 표시할 위치
                                title : positions[i].title, // 마커의 타이틀, 마커에 마우스를 올리면 타이틀이 표시됩니다
                                image : markerImage // 마커 이미지
                            });
                            // 마커에 표시할 인포윈도우를 생성합니다
                            var infowindow = new kakao.maps.InfoWindow({
                                content: positions[i].content, // 인포윈도우에 표시할 내용
                                removable:true
                            });

                            // 마커에 mouseover 이벤트와 mouseout 이벤트를 등록합니다
                            // 이벤트 리스너로는 클로저를 만들어 등록합니다
                            // for문에서 클로저를 만들어 주지 않으면 마지막 마커에만 이벤트가 등록됩니다
                            kakao.maps.event.addListener(marker, 'click', makeClickListener(map, marker, infowindow));


                        }
                        $("#store-list").html(strHtml);
                    }
                });
            }
            function makeClickListener(map, marker, infowindow) {
                return function() {
                    infowindow.open(map, marker);
                };
            }

           
        </script>
    </div>
</div>*/?>

<div id="container">
<div id="bo_gall" style="width:<?php echo $width; ?>">

      <!-- 게시판 카테고리 시작 { 
      <nav id="bo_cate">
          <ul id="bo_cate_ul">
              <li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=store" id="bo_cate_on">국내</a></li>
              <li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=store_freign">베트남</a></li>
          </ul>
      </nav>-->

<!--	<script type="text/javascript">flashWrite('<?php echo $board_skin_path; ?>/img/fran_area.swf','778','293')</script>-->


    <fieldset id="bo_sch"></fieldset>
	<!-- 게시물 검색 시작 { -->
	<? /*<fieldset id="bo_sch">
		<legend>게시물 검색</legend>

			<form name="fsearch" method="get">
				<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
				<input type="hidden" name="sca" value="<?php echo $sca ?>">
				<input type="hidden" name="sop" value="and">
				<input type="hidden" name="sfl" value="wr_1">
				<div class="shop_search">
					<select name="si" id="si" class="sch_sel">
						<option value="">시/도(전체)</option>
						<?php for($i=0; $i<count($si_arr); $i++){ ?>
						<option value="<?php echo $si_arr[$i]?>" <?php if($si==$si_arr[$i]) echo "selected";?>><?php echo $si_arr[$i]?></option>
						<?php } ?>
					</select>
					<select name="gu" id="gu" class="sch_sel">
						<option value="" >구/군(전체)</option>
					</select>
					<select name="dong" id="dong" class="sch_sel">
						<option value="" >동</option>
					</select>
					<input type="submit" value="Find a store" class="sch_btn">
				</div>
			</form>
	</fieldset>*/ ?>
	<!-- 게시물 검색 끝 } -->

    <div class="bo_fx">
        <div id="bo_list_total">
            <span style="font-size:11pt; font-weight:bold;"><?php if(!$si) echo "Total"; else echo $si." ".$gu." ".$dong; ?> Store List <?php echo number_format($total_count) ?></span>
            <?php echo $page ?> page
        </div>

        <?php if ($rss_href || $write_href) { ?>
        <ul class="btn_bo_user">
            <?php if ($rss_href) { ?><li><a href="<?php echo $rss_href ?>" class="btn_b01">RSS</a></li><?php } ?>
            <?php if ($_SESSION['ss_mb_id']=="lets080") { ?><li><a href="<?php echo $admin_href ?>" class="btn_admin">관리자</a></li><?php } ?>
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">등록하기</a></li><?php } ?>
        </ul>
        <?php } ?>
    </div>

    <form name="fboardlist"  id="fboardlist" action="./board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="sw" value="">

    <?php if ($is_checkbox) { ?>
    <div id="gall_allchk">
        <label for="chkall" class="sound_only">현재 페이지 게시물 전체</label>
        <input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);">
    </div>
    <?php } ?>
	<div id="list_store">
	<?php for ($i=0; $i<count($list); $i++) {?>
	<a href="<?php echo $list[$i]['href'] ?>">
		<div class="list_store">
			<dl>
				<dt>
					<?php
					if ($list[$i]['is_notice']) { // 공지사항  ?>
						<strong style="width:<?php echo $board['bo_gallery_width'] ?>px;height:<?php echo $board['bo_gallery_height'] ?>px">공지</strong>
					<?php } else {
						$thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], $board['bo_gallery_width'], $board['bo_gallery_height']);

						if($thumb['src']) {
							$img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'" width="'.$board['bo_gallery_width'].'" height="'.$board['bo_gallery_height'].'">';
						} else {
							//$img_content = '<span style="width:'.$board['bo_gallery_width'].'px;height:'.$board['bo_gallery_height'].'px">no image</span>';
							$img_content = '<img src="'.$board_skin_url.'/img/cover_list.jpg" alt="이미지 준비중입니다." width="'.$board['bo_gallery_width'].'" height="'.$board['bo_gallery_height'].'">';
						}

						echo $img_content;
					 }
					 ?>
                     <!--<p class="new_icon"><?php if (isset($list[$i]['icon_new'])) echo $list[$i]['icon_new']; ?></p>-->
				</dt>
				<dd>
					<div class="title"><?php if ($is_checkbox) { ?>
					<label for="chk_wr_id_<?php echo $i ?>" class="sound_only"><?php echo $list[$i]['subject'] ?></label>
					<input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
					<?php } ?>
					<span><?php echo $list[$i]['subject'] ?></span>
                    </div>
					<!--<ul class="fa-ul info">
                        <li><i class="fa-li fal fa-map-marker" aria-hidden="true"></i><strong>Address</strong> <span><? /*php echo $list[$i]['wr_1']; */?> <?php echo $list[$i]['wr_2']; ?></span></li>
                        <li><i class="fa-li fal fa-phone" aria-hidden="true"></i><strong>Tel</strong> <span><?php echo $list[$i]['wr_4']; ?></span></li>
                        <li><i class="fa-li fal fa-car" aria-hidden="true"></i><strong>Parking</strong> <span><?php echo $list[$i]['wr_6']; ?></span></li>
					</ul>-->
				</dd>
			</dl>
		</div>
	</a>
	<?php } ?>
	<?php if (count($list) == 0) { echo "<li class=\"empty_list\">게시물이 없습니다.</li>"; } ?>
	</div>
    
    <?php if ($list_href || $is_checkbox || $write_href) { ?>
    <div class="bo_fx">
        <?php if ($is_checkbox) { ?>
        <ul class="btn_bo_adm">
            <li><input type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value"></li>
        </ul>
        <?php } ?>

        <?php if ($list_href || $write_href) { ?>
        <ul class="btn_bo_user">
            <?php if ($list_href) { ?><li><a href="<?php echo $list_href ?>" class="btn_b01">목록</a></li><?php } ?>
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">등록하기</a></li><?php } ?>
        </ul>
        <?php } ?>
    </div>
    <?php } ?>
    </form>
</div>
</div>
<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>

<!-- 페이지 -->
<?php echo $write_pages;  ?>

<script>
function all_checked(sw) {
    var f = document.fboardlist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]")
            f.elements[i].checked = sw;
    }
}

function fboardlist_submit(f) {
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택복사") {
        select_copy("copy");
        return;
    }

    if(document.pressed == "선택이동") {
        select_copy("move");
        return;
    }

    if(document.pressed == "선택삭제") {
        if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다\n\n답변글이 있는 게시글을 선택하신 경우\n답변글도 선택하셔야 게시글이 삭제됩니다."))
            return false;

        f.removeAttribute("target");
        f.action = "./board_list_update.php";
    }

    return true;
}

// 선택한 게시물 복사 및 이동
function select_copy(sw) {
    var f = document.fboardlist;

    if (sw == 'copy')
        str = "복사";
    else
        str = "이동";

    var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

    f.sw.value = sw;
    f.target = "move";
    f.action = "./move.php";
    f.submit();
}

function getCity(si, gu){
	if(!si && !gu){
		return false;
	}

	var opt;
	var opt_select;

	$.ajax({
		type:"GET",
		url:"<?php echo G5_PLUGIN_URL?>/address/address.php",
		dataType: "json",
		data: {
			"si": si,
			"gu": gu
		},
		success:function(datas){
			for(var i=0; i<datas.length; i++){
				if("<?php echo $si?>" == datas[i] || "<?php echo $gu?>" == datas[i] || "<?php echo $dong?>" == datas[i])
					opt_select = "selected";
				else 
					opt_select = "";

				opt = "<option value='"+datas[i]+"' "+opt_select+">"+datas[i]+"</option>";
				if(!gu){
					$("#gu").append(opt);
				}else{
					$("#dong").append(opt);
				}
			}
		},
		error:function(request,status,error){
			alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		}
	});
}

$(document).ready(function (){
	getCity("<?php echo $si?>");
	getCity("<?php echo $si?>", "<?php echo $gu?>");
});

$("#si").change(function (){
	$("#gu").find("option").remove();
	$("#gu").append("<option value=''>구/군(전체)</option>");
	$("#dong").find("option").remove();
	$("#dong").append("<option value=''>동</option>");

	getCity($(this).val(), "")
});

$("#gu").change(function (){
	var si = $("#si").val();
	$("#dong").find("option").remove();
	$("#dong").append("<option value=''>동</option>");

	getCity(si, $(this).val())
});

</script>
<!-- } 게시판 목록 끝 -->
