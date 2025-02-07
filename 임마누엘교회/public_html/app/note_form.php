<?php
$pid = "note_form";
include_once("./app_head.php");
include_once("../jl/JlConfig.php");
?>

<div id="app">
    <bbs-note-input mb_no="<?=$member['mb_no']?>" mb_id="<?=$member['mb_id']?>"></bbs-note-input>
</div>

<?
$jl->vueLoad('app');
$jl->componentLoad("/bbs/note");
$jl->componentLoad("/item");
?>
<?php
include_once("./app_tail.php");
?>