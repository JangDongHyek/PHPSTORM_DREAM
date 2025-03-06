<?php
$sub_menu = "400000";
include_once('./_common.php');
include_once(G5_PATH."/jl/JlConfig.php");

auth_check($auth[$sub_menu], 'r');

$html_title = '카테고리';

$g5['title'] = $html_title;
include_once('./admin.head.php');
?>

<!-- Button trigger modal -->
<!--<a data-toggle="modal" data-target="#exampleModal">-->
<!--    Launch demo modal-->
<!--</a>-->

<!-- Modal -->
<!--<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">-->
<!--    <div class="modal-dialog">-->
<!--        <div class="modal-content">-->
<!--            <div class="modal-header">-->
<!--                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>-->
<!--                <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
<!--                    <span aria-hidden="true">&times;</span>-->
<!--                </button>-->
<!--            </div>-->
<!--            <div class="modal-body">-->
<!--                ...-->
<!--            </div>-->
<!--            <div class="modal-footer">-->
<!--                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
<!--                <button type="button" class="btn btn-primary">Save changes</button>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<div id="app">
    <adm-category-list></adm-category-list>
</div>
<?
$jl->vueLoad('app');
$jl->componentLoad("adm");
$jl->componentLoad("external");
?>
<?php
include_once('./admin.tail.php');
?>
