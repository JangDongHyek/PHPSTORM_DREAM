<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
function getSizeFile($url) {
    if (substr($url,0,4)=='http') {
        $x = array_change_key_case(get_headers($url, 1),CASE_LOWER);
        if ( strcasecmp($x[0], 'HTTP/1.1 200 OK') != 0 ) { $x = $x['content-length'][1]; }
        else { $x = $x['content-length']; }
    }
    else { $x = @filesize($url); }

    return $x;
}
/**
 * Get Video ID
 * 유투브 주소에서 Video ID를 추출합니다. http://blog.grotesq.com/post/426
 *
 * @access  public
 * @param   string
 * @return  string
 */
if ( ! function_exists( 'get_video_id' ) )
{
    function get_video_id( $str )
    {
        if( substr( $str, 0, 4 ) == 'http' )
        {
            if( strpos( $str, 'youtu.be' ) )
            {
                return array_pop( explode( '/', $str ) );
            }
            else if( strpos( $str, '/embed/' ) )
            {
                return array_pop( explode( '/', $str ) );
            }
            else if( strpos( $str, '/v/' ) )
            {
                return array_pop( explode( '/', $str ) );
            }
            else
            {
                $params = explode( '&', array_shift( explode( '#', array_pop( explode( '?', $str ) ) ) ) );
                foreach( $params as $data )
                {
                    $arr = explode( '=', $data );
                    if( $arr[ 0 ] == 'v' )
                    {
                        return $arr[ 1 ];
                    }
                }
            }
        }
        else
        {
            return $str;
        }
 
        return '';
    }
}
 
/**
 * Get Thumbnail URL
 * 썸네일 주소를 가져옵니다. 기본값은 default 입니다.
 *
 * @param $url_or_id
 * @param $type
 * @return string
 */
if ( ! function_exists( 'get_yt_thumb' ) )
{
    function get_yt_thumb( $url_or_id, $type )
    {
        switch( $type )
        {
            case '0' :
                return '//img.youtube.com/vi/'.get_video_id( $url_or_id ).'/0.jpg';
                break;
            case '1' :
                return '//img.youtube.com/vi/'.get_video_id( $url_or_id ).'/1.jpg';
                break;
            case '2' :
                return '//img.youtube.com/vi/'.get_video_id( $url_or_id ).'/2.jpg';
                break;
            case '3' :
                return '//img.youtube.com/vi/'.get_video_id( $url_or_id ).'/3.jpg';
                break;
            case 'hq' :
                return '//img.youtube.com/vi/'.get_video_id( $url_or_id ).'/hqdefault.jpg';
                break;
            case 'mq' :
                return '//img.youtube.com/vi/'.get_video_id( $url_or_id ).'/mqdefault.jpg';
                break;
            case 'sd' :
                return '//img.youtube.com/vi/'.get_video_id( $url_or_id ).'/sddefault.jpg';
                break;
            case 'maxres' :
                return '//img.youtube.com/vi/'.get_video_id( $url_or_id ).'/maxresdefault.jpg';
                break;
            default :
                return '//img.youtube.com/vi/'.get_video_id( $url_or_id ).'/default.jpg';
        }
    }
}
?>
<!-- wr_1값을 통해 과정명 로드 부분 -->
<?
$sql = "select * from g5_process where idx = {$wr_1}";
$result = sql_fetch($sql);
?>

<h2 id="container_title"><?=$result['process'].' '.$result['textbook']?></h2>

<!-- 게시판 목록 시작 { -->
<div id="bo_gall" style="width:<?php echo $width; ?>">

    <?php if ($is_category) { ?>
    <nav id="bo_cate">
        <h2><?php echo $board['bo_subject'] ?> 카테고리</h2>
        <ul id="bo_cate_ul">
            <?php echo $category_option ?>
        </ul>
    </nav>
    <?php } ?>

    <form name="fboardlist"  id="fboardlist" action="./board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="sw" value="">

    <?php if ($is_checkbox) { ?>
    <div id="gall_allchk">
        <label for="chkall" class="sound_only">현재 페이지 게시물 전체</label>
        <input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);">
    </div>
    <?php } ?>
	
	<ul id="ytb_list">
		<?php for ($i=0; $i<count($list); $i++) {
            if($i>0 && ($i % $bo_gallery_cols == 0))
                $style = 'clear:both;';
            else
                $style = '';
            if ($i == 0) $k = 0;
            $k += 1;
            if ($k % $bo_gallery_cols == 0) $style .= "";

			$sql = "select count(*) as cnt from g5_favorite_video where mb_id = '{$member['mb_id']}' and wr_id = {$list[$i]['wr_id']}";	
			$cnt_bookmark = sql_fetch($sql);

         ?>
		 <li>
		   <a href="<?=$list[$i]['href']?>">
			  <div class="ytb_wrap">
				
				<img src="<?php echo $list[$i]['wr_9'];?>" alt="<?php echo $list[$i]['subject'] ?>">
				
			  </div>
			  <div class="title"><?=$list[$i]['subject']?></div>
			  <div class="con"><?=cut_str(strip_tags($list[$i]['wr_content']), 100, '...');?></div>
		   </a>
		</li>    
		<?php } ?>
        <?php if (count($list) == 0) { echo "<li class=\"empty_list\">등록된 영상이 없습니다.</li>"; } ?>
	</ul>


    

    <?php if ($list_href || $is_checkbox || $write_href) { ?>
    <div class="bo_fx">

        <?php if ($list_href || $write_href) { ?>
        <ul class="btn_bo_user">
            <?php if ($list_href) { ?><li><a href="<?php echo $list_href ?>" class="btn_b01">목록</a></li><?php } ?>
						
            <?php if ($write_href) { ?><li><a href="javascript:void(0);" onclick="move_write('<?=$member['mb_id']?>', '<?=$result['mb_id']?>')" class="btn_b02">등록</a></li><?php } ?>
						
			
        </ul>
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

<script>
function move_write(mb_id, wr_id){

//	<?php echo $write_href.'&wr_1='.$wr_1 ?>

	/*if(mb_id != wr_id){
		alert("작성자만 가능합니다");
	}
	else{*/
		location.href="<?php echo $write_href.'&wr_1='.$wr_1 ?>&mode=<?=$mode?>&mb_id=<?=$stx?>";
	//}
}


function favorite(wrid, flg){

		var process_id = <?if(!empty($wr_1)) echo $wr_1; else echo 0;?>		
		

	if(process_id !='none'){
		
		if(flg ==1){		

		$.ajax({
				url: "./ajax.insert_favorite.php",
				type: "POST",
				data: {
						"process_id": process_id,
						"wr_id" : wrid
				},
				success: function(data){												
					$("#ic_on"+wrid).css("display","block");
					$("#ic_off"+wrid).css("display","none");
				}
		});
		}
		else{
		$.ajax({
				url: "./ajax.delete_favorite.php",
				type: "POST",
				data: {					
						"wr_id" : wrid
				},
				success: function(data){	
					console.log(data);
					$("#ic_on"+wrid).css("display","none");
					$("#ic_off"+wrid).css("display","block");

				}
		});

		}
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
