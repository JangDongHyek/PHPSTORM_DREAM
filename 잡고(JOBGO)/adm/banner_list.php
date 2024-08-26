<?php
$sub_menu = "280100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$g5['title'] = '배너관리';
include_once('./admin.head.php');


$sql = " select count(*) as cnt FROM new_adm_banner ";
$cnt =  sql_fetch($sql);
$total_count = $cnt['cnt'];

$rows = $config['cf_page_rows'];
//$rows = 2;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

// 배너 리스트
$sql = "SELECT * FROM new_adm_banner ORDER BY FIELD(ba_place, 'top','btm','ctg') limit {$from_record}, {$rows} ";
$result = sql_query($sql);
$result_cnt = sql_num_rows($result);

?>


<div class="local_desc">
    <p style="margin-left: 20px ">노출순서 : 숫자가 클수록 먼저 노출됩니다.</p>
</div>

<div class="btn_add01 btn_add" style="float:left;">
    <a onclick="getModalOpen()">배너등록</a>
</div>

<form name="fbanner" id="fbanner" action="<?=G5_BBS_URL?>/ajax.controller.php" method="post">
    <input type="hidden" name="mode" value="yn_list_banner_change">
    <div class="tbl_head02 tbl_wrap" style="max-width:1200px;">
        <table>
            <caption><?php echo $g5['title']; ?> 목록</caption>
            <colgroup>
                <col width="2%">
                <col width="5%">
                <col width="8%">
                <col width="5%">
                <col width="30%">
                <col width="5%">
                <col width="30%">
                <col width="5%">
                <col width="10%">
            </colgroup>
            <thead>
            <tr>
                <th scope="col">
                    <label for="chkall" class="sound_only">회원 전체</label>
                    <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
                </th>
                <th>No.</th>
                <th>카테고리</th>
                <th>노출순서</th>
                <th>연결링크</th>
                <th>새탭여부</th>
                <th>배너이미지</th>
                <th>사용여부</th>
                <th>관리</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if ($result_cnt == 0) {
                ?>
                <tr><td colspan='10' class='empty_table'>자료가 없습니다.</td></tr>
                <?
            } else {
                $list_no = $total_count - ($rows * ($page - 1));

                for ($i=0; $row=sql_fetch_array($result); $i++) {
                    $bg = 'bg'.($i%2);
                    $image = G5_DATA_URL."/banner/".$row['image'];
                    $img_path = G5_BNR_PATH."/".$row['image'];
                    $img_exists = (file_exists($img_path) && $row['image'] != "")? true : false;
                    if($row['ba_place'] == 'ctg'){
                        $category = common_code($row['ba_category'],'code_idx','json');
                        $category = $category[0]['name'];
                    }elseif ($row['ba_place'] == 'top'){
                        $category = '메인상단';
                    }elseif ($row['ba_place'] == 'btm'){
                        $category = '메인하단';
                    }

                    ?>
                    <tr class="<?php echo $bg; ?>" style="text-align:center;">
                        <td>
                            <input type="checkbox" name="chk[]" value="<?php echo $row['idx'] ?>" id="chk_<?php echo $i ?>">
                        </td>
                        <td><?=$list_no?></td>
                        <td><?=$category?></td>
                        <td><?=$row['ba_number']?></td>
                        <td><a href="<?=$row['ba_link']?>" target="_blank"><?=$row['ba_link']?></a></td>
                        <td>
                            <?= $row['ba_new_tab'] == '1' ? '새탭으로 이동': "잡고에서 이동";?>
                        </td>
                        <td>
                            <? if ($img_exists) { ?>
                                <img src="<?=$image?>" style="max-width: 80%; max-height: 120px">
                            <? } else { ?>
                                배너이미지 없음
                            <? } ?>
                        </td>

                        <td>
                            <?=$yn_list[$row['ba_use']]?>
                        </td>
                        <td>
                            <a href="#" onclick="getModalOpen('<?=$row['idx']?>')">수정</a>
                            <a href="#" onclick="bannerDel('<?=$row['idx']?>')">삭제</a>
                        </td>
                    </tr>
                    <?
                    $list_no--;

                } // end for
            }
            ?>
            </tbody>
        </table>
        <div class="btn_list01 btn_list" style="margin-left: -1px; margin-top: 10px">
            <input type="submit" name="act_button" value="비노출로 변경" onclick="document.pressed=this.value">
            <input type="submit" name="act_button" value="노출로 변경" onclick="document.pressed=this.value">
        </div>
</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>


<!-- modal  -->
<div id="dialog-confirm" title="배너 등록"></div>
<iframe name="hFrame" id="hFrame" style="width:0; hiehgt: 0; position:absolute; left: -999px;"></iframe>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(function() {
        $("#dialog-confirm").dialog({
            autoOpen : false, //resizable: false,
            height: "auto",
            width: "650",
            modal: true,
            show: {effect: "blind", duration: 100},
            hide: {effect: "blind",	duration: 100},
            buttons: {
                "등록": function() {
                    frmSubmit();
                },
                "닫기" : function() {
                    getModalClose();
                }
            }
        });

        $(document).on("keydown", "input[name=ba_link]", function(e) {
            if (event.keyCode === 13) {
                event.preventDefault();
            };

        }).on("keyup", "input[name=ba_number]", function() {
            $(this).val($(this).val().replace(/[^0-9]/gi,""));
        });
    });

    function getModalClose() {
        $("#dialog-confirm").dialog("close").html("");
    }
    function getModalOpen(idx) {
        var mode = "w";
        if (typeof idx != "undefined") {
            mode = "u";
        }

        $.ajax({
            type : "get",
            url : g5_admin_url + "/ajax.banner_form.php",
            data : {"idx" : idx, "mode" : mode, "pos" : "<?=$pos?>"},
            dataType : "html",
            success : function(data) {
                $("#dialog-confirm").html(data).dialog("open");
            },
            error : function(xhr,status,error) {
                alert("입력폼을 불러오는데 실패하였습니다. 다시 시도해 주세요.");
            }
        });
    }
    // 등록/수정
    function frmSubmit() {
        var f = document.regFrm;

        /*
        if (f.bnr_link.value.length == 0) {
            alert("연결링크를 입력해 주세요.");
            f.bnr_link.focus();
            return false;
        }
        */

        if ((f.mode.value == "w" && f.image.value == "") || f.mode.value == "u" && $(".p_img").length == 0) {
            alert("배너이미지를 등록해 주세요.");
            return false;
        }

        f.target = "hFrame";
        f.submit();
    }

    // 배너 업로드결과
    function frmResult(rslt) {
        if (rslt == "F") {
            alert("배너등록에 실패하였습니다. 다시 시도해 주세요.");
        }
        location.reload();
    }

    // 배너 삭제
    function bannerDel(idx) {
        if (confirm("해당 배너를 삭제하시겠습니까?")) {
            $.ajax({
                type : "post",
                url : "./banner_del.php",
                data : {"idx" : idx},
                dataType : "text",
                success : function(data) {
                    location.reload();
                },
                error : function(xhr,status,error) {
                    console.log(error);
                }
            });

        }
    }
</script>
<!-- // modal -->



<?php
include_once ('./admin.tail.php');
?>
