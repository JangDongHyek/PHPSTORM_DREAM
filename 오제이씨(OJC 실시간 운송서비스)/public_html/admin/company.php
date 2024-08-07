<?php
$pid = "admin";
$subPid = "company";

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

$listData = getCompanyList($pageData);

$list = $listData['list'];
$totalCount = $listData['totalCount'];

?>

<div id="admcent">
    <? include_once('./inc/head.php'); ?>
    <div class="wrap">
        <div class="cate flex">
            <div class="select">
                <button type="button" class="btn-plus" onclick="openCompanyModal()">업체등록</button>
                <button type="button" class="btn-del" onclick="excelUpload()">업체일괄등록(엑셀업로드.xlsx)</button>
                <input type="hidden" id="excelMode" value="company" />
                <input type="file" id="excelFile" class="hide" accept=".xlsx" />
                <!--					<button type="button" class="btn-del">선택삭제</button>-->
            </div>
            <form id="formSearch" action="./company.php" method="GET">
                <input type="hidden" name="page" value="<?=$page?>" />
                <div class="select2">
                    <select name="searchType">
                        <?
                            /* 검색 필드값(searchType) 배열처리 */
                            $searchTypeArr = [
                                ['code' => "M.mb_company_name", 'name' => "상호"],
                                ['code' => "M.mb_name", 'name' => "담당자"],
                                ['code' => "M.mb_hp", 'name' => "연락처"],
                                ['code' => "M.mb_company_number", 'name' => "사업자등록번호"],                                    
                                ['code' => "M.mb_company_tel", 'name' => "업체대표번호"],                                      
                                ['code' => "M.mb_company_email", 'name' => "이메일"],
                                ['code' => "M.mb_addr", 'name' => "주소지"],
                                ['code' => "M.mb_id", 'name' => "아이디"]
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
                    <!--									<col width="10px">-->
                    <col width="50px">
                    <col width="">
                    <col width="">
                    <col width="">
                    <col width="">
                    <col width="">
                    <col width="">
                    <col width="">
                    <col width="">
                    <col width="50px">
                    <col width="50px">
                    <col width="50px">
                </colgroup>
                <thead>
                    <tr>
                        <!--							<th><input type="checkbox" name="" value=""></th>-->
                        <th>No.</th>
                        <th>상호</th>
                        <th>아이디</th>
                        <th>사업자등록번호</th>
                        <th>업체 대표번호</th>
                        <th>담당자</th>
                        <th>연락처</th>
                        <th>이메일</th>
                        <th>주소지</th>
                        <th>납품기록</th>
                        <th>기타</th>
                        <th>기타</th>
                    </tr>
                </thead>
                <tbody>
                    <? foreach($list as $key => $data){ ?>
                    <tr>
                        <!--                                <td><input type="checkbox" name="" value=""></td>-->
                        <td><?=getTableNumber($page, $pagingCount, $key)?></td>
                        <td><?=$data['mb_company_name']?></td>
                        <td><?=$data['mb_id']?></td>
                        <td><?=bizNoHyphen($data['mb_company_number'])?></td>
                        <td><?=telNoHyphen($data['mb_company_tel'])?></td>
                        <td><?=$data['mb_name']?></td>
                        <td><?=telNoHyphen($data['mb_hp'])?></td>
                        <td><?=$data['mb_company_email']?></td>
                        <td><?=$data['mb_addr']?> <?=$data['mb_addr_detail']?></td>
                        <td><button type="button" class="btn-4" onclick="openRecordModal('company', '<?=$data['mb_company_name']?>', '<?=$data['mb_id']?>')">확인</button></td>
                        <td><button type="button" class="btn-3" onclick='openCompanyModal(<?=json_encode($data)?>)'>수정</button></td>
                        <td><button type="button" class="btn-5" onclick="removeData('g5_member', '<?=$data['idx']?>')">삭제</button></td>
                    </tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
        <? include_once('./inc/page.php'); ?>
    </div>
</div>
</div>

<!-- companyModal 업체 관리 -->

<input type="hidden" id="company_setting_type" value="" />

<div class="modal fade" id="companyModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div id="companyModalBody" class="modal-body">
                <h5 id="company_title">정보 수정</h5>
                <table border="0" width="100%">
                    <colgroup>
                        <col width="100px">
                        <col width="*">
                    </colgroup>
                    <tr>
                        <th>아이디</th>
                        <td><input type="text" id="mb_id" value="" placeholder="아이디"></td>
                    </tr>
                    <tr>
                        <th>비밀번호</th>
                        <td><input type="text" id="mb_password" value="" placeholder="비밀번호"></td>
                    </tr>
                    <tr>
                        <th>상호</th>
                        <td><input type="text" id="mb_company_name" placeholder="상호명를 입력하세요."></td>
                    </tr>
                    <tr>
                        <th>대표번호</th>
                        <td><input type="text" id="mb_company_tel" placeholder="대표번호를 입력하세요." onkeyup="setHyphen($(this));"></td>
                    </tr>
                    <tr>
                        <th>사업자등록번호</th>
                        <td><input type="text" id="mb_company_number" placeholder="사업자등록번호를 입력하세요." onkeyup="setBizNoHyphen($(this))" maxlength="12"></td>
                    </tr>
                    <tr>
                        <th>대표이메일</th>
                        <td><input type="email" id="mb_company_email" placeholder="대표이메일을 입력하세요."></td>
                    </tr>
                    <tr>
                        <th>주소</th>
                        <td>
                            <input type="text" id="mb_addr" placeholder="주소검색" onclick="openDaumPostcode($('#mb_zip_code'), $('#mb_addr'), $('#mb_addr_detail'), $('#mb_lat'), $('#mb_lng'))" style="cursor: pointer" readonly>
                        </td>
                        <input type="hidden" id="mb_zip_code" value="">
                        <input type="hidden" id="mb_lat" value="">
                        <input type="hidden" id="mb_lng" value="">
                    </tr>
                    <tr>
                        <th>상세주소</th>
                        <td><input type="text" id="mb_addr_detail" placeholder="주소지를 입력하세요."></td>
                    </tr>
                    <tr>
                        <th>담당자 성함</th>
                        <td><input type="text" id="mb_name" placeholder="담당자 성함을 입력하세요."></td>
                    </tr>
                    <tr>
                        <th>담당자 전화번호</th>
                        <td><input type="text" id="mb_hp" placeholder="담당자 전화번호를 입력하세요." onkeyup="setHyphen($(this));"></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="saveCompany()">저장</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
            </div>
        </div>
    </div>
</div>


<script>
    function openCompanyModal(data = {}) {
        let settingType = isEmptyObj(data) ? 'insert' : 'update', // data가 빈 객체면 insert
            isInsert = settingType == 'insert',
            $mb_id = $('#mb_id');

        $('#company_title').text(isInsert ? '업체등록' : '업체수정');
        $('#company_setting_type').val(settingType);

        $mb_id.val(isInsert ? '' : data.mb_id);
        $('#mb_password').val(isInsert ? '' : data.mb_password);
        $('#mb_company_name').val(isInsert ? '' : data.mb_company_name);
        $('#mb_company_tel').val(isInsert ? '' : telNoHypen(data.mb_company_tel));
        $('#mb_company_number').val(isInsert ? '' : bizNoHyphen(data.mb_company_number));
        $('#mb_company_email').val(isInsert ? '' : data.mb_company_email);
        $('#mb_addr').val(isInsert ? '' : data.mb_addr);
        $('#mb_zip_code').val(isInsert ? '' : data.mb_zip_code);
        $('#mb_lat').val(isInsert ? '' : data.mb_lat);
        $('#mb_lng').val(isInsert ? '' : data.mb_lng);
        $('#mb_addr_detail').val(isInsert ? '' : data.mb_addr_detail);
        $('#mb_name').val(isInsert ? '' : data.mb_name);
        $('#mb_hp').val(isInsert ? '' : telNoHypen(data.mb_hp));

        // 수정이면 아이디 수정금지
        $mb_id.attr('readonly', !isInsert);

        dealyScrollTop($('#companyModalBody'));
        $('#companyModal').modal('show');
        dealyFocus($mb_id);
    }

    async function saveCompany() {
        let $mb_id = $('#mb_id'), // 아이디
            $mb_password = $('#mb_password'), // 비밀번호
            $mb_company_name = $('#mb_company_name'), // 회사명
            $mb_company_tel = $('#mb_company_tel'), // 대표번호
            $mb_company_number = $('#mb_company_number'), // 사업자등록번호
            $mb_company_email = $('#mb_company_email'), // 이메일
            $mb_addr = $('#mb_addr'), // 기본주소
            $mb_addr_detail = $('#mb_addr_detail'), // 상세주소
            $mb_name = $('#mb_name'), // 담당자 성함
            $mb_hp = $('#mb_hp'), // 담당자 전화번호
            settingType = $('#company_setting_type').val(),
            target = null,
            falseMsg = '';

        /* 유효성 검사 */
        if (!$mb_id.val()) {
            falseMsg = "아이디를 입력해주세요.";
            target = $mb_id;
        } else if (!$mb_password.val()) {
            falseMsg = "비밀번호 입력해주세요.";
            target = $mb_password;
        } else if (!$mb_company_name.val()) {
            falseMsg = "회사명을 입력해주세요.";
            target = $mb_company_name;
        }

        //        else if(!$mb_company_tel.val()){
        //            falseMsg = "대표번호를 입력해주세요.";
        //            target = $mb_company_tel;
        //        }else if($mb_company_number.val().length != 12){
        //            falseMsg = "사업자번호 10자리를 정확히 입력해주세요.";
        //            target = $mb_company_number;
        //        }else if(!validateEmail($mb_company_email.val())){
        //            falseMsg = "이메일 형식에 맞게 입력해주세요.";
        //            target = $mb_company_email;
        //        }else
        else if (!$mb_addr.val()) {
            falseMsg = "주소를 등록해주세요.";
            target = $mb_addr;
        }
        //        else if(!$mb_addr_detail.val()){
        //            falseMsg = "상세주소를 입력해주세요.";
        //            target = $mb_addr_detail;
        //        }
        //        else if(!$mb_name.val()){
        //            falseMsg = "담당자 성함을 입력해주세요.";
        //            target = $mb_name;
        //        }else if(!$mb_hp.val()){
        //            falseMsg = "담당자 전화번호를 입력해주세요.";
        //            target = $mb_hp;
        //        }

        if (falseMsg != '') {
            swal(falseMsg)
                .then(() => {
                    if (target == null) return;

                    if (target == $mb_addr) target.click();
                    else target.focus();
                });
            return;
        }

        const saveCompanyRes = await postJson(getAjaxUrl('admin'), {
            mode: 'companySet',
            settingType: settingType,
            mb_id: $mb_id.val(),
            mb_password: $mb_password.val(),
            mb_company_name: $mb_company_name.val(),
            mb_company_tel: unHypen($mb_company_tel.val()),
            mb_company_number: unHypen($mb_company_number.val()),
            mb_company_email: $mb_company_email.val(),
            mb_addr: $mb_addr.val(),
            mb_zip_code: $('#mb_zip_code').val(),
            mb_lat: $('#mb_lat').val(),
            mb_lng: $('#mb_lng').val(),
            mb_addr_detail: $mb_addr_detail.val(),
            mb_name: $mb_name.val(),
            mb_hp: unHypen($mb_hp.val())
        });

        if (!saveCompanyRes.result) {
            swal(saveCompanyRes.msg);
            return false;
        }

        swal('저장되었습니다.')
            .then(() => {
                location.reload();
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
                "sEmptyTable": "업체가 존재하지않습니다."
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