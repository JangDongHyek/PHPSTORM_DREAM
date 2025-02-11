<?php
$sub_id = "contest";
include_once('./_common.php');
include_once(G5_PATH."/jl/JlConfig.php");

$g5['title'] = '공모전';
include_once('./_head.php');
add_stylesheet('<link rel="stylesheet" href="' . $member_skin_url . '/style.css">', 0);
add_stylesheet('<link rel="stylesheet" href="' . $member_skin_url . '/style_pro.css">', 0);
?>
    <link rel="stylesheet" href="<?= $member_skin_url?>/competition.css">
    <style>
        .box-article .box-body .row{ background:#fff}
        .tab-content {
            display: none;
            float: left;
            width: 100%;
            padding: 0 0 1em 0;
            background:#fff;
        }
        #item_review{ padding:0}
        #item_review .info .nick {
            color: #555;
            font-size: 1.13em;
            margin:0 0 10px;
            font-weight:500;
        }
    </style>


<div id="app">
    <project-view primary="<?=$_GET['idx']?>"></project-view>
</div>

<?
$jl->vueLoad("app");
$jl->componentLoad("/project");
$jl->componentLoad("/item");
?>

<?
include_once('./_tail.php');
?>