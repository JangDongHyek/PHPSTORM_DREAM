<?php
$sub_menu = "301200";
include_once('./_common.php');

$g5['title'] = '광고신청';
include_once ('./admin.head.php');


?>

<form name="fboardform" id="fboardform" action="./board_form_update.php" onsubmit="return fboardform_submit(this)" method="post" enctype="multipart/form-data">
<input type="hidden" name="w" value="<?php echo $w ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">

<section id="anc_bo_basic">
    <h2 class="h2_frm">광고주</h2>
    <?php echo $pg_anchor ?>

    <div class="tbl_frm01 tbl_wrap">
        <table>
        <caption>게시판 기본 설정</caption>
        <colgroup>
            <col class="grid_4">
            <col>
            <col class="grid_3">
        </colgroup>
        <tbody>
        <tr>
            <th scope="row">업체명(성명)</th>
            <td colspan="2">
                이름들어갑니다
            </td>
        </tr>
        <tr>
            <th scope="row">주소</th>
            <td colspan="2">
                주소들어갑니다
            </td>
        </tr>
        <tr>
            <th scope="row">사업자등록번호</th>
            <td colspan="2">
                사업자등록번호들어갑니다
            </td>
        </tr>
        <tr>
            <th scope="row">담당자</th>
            <td colspan="2">
                담당자들어갑니다
            </td>
        </tr>
        <tr>
            <th scope="row">연락처</th>
            <td colspan="2">
                limwook@gmail.com
            </td>
        </tr>
        </tbody>
        </table>
    </div>

    <div class="tbl_frm01 tbl_wrap">
        <table>
        <caption>게시판 기본 설정</caption>
        <colgroup>
            <col class="grid_4">
            <col>
            <col class="grid_3">
        </colgroup>
        <tbody>
        <tr>
            <th scope="row">업체명(성명)</th>
            <td colspan="2">
                이름들어갑니다
            </td>
        </tr>
        <tr>
            <th scope="row">주소</th>
            <td colspan="2">
                주소들어갑니다
            </td>
        </tr>
        <tr>
            <th scope="row">사업자등록번호</th>
            <td colspan="2">
                사업자등록번호들어갑니다
            </td>
        </tr>
        <tr>
            <th scope="row">담당자</th>
            <td colspan="2">
                담당자들어갑니다
            </td>
        </tr>
        <tr>
            <th scope="row">연락처</th>
            <td colspan="2">
                limwook@gmail.com
            </td>
        </tr>
        </tbody>
        </table>
    </div>
</section>



<div class="btn_fixed_top">
    <a class="btn_03 btn">삭제</a>
    <a class="btn_02 btn">목록</a>
</div>

</form>

<script>
</script>

<?php
include_once ('./admin.tail.php');
?>
