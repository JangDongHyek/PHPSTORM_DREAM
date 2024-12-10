<?php
/*************************************
드라이버 콜내역 - 상세
 *************************************/
include_once('./_common.php');
include_once(G5_THEME_MOBILE_PATH.'/head.php');

$sql = "SELECT * FROM g5_call WHERE idx = '{$idx}'";
$row = sql_fetch($sql);
$agency_no = $row["agency_no"];

/*
// 동일 대리점인지 확인
if ($agency_no != $member['agency_no']) {
	alert('잘못된 접근입니다.');
}
*/

// 내콜이 아닌 일반회원 패스
if ($member['mb_level'] == "2") {
    if ($row['mb_id'] != $member['mb_id']) {
        alert('잘못된 접근입니다.');
    }
}

// 출발지, 경유지, 도착지 정보
$start_place = $row['start_place'];
$start_lat = $row['start_lat'];
$start_lng = $row['start_lng'];
$pass_place = $row['pass_place'];
$pass_lat = $row['pass_lat'];
$pass_lng = $row['pass_lng'];
$end_place = $row['end_place'];
$end_lat = $row['end_lat'];
$end_lng = $row['end_lng'];

// 좌표로 상세주소
$path = '/v2/local/geo/coord2address';
$content_type = 'json'; // json or xml
// 1) 출발지 주소
$params1 = http_build_query(array('x' =>$start_lng, 'y'=>$start_lat));
$decode1 = kakaoRestApi($path, $params1, $content_type);
// 2) 경유지 주소
if ($pass_place != "") {
    $params2 = http_build_query(array('x' =>$pass_lng, 'y'=>$pass_lat));
    $decode2 = kakaoRestApi($path, $params2, $content_type);
}
// 3) 도착지 주소
$params3 = http_build_query(array('x' =>$end_lng, 'y'=>$end_lat));
$decode3 = kakaoRestApi($path, $params3, $content_type);
// 상세주소
$startAddress = $decode1['documents'][0]['address']['address_name'];
$passAddress = $decode2['documents'][0]['address']['address_name'];
$endAddress = $decode3['documents'][0]['address']['address_name'];

// 총금액 (고객, 본사, 드라이버)
$total_price = (int)$row['call_total_price'];
$customPrice = $total_price;
//$bonsaPrice = $total_price * 0.2;
//$driverPrice = $customPrice + $bonsaPrice;
$driver_sudang = $total_price * 0.8;

// 상태
$call_status = $row['call_status'];

// 요청 수락가능 레벨 (현재 레벨5 자기사만)
$request_falg = false;
if ($member['mb_level'] == "5") $request_falg = true;

// 총금액수정 (내가 신청한 콜 & 상태가 대기인것만)
$amt_modify = false;
if ($row['call_status'] == "0" && $member['mb_id'] == $row['mb_id']) $amt_modify = true;


