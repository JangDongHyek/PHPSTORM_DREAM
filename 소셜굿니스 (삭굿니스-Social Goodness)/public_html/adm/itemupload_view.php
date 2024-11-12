<?php
$sub_menu = "301100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$g5['title'] = '아이템업로드';
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
<!--    <h2 class="h2_frm">아이템 업로드 상세보기</h2>-->
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
            <th scope="row">이름</th>
            <td colspan="2">
                이름들어갑니다
            </td>
        </tr>
        <tr>
            <th scope="row">상품명</th>
            <td colspan="2">
                상품명
            </td>
        </tr>
        <tr>
            <th scope="row">제조사</th>
            <td colspan="2">
                모름

            </td>
        </tr>
        <tr>
            <th scope="row">전화번호</th>
            <td colspan="2">
                010-9872-2345
            </td>
        </tr>
        <tr>
            <th scope="row">이메일</th>
            <td colspan="2">
                limwook@gmail.com
            </td>
        </tr>
        <tr>
            <th scope="row">가격필수</th>
            <td colspan="2">
                상품명
            </td>
        </tr>
        <tr>
            <th scope="row">이름</th>
            <td colspan="2">
                23000원
            </td>
        </tr>
        <tr>
            <th scope="row">원산지</th>
            <td colspan="2">
                모름
            </td>
        </tr>
        <tr>
            <th scope="row">상세정보</th>
            <td colspan="2">
                모름
            </td>
        </tr>
        <tr>
            <th scope="row">판매유무</th>
            <td colspan="2">
                유
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
