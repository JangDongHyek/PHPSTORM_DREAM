<?php
$pid = "note";
include_once("./app_head.php");
include_once("../jl/JlConfig.php");
?>
<div id="app">
    <div id="note">
        <div class="slogan">
            <h5>결단노트쓰기는, 주일예배의 결단 내용을 어떻게<br class="visible-xs"> 실천할 것인지를 다짐하고,<br class="hidden-xs">
                생활속에서 실천한 <br class="visible-xs">내용을 성도들과 나누는 코이노니아의 장입니다.</h5>
            <button type="button" class="btn btn_color btn-large" onclick="location.href='./note_form'">결단노트 작성하기</button>
        </div>
        <div class="box_radius box_white">
            <h6>남의 험담을 하지 않겠습니다.
                <span>2024 IMC <b>0</b>번째 결단</span>
            </h6>

            <bbs-note-list mb_1="<?=$member['mb_1']?>" mb_no="<?=$member['mb_no']?>"></bbs-note-list>
        </div>
    </div>
</div>

<?
$jl->vueLoad('app');
$jl->componentLoad("/bbs/note");
$jl->componentLoad("/item");
?>
<?php
include_once("./app_tail.php");
?>