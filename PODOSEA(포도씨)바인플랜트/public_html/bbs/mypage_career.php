<?
include_once('./_common.php');
$name = "mypage";
$g5['title'] = '마이페이지 커리어';
include_once('./_head.php');

/** 지원한 이력서 표시 **/
?>

<? if($name=="mypage") { ?>
	<body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?> class="mypage">
<?}?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">


    <div id="area_mypage" class="career">
        <input type="hidden" id="page" name="page" value="1">
        <div class="inr v3">
			<div id="mypage_wrap">	
				<?php include_once('./mypage_info.php'); ?> 
				<div class="mypage_cont">
					<div class="box">
						<h3>커리어</h3>
						<div class="box_cont">					
							<div id="help_list" class="inquiry">
								<ul class="list full career_"></ul>
							</div>
						</div>
                        <div id="paging"></div>
					</div>
				</div>
				<?php include_once('./mypage_menu.php'); ?> 
			</div>			
		</div>
	</div>

<script>
    $(document).ready(function () {
        mypage_career(); // 리스트
    });

    function mypage_career(page) {
        if(page == undefined) { page = 1; }
        $('#page').val(page);

        $.ajax({
            url : g5_bbs_url + "/ajax.mypage_career.php",
            data: {page : $('#page').val()},
            type: 'POST',
            cache: false,
            async: false,
            success : function(data) {
                if(data){
                    $('.career_').html(data);

                    // 페이징 처리 -- 하단에 페이지 표시
                    ajaxGetPaging();
                }
            },
            error : function(err) {
                swal(err.status);
            }
        });
    }

    // 페이징 처리 -- 페이지 클릭 시 동작 이벤트
    function get_page(page) {
        mypage_career(page);
    }
</script>

<?
include_once('./_tail.php');
?>

