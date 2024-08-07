<?php
$pid = "admin";
$subPid = "driver";

/* 기본 셋팅 */
include_once("../app/app_head.php");
include_once("./admin_head.php");

/* GET - init */
$searchType = empty($_GET['searchType'])? '' : $_GET['searchType'];
$searchTxt = empty($_GET['searchTxt'])? '' : $_GET['searchTxt'];
$page = empty($_GET['page'])? 1 : $_GET['page'];
$pagingCount = 15;

$pageData = [
    'searchType' => $searchType,
    'searchTxt' => $searchTxt,
    'page' => $page,
    'pagingCount' => $pagingCount
];

/* LIST - init */
include_once("./util/cmmList.php");

$listData = getDriverList($pageData);

$list = $listData['list'];
$totalCount = $listData['totalCount'];

?>

<div id="admcent">
    <? include_once('./inc/head.php'); ?>

    <div class="wrap">
        <div class="cate flex">
            <form id="formSearch" action="./driver.php" method="GET">
                <input type="hidden" name="page" value="<?=$page?>" />
                <div class="select">
                    <!--
                        <? foreach(StatusCode as $key => $data){ ?>
                            <input type="radio" id="select<?=$key?>" name="statusCode" <?=$data['code'] == $statusCode? 'checked' : ''?>>
                            <label for="select<?=$key?>"><?=$data['name']?></label>
                        <? } ?>                        
-->
                    <button type="button" class="btn-plus" onclick="openDriverModal()">기사등록</button>
                    <button type="button" class="btn-del" onclick="excelUpload()">기사일괄등록(엑셀업로드.xlsx)</button>
                    <input type="hidden" id="excelMode" value="driver" />
                    <input type="file" id="excelFile" class="hide" accept=".xlsx" />
                    <!--                        <button type="button" class="btn-del">선택삭제</button>-->
                </div>
                <div class="select2">
                    <select name="searchType">
                        <?
                                /* 검색 필드값(searchType) 배열처리 */
                                $searchTypeArr = [
                                    ['code' => "M.driver_car_number", 'name' => "차량번호"],
                                    ['code' => "M.mb_name", 'name' => "이름"],                                    
                                    ['code' => "M.mb_hp", 'name' => "연락처"],
                                    ['code' => "M.mb_id", 'name' => "아이디"],
                                    ['code' => "M.driver_member_key", 'name' => "회원키"],
                                ];
                            ?>
                        <? foreach($searchTypeArr as $key => $data){ ?>
                        <option value="<?=$data['code']?>" <?=$searchType == $data['code']? 'selected' : ''?>><?=$data['name']?></option>
                        <? } ?>
                    </select>
                    <p>
                        <input type="text" id="searchTxt" name="searchTxt" placeholder="검색어를 입력하세요." value="<?=$searchTxt?>">
                    </p>
                    <button type="submit" class="btn-srch">
                        <i class="fa-light fa-magnifying-glass"></i>
                    </button>
                </div>
            </form>
        </div>
        <!-- Button trigger modal -->
        <div class="table">
            <table id="table_id" class="display">
                <colgroup>
                    <!--                    	<col width="10px">-->
                    <col width="50px">
                    <!--                    	<col width="100px">-->
                    <col width="100px">
                    <col width="200px">
                    <col width="100px">
                    <col width="150px">
                    <col width="">
                    <col width="50px">
                    <col width="50px">
                    <col width="50px">
                </colgroup>
                <thead>
                    <tr>
                        <!--							<th><input type="checkbox" name="" value=""></th>-->
                        <th>No.</th>
                        <!--							<th>상태</th>-->
                        <th>이름</th>
                        <th>연락처</th>
                        <th>아이디</th>
                        <th>차량번호</th>
                        <th>회원키</th>
                        <th>운행기록</th>
                        <th>기타</th>
                        <th>기타</th>
                    </tr>
                </thead>
                <tbody>
                    <? foreach($list as $key => $data){ ?>
                    <tr>
                        <!--                                <td><input type="checkbox" name="" value=""></td>-->
                        <td><?=getTableNumber($page, $pagingCount, $key)?></td>
                        <!--
                                <td>
                                    <span class="ty2">배차</span>
                                    <span class="ty4">대기</span>
                                </td>
-->
                        <td><?=$data['mb_name']?></td>
                        <td><?=telNoHyphen($data['mb_hp'])?></td>
                        <td><?=$data['mb_id']?></td>
                        <td><?=$data['driver_car_number']?></td>
                        <td><?=$data['driver_member_key']?></td>
                        <td><button type="button" class="btn-4" onclick="openRecordModal('delivery', '<?=$data['mb_name']?>', '<?=$data['mb_id']?>')">확인</button></td>
                        <td><button type="button" class="btn-3" onclick='openDriverModal(<?=json_encode($data)?>)'>수정</button></td>
                        <td><button type="button" class="btn-5" onclick="removeData('g5_member', '<?=$data['idx']?>')">삭제</button></td>
                    </tr>
                    <? 
                          } 
                       ?>
                </tbody>
            </table>
        </div>
        <? include_once('./inc/page.php'); ?>
    </div>
</div>
</div>


