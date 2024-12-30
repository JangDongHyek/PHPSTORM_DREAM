<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH . '/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="' . $board_skin_url . '/style.css">', 0);
add_javascript('<script type="text/javascript" src="' . $board_skin_url . '/js/default.js"></script>', 100);
add_javascript('<script type="text/javascript" src="' . $board_skin_url . '/js/ui.js"></script>', 100);
?>
<style>
.active{
	border:1px solid #1d3d88;
}
.active li{
	background-color:#1d3d88 !important;
	color:#fff;
}
.active input{
	background-color:#fff;
	color:#000;
}
.active button{
	color:#000;
}
</style>


<div class="gall_wrap">

    <!-- 게시판 목록 시작 { -->
    <div id="bo_gall" style="width:<?php echo $width; ?>">

        <div class="bo_fx">
            <div id="bo_list_total">
                <span>Total <?php echo number_format($total_count) ?>건</span>
                <?php echo $page ?> 페이지
            </div>

            <?php if ($rss_href || $write_href) { ?>
                <ul class="btn_bo_user">
                    <?php if ($rss_href) { ?>
                        <li><a href="<?php echo $rss_href ?>" class="btn_b01">RSS</a></li><?php } ?>
                    <?php if ($_SESSION['ss_mb_id'] == "lets080") { ?>
                        <li><a href="<?php echo $admin_href ?>" class="btn_admin">관리자</a></li><?php } ?>
<!--                    --><?php //if ($write_href) { ?>
<!--                        <li><a href="--><?php //echo $write_href ?><!--" class="btn_b02">등록하기</a></li>--><?php //} ?>
                </ul>
            <?php } ?>
        </div>

        <form name="fboardlist" id="fboardlist" action="./board_list_update.php"
              onsubmit="return fboardlist_submit(this);" method="post">
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
                    <input type="checkbox" id="chkall"
                           onclick="if (this.checked) all_checked(true); else all_checked(false);">
                </div>
            <?php } ?>

            <ul id="gall_ul">
                <?php /*?><?php for ($i=0; $i<count($list); $i++) {
            if($i>0 && ($i % $bo_gallery_cols == 0))
                $style = 'clear:both;';
            else
                $style = '';
            if ($i == 0) $k = 0;
            $k += 1;
            if ($k % $bo_gallery_cols == 0) $style .= "margin:0 !important;";
         ?><?php */ ?>
                <?php for ($i = 0; $i < count($list); $i++) {
                    ?>
                    <li class="gall_li <?php if ($wr_id == $list[$i]['wr_id']) { ?>gall_now<?php } ?>"
                        style="<?php echo $style ?>width:<?php echo $board['bo_gallery_width'] ?>px">
                        <?php if ($is_checkbox) { ?>
                            <label for="chk_wr_id_<?php echo $i ?>"
                                   class="sound_only"><?php echo $list[$i]['subject'] ?></label>
                            <input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>"
                                   id="chk_wr_id_<?php echo $i ?>">
                        <?php } ?>
                        <span class="sound_only">
                <?php
                if ($wr_id == $list[$i]['wr_id'])
                    echo "<span class=\"bo_current\">열람중</span>";
                else
                    echo $list[$i]['num'];
                ?>
            </span>
                        <ul class="gall_con" id="list<?php echo $list[$i]['wr_id']?>" style="cursor:pointer">

                            <li class="gall_href"  onclick="productChoice('<?php echo $list[$i]['wr_id']?>')">
                                <!--<a href="<?php echo $list[$i]['href'] ?>">-->
                                    <div class="over"></div>
                                    <?php
                                    if ($list[$i]['is_notice']) { // 공지사항  ?>
                                        <strong style="width:<?php echo $board['bo_gallery_width'] ?>px;line-height:<?php echo $board['bo_gallery_height'] ?>px">공지</strong>
                                    <?php } else {

                                        $thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], $board['bo_gallery_width'], $board['bo_gallery_height']);

                                        if ($thumb['src']) {
                                            $img_content = '<img src="' . $thumb['src'] . '" alt="' . $thumb['alt'] . '" width="' . $board['bo_gallery_width'] . '" height="' . $board['bo_gallery_height'] . '" class="img">';
                                        } else {
                                            $img_content = '<span class="noimg"><strong>no image</strong></span>';
                                        }

                                        echo $img_content;
                                    }
                                    ?>
                                    
                                
                            </li>
                            <!--<li class="gall_text_href" style="width:<?php echo $board['bo_gallery_width'] ?>px"> -->
                            <li class="gall_text_href">
                                <!--<a href="<?php echo $list[$i]['href'] ?>" class="title">-->
									<div  onclick="productChoice('<?php echo $list[$i]['wr_id']?>')">
                                    <p class="t9" id="subject<?php echo $list[$i][wr_id]?>" ><?php echo $list[$i]['subject'] ?></p><!-- 제목 -->
                                    <p class="t16"><?php echo $list[$i]['wr_1'] ?><!--제품코드 --></p>
                                    <p class="t7 shot" ><!--간단설명-->
                                        <?php echo nl2br($list[$i]['wr_4']);?>
                                    </p>
									</div>
                                    <div class="flex">
                                        <!--<input type="checkbox" id="subject"><label for="subject"></label>-->
                                        <p class="number_controller">
                                            <button type="button" id="minus-btn<?php echo $list[$i]['wr_id']?>" onclick="productCount('<?php echo $list[$i][wr_id]?>',-1)"><i class="fa-regular fa-minus"></i></button>
                                            <input type="text" name="optCnt" value="0" id="count<?php echo $list[$i][wr_id]?>" readonly/>
                                            <button type="button" id="plus-btn<?php echo $list[$i]['wr_id']?>" onclick="productCount('<?php echo $list[$i][wr_id]?>',1)"><i class="fa-regular fa-plus"></i></button>
                                        </p>
										
                                    </div>
									<?php
											if($is_admin){
										?>
											<div><a href="<?php echo G5_BBS_URL?>/write.php?wr_id=<?php echo $list[$i][wr_id]?>&w=u&bo_table=<?php echo $bo_table?>" class="btn">수정하기</a></div>
										<?php }?>
                                    <!--<p class="t6 t_margin20 text-right"><?php echo $list[$i]['wr_3'] ?> 가격안내 -->
                                    <?php /*?><?php if ($list[$i]['comment_cnt']) { ?><span class="sound_only">댓글</span><?php echo $list[$i]['comment_cnt']; ?><span class="sound_only">개</span><?php } ?><?php */ ?>
                                </a>
                                <?php
                                // if ($list[$i]['link']['count']) { echo '['.$list[$i]['link']['count']}.']'; }
                                // if ($list[$i]['file']['count']) { echo '<'.$list[$i]['file']['count'].'>'; }

                                //if (isset($list[$i]['icon_new'])) echo $list[$i]['icon_new'];
                                //if (isset($list[$i]['icon_hot'])) echo $list[$i]['icon_hot'];
                                //if (isset($list[$i]['icon_file'])) echo $list[$i]['icon_file'];
                                //if (isset($list[$i]['icon_link'])) echo $list[$i]['icon_link'];
                                //if (isset($list[$i]['icon_secret'])) echo $list[$i]['icon_secret'];
                                ?></p>
                            </li>
                            <!--<div class="gall_subject">
                    <span>작성자 </span><?php echo $list[$i]['name'] ?>
                    <span>작성일 </span><?php echo $list[$i]['datetime'] ?>
                    <span>조회 </span><?php echo $list[$i]['wr_hit'] ?>
                </div> -->

                            <?php if ($is_good) { ?>
                                <li><span
                                        class="gall_subject">추천</span><strong><?php echo $list[$i]['wr_good'] ?></strong>
                                </li><?php } ?>
                            <?php if ($is_nogood) { ?>
                                <li><span
                                        class="gall_subject">비추천</span><strong><?php echo $list[$i]['wr_nogood'] ?></strong>
                                </li><?php } ?>
                        </ul>
                    </li>
                <?php } ?>
                <?php if (count($list) == 0) {
                    echo "<li class=\"empty_list\">등록된 상품이 없습니다.</li>";
                } ?>
            </ul>

            <div class="text-center">
            <a class="counsel" data-toggle="modal" data-target="#myModal" id="request-btn" style="display:none">
                제품 견적 요청&nbsp;<i class="fa-solid fa-file-import"></i>
            </a>
            </div>

            <!-- 제품 견적 요청 Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">제품견적 요청내용</h4>
                        </div>
                        <div class="modal-body">
                            <textarea placeholder="제품견적요청 상세내용을 입력해주세요" id="content" readonly></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">취소</button>
                            <button type="button" class="btn btn-primary" id="btn-request">요청하기</button>
                        </div>
                        <script type="text/javascript">
							let contents=[];
							//제품 선택과 해제시 이벤트
							const productChoice = (wr_id) => {
					 			const cls = $(`#list${wr_id}`).attr("class");
								//제품이 선택됐을 때
								if(cls.indexOf("active") === -1){
									$(`#list${wr_id}`).addClass("active");
									let data = {};
									data.wr_id=wr_id;
									data.subject = $(`#subject${wr_id}`).html();
									data.count = Number($(`#count${wr_id}`).val());
									
									
									
									contents.push(data);
								//제품이 해제됐을 때
								}else{
									$(`#list${wr_id}`).removeClass("active");
									$(`#count${wr_id}`).val(0);
									
									contents=contents.filter((v) => v.wr_id!==wr_id);
								}
								let content = '';
								for(let i=0;i<contents.length;i++){
									content+=`제품명 : ${contents[i].subject} 개수 : ${contents[i].count}개\n`;
								}
								$("#content").val(content);
								contents.length !==0?$("#request-btn").css("display",""):$("#request-btn").css("display","none");
							}
							//개수 변경하기
							const productCount = (wr_id,sign) => {
								let count = Number($(`#count${wr_id}`).val());
								if(sign === 1){
									
									const cls = $(`#list${wr_id}`).attr("class");
									//제품이 선택됐을 때
									if(cls.indexOf("active") === -1){
										$(`#list${wr_id}`).addClass("active");
										let data = {};
										data.wr_id=wr_id;
										data.subject = $(`#subject${wr_id}`).html();
										data.count = Number($(`#count${wr_id}`).val());
										$("#request-btn").css("display","");
										contents.push(data);
									//제품이 해제됐을 때
									}
								}

								
								sign === -1?count--:count++;

                                if(sign === -1 && count <= 0){

                                    contents=contents.filter((v) => v.wr_id!==wr_id);
                                    $(`#list${wr_id}`).removeClass("active");
                                    $(`#count${wr_id}`).val(0);
                                    $("#request-btn").css("display","none");
                                    return;
                                }
								$(`#count${wr_id}`).val(count);
								//해당 배열에 개수를 변경하기
								const index = contents.findIndex(item => item.wr_id === wr_id);
								if(0<=index){
									contents[index].count=count;
								}
								let content = '';
								for(let i=0;i<contents.length;i++){
									content+=`제품명 : ${contents[i].subject} 개수 : ${contents[i].count}개\n`;
								}
								$("#content").val(content);
							}
                            $("#btn-request").click(()=> {
                                if($("#content").val().length === 0){
                                    alert("내용을 입력하세요");
                                    return false;
                                }
								
                                const data = {
                                    mb_id:'<?php echo $member[mb_id]?>',
									wr_subject:'<?php echo $board[bo_subject]?> 견적요청',
                                    mb_name:'<?php echo $member[mb_name]?>',
									bo_table:"<?php echo $bo_table?>",
                                    content:$("#content").val()
                                }
									
                                $.ajax({
                                    url:`${g5_bbs_url}/ajax.request2.update.php`,
                                    data:data,
                                    type:'post',
                                    dataType:'html',
                                    success:(result)=>{
                                        if(result === 'ok'){
                                            alert('견적문의 요청하였습니다. 관리자가 확인 후 연락드리겠습니다.');
                                        }else{
                                            alert('견적문의 요청에 실패하였습니다.');
                                        }
										//선택된 제품들을 전체 초기화하기
										for(let i=0;i<contents.length;i++){
											let wr_id = contents[i].wr_id;
											$(`#list${wr_id}`).removeClass("active");
											$(`#minus-btn${wr_id}`).attr("disabled",true);
											$(`#count${wr_id}`).attr("disabled",true);
											$(`#count${wr_id}`).val('1');
											$(`#plus-btn${wr_id}`).attr("disabled",true);
										
										}
										contents = [];
										console.log(contents);
                                        $("#myModal").modal('hide');
                                        $("#content").val('');
										$("#request-btn").css("display","none");
                                    }

                                });
                            });

                        </script>
                    </div>
                </div>
            </div>
            <?php

                $sql = "select * from g5_board_file where bo_table='product' and wr_id='{$view['wr_id']}' and bf_no='1'";
                $row2 = sql_fetch($sql);
                if ($row2[bf_no]) {
                    ?>
                    <a class="counsel manual"
                       href="<?php echo G5_BBS_URL ?>/download.php?bo_table=product&wr_id=<?php echo $view[wr_id] ?>&no=1">
                        사용자 메뉴얼
                        <i class="fa-light fa-arrow-down-to-line"></i>
                    </a>
                <?php } ?>


            <?php if ($list_href || $is_checkbox || $write_href) { ?>
                <div class="bo_fx">
                    <?php if ($is_checkbox) { ?>
                        <ul class="btn_bo_adm">
                            <li><input type="submit" name="btn_submit" value="선택삭제"
                                       onclick="document.pressed=this.value"></li>
                            <li><input type="submit" name="btn_submit" value="선택복사"
                                       onclick="document.pressed=this.value"></li>
                            <li><input type="submit" name="btn_submit" value="선택이동"
                                       onclick="document.pressed=this.value"></li>
                        </ul>
                    <?php } ?>

                    <?php if ($list_href || $write_href) { ?>
                        <ul class="btn_bo_user">
                            <?php if ($list_href) { ?>
                                <li><a href="<?php echo $list_href ?>" class="btn_b01">목록</a></li><?php } ?>
                            <?php if ($write_href) { ?>
                                <li><a href="<?php echo $write_href ?>" class="btn_b02">등록하기</a></li><?php } ?>
                        </ul>
                    <?php } ?>
                </div>
            <?php } ?>
        </form>


        <!-- 게시물 검색 시작 { -->
        <fieldset id="bo_sch">
            <legend>게시물 검색</legend>

            <form name="fsearch" method="get">
                <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
                <input type="hidden" name="sca" value="<?php echo $sca ?>">
                <input type="hidden" name="sop" value="and">
                <label for="sfl" class="sound_only">검색대상</label>

                <span class="select_box">
    <select name="sfl" id="sfl">
        <option value="wr_subject"<?php echo get_selected($sfl, 'wr_subject', true); ?>>제목</option>
        <option value="wr_content"<?php echo get_selected($sfl, 'wr_content'); ?>>내용</option>
        <option value="wr_subject||wr_content"<?php echo get_selected($sfl, 'wr_subject||wr_content'); ?>>제목+내용</option>
        <option value="mb_id,1"<?php echo get_selected($sfl, 'mb_id,1'); ?>>회원아이디</option>
        <!--<option value="mb_id,0"<?php echo get_selected($sfl, 'mb_id,0'); ?>>회원아이디(코)</option>
        <option value="wr_name,1"<?php echo get_selected($sfl, 'wr_name,1'); ?>>글쓴이</option>
        <option value="wr_name,0"<?php echo get_selected($sfl, 'wr_name,0'); ?>>글쓴이(코)</option> -->
    </select>
    </span>

                <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
                <input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required id="stx"
                       class="frm_input sch_input required" maxlength="20">
                <input type="submit" value="검색" class="btn_submit02">
            </form>
        </fieldset>
        <!-- } 게시물 검색 끝 -->


    </div>


</div>

<?php if ($is_checkbox) { ?>
    <noscript>
        <p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
    </noscript>
<?php } ?>

<!-- 페이지 -->
<?php echo $write_pages; ?>
	<script type="text/javascript">
		
	</script>
<?php if ($is_checkbox) { ?>
    <script>
        function all_checked(sw) {
            var f = document.fboardlist;

            for (var i = 0; i < f.length; i++) {
                if (f.elements[i].name == "chk_wr_id[]")
                    f.elements[i].checked = sw;
            }
        }

        function fboardlist_submit(f) {
            var chk_count = 0;

            for (var i = 0; i < f.length; i++) {
                if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
                    chk_count++;
            }

            if (!chk_count) {
                alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
                return false;
            }

            if (document.pressed == "선택복사") {
                select_copy("copy");
                return;
            }

            if (document.pressed == "선택이동") {
                select_copy("move");
                return;
            }

            if (document.pressed == "선택삭제") {
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