?>

    <script src="https://apis.openapi.sk.com/tmap/jsv2?version=1&appKey=<?=$config['cf_tmap_api']?>"></script><!-- tmap -->
    <script>
        //================================================================
        // 티맵API : 출발지, 경유지, 도착지 정보
        //----------------------------------------------------------------
        var start_place = "<?=urldecode($start_place)?>",
            start_lat = parseFloat("<?=$start_lat?>"),
            start_lng = parseFloat("<?=$start_lng?>");
        var pass_place = "<?=urldecode($pass_place)?>",
            pass_lat = parseFloat("<?=$pass_lat?>"),
            pass_lng = parseFloat("<?=$pass_lng?>");
        var end_place = "<?=urldecode($end_place)?>",
            end_lat = parseFloat("<?=$end_lat?>"),
            end_lng = parseFloat("<?=$end_lng?>");

        // 티맵 변수
        var map;
        var marker_s, marker_e, marker_m, waypoint;
        var resultMarkerArr = [];
        var drawInfoArr = [];
        var resultInfoArr = [];


        $(function() {
            initTmap();
        })

        function initTmap() {
            resultMarkerArr = [];

            // 1. 지도 띄우기
            map = new Tmapv2.Map("map_div", {
                center: new Tmapv2.LatLng(start_lat, start_lng),
                width : "100%",
                height : "260px",
                zoom : 12,
                zoomControl : true,
                scrollwheel : true
            });

            // 2. 시작, 도착 심볼찍기
            // 시작
            marker_s = new Tmapv2.Marker({
                position : new Tmapv2.LatLng(start_lat, start_lng),
                icon : "http://tmapapis.sktelecom.com/upload/tmap/marker/pin_r_m_s.png",
                iconSize : new Tmapv2.Size(24, 38),
                map:map
            });
            resultMarkerArr.push(marker_s);
            // 도착
            marker_e = new Tmapv2.Marker({
                position : new Tmapv2.LatLng(end_lat, end_lng),
                icon : "http://tmapapis.sktelecom.com/upload/tmap/marker/pin_r_m_e.png",
                iconSize : new Tmapv2.Size(24, 38),
                map:map
            });
            resultMarkerArr.push(marker_e);

            // 3. 경유지 심볼 찍기
            if (pass_place != "") {
                marker = new Tmapv2.Marker({
                    position : new Tmapv2.LatLng(pass_lat, pass_lng),
                    icon : "http://tmapapis.sktelecom.com/upload/tmap/marker/pin_b_m_1.png",
                    iconSize : new Tmapv2.Size(24, 38),
                    map:map
                });
                resultMarkerArr.push(marker);
            }

            // 4. 경로탐색 API 사용요청
            var searchOption = 0; // 교통최적+(0:추천, 1:무료우선, 2:최소시간, 3:초보)
            var apiKey = "<?=$config['cf_tmap_api']?>";

            // 4.1 경유지가 있는경우
            if (pass_place != "") {
                var routeLayer;
                var headers = {};
                headers["appKey"] = apiKey;
                headers["Content-Type"] = "application/json";

                var param = JSON.stringify({
                    "startName" : encodeURI(start_place),
                    "startX" : String(start_lng),
                    "startY" : String(start_lat),
                    "startTime" : "<?=date('YmdHi')?>",
                    "endName" : encodeURI(end_place),
                    "endX" : String(end_lng),
                    "endY" : String(end_lat),
                    "viaPoints" : [{
                        "viaPointId" : "12345",
                        "viaPointName" : encodeURI(pass_place),
                        "viaX" : String(pass_lng),
                        "viaY" : String(pass_lat),
                    }],
                    "reqCoordType" : "WGS84GEO",
                    "resCoordType" : "EPSG3857",
                    "searchOption": searchOption
                });

                $.ajax({
                    method:"POST",
                    url:"https://apis.openapi.sk.com/tmap/routes/routeSequential30?version=1&format=json",//
                    headers : headers,
                    async:false,
                    data:param,
                    success:function(response){
                        var resultData = response.properties;
                        var resultFeatures = response.features;
                        var tDistance = (resultData.totalDistance / 1000).toFixed(1); // 총거리(km)
                        var tTime = (resultData.totalTime / 60).toFixed(0); // 총시간(분)
                        //var tFare = resultData.totalFare; // 총요금(원)

                        // 기존 라인 초기화
                        if(resultInfoArr.length>0){
                            for(var i in resultInfoArr){
                                resultInfoArr[i].setMap(null);
                            }
                            resultInfoArr=[];
                        }

                        for(var i in resultFeatures) {
                            var geometry = resultFeatures[i].geometry;
                            var properties = resultFeatures[i].properties;
                            var polyline_;

                            drawInfoArr = [];

                            if(geometry.type == "LineString") {
                                for(var j in geometry.coordinates){
                                    // 경로들의 결과값(구간)들을 포인트 객체로 변환
                                    var latlng = new Tmapv2.Point(geometry.coordinates[j][0], geometry.coordinates[j][1]);
                                    // 포인트 객체를 받아 좌표값으로 변환
                                    var convertPoint = new Tmapv2.Projection.convertEPSG3857ToWGS84GEO(latlng);
                                    // 포인트객체의 정보로 좌표값 변환 객체로 저장
                                    var convertChange = new Tmapv2.LatLng(convertPoint._lat, convertPoint._lng);

                                    drawInfoArr.push(convertChange);
                                }

                                polyline_ = new Tmapv2.Polyline({
                                    path : drawInfoArr,
                                    strokeColor : "#FF0000",
                                    strokeWeight: 6,
                                    map : map
                                });
                                resultInfoArr.push(polyline_);

                            }else{
                                var markerImg = "";
                                var size = "";			//아이콘 크기 설정합니다.

                                if(properties.pointType == "S"){	//출발지 마커
                                    markerImg = "http://tmapapis.sktelecom.com/upload/tmap/marker/pin_r_m_s.png";
                                    size = new Tmapv2.Size(24, 38);
                                }else if(properties.pointType == "E"){	//도착지 마커
                                    markerImg = "http://tmapapis.sktelecom.com/upload/tmap/marker/pin_r_m_e.png";
                                    size = new Tmapv2.Size(24, 38);
                                }else{	//각 포인트 마커
                                    markerImg = "http://topopen.tmap.co.kr/imgs/point.png";
                                    size = new Tmapv2.Size(8, 8);
                                }

                                // 경로들의 결과값들을 포인트 객체로 변환
                                var latlon = new Tmapv2.Point(geometry.coordinates[0], geometry.coordinates[1]);
                                // 포인트 객체를 받아 좌표값으로 다시 변환
                                var convertPoint = new Tmapv2.Projection.convertEPSG3857ToWGS84GEO(latlon);

                                marker_p = new Tmapv2.Marker({
                                    position: new Tmapv2.LatLng(convertPoint._lat, convertPoint._lng),
                                    icon : markerImg,
                                    iconSize : size,
                                    map:map
                                });

                                resultMarkerArr.push(marker_p);
                            }
                        }
                    },
                    error:function(request,status,error){
                        //console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
                        var msg = "경로를 불러오는데 실패하였습니다. 다시 시도해 주세요.";
                        swal("경로검색실패", msg, "error", {button: "확인",}).then(function(result) {
                            getError();
                        });
                    }
                });

                // 4.2 경유지가 없는 경우
            } else {
                var trafficInfochk = "N";	// 실시간 교통정보 표시
                var param = {
                    "appKey" : apiKey,
                    "startX" : String(start_lng),
                    "startY" : String(start_lat),
                    "endX" : String(end_lng),
                    "endY" : String(end_lat),
                    "reqCoordType" : "WGS84GEO",
                    "resCoordType" : "EPSG3857",
                    "searchOption" : searchOption,
                    "trafficInfo" : trafficInfochk
                }

                $.ajax({
                    type : "POST",
                    url : "https://apis.openapi.sk.com/tmap/routes?version=1&format=json&callback=result",
                    async : false,
                    data : param,
                    success : function(response) {
                        var resultData = response.features;
                        var tDistance = (resultData[0].properties.totalDistance / 1000).toFixed(1);	// 총거리(km)
                        var tTime = (resultData[0].properties.totalTime / 60).toFixed(0);	// 총시간(분)
                        //var tFare = resultData[0].properties.totalFare;	// 총요금(원)
                        //var taxiFare = " 예상 택시 요금 : " + resultData[0].properties.taxiFare + "원";

                        // 기존 라인 초기화
                        resettingMap();

                        for ( var i in resultData) { //for문 [S]
                            var geometry = resultData[i].geometry;
                            var properties = resultData[i].properties;

                            if (geometry.type == "LineString") {
                                for ( var j in geometry.coordinates) {
                                    // 경로들의 결과값들을 포인트 객체로 변환
                                    var latlng = new Tmapv2.Point(geometry.coordinates[j][0], geometry.coordinates[j][1]);
                                    // 포인트 객체를 받아 좌표값으로 변환
                                    var convertPoint = new Tmapv2.Projection.convertEPSG3857ToWGS84GEO(latlng);
                                    // 포인트객체의 정보로 좌표값 변환 객체로 저장
                                    var convertChange = new Tmapv2.LatLng(convertPoint._lat, convertPoint._lng);
                                    // 배열에 담기
                                    drawInfoArr.push(convertChange);
                                }

                                var polyline_ = new Tmapv2.Polyline({
                                    path : drawInfoArr,
                                    strokeColor : "#DD0000",
                                    strokeWeight : 6,
                                    map : map
                                });
                                resultInfoArr.push(polyline_);

                            } else {
                                var markerImg = "";
                                var pType = "";

                                if (properties.pointType == "S") { //출발지 마커
                                    markerImg = "http://tmapapis.sktelecom.com/upload/tmap/marker/pin_r_m_s.png";
                                    pType = "S";
                                } else if (properties.pointType == "E") { //도착지 마커
                                    markerImg = "http://tmapapis.sktelecom.com/upload/tmap/marker/pin_r_m_e.png";
                                    pType = "E";
                                } else { //각 포인트 마커
                                    markerImg = "http://topopen.tmap.co.kr/imgs/point.png";
                                    pType = "P"
                                }

                                // 경로들의 결과값들을 포인트 객체로 변환
                                var latlon = new Tmapv2.Point(geometry.coordinates[0], geometry.coordinates[1]);
                                // 포인트 객체를 받아 좌표값으로 다시 변환
                                var convertPoint = new Tmapv2.Projection.convertEPSG3857ToWGS84GEO(latlon);

                                var routeInfoObj = {
                                    markerImage : markerImg,
                                    lng : convertPoint._lng,
                                    lat : convertPoint._lat,
                                    pointType : pType
                                };

                                // 마커 생성하기
                                var size = new Tmapv2.Size(24, 38);//아이콘 크기 설정합니다.

                                if (routeInfoObj.pointType == "P") { //포인트점일때는 아이콘 크기를 줄입니다.
                                    size = new Tmapv2.Size(8, 8);
                                }

                                marker_p = new Tmapv2.Marker({
                                    position : new Tmapv2.LatLng(routeInfoObj.lat, routeInfoObj.lng),
                                    icon : routeInfoObj.markerImage,
                                    iconSize : size,
                                    map : map
                                });

                                resultMarkerArr.push(marker_p);
                            }
                        }//for문 [E]
                    },
                    error : function(request, status, error) {
                        //console.log("code:" + request.status + "\n" + "message:" + request.responseText + "\n" + "error:" + error);
                        var msg = "경로를 불러오는데 실패하였습니다. 다시 시도해 주세요.";
                        swal("경로검색실패", msg, "error", {button: "확인",}).then(function(result) {
                            getError();
                        });
                    }
                });

            } // end 4

        }

        //초기화 기능
        function resettingMap() {
            //기존마커는 삭제
            marker_s.setMap(null);
            marker_e.setMap(null);

            if (resultMarkerArr.length > 0) {
                for (var i = 0; i < resultMarkerArr.length; i++) {
                    resultMarkerArr[i].setMap(null);
                }
            }

            if (resultInfoArr.length > 0) {
                for (var i = 0; i < resultInfoArr.length; i++) {
                    resultInfoArr[i].setMap(null);
                }
            }

            chktraffic = [];
            drawInfoArr = [];
            resultMarkerArr = [];
            resultInfoArr = [];
        }

        // 경로검색 오류시
        function getError() {
            alert('경로를 불러오는데 실패하였습니다. 다시 시도해 주세요.');
            history.back();
        }

        //================================================================
        var fn_interval = ""; // n초마다 실행변수

        $(function() {
            var cur_status = document.fcall.cur_status.value;
            console.log('현재 콜상태 : ' + cur_status);

            // 진행중이면 드라이버 위치 호출
            if (cur_status == "1") {
                //intervalType('start');
                console.log('진행중 : 드라이버 위치호출하기');
            }
        });

        // 취소창
        function openCancel() {
            $("#myCancelModal").modal("show");
            $("#cancel_response").focus();
        }

        var data_list = {};
        var my_point = parseInt("<?=$member['mb_point']?>");	// 내 포인트
        var custom_price = parseInt("<?=$customPrice?>");		// 고객이낼금액
        var call_payment = "<?=$row['call_payment']?>";			// P:포인트 C:현금

        // 상태변경 호출
        function request(status) {
            // 초기화
            data_list = {};
            data_list.mode = "status";
            data_list.idx = document.fcall.idx.value;
            data_list.status = status;
            data_list.cur_lat = "<?=$cur_lat?>";
            data_list.cur_lng = "<?=$cur_lng?>";

            switch (status) {
                case "-1" :			// -1) 고객 취소
                    var txt = $("#cancel_response").val();
                    if (txt.length == 0) {
                        getNoti(1, '취소사유를 입력하세요.');
                        return false;
                    }
                    data_list.cancel_reason = $("#cancel_response").val();
                    setRequest();
                    break;

                case "1" :			// 1) 기사 수락
                    // 콜(현금)일때 기사포인트가 고객이낼금액의 20%가 안되면 수락불가
                    if (call_payment == "C" && (custom_price*0.2) > my_point) {
                        getNoti(1, '포인트가 부족합니다.\n(현금콜의 경우 금액의 20%에 해당하는 포인트가 필요합니다.)');
                        return false;
                    }
                    var msg = "대리요청을 수락하시겠습니까?";
                    if (call_payment == "C") msg += "\n(현금콜의 경우 금액의 20%에 해당하는 포인트가 필요합니다.)";

                    console.log('고객낼금액의 20%', custom_price*0.2);
                    console.log('내포인트', my_point);

                    swal({
                        title : "수락하기",
                        text: msg,
                        icon: 'info',
                        buttons: ['닫기', '확인'],
                        dangerMode: true,
                    })
                        .then(function(result) {
                            if (result) {
                                setRequest();
                            }
                        });
                    break;

                case "2" :			// 2) 진행중→진행완료로 변경 (기사만 가능)
                    swal({
                        title : "진행완료",
                        text: "해당 콜을 진행완료 하시겠습니까?",
                        icon: 'info',
                        buttons: ['닫기', '확인'],
                        dangerMode: true,
                    })
                        .then(function(result) {
                            if (result) {
                                setRequest();
                            }
                        });
                    break;

                default :
                    alert('작업대기중');
                    return false;
            }
        }
        // 상태변경 실행
        function setRequest() {
            console.log(data_list);

            $.ajax({
                type : "post",
                url : g5_bbs_url + "/ajax.call_update.php",
                data : data_list,
                dataType : "json",
                async : false,
                success : function(data) {
                    console.log(data);

                    // 헤더 포인트 업데이트
                    getMemberPoint();

                    if (data.result == "F") {
                        getNoti(1, '변경에 실패하였습니다. 다시 시도해 주세요.');
                        return false;

                    } else if (data.result == "CALL_PASS") {
                        getNoti(1, '이미 다른기사에게 배정된 콜 입니다.');
                        $("#request_btn").remove();
                        return false;

                    } else if (data.result == "LACK_POINT") {
                        // 현금콜 & 기사 수락시 20% 포인트 부족
                        getNoti(1, '포인트가 부족합니다.\n(현금콜의 경우 금액의 20%에 해당하는 포인트가 필요합니다.)');
                        $("#request_btn").remove();
                        return false;

                    } else if (data.result == "LACK_POINT2") {
                        // 현금콜 & 기사 완료시 20% 포인트 부족
                        getNoti(1, '포인트가 부족합니다. 포인트충전 후 완료가 가능합니다.\n(현금콜의 경우 금액의 20%에 해당하는 포인트가 필요합니다.)');
                        $("#request_btn").remove();
                        return false;
                    }

                    // 현재 상태 bind
                    document.fcall.cur_status.value = data_list.status;

                    switch (data_list.status) {
                        case "-1" :			// -1) 고객 취소
                            /*$("#cancel-btn").hide();
                            $("#status-btn4").show();
                            $("#myCancelModal").modal("hide");*/
                            location.reload();
                            break;

                        case "1" :			// 1) 기사 수락
                            $("#request_btn").hide();
                            $("#custom-tel").slideDown('800');
                            $("#ongoing_area").show();	// 진행중 버튼영역
                            break;

                        case "2" :			// 2) 기사 진행완료
                            /*$("#ongoing_area").hide();
                            $("#end_btn").show();*/
                            location.reload();
                            break;
                    }

                },
                error : function(xhr,status,error) {
                    getNoti(1, '변경에 실패하였습니다. 다시 시도해 주세요.');
                }
            });
        }

        // 회원포인트 조회
        function getMemberPoint() {
            $.ajax({
                type : "post",
                url : "./ajax.mb_point.php",
                data : {"mb_id" : "<?=$member['mb_id']?>"},
                dataType : "text",
                success : function(result) {
                    $("p#my_pt").html(result);
                }
            });
        }

        //*********************************************
        // 드라이버위치호출 반복실행 등록/해제
        function intervalType(mode) {
            if (mode == 'start') {
                fn_interval = setInterval(driverPosition, 3000);
            } else {
                clearInterval(fn_interval);
            }
        }

        // 드라이버위치호출
        var tst = 0;

        function driverPosition() {
            console.log(tst);

            if (tst == 3) {
                intervalType();
                console.log('end');
            }

            tst++;
        }


        //================================================================
        // 요금직접수정 (직접수정시는 총금액만 변경, 원래금액 필드는 냅두기)
        function changeAmt(mode) {
            var f = document.fcall;
            var amt = parseInt(unComma($('#mod_total').val()));
            var min_amt = 1000;

            amt = (mode == 0)? amt - 1000 : amt + 1000;
            if (amt < min_amt) amt = min_amt;

            $('#mod_total').val(addComma(amt));
        }

        // 요금수정
        function setModifyAmt() {
            var idx = document.fcall.idx.value;
            var mod_total = parseInt(unComma($('#mod_total').val()));
            var ori_price = parseInt(unComma($('#ori_price').val())),	// 원래기본요금
                ori_total = parseInt(unComma($('#ori_total').val()));	// 원래총금액
            var cacl = mod_total - ori_total;	// 차액
            var mod_price = ori_price + cacl;
            var obj = {mode: 'amt_mod', idx : idx, total : mod_total, price : mod_price};
            var success = false;

            if (cacl == 0) {
                getNoti(1, '금액을 수정하세요.');
                return false;
            }

            $.ajax({
                type : "post",
                url : g5_bbs_url + "/ajax.call_update.php",
                data : obj,
                dataType : "json",
                async : false,
                success : function(data) {
                    if (data.result == "T") success = true;
                },
                error : function(xhr,status,error) {
                },
                complete : function() {
                    var msg = "금액수정에 실패하였습니다. 다시 시도해 주세요.";
                    var icon = "error";
                    if (success) {
                        msg = "수정이 완료되었습니다.";
                        icon = "success";
                    }
                    swal("", msg, icon, {button: "확인",}).then(function(result) {
                        location.reload();
                    });
                }
            });

        }

    </script>

    <!-- 취소창 Modal -->
    <div class="modal fade" id="myCancelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">취소사유</h4>
                </div>
                <div class="modal-body"><textarea name="cancel_response" id="cancel_response" class="form-control" style="height:150px;"></textarea></div>
                <div class="modal-foot">
                    <button class="col-xs-12 col-md-12 btn btn-primary" type="button" onclick="request('-1')" style="background:#171717;color:#f2de2b;border:0;padding:13px;font-weight: bold;font-size:1.2em;">취소하기</button>
                </div>
            </div>
        </div>
    </div>

    <!-- 가격상세보기 Modal -->
    <div class="modal fade price_info" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">요금안내</h4>
                </div>
                <div class="modal-body">
                    <dl>
                        <dt>고객이 낼 금액</dt>
                        <dd id="modal-price1"><?=number_format($customPrice)?>원</dd>
                    </dl>
                    <dl>
                        <dt>기사수입</dt>
                        <dd id="total-price1"><?=number_format($driver_sudang)?>원</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

