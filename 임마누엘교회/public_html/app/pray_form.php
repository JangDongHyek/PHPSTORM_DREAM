<?php
$pid = "pray_form";
include_once("./app_head.php");
include_once("../jl/JlConfig.php");
?>

<div id="app">
    <bbs-prayer-input></bbs-prayer-input>
</div>

<script>
    //$(document).ready(function(){
    //
    //    $('ul.tabs li').click(function(){
    //        var tab_id = $(this).attr('data-tab');
    //
    //        $('ul.tabs li').removeClass('current');
    //        $('.tab-content').removeClass('current');
    //
    //        $(this).addClass('current');
    //        $("#"+tab_id).addClass('current');
    //    })
    //
    //})

</script>
<?
$jl->vueLoad('app');
$jl->componentLoad("/bbs/prayer");
?>
<?php
include_once("./app_tail.php");
?>