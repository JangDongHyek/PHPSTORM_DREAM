<?php
$sub_menu = "350100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$g5['title'] = '회원관리';
include_once('./admin.head.php');

// 중복회원가입 부모 회원번호 update
updateParentMbNo();

$sql_common = " from {$g5['member_table']} ";

$sql_search = " where mb_id != 'lets080' AND (mb_level < 10 OR (mb_level = 10 AND mb_status != '헬퍼')) ";
$sql_order_add = "";

// 220921. 헬퍼 소개이력에서 제외한 회원 조회
$block_result = sql_query("SELECT DISTINCT parent_mb_no FROM g5_member_block WHERE helper_no = {$member['mb_no']}");
$result_cnt = sql_num_rows($block_result);
if ($result_cnt > 0) {
    $tmp_arr = [];
    while ($brow = sql_fetch_array($block_result)) {
        $tmp_arr[] = $brow['parent_mb_no'];
    }
    $sql_search .= " AND parent_mb_no NOT IN (" . implode(",", $tmp_arr) . ")";
}


// ***** 검색 *****
// - 이름
if ($stx) {
    $exp = explode(",", preg_replace("/\s+/","", $_GET['stx']));
    $sql_search .= " AND (";
    foreach ($exp AS $key=>$val) {
        $sql_search .= ($key == 0)? "" : " OR ";
        $sql_search .= " {$sfl} LIKE '%{$val}%' ";
    }
    $sql_search .= ") ";
    //$sql_search .= " and ({$sfl} like '{$stx}%') ";
}

// - 나이
if ($s_age1 != "") {
    $s_birth = (date("Y")+1) - $s_age1;
    $s_birth .= "-01-01";
    $sql_search .= " AND mb_birth <= '{$s_birth}' ";
}
if ($s_age2 != "") {
    $e_birth = (date("Y")+1) - $s_age2;
    $e_birth .= "-01-01";
    $sql_search .= " AND mb_birth >= '{$e_birth}' ";
}
// - 지역
// if ($s_city != "") {
// 	$sql_search .= " AND mb_si = '{$s_city}' ";
// }
// - 상세지역
// if ($s_gu != "") {
// 	$gu_list = explode(",", $_GET['s_gu']);
// 	$gu_cnt = (count($gu_list) > 0)? "(".count($gu_list).")" : "";
//
// 	$tmp_str = "";
// 	foreach ($gu_list as $key=>$val) {
// 		$tmp_str .= ($tmp_str != "")? ", '{$val}'" : "'{$val}'";
// 	}
// 	$sql_search .= " AND mb_gu IN ({$tmp_str}) ";
// }
// - 지역 & 상세지역
if (count($_GET['s_city_lst']) > 0) {
    $add_query = [];
    foreach ($_GET['s_city_lst'] AS $key=>$val) {
        if (strpos($_GET['s_gu_lst'][$key], "전체") !== false){
            $add_query[] = "(mb_si = '{$val}')";
        } else {
            $gu_in_str = str_replace(",", "','", $_GET['s_gu_lst'][$key]);
            $gu_in_str = "'{$gu_in_str}'";
            $add_query[] = "(mb_si = '{$val}' AND mb_gu IN ({$gu_in_str}))";
        }
    }
    if (count($add_query) > 0) $sql_search .= " AND ".implode(" OR ", $add_query);
}
// - 키
if ($s_hgt1 != "") {
    $sql_search .= " AND mb_height >= '{$s_hgt1}' ";
}
if ($s_hgt2 != "") {
    $sql_search .= " AND mb_height <= '{$s_hgt2}' ";
}
// - 회원상태
if ($s_swt != "") {
    $sql_search .= " AND mb_switch = '{$s_swt}' ";
}
// - 회원구분
if ($s_lv != "") {
    $sql_search .= " AND mb_status = '{$s_lv}' ";
}

// 카테고리 (여자,남자)
if ($sca != "") {
    $sql_search .= " AND mb_sex = '{$sca}' ";
}
// 카테고리 (일반,숨김)
if ($shd == "Y") {
    $sql_search .= " AND mb_hide = '{$shd}' ";
} else {
    $sql_search .= " AND mb_hide != 'Y' ";
}

// 정렬
if (!$sst) {
    $sst = "mb_datetime";
    $sod = "desc";
}
if ($sst == "mb_last_match") {
    $sql_order_add = ", mb_no {$sod}";

} else if ($sst == "mb_today_login") {    // 최근접속일자
    $sst = "mb_today_login";
    $sod = $_GET['sod'];
}
$sql_order = " order by mb_level ASC, {$sst} {$sod} {$sql_order_add}";

// 페이징
$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);		// 전체 페이지 계산
if ($page < 1) $page = 1;						// 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows;				// 시작 열을 구함


// 블랙/탈퇴회원 공통쿼리
$block_sql = "select count(*) as cnt {$sql_common} {$sql_search} and mb_intercept_date != ''";

// 블랙회원수
$sql = $block_sql." AND mb_status = '블랙'";
$row = sql_fetch($sql);
$intercept_count = $row['cnt'];

