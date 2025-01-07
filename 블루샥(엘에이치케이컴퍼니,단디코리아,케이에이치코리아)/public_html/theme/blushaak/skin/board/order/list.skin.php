<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 6;

if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/default.js"></script>', 100);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/ui.js"></script>', 100);
$statusClassArr=array("접수대기"=>"receipt","입금대기"=>"receipt","배송준비중"=>"receipt","배송지연"=>"order","발주완료"=>"delivery","발주취소"=>"completion");

?>


<!--<h2 id="container_title"><?php echo $board['bo_subject'] ?><span class="sound_only"> 목록</span></h2>-->

<!-- 게시판 목록 시작 { -->
<div id="bo_list" style="width:<?php echo $width; ?>">

    <!-- 게시판 카테고리 시작 { -->
    <?php if ($is_category) { ?>
    <nav id="bo_cate">
        <h2><?php echo $board['bo_subject'] ?> 카테고리</h2>
        <ul id="bo_cate_ul">
            <?php echo $category_option ?>
        </ul>
    </nav>
    <?php } ?>
    <!-- } 게시판 카테고리 끝 -->

    <!-- 게시판 페이지 정보 및 버튼 시작 { -->
    <div class="bo_fx">
        <div id="bo_list_total">
            <span>Total <?php echo number_format($total_count) ?>건</span>
            <?php echo $page ?> 페이지
        </div>

        <?php if ($rss_href || $write_href) { ?>
        <ul class="btn_bo_user">
            <?php if ($rss_href) { ?><li><a href="<?php echo $rss_href ?>" class="btn_b01">RSS</a></li><?php } ?>
            <?php if ($_SESSION['ss_mb_id']=="lets080") { ?><li><a href="<?php echo $admin_href ?>" class="btn_admin">관리자</a></li><?php } ?>
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">발주하기</a></li><?php } ?>
        </ul>
        <?php } ?>
    </div>
    <!-- } 게시판 페이지 정보 및 버튼 끝 -->

    <form name="fboardlist" id="fboardlist" action="./board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="sw" value="">
	<div class="tab">
		<ul>
			<li class="<?php echo $_GET['wr_1']==""?"active":"";?>" onclick="location.href='?bo_table=<?php echo $bo_table?>';">전체</li>
			<li class="<?php echo $_GET['wr_1']=="접수대기"?"active":"";?>" onclick="location.href='?bo_table=<?php echo $bo_table?>&wr_1=접수대기';">접수대기</li>
			<li class="<?php echo $_GET['wr_1']=="입금대기"?"active":"";?>" onclick="location.href='?bo_table=<?php echo $bo_table?>&wr_1=입금대기';">입금대기</li>
			<li class="<?php echo $_GET['wr_1']=="배송준비중"?"active":"";?>" onclick="location.href='?bo_table=<?php echo $bo_table?>&wr_1=배송준비중';">배송준비중</li>
			<li class="<?php echo $_GET['wr_1']=="배송지연"?"active":"";?>" onclick="location.href='?bo_table=<?php echo $bo_table?>&wr_1=배송지연';">배송지연</li>
			<li class="<?php echo $_GET['wr_1']=="발주완료"?"active":"";?>" onclick="location.href='?bo_table=<?php echo $bo_table?>&wr_1=발주완료';">발주완료</li>
			<li class="<?php echo $_GET['wr_1']=="발주취소"?"active":"";?>" onclick="location.href='?bo_table=<?php echo $bo_table?>&wr_1=발주취소';">발주취소</li>
		</ul>
	</div>
    <div class="tbl_head01 tbl_wrap">
        <table>
        <caption><?php echo $board['bo_subject'] ?> 목록</caption>
        <thead>
        <tr>
            <th scope="col">번호</th>
            <?php if ($is_checkbox) { ?>
            <th scope="col">
                <label for="chkall" class="sound_only">현재 페이지 게시물 전체</label>
                <input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);">
            </th>
            <?php } ?>
            <th scope="col">제목</th>
            <th scope="col">상태</th>
            <th scope="col" class="hidden-xs"><?php echo subject_sort_link('wr_datetime', $qstr2, 1) ?>날짜</a></th>
            <th scope="col" class="hidden-xs"><?php echo subject_sort_link('wr_hit', $qstr2, 1) ?>조회</a></th>
            <?php if ($is_good) { ?><th scope="col"><?php echo subject_sort_link('wr_good', $qstr2, 1) ?>추천</a></th><?php } ?>
            <?php if ($is_nogood) { ?><th scope="col"><?php echo subject_sort_link('wr_nogood', $qstr2, 1) ?>비추천</a></th><?php } ?>
        </tr>
        </thead>
        <tbody>
        <?php
        for ($i=0; $i<count($list); $i++) {
         ?>
        <tr class="<?php if ($list[$i]['is_notice']) echo "bo_notice"; ?>">
            <td class="td_num">
            <?php
            if ($list[$i]['is_notice']) // 공지사항
                echo '<strong>공지</strong>';
            else if ($wr_id == $list[$i]['wr_id'])
                echo "<span class=\"bo_current\">열람중</span>";
            else
                echo $list[$i]['num'];
             ?>
            </td>
            <?php if ($is_checkbox) { ?>
            <td class="td_chk">
                <label for="chk_wr_id_<?php echo $i ?>" class="sound_only"><?php echo $list[$i]['subject'] ?></label>
                <input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
            </td>
            <?php } ?>
            <td class="td_subject">
                <?php
                echo $list[$i]['icon_reply'];
                if ($is_category && $list[$i]['ca_name']) {
                 ?>
                <a href="<?php echo $list[$i]['ca_name_href'] ?>" class="bo_cate_link hidden-xs"><?php echo $list[$i]['ca_name'] ?></a>
                <?php } ?>

                <a href="<?php echo $list[$i]['href'] ?>">
                    <?php echo $list[$i]['subject']; if (!$list[$i]['is_notice']) echo "님이 발주신청하였습니다.";?>
                    <?php if ($list[$i]['comment_cnt']) { ?><span class="sound_only">댓글</span><?php echo $list[$i]['comment_cnt']; ?><span class="sound_only">개</span><?php } ?>
                </a>

                <?php
                // if ($list[$i]['link']['count']) { echo '['.$list[$i]['link']['count']}.']'; }
                // if ($list[$i]['file']['count']) { echo '<'.$list[$i]['file']['count'].'>'; }

                if (isset($list[$i]['icon_new'])) echo $list[$i]['icon_new'];
                if (isset($list[$i]['icon_hot'])) echo $list[$i]['icon_hot'];
                if (isset($list[$i]['icon_file'])) echo $list[$i]['icon_file'];
                if (isset($list[$i]['icon_link'])) echo $list[$i]['icon_link'];
                if (isset($list[$i]['icon_secret'])) echo $list[$i]['icon_secret'];

                 ?>
            </td>
            <td class="td_name sv_use">
				<?php
					if($list[$i]['is_notice']){
				?>
				<span class="btn_confirm noti" style="overflow:hidden">공지사항</span>
				<?php }else{?>
				<span class="btn_confirm <?php echo $statusClassArr[$list[$i]['wr_1']]?>" style="cursor:pointer" <?php if($is_admin){?>onclick="modalView('<?php echo $list[$i]['wr_id']?>','<?php echo $list[$i]['wr_1']?>')"<?php }?> id="status<?php echo $list[$i][wr_id]?>"><?php echo $list[$i]['wr_1']?></span>
				<?php }?>
			</td>
            <td class="td_date hidden-xs"><?php echo $list[$i]['datetime2'] ?></td>
            <td class="td_num hidden-xs"><?php echo $list[$i]['wr_hit'] ?></td>
            <?php if ($is_good) { ?><td class="td_num"><?php echo $list[$i]['wr_good'] ?></td><?php } ?>
            <?php if ($is_nogood) { ?><td class="td_num"><?php echo $list[$i]['wr_nogood'] ?></td><?php } ?>
        </tr>
        <?php } ?>
        <?php if (count($list) == 0) { echo '<tr><td colspan="'.$colspan.'" class="empty_table">게시물이 없습니다.</td></tr>'; } ?>
        </tbody>
        </table>
    </div>

    <?php if ($list_href || $is_checkbox || $write_href) { ?>
    <div class="bo_fx">
        <?php if ($is_checkbox) { ?>
        <ul class="btn_bo_adm">
            <li><input type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value"></li>
            <li><input type="submit" name="btn_submit" value="선택복사" onclick="document.pressed=this.value"></li>
            <li><input type="submit" name="btn_submit" value="선택이동" onclick="document.pressed=this.value"></li>
        </ul>
        <?php } ?>

        <?php if ($list_href || $write_href) { ?>
        <!--<ul class="btn_bo_user">
            <?php if ($list_href) { ?><li><a href="<?php echo $list_href ?>" class="btn_b01">목록</a></li><?php } ?>
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">등록하기</a></li><?php } ?>
        </ul>-->
		<div class="text-center t_margin30 b_margin30">
			<a href="<?php echo $write_href ?>" class="btn_submit03"><i class="fal fa-mouse"></i>
			<?php echo $is_admin?"공지사항 작성":"발주하기";?>
			</a>
		</div>
        <?php } ?>
    </div>
    <?php } ?>
    </form>
