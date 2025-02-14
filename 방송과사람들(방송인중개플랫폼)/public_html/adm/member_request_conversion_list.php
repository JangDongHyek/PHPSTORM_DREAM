<?php
$sub_menu = "200200";

include_once('./_common.php');
include_once(G5_PATH."/model/model.php");
//print_r($qstr);
//exit;
auth_check($auth[$sub_menu], 'r');


$g5['title'] = '전문가 전환 신청 목록';
include_once('./admin.head.php');

$colspan = 16;
?>

<style>
    .mb_tbl table {text-align: center;}
    .btn_add ul.cate {list-style: none; margin: 0; padding: 0;}
    .btn_add .cate li {float: left; padding: 10px; border: 1px solid #ccc; border-left: 0; width: 85px; text-align: center; cursor: pointer;}
    .btn_add .cate li:nth-child(1) {border-left: 1px solid #ccc;}
    .btn_add .cate li.on {background: #f2f5f9; font-weight: 700;}
</style>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">
    <input type="hidden" name="lv" value="<?php echo $lv ?>">
    <label for="sfl" class="sound_only">검색대상</label>
    <select name="sfl" id="sfl">
        <option value="mb_id"<?php echo get_selected($_GET['sfl'], "mb_id"); ?>>아이디</option>
        <option value="mb_email"<?php echo get_selected($_GET['sfl'], "mb_email"); ?>>이메일</option>
        <? /*
    <option value="mb_nick"<?php echo get_selected($_GET['sfl'], "mb_nick"); ?>>닉네임</option>
    <option value="mb_name"<?php echo get_selected($_GET['sfl'], "mb_name"); ?>>이름</option>
    <option value="mb_level"<?php echo get_selected($_GET['sfl'], "mb_level"); ?>>권한</option>
    <option value="mb_email"<?php echo get_selected($_GET['sfl'], "mb_email"); ?>>E-MAIL</option>
    <option value="mb_tel"<?php echo get_selected($_GET['sfl'], "mb_tel"); ?>>전화번호</option>
    <option value="mb_hp"<?php echo get_selected($_GET['sfl'], "mb_hp"); ?>>휴대폰번호</option>
    <option value="mb_point"<?php echo get_selected($_GET['sfl'], "mb_point"); ?>>포인트</option>
    <option value="mb_datetime"<?php echo get_selected($_GET['sfl'], "mb_datetime"); ?>>가입일시</option>
    <option value="mb_ip"<?php echo get_selected($_GET['sfl'], "mb_ip"); ?>>IP</option>
    <option value="mb_recommend"<?php echo get_selected($_GET['sfl'], "mb_recommend"); ?>>추천인</option>
	*/ ?>
    </select>
    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
    <input type="text" name="stx" value="<?php echo $stx ?>" id="stx" class="frm_input">
    <input type="submit" class="btn_submit" value="검색">

</form>

<!--<div class="local_desc01 local_desc">-->
<!--    <p>회원자료 삭제 시 다른 회원이 기존 회원아이디를 사용하지 못하도록 회원아이디, 이름, 닉네임은 삭제하지 않고 영구 보관합니다.</p>-->
<!--</div>-->

<form name="fmemberlist" id="fmemberlist" action="./member_list_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
    <input type="hidden" name="page" value="<?php echo $page ?>">

    <div class="tbl_head02 tbl_wrap mb_tbl">
        <table>
            <caption><?php echo $g5['title']; ?> 목록</caption>
            <thead>
            <tr>
                <th>no</th>
                <th>회원구분</a></th>
                <th>아이디</th>
                <th>이메일</a></th>
                <th>신청일</th>
                <th>응답일</th>
                <th>관리</th>
            </tr>
            </thead>
            <tbody>
            <?php
                $member_request_conversion = new Model("member_request_conversion");
                $page = $_GET["page"] ? $_GET["page"] : 1;
                $limit = 10;
                $model_response = $member_request_conversion->gets(array("page" => $page,"limit"=>$limit));
                foreach ($model_response["datas"] as $index => $data) {
                    $data["member"] = get_member_no($data["member_idx"]);
                ?>
                <tr class="<?php echo $bg; ?>">
                    <td><?= $data["index"]?> </td>
                    <td><?= (int)$data["member"]["mb_level"] < 3 ? "의뢰인" : "전문가" ?></td>
                    <td><?= $data["member"]["mb_id"] ?></td>
                    <td><?= $data["member"]["mb_email"] ?></td>
                    <td><?= $data["c_date"]?></td>
                    <td><?= $data["u_date"] == "0000-00-00 00:00:00" ? "미응답" : $data["u_date"]?> </td>
                    <td class="btn_confirm02"><button type="button" onclick="putApprove(<?=$data["_idx"]?>)">승인</button></td>
                </tr>

                <?php
                }
                if ((int)$model_response["count"] <= 0)
                    echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">자료가 없습니다.</td></tr>";
            ?>
            </tbody>
        </table>
    </div>

    <div class="btn_list01 btn_list">
        <?php if ($lv == 2){ ?>
            <!--            <input type="submit" name="act_button" style="background: #ccc" value="승인처리" onclick="document.pressed=this.value">-->
        <?php } ?>
        <!--        <input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value">-->
    </div>

</form>

<?php echo get_paging(G5_IS_MOBILE ? $limit : $limit, $page, $model_response["pages"], '?'.'page='); ?>
<!--<div id="paging"><span class="current">1<span class="sound_only">페이지</span></span>-->
<!--    <a href="?sst=&amp;sod=&amp;sfl=&amp;stx=&amp;page=2" class="pg_page">2<span class="sound_only">페이지</span></a>-->
<!--    <a href="?sst=&amp;sod=&amp;sfl=&amp;stx=&amp;page=2" class="pg_page pg_end">맨끝</a>-->
<!--</div>-->

<script>
    function putApprove(_idx) {
        $.ajax({
            url : "ajax_member_request_conversion.php",
            method : "post",
            enctype : "multipart/form-data",
            async : false,
            cache : false,
            data : {
                "_method" : "put",
                "_idx" : _idx
            },
            dataType : "json",
            success: function(res){
                if(!res.success) alert(res.message);
                else {
                    alert("승인되었습니다.");
                }
            }
        });
    }


    $("ul.cate li").on("click", function() {
        var level = $(this).data("lv"),
            params = "",
            sfl = $("#sfl").val(),
            stx = $("#stx").val();

        if (level != "") {
            params += "?lv=" + level;
        }

        if (stx != "") {
            params += (params == "")? "?" : "&";
            params += "sfl=" + sfl + "&stx=" + stx;
        }

        location.href = g5_admin_url + "/member_list.php" + params;
    });
    function fmemberlist_submit(f)
    {
        if (!is_checked("chk[]")) {
            alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
            return false;
        }

        if(document.pressed == "선택삭제") {
            if(!confirm("선택한 자료를 정말 삭제하시겠습니까?")) {
                return false;
            }
        }

        return true;
    }
</script>

<?php
include_once ('./admin.tail.php');
?>
