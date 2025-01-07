<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/default.js"></script>', 100);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/ui.js"></script>', 100);
//처음 큰이미지 보여주기
$sql="select * from $write_table where ca_name='New' order by wr_id desc limit 1";
$vRow=sql_fetch($sql);
$thumbView = get_list_thumbnail($board['bo_table'], $vRow['wr_id'], $board['bo_gallery_width'], $board['bo_gallery_height']);
//New 커피 쿼리문
$sql="select * from $write_table where ca_name='New' order by wr_id desc";
$result=sql_query($sql);

//Best 커피 쿼리문
$sql="select * from $write_table where ca_name='Best' order by wr_id desc";
$result2=sql_query($sql);
?>
<div id="box_wrap">
<h2>NEW</h2>
<!-- New 메뉴 이미지 보기 시작 -->
<div class="text-center" id="imgBig1" >
	<img src="<?php echo $thumbView['ori']?>" /><br/><br/>
	<span class="icon">New</span>
	<?php echo $vRow[wr_subject]?>

</div>
<!-- New 메뉴 이미지 보기 끝 -->
<!-- New 메뉴 목록 시작-->
<div class="">
		<div class="table">
			<ul>
				<?php
					for($i=0;$row=sql_fetch_array($result);$i++){
						$thumb = get_list_thumbnail($board['bo_table'], $row['wr_id'], $board['bo_gallery_width'], $board['bo_gallery_height']);
						if($i%5==0){
							echo "</tr><tr><td>";
						}
				?>
				<li>
					<div style="cursor:pointer;" onclick="imgView('imgBig1','<?php echo $thumb['ori']?>','<?php echo $row[wr_subject]?>')">
					<?php 
						if($thumb['src']) {
                            $img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'" width="'.$board['bo_gallery_width'].'" height="'.$board['bo_gallery_height'].'" class="img">';
                        } else {
                            $img_content = '<span style="width:'.$board['bo_gallery_width'].'px;line-height:'.$board['bo_gallery_height'].'px" class="noimg">no image</span>';
                        }

                        echo $img_content;
					?>
                    <p><span class="icon">New</span>
					<?php echo $row[wr_subject]?></p>
					<?php
						if($is_admin){
					?><br/>
					<a href="./write.php?bo_table=<?php echo $bo_table?>&wr_id=<?php echo $row[wr_id]?>&w=u" class="btn"><i class="fal fa-pen"></i></a>
					<a href="javascript:;" onclick="boardRemove('<?php echo $row[wr_id]?>')" class="btn"><i class="fal fa-trash"></i></a>
					<?php }?>
					</div>
				</li>
				<?php }?>
			</ul>
		</div>
</div>
<!-- New 메뉴 목록 끝 -->
</div>
<div id="box_wrap">
<h2>Best</h2>
<!-- New 메뉴 이미지 보기 시작 -->
<div class="text-center" id="imgBig2" style="display:none">
	<img src="<?php echo $thumbView['ori']?>"/><br/><br/>
	<span class="icon">New</span>
	<?php echo $vRow[wr_subject]?>

</div>

<!-- Best 메뉴 시작 -->
<div class="">
		<div class="table">
			<ul>
				<?php
					for($i=0;$row2=sql_fetch_array($result2);$i++){
						$thumb = get_list_thumbnail($board['bo_table'], $row2['wr_id'], $board['bo_gallery_width'], $board['bo_gallery_height']);
						if($i%5==0){
							echo "</tr><tr><td>";
						}
				?>
				<li>
					<div style="cursor:pointer;" onclick="imgView('imgBig2','<?php echo $thumb['ori']?>','<?php echo $row2[wr_subject]?>')">
					<?php 
						if($thumb['src']) {
                            $img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'" width="'.$board['bo_gallery_width'].'" height="'.$board['bo_gallery_height'].'" class="img">';
                        } else {
                            $img_content = '<span style="width:'.$board['bo_gallery_width'].'px;line-height:'.$board['bo_gallery_height'].'px" class="noimg">no image</span>';
                        }

                        echo $img_content;
					?><p><span class="icon">Best</span>
					<?php echo $row2[wr_subject]?></p>
					<?php
						if($is_admin){
					?><br/>
					<a href="./write.php?bo_table=<?php echo $bo_table?>&wr_id=<?php echo $row2[wr_id]?>&w=u" class="btn"><i class="fal fa-pen"></i></a>
					<a href="javascript:;" onclick="boardRemove('<?php echo $row2[wr_id]?>')" class="btn"><i class="fal fa-trash"></i></a>
					<?php }?>
					</div>
				</li>
				<?php }?>
			</ul>
		</div>
</div>
<!-- Best 메뉴 끝 -->
</div>


<?php if ($list_href || $is_checkbox || $write_href) { ?>
    <div class="bo_fx">


        <?php if ($list_href || $write_href) { ?>
        <ul class="btn_bo_user">
            <!--<?php if ($list_href) { ?><li><a href="<?php echo $list_href ?>" class="btn_b01">목록</a></li><?php } ?>-->
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">메뉴등록하기</a></li><?php } ?>
        </ul>
        <?php } ?>
    </div>
    <?php } ?>
<script>
	//이미지 크게 보기 이벤트
	function imgView(id,path,subject){
		if(id=="imgBig1"){
			if($("#imgBig2").css("display")=="block"||$("#imgBig2").css("display")==""){
				$("#imgBig2").css("display","none")
			}
		}else if(id=="imgBig2"){
			if($("#imgBig1").css("display")=="block"||$("#imgBig1").css("display")==""){
				$("#imgBig1").css("display","none")
			}
		}
		$("#"+id).css("display","");


		var strHtml=`<img src="${path}" /><br/><br/>`;
		strHtml+=`<span class="icon">New</span>`
		strHtml+=`${subject}`;
		$("#"+id).html(strHtml);
	}
	//삭제하기 confirm창 띄우기
	function boardRemove(wr_id){
		if(confirm("이 사진을 삭제하시겠습니까?\n삭제하시면 복구는 불가능합니다.")){
			location.href="./delete.php?bo_table=<?php echo $bo_table?>&wr_id="+wr_id;
		}
	}
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

    if (sw == 'copy')
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
