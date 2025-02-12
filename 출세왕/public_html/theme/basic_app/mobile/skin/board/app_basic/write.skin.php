<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_PATH."/jl/JlConfig.php");
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 100);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/default.js"></script>', 100);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/ui.js"></script>', 100);
?>
<style>
#ft_menu{display:none;}
</style>
  <?php  if (G5_IS_ADMIN == 1) { ?>
    <style>
        .btn{
            display: inline-block;
            vertical-align: middle;
            padding: 10px;
            border: 1px solid #ccc;
            background: #f0f0f0;
            text-decoration: none;
            cursor: pointer;
            float: right;
        }
    </style>
<?php } ?>
<section id="bo_w">

    <div id="app">
        <bbs-app_basic-input primary="<?=$_GET['wr_id']?>" table="g5_write_<?=$_GET['bo_table']?>"></bbs-app_basic-input>
    </div>

</section>

<? $jl->vueLoad("app",["jquery","bootstrap","summernote"]);?>
<? $jl->componentLoad("/bbs/app_basic");?>
<? $jl->componentLoad("/external");?>