<? if ($amt_modify) { ?>
    <!-- 금액수정 Modal -->
    <div class="modal fade" id="modifyModal" tabindex="-1" role="dialog" aria-labelledby="modifyModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modifyModalLabel">금액수정</h4>
                </div>
                <div class="modal-body" id="point_b">
                    <div class="pb_box row">
                        <div class="col-xs-2"><button type="button" class="btn" onclick="changeAmt(0);">-</button></div>
                        <div class="col-xs-8">
                            <!-- 총금액 -->
                            <input type="text" id="mod_total" class="pb_input" value="<?=number_format($customPrice)?>" readonly>
                            <!-- 기본금액 -->
                            <input type="hidden" id="ori_price" value="<?=$row['call_price']?>">
                            <input type="hidden" id="ori_total" value="<?=$row['call_total_price']?>">
                        </div>
                        <div class="col-xs-2"><button type="button" class="btn" onclick="changeAmt(1);">+</button></div>
                        <div class="col-xs-12" style="margin-top:10px;"><input type="button" class="pb_btn" value="금액수정완료" onclick="setModifyAmt();"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<? } ?>

    <!-- 지도영역 -->
    <div id="map_div"></div>

    <form name="fcall" method="post">
        <input type="hidden" name="idx" value="<?=$idx?>">
        <input type="hidden" name="cur_status" value="<?=$call_status?>">

        <div class="collapse in" id="ft_req">
            <div class="well">
                <ul>
                    <li class="nebi">
                        <div class="route col-xs-8">
                            <div class="loc">출발지까지 0m</div>
                            <div class="loc"><span>요청출발지</span><div class="add1"><?=$start_place?><div class="add2"><?=$startAddress?></div></div></div>
                            <? if ($pass_place != "") { ?>
                                <div class="loc"><span>요청경유지</span><div class="add1"><?=$pass_place?><div class="add2"><?=$passAddress?></div></div></div>
                            <? } ?>
                            <div class="loc"><span>요청도착지</span><div class="add1"><?=$end_place?><div class="add2"><?=$endAddress?></div></div></div>
                        </div>
                        <div class="info col-xs-4 text-right">
                            <span id="distance"><?=$row['call_dist']?>km</span>
                            <p id="time"><?=$row['call_time']?>분</p>
                        </div>
                    </li>
                    <li class="total">
                        <div class="col-xs-6 consign">
                            <!-- 대리콜/탁송콜 -->
                            <span class="<?=$calltype_class[$row['call_type']]?>"><?=$calltype_name[$row['call_type']]?></span>
                            <!-- 톤수 -->
                            <? if ((int)$row['call_5t_price'] > 0) { ?><span>2.5톤이상</span><? } ?>
                            <!-- 경유콜 -->
                            <? if ((int)$row['call_pass_call_price'] > 0) { ?><span>경유콜</span><? } ?>
                            <!-- 가장빠른콜, 환급콜 -->
                            <span><? echo ($row['call_kind'] == "0")? "가장빠른콜" : "환급콜"; ?></span>
                        </div>
                        <div class="col-xs-6 text-right">
                            <dl>
                                <dt>총금액</dt>
                                <dd>
                                    <?=number_format($customPrice)?>원
                                    <? if ($amt_modify) { ?>
                                        <div class="btn_modify" data-toggle="modal" data-target="#modifyModal">금액수정</div>
                                    <? } ?>
                                </dd>
                            </dl>
                        </div>
                    </li>
                    <li><a class="btn btn-success" data-toggle="modal" data-target="#myModal">가격 상세보기</a></li>


                    <!-- 매칭되면 고객전화번호 노출 -->
                    <?
                    $tel_style = "none";
                    if ($member['mb_id'] == $row['mb_id']) $tel_style = "block";
                    else if ((int)$call_status > 0 && $call_status != "") $tel_style = "block";
                    // 완료콜
                    // if ($call_status == "2") $tel_style = "none";
                    ?>
                    <li class="total" id="custom-tel" style="display:<?=$tel_style?>">
                        <div class="col-xs-6 consign"><strong>고객전화번호</strong></div>
                        <div class="col-xs-6 text-right"><?=$row['mb_hp']?></div>
                    </li>

                    <li><?=nl2br($row['call_memo'])?></li>

                </ul>

                <!-- 버튼영역 [S] -->
                <? if ($member['mb_level'] == "2" && $member['mb_id'] == $row['mb_id']) { ?>
                    <!-- 1) 고객 : 요청취소버튼 -->
                    <button class="btn request" type="button" id="cancel-btn" onclick="openCancel()" style="display:<? echo ($call_status == "0")? "block" : "none"; ?>">T대리 취소하기</button>
                <? } ?>

                <!-- 2) 공통 : 취소알림 -->
                <button class="btn state off" type="button" id="status-btn4" style="display:<? echo ($call_status == "-1")? "block" : "none"; ?>">취소됨</button>

                <? if ($request_falg && $call_status == "0") { ?>
                    <!-- 3) 기사 : 요청수락버튼 -->
                    <button class="btn request" type="button" id="request_btn" onclick="request('1')">T대리 수락하기</button>
                <? } ?>

                <!-- 4) 기사 : 요청수락시 진행중 버튼 (기사완료) -->
                <div id="ongoing_area" style="display:<? echo ($member['mb_id'] == $row['driver_id'] && $call_status == "1")? "block" : "none"; ?>">
                    <button class="btn state on" type="button" id="status-btn1" onclick="request('2')">진행중 (진행완료하기)</button>
                    <div class="connect" style="margin-top: 5px;">
                        <a type="button" class="btn" href="tel://<?=$row['mb_hp']?>">고객연결</a>
                        <a type="button" class="btn" href="javascript:getNoti(1, '준비중입니다.');">상황실연결</a>
                    </div>
                </div>

                <!-- 5) 고객 : 요청수락시 진행중 버튼 -->
                <button class="btn state on" type="button" id="status-btn5" style="display:<? echo ($member['mb_id'] == $row['mb_id'] && $call_status == "1")? "block" : "none"; ?>">진행중</button>

                <!-- 6) 기사 : 진행완료 -->
                <button class="btn state off" type="button" id="end_btn" style="display:<? echo ($call_status == "2")? "block" : "none"; ?>">진행완료</button>

                <!-- 버튼영역 [E] -->
            </div>
        </div>

    </form>

<?
include_once(G5_THEME_MOBILE_PATH.'/tail.php');
?>