</div>

<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>

<!-- 페이지 -->
<?php echo $write_pages;  ?>
<!-- 모달창 시작 -->
<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">상태 변경</h4>
      </div>
      <div class="modal-body">
		<input type="hidden" id="modal-wr-id" value="">
		<ul>
			<li>접수대기</li>
			<li>입금대기</li>
			<li>배송준비중</li>
			<li>배송지연</li>
			<li>발주완료</li>
			<li>발주취소</li>
		</ul>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
      </div>
    </div>
  </div>
</div>
<!-- 모달창 끝 -->
<!-- 게시판 검색 시작 { -->
<fieldset id="bo_sch">
    <legend>게시물 검색</legend>

    <form name="fsearch" method="get">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sop" value="and">
    <label for="sfl" class="sound_only">검색대상</label>
    
    <span class="select_box">
    <select name="sfl" id="sfl">
        <option value="wr_subject,1"<?php echo get_selected($sfl, 'wr_subject,1'); ?>>매장명</option>
        <!--<option value="mb_id,0"<?php echo get_selected($sfl, 'mb_id,0'); ?>>회원아이디(코)</option>
        <option value="wr_name,1"<?php echo get_selected($sfl, 'wr_name,1'); ?>>글쓴이</option>
        <option value="wr_name,0"<?php echo get_selected($sfl, 'wr_name,0'); ?>>글쓴이(코)</option>-->
    </select>
    </span>
    
    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
    <input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required id="stx" class="frm_input sch_input required" maxlength="20">
    <input type="submit" value="검색" class="btn_submit02">
    </form>
</fieldset>
<!-- } 게시판 검색 끝 -->
<script type="text/javascript">
	function modalView(wr_id,status){
		$("#statusModal").modal('show');
		$("#modal-wr-id").val(wr_id);
		const status2=document.getElementById("status"+wr_id).innerHTML;
		var currentStatus=status2;
		if(status2==""){
			currentStatus=status;
		}
		for(var i=0;i < $("#statusModal ul li").length;i++){
			if($("#statusModal ul li").eq(i).html()==currentStatus){
				$("#statusModal ul li").eq(i).addClass("active");
			}else{
				$("#statusModal ul li").eq(i).removeClass("active");
			}
		}
	}
	$(function(){
		$("#statusModal ul li").click(function(){
			const wr_1=$(this).html();
			$.ajax({
				url:g5_bbs_url+"/ajax.wr_1.change.php",
				data:{wr_1:wr_1,wr_id:$("#modal-wr-id").val()},
				dataType:"html",
				type:"post",
				success:function(data){
					$("#statusModal").modal('hide');
					$("#status"+$("#modal-wr-id").val()).html(wr_1);
					switch(wr_1){
						case "접수대기":
							$("#status"+$("#modal-wr-id").val()).addClass("receipt");
							$("#status"+$("#modal-wr-id").val()).removeClass("order");
							$("#status"+$("#modal-wr-id").val()).removeClass("delivery");
							$("#status"+$("#modal-wr-id").val()).removeClass("completion");
							break;
						case "입금대기":
							$("#status"+$("#modal-wr-id").val()).removeClass("receipt");
							$("#status"+$("#modal-wr-id").val()).addClass("order");
							$("#status"+$("#modal-wr-id").val()).removeClass("delivery");
							$("#status"+$("#modal-wr-id").val()).removeClass("completion");
							break;
						case "배송지연":
							$("#status"+$("#modal-wr-id").val()).removeClass("receipt");
							$("#status"+$("#modal-wr-id").val()).removeClass("order");
							$("#status"+$("#modal-wr-id").val()).addClass("delivery");
							$("#status"+$("#modal-wr-id").val()).removeClass("completion");
							break;
						case "발주완료":
							$("#status"+$("#modal-wr-id").val()).removeClass("receipt");
							$("#status"+$("#modal-wr-id").val()).removeClass("order");
							$("#status"+$("#modal-wr-id").val()).removeClass("delivery");
							$("#status"+$("#modal-wr-id").val()).addClass("completion");
							break;
						case "발주취소":
							$("#status"+$("#modal-wr-id").val()).removeClass("receipt");
							$("#status"+$("#modal-wr-id").val()).removeClass("order");
							$("#status"+$("#modal-wr-id").val()).removeClass("delivery");
							$("#status"+$("#modal-wr-id").val()).addClass("completion");
							break;
					}
					alert("상태가 변경되었습니다.");
				}
			});
		});
	});
</script>
<?php if ($is_checkbox) { ?>
<script>
function all_checked(sw) {
    var f = document.fboardlist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]")
            f.elements[i].checked = sw;
    }
}

function fboardlist_submit(f) {
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택복사") {
        select_copy("copy");
        return;
    }

    if(document.pressed == "선택이동") {
        select_copy("move");
        return;
    }

    if(document.pressed == "선택삭제") {
        if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다\n\n답변글이 있는 게시글을 선택하신 경우\n답변글도 선택하셔야 게시글이 삭제됩니다."))
            return false;

        f.removeAttribute("target");
        f.action = "./board_list_update.php";
    }

    return true;
}

// 선택한 게시물 복사 및 이동
function select_copy(sw) {
    var f = document.fboardlist;

    if (sw == "copy")
        str = "복사";
    else
        str = "이동";

    var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

    f.sw.value = sw;
    f.target = "move";
    f.action = "./move.php";
    f.submit();
}
</script>
<?php } ?>
<!-- } 게시판 목록 끝 -->