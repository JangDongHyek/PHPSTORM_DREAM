<?php
$sub_menu = "210100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');

if ($w == '')
{

}
else if ($w == 'u')
{
    $ci = sql_fetch(" select ci.*, mb.mb_hp from g5_company_inquiry as ci left join g5_member as mb on mb.mb_id = ci.mb_id where ci.idx = {$idx} ");
}
else
    alert('제대로 된 값이 넘어오지 않았습니다.');

$g5['title'] .= '기업의뢰정보';
include_once('./admin.head.php');

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js
?>

<style>
    .btn_submit {
        padding: 0 5px;
        height: 24px;
        border: 0;
        color: #fff;
        vertical-align: middle;
        cursor: pointer;
    }
    .btn_pass {
        background: blue;
        font-weight: bold;
    }

    .tbl_head02 thead th {text-align: center !important;}
    .tbl_head02 tbody td {border: 1px solid #ececec !important;}
</style>

<!-- 의뢰 전달 모달 -->
<div class="modal fade" id="passModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">기업 의뢰 전달</h2>
            </div>
            <div class="modal-body">
                <p>아이디/회사명<br>※ 기업 회원의 아이디 또는 회사명을 검색하세요.</p>
                <div>
                    <form name="sfrm" autocomplete="off" onsubmit="return search_id(this);">
                        <input type="text" name="input_id" id="input_id" class="frm_input" size="20" required minlength="2">
                        <button type="submit" class="btn_submit">검색</button>
                    </form>
                </div>
                <br/>
                <div id="srch_result" class="tbl_head02 mb_tbl"></div><br/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn_frmline" data-dismiss="modal">닫기</button>
            </div>
        </div>
    </div>
</div>
<!-- //의뢰 전달 모달 -->

<form name="finquiry" id="fcompanyinquiry" method="post" enctype="multipart/form-data">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="token" value="">

    <div class="tbl_frm01 tbl_wrap">
        <h1 class="subj">* 의뢰인정보</h1>
        <table>
            <caption><?php echo $g5['title']; ?></caption>
            <colgroup>
                <col width="10%">
                <col width="25%">
                <col width="10%">
                <col width="*">
            </colgroup>
            <tbody>
            <tr>
                <th scope="row"><label for="mb_id">아이디<?php echo $sound_only ?></label></th>
                <td>
                    <input type="text" name="mb_id" value="<?php echo $ci['mb_id'] ?>" id="mb_id" class="frm_input" size="50" minlength="3" maxlength="20">
                </td>
                <th scope="row"><label for="mb_hp">휴대폰</label></th>
                <td><input type="text" name="mb_hp" value="<?php echo $ci['mb_hp'] ?>" id="mb_hp" class="frm_input" size=50" maxlength="20"></td>
            </tr>
            </tbody>
        </table>

        <h1 class="subj">* 의뢰상세정보</h1>
        <table>
            <caption><?php echo $g5['title']; ?></caption>
            <colgroup>
                <col width="10%">
                <col width="25%">
                <col width="10%">
                <col width="*">
            </colgroup>
            <tbody>
            <tr>
                <?php $ciTypes = explode("|", $ci['ci_type']); ?>
                <th scope="row"><label for="ci_type">RFQ Type<strong class="sound_only">필수</strong></label></th>
                <td>
                    <input type="checkbox" name="ci_type" value="서비스" <?= in_array('Service', $ciTypes) ? 'checked' : ''; ?> disabled class="frm_input"><span style="margin-right: 5px;margin-left: 5px;">Service</span>
                    <input type="checkbox" name="ci_type" value="부품" <?= in_array('Parts', $ciTypes) ? 'checked' : ''; ?> disabled class="frm_input"><span style="margin-right: 5px;margin-left: 5px;">Parts</span>
                    <input type="checkbox" name="ci_type" value="선용품" <?= in_array('Ship supplies', $ciTypes) ? 'checked' : ''; ?> disabled class="frm_input"><span style="margin-right: 5px;margin-left: 5px;">Ship supplies</span>
                    <input type="checkbox" name="ci_type" value="기타" <?= in_array('Ohters', $ciTypes) ? 'checked' : ''; ?> disabled class="frm_input"><span style="margin-right: 5px;margin-left: 5px;">Others</span>
                </td>
                <th scope="row"></th>
                <td></td>
            </tr>
            <tr>
                <th scope="row"><label for="ci_vessel">Vessel name<strong class="sound_only">필수</strong></label></th>
                <td><input type="text" name="ci_vessel" value="<?php echo $ci['ci_vessel'] ?>" id="ci_vessel" class="frm_input" size="50"></td>
                <th scope="row"><label for="ci_imo_no">INO No.<strong class="sound_only">필수</strong></label></th>
                <td><input type="text" name="ci_imo_no" value="<?php echo $ci['ci_imo_no'] ?>" id="ci_imo_no" class="frm_input" size="50"></td>
            </tr>
            <tr>
                <th scope="row"><label for="ci_subject">Subject<strong class="sound_only">필수</strong></label></th>
                <td><input type="text" name="ci_subject" value="<?php echo $ci['ci_subject'] ?>" id="ci_subject" class="frm_input" size="50"></td>
                <th scope="row"><label for="ci_deadline_date">Quotation deadline<strong class="sound_only">필수</strong></label></th>
                <td><input type="text" name="ci_deadline_date" value="<?php echo $ci['ci_deadline_date'] ?>" id="ci_deadline_date" class="frm_input" size="50"></td>
            </tr>
            <tr>
                <th scope="row"><label for="ci_category">Category<strong class="sound_only">필수</strong></label></th>
                <td><input type="text" name="ci_category" value="<?php echo $ci['ci_category'] ?>" id="ci_category" class="frm_input" size="50"></td>
                <th scope="row"><label for="ci_maker">Maker(manufacturer)<strong class="sound_only">필수</strong></label></th>
                <td><input type="text" name="ci_maker" value="<?php echo $ci['ci_maker'] ?>" id="ci_maker" class="frm_input" size="50"></td>
            </tr>
            <tr>
                <th scope="row"><label for="ci_model">Model<strong class="sound_only">필수</strong></label></th>
                <td><input type="text" name="ci_model" value="<?php echo $ci['ci_model'] ?>" id="ci_model" class="frm_input" size="50"></td>
                <th scope="row"><label for="ci_serial_no">Serial No.<strong class="sound_only">필수</strong></label></th>
                <td><input type="text" name="ci_serial_no" value="<?php echo $ci['ci_serial_no'] ?>" id="ci_serial_no" class="frm_input" size="50"></td>
            </tr>
            <tr>
                <th scope="row"><label for="ci_contents">RFQ content<strong class="sound_only">필수</strong></label></th>
                <td colspan="3">
                    <div class="tbl_head02 mb_tbl" style="width: 80%;">
                        <table>
                            <thead>
                            <tr>
                                <th>NO.</th>
                                <th>DESCRIPTION</th>
                                <th>REFERENCE</th>
                                <th>PART NO.</th>
                                <th>QUANTITY</th>
                                <th>UoM</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $contentRlt = sql_query("SELECT * FROM g5_company_inquiry_content WHERE inquiry_idx = '{$idx}' order by idx");
                            for($i=1; $content=sql_fetch_array($contentRlt); $i++) { ?>
                                <tr>
                                    <td><?=$i?></td>
                                    <td><span><?=$content['description']?></span></td>
                                    <td><span><?=$content['reference']?></span></td>
                                    <td><span><?=$content['part_no']?></span></td>
                                    <td><span><?=number_format($content['quantity'])?></span></td>
                                    <td><span><?=$content['uom']?></span></td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <textarea name="ci_contents" id="ci_contents" style="resize: unset;width: 80%;"><?php echo $ci['ci_contents'] ?></textarea>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="ci_file">RFQ details and materials<strong class="sound_only">필수</strong></label></th>
                <td>
                <?php
                $filecount = sql_fetch(" select count(*) as count from g5_company_inquiry_img where company_inquiry_idx = {$idx}; ")['count'];
                if($filecount > 0) {
                    $file_sql = " select * from g5_company_inquiry_img where company_inquiry_idx = {$idx} order by idx; ";
                    $file_result = sql_query($file_sql);
                    for($i=0; $row=sql_fetch_array($file_result); $i++) {
                    ?>
                    <span class="fileName"><a style="text-decoration: underline;" href="<?=G5_DATA_URL?>/file/company_inquiry/<?=$row['img_file']?>" download="<?=$row['img_source']?>"><?=$row['img_source']?></a></span><br>
                    <?php
                    }
                }
                else {
                ?>
                <span>-</span>
                <?php
                }
                ?>
                <th scope="row"><label for="ci_open">Privacy setting for materials<strong class="sound_only">필수</strong></label></th>
                <td>
                    <input type="radio" name="ci_open" value="open" <?php echo $ci['ci_open'] == 'open' ? 'checked' : '';  ?> disabled class="frm_input"><span style="margin-right: 5px;">Reveal all</span>
                    <input type="radio" name="ci_open" value="private" <?php echo $ci['ci_open'] == 'private' ? 'checked' : '';  ?> disabled class="frm_input"><span style="margin-right: 5px;">Selective sharing</span>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="ci_budget">BUDGET<strong class="sound_only">필수</strong></label></th>
                <td><input type="text" name="ci_budget" value="<?php echo $company_budget[$ci['ci_budget']] ?>" id="ci_budget" class="frm_input" size="50"></td>
                <th scope="row"><label for="ci_delivery_to">Delivery To<strong class="sound_only">필수</strong></label></th>
                <td><input type="text" name="ci_delivery_to" value="<?php echo $ci['ci_delivery_to'] ?>" id="ci_delivery_to" class="frm_input" size="50"></td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="btn_confirm01 btn_confirm">
        <?php if(!empty($ci['podosea'])) { ?>
        <input type="button" value="의뢰전달" class="btn_submit" onclick="inquiryPass();" style="background: blue;font-weight: bold;">
        <?php } ?>
        <a href="./company_inquiry_list.php?<?php echo $qstr ?>">목록</a>
    </div>
</form>

<hr style="display: block;">

<?php if(!empty($ci['podosea']) || !empty($ci['target_mb_no'])) { ?>
<div class="tbl_head02 tbl_wrap mb_tbl">
    <h1 class="subj">* 의뢰전달현황</h1>
    <table style="width: 35%;">
        <thead>
        <tr>
            <th>No.</th>
            <th>아이디</th>
            <th>회사명</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $target_mb_no = explode(',', $ci['target_mb_no']);
        for($i=0; $i<count($target_mb_no); $i++) {
            $info = sql_fetch(" select * from g5_member where mb_no = '{$target_mb_no[$i]}' ");
        ?>
        <tr>
            <td><?=$i+1?></td>
            <td><?=$info['mb_id']?></td>
            <td><?=$info['mb_company_name']?></td>
        </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
</div>
<?php } ?>

<div class="tbl_head02 tbl_wrap mb_tbl">
    <h1 class="subj">* 견적제안현황</h1>
    <table>
        <colgroup>
            <col width="5%">
            <col width="*">
            <col width="20%">
            <col width="10%">
        </colgroup>
        <thead>
        <tr>
            <th>No.</th>
            <th>Quotations proposal price</th>
            <th>Remark</th>
            <th>의뢰상태</th>
        </tr>
        <tr>
            <th>아이디</th>
            <th>Valid To</th>
            <th>attachment</th>
            <th>등록일</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql = " select * from g5_company_estimate where company_inquiry_idx = {$idx} order by idx ";
        $result = sql_query($sql);

        for($i=0; $row=sql_fetch_array($result); $i++) {
        ?>
        <tr>
            <td><?=$i+1?></td>
            <td>
                <span style="float: right;font-weight: bold"><?=number_format($row['total_cost']).' '.$row['ce_unit']?></span>
                <div class="tbl_head02 mb_tbl">
                <table class="">
                    <thead>
                    <tr>
                        <th>NO.</th>
                        <th>DESCRIPTION</th>
                        <th>REFERENCE</th>
                        <th>PART NO.</th>
                        <th>QUANTITY</th>
                        <th>UoM</th>
                        <th>QUANTITY<br/>OFFERED</th>
                        <th>UoM</th>
                        <th>UNIT COST</th>
                        <th>LINE COST</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $contentRlt = sql_query("SELECT A.*, B.quantity_offered, B.uom AS eUom, B.unit_cost, B.line_cost 
                                                  FROM g5_company_inquiry_content AS A 
                                                  LEFT JOIN g5_company_estimate_content AS B ON A.idx = B.inquiry_content_idx AND B.mb_id = '{$row['mb_id']}'  
                                                  WHERE A.inquiry_idx = '{$idx}'
                                                  ORDER BY A.idx");
                    for ($k=1; $content=sql_fetch_array($contentRlt); $k++) {
                    ?>
                    <tr>
                        <td><?=$k?></td>
                        <td><span><?=$content['description']?></span></td>
                        <td><span><?=$content['reference']?></span></td>
                        <td><span><?=$content['part_no']?></span></td>
                        <td><span><?=number_format($content['quantity'])?></span></td>
                        <td><span><?=$content['uom']?></span></td>
                        <td><span><?=number_format($content['quantity_offered'])?></span></td>
                        <td><span><?=$content['eUom']?></span></td>
                        <td><span><?=number_format($content['unit_cost'])?></span></td>
                        <td><span><?=number_format($content['line_cost'])?></span></td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="8"></td>
                        <td>TOTAL COST</td>
                        <td><?= number_format($row['total_cost']) ?></td>
                    </tr>
                    <tr>
                        <td colspan="7"></td>
                        <td> VAT</td>
                        <td>
                            <input type="radio" id="vat_type1" name="vat" value="VAT" <?=$row['vat_include_yn'] == 'Y'? 'checked' : ''?> disabled>
                            <label for="vat_type1">
                                <span></span>
                                <span>INCLUDED</span>
                            </label>
                        </td>
                        <td>
                            <input type="radio" id="vat_type2" name="vat" value="VAT" <?=$row['vat_include_yn'] == 'N'? 'checked' : ''?> disabled>
                            <label for="vat_type2">
                                <span></span>
                                <span>EXCLUDED</span>
                            </label>
                        </td>
                    </tr>
                    </tbody>
                </table>
                </div>
            </td>
            <td><?=$row['ce_contents']?></td>
            <td><?=$row['ce_state']?></td>
        </tr>
        <tr style="border-bottom: 2px solid #ececec">
            <td><?=$row['mb_id']?></td>
            <td><?=$row['ce_valid_date']?></td>
            <td>
                <?php
                $filecount = sql_fetch(" select count(*) as count from g5_company_estimate_img where company_estimate_idx = {$row['idx']}; ")['count'];
                if($filecount > 0) {
                    $file_sql = " select * from g5_company_estimate_img where company_estimate_idx = {$row['idx']} order by idx; ";
                    $file_result = sql_query($file_sql);
                    for($j=0; $file=sql_fetch_array($file_result); $j++) {
                    ?>
                    <span class="fileName"><a style="text-decoration: underline;" href="<?=G5_DATA_URL?>/file/company_estimate/<?=$file['img_file']?>" download="<?=$file['img_source']?>"><?=$file['img_source']?></a></span><br>
                    <?php
                    }
                }
                else {
                ?>
                -
                <?php
                }
                ?>
            </td>
            <td><?=substr($row['wr_datetime'],0,10)?></td>
        </tr>
        <?php
        }
        if($i==0) {
        ?>
        <tr>
            <td colspan="10">견적이 없습니다.</td>
        </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
</div>

<script>
$(function() {
    $("input").attr('readonly', true);
    $("textarea").attr('readonly', true);
    $('#input_id').attr('readonly', false);
});

// 견적보내기 (팝업)
function estimate() {
    window.open('./popup.estimate.php?idx=<?=$idx?>', "", "left=350, top=100, status=0, width=450, height=550" );
}

// 의뢰전달하기 (팝업)
function inquiryPass() {
    $('#passModal').appendTo("body").modal('show');
}

// 아이디/회사명 검색
function search_id(f) {
    if (f.input_id.value.length < 2) {
        alert('검색어를 2자 이상 입력하세요.');
        f.input_id.focus();
        return false;
    }

    $.ajax({
        type : "get",
        url : "./ajax.id_search.php",
        data : {"id": f.input_id.value, mb_id: '<?=$ci['mb_id']?>', mode: "company"},
        dataType : "html",
        async : false,
        success : function(data) {
            $("#srch_result").html(data);
        },
        error : function(xhr,status,error) {
            console.log(error);
        },
        complete : function() {
            return false;
        }
    });

    return false;
}

// 아이디/회사명 검색 선택 - 의뢰전달
function select_id(mb_id) {
    $.ajax({
        url: "./ajax.inquiry_pass",
        data: {idx: '<?=$idx?>', mb_id: mb_id},
        type: "post",
        success: function(data) {
            if(data == 'success') {
                alert('의뢰가 전달되었습니다.');
                location.reload();
            } else {
                alert('의뢰가 이미 전달되었습니다.');
                //$('#passModal').modal('hide');
            }
        },
    })
}

</script>

<?php
include_once('./admin.tail.php');
?>
