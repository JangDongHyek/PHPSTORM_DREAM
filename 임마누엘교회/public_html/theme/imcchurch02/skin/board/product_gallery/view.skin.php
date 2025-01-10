<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<!-- 이미지 슬라이더 -->
<link rel="stylesheet" href="<?=$board_skin_url?>/fotorama/fotorama.css">
<script src="<?=$board_skin_url?>/fotorama/fotorama.js"></script>

<!--<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>-->

<!-- 게시물 읽기 시작 { -->
<!--<div id="bo_v_table"><?php echo $board['bo_subject']; ?></div> -->
<!-- Large modal -->


<style>
	@media(max-width:768px){
	.col-md-7{
		padding: 0;
	}
	}
</style>

<article id="bo_v" style="width:<?php echo $width; ?>">

	<?php
    if ($view['file']['count']) {
        $cnt = 0;
        for ($i=0; $i<count($view['file']); $i++) {
            if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view'])
                $cnt++;
        }
    }
     ?>



	<?php
    if ($view['link']) {
     ?>
	<!-- 관련링크 시작 { -->
	<section id="bo_v_link">
		<h2>관련링크</h2>
		<ul>
			<?php
        // 링크
        $cnt = 0;
        for ($i=1; $i<=count($view['link']); $i++) {
            if ($view['link'][$i]) {
                $cnt++;
                $link = cut_str($view['link'][$i], 70);
         ?>
			<li>
				<a href="<?php echo $view['link_href'][$i] ?>" target="_blank">
					<img src="<?php echo $board_skin_url ?>/img/icon_link.gif" alt="관련링크">
					<strong><?php echo $link ?></strong>
				</a>
				<span class="bo_v_link_cnt"><?php echo $view['link_hit'][$i] ?>회 연결</span>
			</li>
			<?php
            }
        }
         ?>
		</ul>
	</section>
	<!-- } 관련링크 끝 -->
	<?php } ?>

	<!-- 게시물 상단 버튼 시작 { -->
	<div id="bo_v_top">
		<?php
        ob_start();
         ?>
		<?php if ($prev_href || $next_href) { ?>
		<ul class="bo_v_nb">
			<?php if ($prev_href) { ?><li><a href="<?php echo $prev_href ?>" class="btn_b01">이전제품</a></li><?php } ?>
			<?php if ($next_href) { ?><li><a href="<?php echo $next_href ?>" class="btn_b01">다음제품</a></li><?php } ?>
		</ul>
		<?php } ?>

		<ul class="bo_v_com">
			<?php if ($update_href) { ?><li><a href="<?php echo $update_href ?>" class="btn_b01">수정</a></li><?php } ?>
			<?php if ($delete_href) { ?><li><a href="<?php echo $delete_href ?>" class="btn_b01" onclick="del(this.href); return false;">삭제</a></li><?php } ?>
			<!--<?php if ($copy_href) { ?><li><a href="<?php echo $copy_href ?>" class="btn_admin" onclick="board_move(this.href); return false;">복사</a></li><?php } ?>
            <?php if ($move_href) { ?><li><a href="<?php echo $move_href ?>" class="btn_admin" onclick="board_move(this.href); return false;">이동</a></li><?php } ?>-->
			<?php if ($search_href) { ?><li><a href="<?php echo $search_href ?>" class="btn_b01">검색</a></li><?php } ?>
			<li><a href="<?php echo $list_href ?>" class="btn_b01">목록</a></li>
			<?php /*?><?php if ($reply_href) { ?><li><a href="<?php echo $reply_href ?>" class="btn_b01">답변</a></li><?php } ?><?php */?>
			<?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">글쓰기</a></li><?php } ?>
		</ul>
		<?php
        $link_buttons = ob_get_contents();
        ob_end_flush();
         ?>
	</div>
	<!-- } 게시물 상단 버튼 끝 -->

	<section id="bo_v_atc">
		<h2 id="bo_v_atc_title">본문</h2>

		<div class="clearfix header">
			<div class="col-md-5 text-center wow bounceIn">
				<div id="foto" class="fotorama" data-width="100%" data-nav="thumbs" data-loop="true" data-autoplay="true">
					<?php
				// 파일 출력
				$v_img_count = count($view['file']);
				if($v_img_count) {
					for ($i=0; $i<=4; $i++) {
						if ($view['file'][$i]['view']) {
							$view['file'][$i]['href'] = '';
							echo get_view_thumbnail($view['file'][$i]['view']);
						}
					}
				}
				?>
				</div>
			</div>
			<div class="col-md-7 info_wrap">
				<div class="info_t">
					<p class="t1"><?=$view['wr_subject']?></p>
					<?php
						echo $view[wr_2]!=""?$view[wr_2]:"";
					?>
				</div> <!-- 제품명 -->
				<div class="info_c">
				<p class="tit"><i class="fas fa-mouse-pointer"></i> 원하시는 부품을 선택해주세요</p>
				<ul class="file_list">
					<input type="hidden" name="part_idx" value="" id="part-idx">
					<?php
						$sql="select * from g5_part where wr_id='$wr_id' and is_view='1'";
						$result2=sql_query($sql);
						for($i=0;$row2=sql_fetch_array($result2);$i++){
					?>
					<!-- <li class="pro_box checked"> -->
					<li class="pro_box" onclick="partChoice('<?php echo $row2[idx]?>')" id="pro_box<?php echo $row2[idx]?>">
						<input type="hidden" id="partname<?php echo $row2[idx]?>" value="<?php echo $row2[partname]?>">
						<input type="hidden" id="partprice<?php echo $row2[idx]?>" value="<?php echo $row2[partprice]?>">
						<div class="img_wrap">
							<a href="javascript:;" class="ico_sch" onclick="window.open('<?php echo G5_DATA_URL ?>/file/part/image/<?php echo $row2[partimg]?>','popup','width=800,height=600,scrollbars=yes')"><i></i></a>
						<img src="<?php echo G5_DATA_URL ?>/file/part/image/<?php echo $row2[partimg]?>" alt="">
						<i class="fas fa-check-circle"></i>
						</div>
						<div class="text_wrap">
							<h6>
								<?php echo $row2[partname]?>
							</h6>
							<p>₩<span class="pro_price"><?php echo number_format($row2[partprice])?></span></p>
						</div>
						<?php
							if($row2[partpdf]!=""){
						?>
						<a href="<?php echo G5_BBS_URL?>/pdf_download.php?wr_id=<?php echo $wr_id?>&idx=<?php echo $row2[idx]?>" class="btn_download">
							부품 PDF파일 다운로드
						</a>
						<?php }?>
							
						
					</li>
					<?php }?>
					<script type="text/javascript">
						var total=0;
						var idxArr=new Array();
						let partIdx="";
						function partChoice(idx){
							if(0 < $("#pro_box"+idx).attr("class").indexOf("checked")){
								total-=parseInt($("#partprice"+idx).val());

								idxArr = idxArr.filter((item) => {
									return item !== idx;
								});
							}else{
								total+=parseInt($("#partprice"+idx).val());
								idxArr.push(idx);

							}
							$("#total").html(number_format(total.toString()));
							
							idxArr.sort();
							let tempPartIdx="";
							for(let i=0;i<idxArr.length;i++){
								tempPartIdx+=idxArr[i]+"|";
							}
							partIdx=tempPartIdx;
						}
											// 자바스크립트로 PHP의 number_format 흉내를 냄
						// 숫자에 , 를 출력
						function number_format(data)
						{

							var tmp = '';
							var number = '';
							var cutlen = 3;
							var comma = ',';
							var i;

							var sign = data.match(/^[\+\-]/);
							if(sign) {
								data = data.replace(/^[\+\-]/, "");
							}

							len = data.length;
							mod = (len % cutlen);
							k = cutlen - mod;
							for (i=0; i<data.length; i++)
							{
								number = number + data.charAt(i);

								if (i < data.length - 1)
								{
									k++;
									if ((k % cutlen) == 0)
									{
										number = number + comma;
										k = 0;
									}
								}
							}

							if(sign != null)
								number = sign+number;

							return number;
						}
						function goRequest(){
							if(partIdx==""){
								alert("부품을 먼저 선택하십시오");
								return;
							}
							location.href="<?php echo G5_BBS_URL ?>/write.php?bo_table=product_request&subject=<?php echo $view[wr_subject]?>&partIdx="+partIdx;
						}

					</script>
					
				</ul>
				<?php
							if($view[wr_4]){
					?>
				<p><?php echo $view[wr_4]?></p>
				<?php }?>
				</div>
				
				<div class="info_b">
				<h1>
					합계금액:
					<span class="total_price" id="total">
						
					</span>
					원
				</h1><!-- 제품코드 -->

				<!--견적신청버튼-->
				<!-- <a href="<?php echo G5_BBS_URL ?>/write.php?bo_table=product_request&subject=<?php echo $view[wr_subject]?>" class="counsel"> -->
				<a href="javascript:;" onclick="goRequest()" class="counsel">
				<i class="fal fa-keyboard"></i>&nbsp;&nbsp;제품견적하기</a>

				<!--
						<a href="<?php echo $view['file'][4]['href'];  ?>" class="counsel ver2"><i class='fa fa-clone'></i>&nbsp;도면다운로드</a>
						<a href="#link" class="counsel ver2"  data-toggle="modal" data-target="#exampleModal"><i class='fa fa-clone'></i>&nbsp;도면보기</a>-->

				<!--//견적신청버튼-->
				</div>
			</div>
		</div>



		<!-- 본문 내용 시작 { -->
		<div class="thumb_img">
			<h3>제품상세설명</h3>
			<?php echo get_view_thumbnail($view['content']); ?>
		</div>

		<? /* <div class="wrapper">
	    <div class="tabs cf">
		<input type="radio" name="tabs" id="tab1" checked>
		<label for="tab1">
        제품설명
        </label>
		<input type="radio" name="tabs" id="tab2">
		<label for="tab2">
        스펙
        </label>

		<div id="tab-content1" class="tab-content"><div class="thumb_img"><?php echo get_view_thumbnail($view['content']); ?>
		</div>
		</div>
		<div id="tab-content2" class="tab-content"><?php echo get_view_thumbnail($view['wr_text2']); ?></div>
		</div>
		</div>*/ ?>



		<!--<h3 class="tit">제품설명</h3>
		<div><?php echo get_view_thumbnail($view['content']); ?></div>-->
		<?php//echo $view['rich_content']; // {이미지:0} 과 같은 코드를 사용할 경우 ?>
		<!-- } 본문 내용 끝 -->

		<?php if ($is_signature) { ?><p><?php echo $signature ?></p><?php } ?>

		<?php /*?>
		<!-- 스크랩 추천 비추천 시작 { -->
		<?php if ($scrap_href || $good_href || $nogood_href) { ?>
		<div id="bo_v_act">
			<?php if ($scrap_href) { ?><a href="<?php echo $scrap_href;  ?>" target="_blank" class="btn_b01" onclick="win_scrap(this.href); return false;">스크랩</a><?php } ?>
			<?php if ($good_href) { ?>
			<span class="bo_v_act_gng">
				<a href="<?php echo $good_href.'&amp;'.$qstr ?>" id="good_button" class="btn_b01">추천 <strong><?php echo number_format($view['wr_good']) ?></strong></a>
				<b id="bo_v_act_good"></b>
			</span>
			<?php } ?>
			<?php if ($nogood_href) { ?>
			<span class="bo_v_act_gng">
				<a href="<?php echo $nogood_href.'&amp;'.$qstr ?>" id="nogood_button" class="btn_b01">비추천 <strong><?php echo number_format($view['wr_nogood']) ?></strong></a>
				<b id="bo_v_act_nogood"></b>
			</span>
			<?php } ?>
		</div>
		<?php } else {
            if($board['bo_use_good'] || $board['bo_use_nogood']) {
        ?>
		<div id="bo_v_act">
			<?php if($board['bo_use_good']) { ?><span>추천 <strong><?php echo number_format($view['wr_good']) ?></strong></span><?php } ?>
			<?php if($board['bo_use_nogood']) { ?><span>비추천 <strong><?php echo number_format($view['wr_nogood']) ?></strong></span><?php } ?>
		</div>
		<?php
            }
        }
        ?>
		<!-- } 스크랩 추천 비추천 끝 --><?php */?>
	</section>

	<?php
    //include_once(G5_SNS_PATH."/view.sns.skin.php");
    ?>

	<?php
    // 코멘트 입출력
    //include_once(G5_BBS_PATH.'/view_comment.php');
     ?>

	<!-- 링크 버튼 시작 { -->
	<div id="bo_v_bot">
		<?php echo $link_buttons ?>
	</div>
	<!-- } 링크 버튼 끝 -->

</article>
<!-- } 게시판 읽기 끝 -->