// 탈퇴회원수
$sql = $block_sql." AND mb_status = '탈퇴'";
$row = sql_fetch($sql);
$leave_count = $row['cnt'];

// 남자/여자 on/off 수
$sql = "SELECT COUNT(if(mb_sex = '남' AND mb_switch = 'on', 1, null)) AS 'cnt01',
		COUNT(if(mb_sex = '남' AND mb_switch = 'off', 1, null)) AS 'cnt02',
		COUNT(if(mb_sex = '여' AND mb_switch = 'on', 1, null)) AS 'cnt03',
		COUNT(if(mb_sex = '여' AND mb_switch = 'off', 1, null)) AS 'cnt04'
		{$sql_common} {$sql_search} ";
$row = sql_fetch($sql);
$m_on_cnt = $row['cnt01'];
$m_off_cnt = $row['cnt02'];
$fm_on_cnt = $row['cnt03'];
$fm_off_cnt = $row['cnt04'];

// 리스트
$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

////// 회원숨김 권한
$mb_hide_auth = false;
if ($member['mb_id'] == "admin" || $member['mb_id'] == "tncjs2" || $member['mb_id'] == "ssd231" || $member['mb_id'] == "lets080") {
    $mb_hide_auth = true;
}

?>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style>
    .btn_area div {margin-top: 2px; }
    .btn_area div:nth-child(1) {margin: 0;}
    .btn01.hd {background: #ff3061;}

    #sub_loca_area {position: relative; display: inline-block; vertical-align: top; display: none; font-size: 0;}
    #sub_loca_area .lst {position: absolute; top: 0; left: 0;background: #FFF; width: 420px; border: 2px solid #444; padding: 10px;}
    #sub_loca_area .btn_area {margin: 10px 0 0; text-align: center; font-size: 12px;}
    #sub_loca_area #loca_load label {margin: 5px 0; width: 30%; display: inline-block; padding: 0; font-size: 12px;}

    #img_layer {position: fixed; padding: 10px; border: 2px solid #444; z-index: 999; background: #FFF; display: none;}
    #img_layer img {float: left; height: 300px; width: auto; margin-right: 3px;}

    #match_message {display: none;}
    .ui-dialog-buttonpane button {font-weight: bold;}
    .ui-dialog-buttonpane .btn01 {color: #ff7994;}
    .ui-dialog-buttonpane .btn02 {color: #123BE6;}

    #city_add_area {margin: 0; padding: 0; list-style-type: none;}
    #city_add_area li {margin-top: 5px;}
    #city_add_area li > div {background: #FFF; display: inline-block; border: 1px solid #EEE; padding: 4px; font-size: 11px; letter-spacing: -1px;}
    #city_add_area span {display: inline-block; margin: 0;}
    #city_add_area button {display: inline-block; margin: 0; padding: 0; border: 0; background: #444; color: #FFF; width: 15px; line-height: 15px; border-radius: 15px; font-size: 10px;}
    .btn_frmline.gray {background: #999;}
</style>

<div class="local_ov01 local_ov">
    <? /* <a href="<?=$_SERVER['SCRIPT_NAME']?>" class="ov_listall">전체목록</a> */ ?>
    <span class="ov_listall">전체 <?php echo number_format($total_count) ?>명</span>
    <? /*
	<span class="ov_listall">
		<? foreach ($city_cnt as $city=>$val) { ?>
		<?=$city?>(<?=$val?>)
		<? } ?>
	</span>
	*/ ?>
    <span class="ov_listall">블랙 <?=$intercept_count?>명</span>
    <span class="ov_listall">탈퇴 <?=$leave_count?>명</span>
    <span class="ov_listall">남자 ON(<?=$m_on_cnt?>) OFF(<?=$m_off_cnt?>)</span>
    <span>여자 ON(<?=$fm_on_cnt?>) OFF(<?=$fm_off_cnt?>)</span>
</div>

<!-- 검색 -->
<form id="fsearch" name="fsearch" class="local_sch01 local_sch type01" method="get" onsubmit="return getSrch(this);" autocomplete="off">
    <input type="hidden" name="sca" value="<?=$sca?>">
    <input type="hidden" name="shd" value="<?=$shd?>">
    <table>
        <tbody>
        <tr>
            <th>나이</th>
            <td><input type="text" name="s_age1" value="<?=$s_age1?>" class="frm_input f_num2" maxlength="2" size="7"> ~ <input type="text" name="s_age2" value="<?=$s_age2?>" class="frm_input f_num2" maxlength="2" size="7"></td>
            <th>지역</th>
            <td style="max-width: 350px">
                <select name="s_city" onchange="getLocaInit()">
                    <option value="">전체</option>
                    <? foreach ($city_arr as $key=>$city) { ?>
                        <option value="<?=$city?>"><?=$city?></option>
                    <? } ?>
                </select>
                <button type="button" class="frm_input" onclick="getLocaOpen();" id="str_detail">상세지역</button>
                <div id="sub_loca_area">
                    <div class="lst">
                        <div id="loca_load"><!-- load --></div>
                        <div class="btn_area">
                            <p>체크하지 않고 선택완료를 누르시면 '전체'로 추가됩니다.</p>
                            <button type="button" class="btn_frmline" onclick="setGugun();">선택완료</button>
                            <button type="button" class="btn_frmline gray" onclick="getLocaInit()">닫기</button>
                        </div>
                    </div>
                </div>
                <ul id="city_add_area">
                    <?
                    $last_num = 0;
                    foreach ($_GET['s_city_lst'] AS $key=>$val) {
                        $label = $val; // 시도
                        if ($_GET['s_gu_lst'][$key] != "") $label .= "({$_GET['s_gu_lst'][$key]})"; // 구군

                        $last_num = $key+1;
                        ?>
                        <li>
                            <div>
                                <input type="hidden" name="city_num[]" value="<?=$key?>">
                                <input type="hidden" name="s_city_lst[<?=$key?>]" value="<?=$val?>">
                                <input type="hidden" name="s_gu_lst[<?=$key?>]" value="<?=$_GET['s_gu_lst'][$key]?>">
                                <?=$label?> <button type="button" onclick="delCity(this)">-</button>
                            </div>
                        </li>
                    <? } ?>
                </ul>

                <script>
                    // 상세지역 열기
                    function getLocaOpen() {
                        var f = document.fsearch,
                            si = f.s_city.options[f.s_city.selectedIndex].value;

                        if (si == "") {
                            alert("지역을 선택하세요.");
                            f.s_city.focus();
                            return false;
                        }
                        getCity("srch", si);
                    }

                    // 상세지역 조회
                    function getCity(mode, si) {
                        $.ajax({
                            type : "GET",
                            url : "<?php echo G5_PLUGIN_URL?>/address/address.php",
                            dataType : "json",
                            data : {"si": si},
                            success : function(datas){
                                var opt_select = "", opt = "";

                                // 체크박스 초기화
                                $("#loca_load").html("");

                                for(var i = 0; i < datas.length; i++){
                                    var id = "gu" + i;
                                    var chkbox = "<label for='"+ id +"'><input type='checkbox' name='gu[]' id='"+ id +"' value='" + datas[i] + "'> " + datas[i] + "</label>&nbsp;";
                                    $("#loca_load").append(chkbox);
                                }

                                if (mode == "srch") {
                                    $("#sub_loca_area").show();
                                }
                            },
                            error : function(request,status,error){
                                if (mode == "srch") {
                                    alert("상세지역을 불러오는데 실패하였습니다. 다시 시도해 주세요.");
                                }
                            }
                        });
                    }

                    // 상세지역 선택완료
                    let city_num = <?=$last_num?>;
                    function setGugun() {
                        let chkbox = document.querySelectorAll("[name='gu[]']:checked");
                        // if (chkbox.length == 0) {
                        //     alert("선택된 지역이 없습니다.");
                        //     return false;
                        // }

                        let gu_arr = [];
                        for (let i=0; i<chkbox.length; i++) {
                            gu_arr.push(chkbox[i].value);
                        }
                        if (chkbox.length == 0) gu_arr = ['전체'];

                        let si = document.querySelector("[name=s_city]").value;
                        let html = '<li>';
                        html += '<div>';
                        html += '<input type="hidden" name="city_num[]" value="'+ city_num +'">';
                        html += '<input type="hidden" name="s_city_lst['+ city_num +']" value="'+ si +'">';
                        html += '<input type="hidden" name="s_gu_lst['+ city_num +']" value="'+ gu_arr.join(",") +'">';
                        html += si + '('+ gu_arr.join(",") +') '; // ex. 강원(강릉시,삼척시,양양군)
                        html += '<button type="button" onclick="delCity(this)">-</button>';
                        html += '</div>';
                        html += '</li>';

                        $("#city_add_area").append(html);
                        $("#sub_loca_area").hide();
                        city_num++;
                    }

                    // 상세지역 선택 삭제
                    function delCity(el) {
                        if (!confirm("지역을 삭제하시겠습니까?")) return false;

                        let row = $(el).parents("li");
                        row.remove();
                    }

                    // 지역변경시 상세지역 초기화
                    function getLocaInit() {
                        $("input[name='gu[]']").prop("checked", false);
                        $("#sub_loca_area").hide();
                    }
                </script>

                <?/*
				<select name="s_city" onchange="getLocaInit();">
					<option value="">전체</option>
					<? foreach ($city_arr as $key=>$city) { ?>
					<option value="<?=$city?>" <? if ($city == $s_city) echo "selected"; ?>><?=$city?></option>
					<? } ?>
				</select>
				<button type="button" class="frm_input" onclick="getLocaOpen();" id="str_detail">상세지역<?=$gu_cnt?></button>
				<div id="sub_loca_area">
					<div class="lst">
						<div id="loca_load"><!-- load --></div>
						<div class="btn_area">
							<button type="button" class="btn_frmline" onclick="getLocaClose();">선택완료</button>
						</div>
					</div>
				</div>

				<script>
				var slctd_si = "";
				var gu_list = [];		// 상세지역 검색후 배열

				$(function() {
					gu_list = <? echo ($gu_list != "")? json_encode($gu_list) : "[]"; ?>;

					// 상세지역까지 선택후 검색했으면
					if (gu_list.length > 0) {
						var f = document.fsearch,
							si = f.s_city.options[f.s_city.selectedIndex].value;

						getCity("load", si);
					}
				});

				// 상세지역 열기
				function getLocaOpen() {
					var f = document.fsearch,
						si = f.s_city.options[f.s_city.selectedIndex].value;

					if (si == "") {
						alert("지역을 선택하세요.");
						f.s_city.focus();
						return false;
					}

					// 지역(시/도) 정보가 바뀌면 상세지역 새로 Load
					if (si != slctd_si || slctd_si == "") {
						getCity("srch", si);

					} else {
						$("#sub_loca_area").show();
					}
				}

				// 상세지역 조회
				function getCity(mode, si) {
					$.ajax({
						type : "GET",
						url : "<?php echo G5_PLUGIN_URL?>/address/address.php",
						dataType : "json",
						data : {"si": si},
						success : function(datas){
							var opt_select = "", opt = "";

							// 체크박스 초기화
							$("#loca_load").html("");

							for(var i = 0; i < datas.length; i++){
								var checked = "";

								if (gu_list.length > 0) {
									$.each(gu_list, function(index, item) {
										if (item == datas[i]) checked = "checked";
									});
								}

								var id = "gu" + i;
								var chkbox = "<label for='"+ id +"'><input type='checkbox' name='gu[]' id='"+ id +"' value='" + datas[i] + "' "+ checked +"> " + datas[i] + "</label>&nbsp;";
								$("#loca_load").append(chkbox);
							}

							if (mode == "srch") {
								$("#sub_loca_area").show();
							}
						},
						error : function(request,status,error){
							if (mode == "srch") {
								alert("상세지역을 불러오는데 실패하였습니다. 다시 시도해 주세요.");
							}
						},
						complete : function() {
							slctd_si = si;
						}
					});
				}

				// 상세지역 닫기
				function getLocaClose() {
					var leng = $("input[name='gu[]']:checked").length;

					if (leng == 0) {
						$("#str_detail").text("상세지역");
					} else {
						$("#str_detail").text("상세지역("+ leng +")");
					}
					$("#sub_loca_area").hide();
				}

				// 상세지역 선택 (100개까지)
				$(document).on("click", "input[name='gu[]']", function() {
					var leng = $("input[name='gu[]']:checked").length;

					if (leng > 100) {
						alert("최대 100개 지역까지 선택이 가능합니다.");
						return false;
					}
				});

				// 지역변경시 상세지역 초기화
				function getLocaInit() {
					gu_list = [];
					$("input[name='gu[]']").prop("checked", false);
					getLocaClose();
				}
				</script>
                */?>
            </td>
            <th>키</th>
            <td><input type="text" name="s_hgt1" value="<?=$s_hgt1?>" class="frm_input f_num2" maxlength="3" size="7"> ~ <input type="text" name="s_hgt2" value="<?=$s_hgt2?>" class="frm_input f_num2" maxlength="3" size="7"></td>
            <th>정렬</th>
            <td>
                <select name="sst">
                    <option value="mb_datetime" <? if ($sst == "mb_datetime") echo "selected"; ?>>가입일자</option>
                    <option value="mb_last_match" <? if ($sst == "mb_last_match") echo "selected"; ?>>마지막소개</option>
                    <option value="mb_today_login" <? if ($sst == "mb_today_login") echo "selected"; ?>>최근접속일자</option>
                </select>
                <select name="sod">
                    <option value="desc" <? if ($sod == "desc") echo "selected"; ?>>최신순</option>
                    <option value="asc" <? if ($sod == "asc") echo "selected"; ?>>과거순</option>
                </select>
            </td>
        </tr>
        <tr>
            <th>이름</th>
            <td>
                <input type="hidden" name="sfl" value="mb_name">
                <input type="text" name="stx" value="<?=$stx?>" class="frm_input" placeholder="예) 이름,이름,···">
            </td>
            <th>회원상태</th>
            <td>
                <select name="s_swt">
                    <option value="" <? if ($s_swt == "") echo "selected"; ?>>전체</option>
                    <option value="on" <? if ($s_swt == "on") echo "selected"; ?>>on</option>
                    <option value="off" <? if ($s_swt == "off") echo "selected"; ?>>off</option>
                </select>
            </td>
            <th>회원구분</th>
            <td>
                <select name="s_lv">
                    <option value="" <? if ($s_lv == "") echo "selected"; ?>>전체</option>
                    <option value="일반" <? if ($s_lv == "일반") echo "selected"; ?>>일반</option>
                    <option value="블랙" <? if ($s_lv == "블랙") echo "selected"; ?>>블랙</option>
                    <option value="탈퇴" <? if ($s_lv == "탈퇴") echo "selected"; ?>>탈퇴</option>
                </select>
            </td>

        </tr>
        </tbody>
    </table>

    <div class="btn_confirm01 btn_confirm">
        <input type="submit" value="검색" class="btn_submit">
        <input type="button" value="초기화" class="btn_frmline" onclick="location.href='./member_list.php'">
    </div>
</form>
<!-- // 검색 -->

<?php if ($is_admin == 'super') { ?>
    <!-- 카테고리 -->
    <div class="btn_add01 btn_add">
        <ul class="category" id="ca_1">
            <li><a <? if ($sca == "") echo 'class="on"'; ?> data-ca="">전체</a></li>
            <li><a <? if ($sca == "남") echo 'class="on"'; ?> data-ca="남">남자회원</a></li>
            <li><a <? if ($sca == "여") echo 'class="on"'; ?> data-ca="여">여자회원</a></li>
        </ul>

        <? if ($mb_hide_auth) { ?>
            <ul class="category" id="ca_2" style="margin-left: 5px;">
                <li><a <? if ($shd == "") echo 'class="on"'; ?> data-ca="">일반목록</a></li>
                <li><a <? if ($shd == "Y") echo 'class="on"'; ?> data-ca="Y">숨김목록</a></li>
            </ul>
        <? } ?>

        <a href="javascript:void(0);" onclick="getWinPop('myBul', '');">My진행불</a>
        <a href="javascript:void(0);" onclick="getWinPop('map', '');">지도보기</a>
        <a href="./member_form.php" id="member_add">회원등록</a>
    </div>
    <!-- // 카테고리 -->
<?php } ?>

<form name="fmemberlist" id="fmemberlist" action="./member_list_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
    <!--<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">-->
    <input type="hidden" name="token" value="">
    <input type="hidden" id="my_mb_id" value="<?=$member['mb_id']?>">
    <input type="hidden" id="my_grade" value="<?=$member['mb_status']?>">

    <div class="tbl_head02 tbl_wrap mb_tbl">
        <table>
            <caption><?php echo $g5['title']; ?> 목록</caption>
            <colgroup>
                <? if ($member['mb_status'] == "관리자") { ?>
                    <col width="3%">
                <? } ?>
                <col width="6%">
                <col width="6%">
                <col width="6%">
                <col width="5%">
                <col width="6%">
                <col width="">
                <col width="5%">
                <col width="5%">
                <col width="10%">
                <col width="6%">
                <col width="6%">
                <col width="8%">
                <col width="6%">
                <col width="5%">
                <col width="5%">
                <col width="5%">
            </colgroup>
            <thead>
            <tr>
                <? if ($member['mb_status'] == "관리자") { ?>
                    <th scope="col">
                        <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
                    </th>
                <? } ?>
                <th>진행여부</th>
                <th>매칭</th>
                <th>회원사진</th>
                <th>회원구분</th>
                <th>상태</th>
                <th>이름</th>
                <th>성별</th>
                <th>나이</th>
                <th>연락처</th>
                <th>가입일자</th>
                <th>지역</th>
                <th>상세지역</th>
                <th>마지막소개</th>
                <th>특이사항</th>
                <th>중복</th>
                <th>소개이력</th>
            </tr>
            </thead>
            <tbody>
            <?php
            for ($i=0; $row=sql_fetch_array($result); $i++) {

                $bg = 'bg'.($i%2);
                $mb_id = $row['mb_id'];

                // 나이계산
                $mb_age = "-";
                if ($row['mb_birth'] != "") {
                    $mb_age = date("Y") - substr($row['mb_birth'], 0, 4) + 1;
                }

                // 수정화면
                $form_href = "./member_form.php?w=u&amp;mb_id=".$mb_id;
                if ($qstr != "")
                    $form_href .= "&amp;".$qstr;

                // 진행불 조회
                $sql = "SELECT A.*, (SELECT mb_name FROM g5_member WHERE mb_id = A.helper_id) AS helper_name 
				FROM g5_member_match A 
				WHERE A.mb_id = '{$mb_id}' AND A.match_status = '1' ORDER BY A.match_regdate DESC";
                $ing_result = sql_query($sql);
                $ing_cnt = sql_num_rows($ing_result);

                // 관리자체크
                $adm_flag = ($row['mb_level'] == "10")? true : false;

                // (여자)진행여부체크
                $female_ing = false;
                if ($ing_cnt > 0 && $row['mb_sex'] == "여") $female_ing = true;

                // 나의 진행불인지 확인
                $my_ing = false;
                if ($ing_cnt > 0) {
                    foreach ($ing_result as $key=>$val) {
                        if ($val['helper_id'] == $member['mb_id']) $my_ing = true;
                    }
                }

                // 상태 버튼클래스
                $btn_calss = ($row['mb_switch'] == "on")? "btn01" : "btn02";

                // 회원구분
                $stt_css = "";
                if ($row['mb_status'] == "블랙") $stt_css = "style='font-weight:bold;'";
                if ($row['mb_status'] == "탈퇴") $stt_css = "style='font-weight:bold;color:red;'";

                // 중복 (재가입회원)
                $join_cnt = 1;
                if ($row['mb_hp'] != "") {
                    $rejoin = memberRejoinList($row['mb_hp'], $row['mb_birth']);
                    if (count($rejoin) > 0) $join_cnt = count($rejoin);
                }
                ?>
                <tr class="<?php echo $bg; ?>">
                    <? if ($member['mb_status'] == "관리자") { ?>
                        <td>
                            <input type="hidden" name="mb_id[<?php echo $i ?>]" value="<?=$mb_id?>" id="mb_id_<?php echo $i ?>">
                            <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
                        </td>
                    <? } ?>
                    <td class="btn_area">
                        <?
                        if (!$adm_flag) {
                        if ($ing_cnt == 0) {
                            ?>
                            <!-- 진행등록 -->
                            <div><button type="button" class="btn02" onclick="setMatchIng('<?=$mb_id?>', '', 0);">등록</button></div>
                            <?
                        } else {
                        foreach ($ing_result as $key=>$val) {
                        $btn_cls = ($val['match_type'] == "1")? "btn04": "btn03";

                        ?>
                        <!-- 진행해제 -->
                        <div><button type="button" class="<?=$btn_cls?>" onclick="setMatchIng('<?=$mb_id?>', '<?=$val['helper_id']?>', '<?=$val['match_status']?>', '<?=$val['idx']?>');">&#10084; <?=$val['helper_name']?></button><div>
                                <?
                                } // end foreach

                                if ($row['mb_sex'] == "남") {
                                ?>
                                <!-- 남자회원은 여러명의 헬퍼가 진행등록가능 -->
                                <div><button type="button" class="btn02" onclick="setMatchIng('<?=$mb_id?>', '', 0);">등록</button><div>
                                        <?
                                        }
                                        } // end if
                                        }
                                        ?>
                    </td>
                    <td>
                        <?
                        // 진행여부 등록한 헬퍼만 매칭가능
                        if (!$adm_flag) {
                            $event_match = ($my_ing)? "getWinPop('matching', '{$mb_id}');" : "alert('진행중인 회원이 아닙니다.');";
                            ?>
                            <button type="button" class="btn01" onclick="<?=$event_match?>">매칭</button>
                        <? } ?>
                    </td>
                    <td><? if (!$adm_flag) { ?><a class="btn01 btn_member_img" data-id="<?=$row['mb_id']?>">사진</a><? } ?></td>
                    <td><span <?=$stt_css?>><?=$row['mb_status']?></span></td>
                    <td><button type="button" class="<?=$btn_calss?>" onclick="memberSwitch('<?=$row['mb_id']?>', '<?=$row['mb_switch']?>');"><?=$row['mb_switch']?></button></td>
                    <td>
                        <? if ($row['mb_hide'] == "Y") echo "<strong class='btn01 hd'>숨김</strong>"; ?>
                        <a href="javascript:void(0);" onclick="getWinPop('profile', '<?=$form_href?>');"><?=$row['mb_name']?></button>
                    </td>
                    <td><?=$row['mb_sex']?></td>
                    <td><?=$mb_age?></td>
                    <td><?=$row['mb_hp']?></td>
                    <td><?=substr($row['mb_datetime'], 2, 8)?></td>
                    <td><?=$row['mb_si']?></td>
                    <td><?=$row['mb_gu']?></td>
                    <td><?=substr($row['mb_last_match'], 2, 8)?></td>
                    <td><? if (!$adm_flag) { ?><button type="button" class="btn01" onclick="getWinPop('memo', '<?=$row['mb_id']?>');">보기</button><? } ?></td>
                    <td>
                        <? if ($join_cnt > 1) { ?>
                            <button type="button" class="btn01" onclick="getWinPop('rejoin', '<?=$row['mb_id']?>');">보기</button>
                        <? } ?>
                    </td>
                    <td><? if (!$adm_flag) { ?><button type="button" class="btn01" onclick="getWinPop('list', '<?=$row['mb_id']?>');">보기</button><? } ?></td>
                </tr>
                <?php
            }
            if ($i == 0)
                echo "<tr><td colspan='20' class=\"empty_table\">조회된 회원이 없습니다.</td></tr>";
            ?>
            </tbody>
        </table>
    </div>

    <? if ($mb_hide_auth) { ?>
        <div class="btn_list01 btn_list">
            <!--<input type="submit" name="act_button" value="선택수정" onclick="document.pressed=this.value">-->
            <input type="submit" name="act_button" value="선택숨김" onclick="document.pressed=this.value">
            <input type="submit" name="act_button" value="선택복귀" onclick="document.pressed=this.value">
        </div>
    <? } ?>

</form>

<!-- paging -->
<?php
$paging_params = get_paging_params($qstr);
echo get_paging($config['cf_write_pages'], $page, $total_page, '?'.$paging_params.'&amp;page=');
?>
<!-- // paging -->

<!-- 팝업레이어 -->
<div id="img_layer"></div>

<!-- 진행불팝업 -->
<div id="match_message" title="진행여부">
    진행 하시겠습니까?
</div>

<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(function() {
        // 카테고리 (전체, 남/녀)
        $("#ca_1 a").on("click", function() {
            var sca = $(this).data("ca"),
                f = document.fsearch;
            f.sca.value = sca;
            getSrch(f);
        });

        // 카테고리 (일반, 숨김)
        $("#ca_2 a").on("click", function() {
            var shd = $(this).data("ca"),
                f = document.fsearch;
            f.shd.value = shd;
            getSrch(f);
        });


        getMoveScroll();

        $("#img_layer").on("mouseover", function(e) {
            $(this).hide();
        });

        // 회원사진 보기
        $(".btn_member_img").on("mouseover", function(e) {
            var mb_id = $(this).data("id"),
                left = $(this).offset().left,	//e.clientX + 15,
                top = e.clientY;

            $.ajax({
                type : "get",
                url : "./ajax.member_img_prev.php",
                data : {"mb_id" : mb_id},
                dataType : "html",
                success : function(data) {
                    $("#img_layer").html(data);
                },
                error : function(xhr,status,error) {
                    $("#img_layer").html("실패");
                },
                complete : function() {
                    $("#img_layer").css({
                        "top": top,
                        "left": left
                    }).show();
                }
            });

        }).on("mouseleave", function() {
            $("#img_layer").hide().html("");

        });

    });

    // 새창팝업
    function getWinPop(mode, mb_id) {
        var pop_w = 700, pop_h = 600, url = "", title = "연인";

        switch (mode) {
            case "profile" :	// 회원프로필
                url = mb_id;
                pop_w = 1200;
                pop_h = 800;
                title = "회원프로필";
                break;

            case "matching" :  // 매칭하기
                url = g5_admin_url + "/matching.php?mb_id=" + mb_id;
                title = "매칭하기";
                break;

            case "list" :		// 소개이력
                pop_w = 750;
                url = g5_admin_url + "/matching_list_pop.php?mb_id=" + mb_id + "&re=all";
                title = "소개이력";
                break;

            case "memo" :		// 특이사항
                url = g5_admin_url + "/member_memo.php?mb_id=" + mb_id;
                title = "특이사항";
                break;

            case "map" :		// 지도
                url = g5_admin_url + "/map.php";
                title = "지도";
                break;

            case "myBul" :		// My진행불
                url = g5_admin_url + "/my_matching.php";
                title = "My진행불";
                break;

            case "rejoin" :		// 중복(재가입정보)
                url = g5_admin_url + "/member_rejoin.php?mb_id=" + mb_id;
                title = "중복가입이력";
                break;
        }

        var left = Math.floor((window.innerWidth - pop_w) / 2),
            top = Math.floor((window.innerHeight - pop_h) / 2);

        var ts = new Date().getTime();
        title += " " + ts;

        window.open(url, title,"width="+pop_w+"px,height="+pop_h+"px,top="+top+",left="+left+",scrollbars=yes");
    }

    // 검색
    function getSrch(f) {
        var url = g5_admin_url + "/member_list.php",
            obj = {},
            params = "";

        if (f.s_age1.value != "") {
            obj.s_age1 = f.s_age1.value;
        }

        if (f.s_age2.value != "") {
            obj.s_age2 = f.s_age2.value;
        }

        // if (f.s_city.value != "") {
        // 	obj.s_city = f.s_city.options[f.s_city.selectedIndex].value;
        // }

        if (f.s_hgt1.value != "") {
            obj.s_hgt1 = f.s_hgt1.value;
        }

        if (f.s_hgt2.value != "") {
            obj.s_hgt2 = f.s_hgt2.value;
        }

        if (f.sst.value != "") {
            obj.sst = f.sst.options[f.sst.selectedIndex].value;
        }

        if (f.sod.value != "") {
            obj.sod = f.sod.options[f.sod.selectedIndex].value;
        }

        if (f.stx.value != "") {
            obj.sfl = f.sfl.value;
            obj.stx = f.stx.value;
        }

        if (f.s_swt.value != "") {	// 회원상태
            obj.s_swt = f.s_swt.options[f.s_swt.selectedIndex].value;
        }

        if (f.s_lv.value != "") {	// 회원구분
            obj.s_lv = f.s_lv.options[f.s_lv.selectedIndex].value;
        }

        if (f.sca.value != "") {    // 남자회원,여자회원
            obj.sca = f.sca.value;
        }

        if (f.shd.value != "") {    // 일반목록,숨김목록
            obj.shd = f.shd.value;
        }

        for (key in obj) {
            if (params != "") params += "&";
            params += key + "=" + obj[key];
        }

        // 상세지역 체크박스
        // var gu_chk = document.getElementsByName("gu[]"),
        // 	gu_list = "";
        // for (var i = 0; i < gu_chk.length; i++) {
        // 	if (gu_chk[i].checked == true) {
        // 		gu_list += (gu_list != "")? "," : "";
        // 		gu_list += gu_chk[i].value;
        // 	}
        // }
        // if (gu_list != "") params += "&s_gu=" + gu_list;

        // 지역
        let nums = document.querySelectorAll("[name='city_num[]']");
        let city_params = [];
        for (let i=0; i<nums.length;i++) {
            let n = nums[i].value;
            let str = "s_city_lst["+n+"]=";
            str += document.querySelector("[name='s_city_lst["+ n +"]']").value;
            str += "&s_gu_lst["+n+"]=";
            str += document.querySelector("[name='s_gu_lst["+ n +"]']").value;
            city_params.push(str);
        }
        if (city_params.length > 0) params += "&" + city_params.join("&");

        if (params != "") url += "?" + params;
        location.href = url;

        return false;
    }

    // 상태전환
    function memberSwitch(mb_id, flag) {
        $.ajax({
            type : "POST",
            url : "./ajax.member_update.php",
            data : {"mb_id" : mb_id, "flag" : flag, "mode" : "switch"},
            dataType : "text",
            success : function(data) {
                getMoveScroll("on");
            },
            error : function(xhr,status,error) {
                alert("상태전환에 실패하였습니다. 다시 시도해 주세요.");
            }
        });
    }


    // 진행여부등록(진행불)
    function setMatchIng(mb_id, helper_id, stt, idx) {
        var my_id = document.getElementById("my_mb_id").value,
            my_grade = document.getElementById("my_grade").value,
            proc = false;

        if (parseInt(stt) == 1) {		// 1) 진행해제
            if (my_id != helper_id) {	// 1.1) 본인 진행아님
                if (my_grade == "헬퍼") {
                    alert("본인의 진행만 해제가 가능합니다.");
                } else if (my_grade == "관리자") {
                    if (confirm("본인의 진행만 해제가 가능합니다.\n관리자의 권한으로 해제하시겠습니까?") == true) {
                        proc = true;
                    }
                }
            } else {					// 1.2) 본인진행
                if (confirm("진행을 해제하시겠습니까?") == true) {
                    proc = true;
                }
            }
        } else {						// 2) 진행등록
            $('#match_message').dialog({
                modal: true,
                buttons: {
                    "기존": function() { newMatchIng(mb_id, helper_id, 0); },
                    "신규": function() { newMatchIng(mb_id, helper_id, 1); },
                    "닫기": function() { $(this).dialog('close'); }
                },
                open: function() {
                    $('.ui-dialog-buttonpane').find('button:contains("기존")').addClass('btn01');
                    $('.ui-dialog-buttonpane').find('button:contains("신규")').addClass('btn02');
                }
            });
            // if (confirm("진행 하시겠습니까?") == true) {
            // 	proc = true;
            // }
        }

        if (proc) {
            $.ajax({
                type : "POST",
                url : "./ajax.member_match_ing.php",
                data : {"mb_id" : mb_id, "idx" : idx, "stt" : stt, "helper_id" : helper_id},
                dataType : "json",
                success : function(data) {
                    if (data.result == "T") {
                        //console.log("매칭완료");
                        location.reload();
                    } else {
                        alert(data.msg);
                    }
                },
                error : function(xhr,status,error) {
                    alert("진행여부 변경에 실패하였습니다. 다시 시도해 주세요.");
                    //location.reload();
                }
            });
        } else {
            return false;
        }
    }

    // 진행등록 추가 (기존/신규로 구분)
    function newMatchIng(mb_id, helper_id, type) {
        $.ajax({
            type : "POST",
            url : "./ajax.member_match_ing.php",
            data : {"mb_id" : mb_id, "stt" : 0, "helper_id" : helper_id, "match_type": type},
            dataType : "json",
            success : function(data) {
                if (data.result == "T") { location.reload(); }
                else { alert(data.msg); }
            },
            error : function(xhr,status,error) {
                alert("진행여부 변경에 실패하였습니다. 다시 시도해 주세요.");
            },
            complete : function() {
                $("#match_message").dialog('close');
            }
        });
    }

    function fmemberlist_submit(f)
    {
        var flag = false;

        if (!is_checked("chk[]")) {
            alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
            return false;
        }

        /*
        if(document.pressed == "선택삭제") {
            if(!confirm("선택한 회원정보를 삭제하시겠습니까?\n삭제된 자료는 복구되지 않습니다.")) {
                return false;
            }
        }
        */

        if(document.pressed == "선택숨김") {
            if(!confirm("선택한 회원정보를 숨김처리 하시겠습니까?")) {
                return false;
            } else {
                flag = "hide";
            }
        }
        if(document.pressed == "선택복귀") {
            if(!confirm("선택한 회원정보를 복귀처리 하시겠습니까?")) {
                return false;
            } else {
                flag = "show";
            }
        }

        if (flag != false) {
            var chk = document.getElementsByName("chk[]"),
                id_list = [];

            for (var i=0; i<chk.length; i++) {
                if (chk[i].checked) {
                    var no = chk[i].value,
                        mb_id = document.getElementById("mb_id_"+no).value;
                    id_list.push(mb_id);
                }
            }

            $.ajax({
                type : "POST",
                url : "./ajax.member_update.php",
                data : {"mb_id" : id_list, "flag" : flag, "mode" : "hide"},
                dataType : "text",
                success : function(data) {
                    location.reload();
                },
                error : function(xhr,status,error) {
                    alert(document.pressed + "에 실패하였습니다. 다시 시도해 주세요.");
                }
            });

            return false;
        }

        return false;
        //return true;
    }
</script>

<?php
include_once ('./admin.tail.php');
?>
