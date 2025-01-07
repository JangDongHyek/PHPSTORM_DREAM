<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/default.js"></script>', 100);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/ui.js"></script>', 100);

?>

<section id="bo_w">
    <!--<h2 id="container_title"><?php echo $g5['title'] ?></h2> -->

    <!-- 게시물 작성/수정 시작 { -->
    <form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:<?php echo $width; ?>">
    <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    

    <!--상품리스트-->
	<?php
		if(!$view[is_notice]){
	?>
    <h3 class="tit_order">발주 상품 리스트<span>아래 발주 상품을 선택해주세요.</span></h3>
    <div id="Wrap_list">
                     <div class="scroll_comm">스크롤을 하셔야 합니다. ↔</div>
                     <div class="tbl_order">
                                
                                <table>
                                   
                                    <thead>
                                    <tr>
                                        
                                        <th class="text-center">사진</th>
                                        <th class="text-center">상품명</th>
                                        <th class="text-center">가격</th>
                                        <th class="text-center">수량</th>
                                        <th class="text-center">합계</th>
                                       <!-- <th class="text-center">삭제</th>-->
                                    </tr>
                                    </thead>
                                    <tbody>
									   <?php
									   $totalPrice=0;
										$sql="select * from g5_order where wr_id='$wr_id'";
										$result=sql_query($sql);
										for($i=0;$row=sql_fetch_array($result);$i++){
											$sql="select item_image from g5_item where idx='$row[item_idx]'";
											$row2=sql_fetch($sql);
									   ?>
									  
                                       <tr>
											<td>
											<div class="proimg" style="background:url(<?php echo $row2[item_image]!=""?G5_DATA_URL."/item/thumb/".$row2[item_image]:G5_THEME_URL."/img/noimg.png"?>) no-repeat center center"></div></td>
                                            <td class="text-center"><?php echo $row[item_name]?></td>
                                            <td class="text-center"><?php echo number_format($row[price])?>원</td>
                                            <td class="text-center in_de" id="eaCount<?php echo $i;?>">
                                                <?php echo $row[ea]?>개
                                            </td>
                                            <td class="text-center"><span class="opt_total_price<?php echo $i?>" id="opt_total_price<?php echo $i?>">
												<?php
													echo number_format($row[ea]*$row[price]);
												?>
											</span>원</td>
                                            <!--<td class="text-center">
                                                <button type="button" onclick="select_del(332)" id="PopoverCustomT-1" class="btn btn-primary btn-sm">삭제</button>
                                            </td>-->
                                        </tr>
										<?php 
											 $totalPrice+=$row[ea]*$row[price];
										}?>
                                                                             
                                    </tbody>
									
                                </table>
                    </div><!--//.table-->
                    <!--총금액-->
                    <div class="totPrice text-right t_margin10 b_margin10">
                            <span>상품가격</span>
							<span id="item_price_txt"><?php echo number_format($totalPrice)?></span><span>원</span>
							<span>+</span>
							<span>배송비</span>
							<span id="tax_price_txt">4,100</span><span>원</span>
							<span>총 금액</span>
                            <span id="total_price_txt"><?php echo number_format($totalPrice+4100)?></span> <span>원</span>
                    </div>
    </div><!--//#Wrap_list-->
	<?php }?>
    <!--//상품리스트-->

    <!--등록폼
    <div class="form">
         <div><?php echo $view[subject] ?><?php if(!$view[is_notice]){?>님 발주하였습니다.<?php }?></div>
         <div><?php echo $view[wr_content]?></div>
    </div>-->
    
	<article id="bo_v" style="width:<?php echo $width; ?>">
    
    <header>
        <h1 id="bo_v_title">
            <!--제목//공지작성시 입력(관리자 전용)-->
            <?php echo $view[subject] ?><?php if(!$view[is_notice]){?>님 발주하였습니다.<?php }?>
        </h1>
    </header>  
      
    <div class="t_margin15 b_margin15"><?php echo $view[wr_content]?></div>
    
	 <!-- 게시물 상단 버튼 시작 { -->
    <div id="bo_v_top">
        <?php
        ob_start();
         ?>
        <?php if ($prev_href || $next_href) { ?>
        <ul class="bo_v_nb">
            <?php if ($prev_href) { ?><li><a href="<?php echo $prev_href ?>" class="btn_b01">이전글</a></li><?php } ?>
            <?php if ($next_href) { ?><li><a href="<?php echo $next_href ?>" class="btn_b01">다음글</a></li><?php } ?>
        </ul>
        <?php } ?>

        <ul class="bo_v_com">
            <?php if($is_admin){?>
               <?php if ($update_href) { ?><li><a href="<?php echo $update_href ?>" class="btn_b01">수정</a></li><?php } ?>
            <?php }else{?>
            <?php } ?>
            <?php if ($delete_href) { ?><li><a href="<?php echo $delete_href ?>" class="btn_b01" onclick="del(this.href); return false;">삭제</a></li><?php } ?>
            <?php if ($copy_href) { ?><li><a href="<?php echo $copy_href ?>" class="btn_admin" onclick="board_move(this.href); return false;">복사</a></li><?php } ?>
            <?php if ($move_href) { ?><li><a href="<?php echo $move_href ?>" class="btn_admin" onclick="board_move(this.href); return false;">이동</a></li><?php } ?>
            <?php if ($search_href) { ?><li><a href="<?php echo $search_href ?>" class="btn_b01">검색</a></li><?php } ?>
            <li><a href="<?php echo $list_href ?>" class="btn_b01">목록</a></li>
<!--            <?php if ($reply_href) { ?><li><a href="<?php echo $reply_href ?>" class="btn_b01">답변</a></li><?php } ?>
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">글쓰기</a></li><?php } ?>-->
        </ul>
        <?php
        $link_buttons = ob_get_contents();
        ob_end_flush();
         ?>
    </div>
    <!-- } 게시물 상단 버튼 끝 -->
	</article>
   
    </form>

   
</section>
<!-- } 게시물 작성/수정 끝 -->