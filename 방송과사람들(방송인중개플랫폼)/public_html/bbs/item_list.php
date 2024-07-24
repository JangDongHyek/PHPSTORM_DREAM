<?
include_once('./_common.php');
include_once("../class/Lib.php");

$jl = new JL();

$g5['title'] = '리스트';
include_once('./_head.php');
?>
<!-- 순서 모달팝업 -->
<div id="basic_modal">
    <!-- Modal -->
    <div class="modal fade" id="listModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
					<ul id="sort_list" class="sort_list_mobile">
						<li class="active">최신순</li>
						<li>추천순</li>
						<li>별점순</li>
					</ul>
                </div>
            </div>
        </div>
    </div>
</div><!--basic_modal-->
<!-- 순서 모달팝업 -->

    <div id="app">

        <div id="area_product">
            <product-list parent_idx="<?=$_GET['ctg']?>"></product-list>
        </div>
    </div>


<?php
$jl->vueLoad("app");
$jl->includeDir("/component/product");

include_once('./_tail.php');
?>