<script>
	<?php if ($board['bo_download_point'] < 0) { ?>
	$(function() {
		$("a.view_file_download").click(function() {
			if (!g5_is_member) {
				alert("다운로드 권한이 없습니다.\n회원이시라면 로그인 후 이용해 보십시오.");
				return false;
			}

			var msg = "파일을 다운로드 하시면 포인트가 차감(<?php echo number_format($board['bo_download_point']) ?>점)됩니다.\n\n포인트는 게시물당 한번만 차감되며 다음에 다시 다운로드 하셔도 중복하여 차감하지 않습니다.\n\n그래도 다운로드 하시겠습니까?";

			if (confirm(msg)) {
				var href = $(this).attr("href") + "&js=on";
				$(this).attr("href", href);

				return true;
			} else {
				return false;
			}
		});
	});
	<?php } ?>

	function board_move(href) {
		window.open(href, "boardmove", "left=50, top=50, width=500, height=550, scrollbars=1");
	}

</script>

<script>
	$(function() {
		$("a.view_image").click(function() {
			window.open(this.href, "large_image", "location=yes,links=no,toolbar=no,top=10,left=10,width=10,height=10,resizable=yes,scrollbars=no,status=no");
			return false;
		});

		// 추천, 비추천
		$("#good_button, #nogood_button").click(function() {
			var $tx;
			if (this.id == "good_button")
				$tx = $("#bo_v_act_good");
			else
				$tx = $("#bo_v_act_nogood");

			excute_good(this.href, $(this), $tx);
			return false;
		});

		// 이미지 리사이즈
		$("#bo_v_atc").viewimageresize();
	});

	function excute_good(href, $el, $tx) {
		$.post(
			href, {
				js: "on"
			},
			function(data) {
				if (data.error) {
					alert(data.error);
					return false;
				}

				if (data.count) {
					$el.find("strong").text(number_format(String(data.count)));
					if ($tx.attr("id").search("nogood") > -1) {
						$tx.text("이 글을 비추천하셨습니다.");
						$tx.fadeIn(200).delay(2500).fadeOut(200);
					} else {
						$tx.text("이 글을 추천하셨습니다.");
						$tx.fadeIn(200).delay(2500).fadeOut(200);
					}
				}
			}, "json"
		);
	}
	
	
	$('.pro_box').click(function(){
		$(this).toggleClass('checked')
	})

</script>
<!-- } 게시글 읽기 끝 -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="exampleModalLabel">도면보기</h4>
			</div>
			<div class="modal-body">
				<?php
			echo $view['file'][1]['view']?get_view_thumbnail($view['file'][1]['view']):"도면 이미지가 없습니다.";
		?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
			</div>
		</div>
	</div>
</div>