<!-- driverModal 기사 추가/수정 -->
<input type="hidden" id="driver_setting_type" value="" />

<div class="modal fade" id="driver_modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-body">
                <h5 id="driver_title">기사등록</h5>
                <table border="0" width="100%">
                    <colgroup>
                        <col width="100px">
                        <col width="*">
                    </colgroup>
                    <tr>
                        <th>아이디</th>
                        <td><input type="text" id="driver_id" placeholder="아이디"></td>
                    </tr>
                    <tr>
                        <th>비밀번호</th>
                        <td><input type="text" id="driver_password" placeholder="비밀번호" value=""></td>
                    </tr>
                    <tr>
                        <th>이름</th>
                        <td><input type="text" id="dirver_name" placeholder="이름" value=""></td>
                    </tr>
                    <tr>
                        <th>연락처</th>
                        <td><input type="text" id="driver_hp" placeholder="연락처" onkeyup="setHyphen($(this));" maxlength="13"></td>
                    </tr>
                    <tr>
                        <th>차량번호</th>
                        <td><input type="text" id="driver_car_number" placeholder="차량번호" value=""></td>
                    </tr>
                    <tr>
                        <th>memberkey<br>(*기사님의 실시간 위치정보)</th>
                        <td><input type="text" id="driver_member_key" placeholder="memberkey를 입력하세요."></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="saveDriver()">저장</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
            </div>
        </div>
    </div>
</div>

<script>
    // 기사정보 모달오픈
    function openDriverModal(data = {}) {

        let settingType = isEmptyObj(data) ? 'insert' : 'update', // data가 빈 객체면 insert
            isInsert = settingType == 'insert',
            $driver_id = $('#driver_id');

        $('#driver_title').text(isInsert ? '기사등록' : '기사수정');
        $('#driver_setting_type').val(settingType);
        $driver_id.val(isInsert ? '' : data.mb_id);
        $('#driver_password').val(isInsert ? '' : data.mb_password);
        $('#dirver_name').val(isInsert ? '' : data.mb_name);
        $('#driver_hp').val(isInsert ? '' : telNoHypen(data.mb_hp));
        $('#driver_car_number').val(isInsert ? '' : data.driver_car_number);
        $('#driver_member_key').val(isInsert ? '' : data.driver_member_key);

        // 수정이면 아이디 수정금지
        $driver_id.attr('readonly', !isInsert);
        $('#driver_modal').modal('show');
        dealyFocus($driver_id);
    }

    // 기사 등록/수정
    async function saveDriver() {
        let $driver_id = $('#driver_id'), // 기사 아이디
            $driver_password = $('#driver_password'), // 기사 비밀번호
            $dirver_name = $('#dirver_name'), // 기사 이름
            $driver_hp = $('#driver_hp'), // 기사 연락처
            $driver_car_number = $('#driver_car_number'), // 기사 차량번호
            $driver_member_key = $('#driver_member_key'), // 기사 memberkey
            settingType = $('#driver_setting_type').val(),
            falseMsg = '',
            target = null;

        if (!$driver_id.val()) {
            falseMsg = '아이디를 입력해주세요.';
            target = $driver_id;
        } else if (!$driver_password.val()) {
            falseMsg = '비밀번호를 입력해주세요.';
            target = $driver_password;
        } else if (!$dirver_name.val()) {
            falseMsg = '이름을 입력해주세요.';
            target = $dirver_name;
        } else if (!$driver_hp.val()) {
            falseMsg = '연락처를 입력해주세요.';
            target = $driver_hp;
        } else if (!$driver_car_number.val()) {
            falseMsg = '차량번호를 입력해주세요.';
            target = $driver_car_number;
        } else if (!$driver_member_key.val()) {
            falseMsg = 'memberkey를 입력해주세요.';
            target = $driver_member_key;
        }

        if (target != null) {
            swal(falseMsg)
                .then(() => {
                    target.focus();
                });
            return;
        }

        const saveDriverRes = await postJson(getAjaxUrl('admin'), {
            mode: 'saveDriver',
            settingType: settingType,
            driver_id: $driver_id.val(),
            driver_password: $driver_password.val(),
            dirver_name: $dirver_name.val(),
            driver_hp: unHypen($driver_hp.val()),
            driver_car_number: $driver_car_number.val(),
            driver_member_key: $driver_member_key.val()
        });

        if (!saveDriverRes.result) {
            swal(saveDriverRes.msg);
            return false;
        }

        swal('저장되었습니다.')
            .then(() => {
                location.replace('./driver.php');
            });
    }

    function defaultSetup() {
        $('#table_id').DataTable({
            // 페이징 기능 숨기기
            paging: false,
            // 표시 건수기능 숨기기
            lengthChange: false,
            // 검색 기능 숨기기
            searching: false,
            // 정렬 기능 숨기기
            ordering: false,

            // 정보 표시 숨기기
            info: false,
            "oLanguage": {
                "sEmptyTable": "배송기사 회원이 존재하지않습니다."
            }
        });

        dealyFocus($('#searchTxt'), 0);
    }

    $(function() {
        defaultSetup();
    });
</script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>



<?php include_once("./admin_modal.php") ?>


<?php
include_once ("../app/tail.sub.php");
?>