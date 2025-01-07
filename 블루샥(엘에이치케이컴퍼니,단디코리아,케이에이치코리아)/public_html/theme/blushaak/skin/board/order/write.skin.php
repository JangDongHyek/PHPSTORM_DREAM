<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/default.js"></script>', 100);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/ui.js"></script>', 100);
if(!$is_admin){
	$subject=$member[mb_1];
}
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
	<input type="hidden" name="wr_1" value="접수대기">
    <?php
    $option = '';
    $option_hidden = '';
    if ($is_notice || $is_html || $is_secret || $is_mail) {
        $option = '';
        if ($is_notice) {
            $option .= "\n".'<input type="checkbox" id="notice" name="notice" value="1" '.$notice_checked.'>'."\n".'<label for="notice">공지</label>';
        }

        if ($is_html) {
            if ($is_dhtml_editor) {
                $option_hidden .= '<input type="hidden" value="html1" name="html">';
            } else {
                $option .= "\n".'<input type="checkbox" id="html" name="html" onclick="html_auto_br(this);" value="'.$html_value.'" '.$html_checked.'>'."\n".'<label for="html">html</label>';
            }
        }

        if ($is_secret) {
            if ($is_admin || $is_secret==1) {
                $option .= "\n".'<input type="checkbox" id="secret" name="secret" value="secret" '.$secret_checked.'>'."\n".'<label for="secret">비밀글</label>';
            } else {
                $option_hidden .= '<input type="hidden" name="secret" value="secret">';
            }
        }

        if ($is_mail) {
            $option .= "\n".'<input type="checkbox" id="mail" name="mail" value="mail" '.$recv_email_checked.'>'."\n".'<label for="mail">답변메일받기</label>';
        }
    }

    echo $option_hidden;
    ?>

    <!--상품리스트-->
	<?php
		if(!$is_admin){
	?>
    <h3 class="tit_order">발주 상품 리스트<span>아래 발주 상품을 선택해주세요.</span></h3>
    <nav id="bo_cate">
            <h2>발주프로그램 카테고리</h2>
            <ul id="bo_cate_ul">
                <li><a href="javascript:;" id="bo_cates" class="bo_cate_on" onclick="categoryView('')">전체</a></li>
				<?php
					$sql="select * from g5_category";
					$cResult=sql_query($sql);
					for($i=0;$cRow=sql_fetch_array($cResult);$i++){
				?>
				
                <li><a href="javascript:;" id="bo_cate<?php echo $cRow[idx]?>" onclick="categoryView('<?php echo $cRow[idx]?>')"><?php echo $cRow[category_name]?></a></li>
				<?php }?>
            </ul>
			<script type="text/javascript">
				function categoryView(no){
					$("a").removeClass("bo_cate_on");
					if(no!==""){
						$(`#bo_cate${no}`).addClass("bo_cate_on");
						$("#item-list tr").css("display","none");
						$(`.category_no${no}`).css('display','');
					}else{
						$('#bo_cates').addClass("bo_cate_on");
						$("#item-list tr").css("display","");
					}
				}
			</script>
    </nav>
    <div id="Wrap_list">
                     <div class="scroll_comm"><img src="../theme/simsan/img/sub/scroll_comm.png" alt="">스크롤을 하셔야 합니다. ↔</div>
                     <div>※ 이미지를 클릭하시면 큰 사진으로 보실 수 있습니다.</div>
                     <div class="tbl_order">
                                <input type="hidden" name="send_limit_price" value="60000">
                                <input type="hidden" name="send_price" value="3500">
                                <input type="hidden" name="total_price" value="0">
                                <table>
                                    <colgroup>
                                        <col style="width:12%">
                                        <col style="width:10%">
                                        <col style="width:*%">
                                        <col style="width:13%">
                                        <col style="width:20%">
                                        <col style="width:13%">
                                    </colgroup>
                                    <thead>
                                    <tr>
                                        <th class="checkbox_custom">
                                        <span>
                                            <input type="checkbox" id="all_pt_chk" onclick="all_chk()" class="form-check-input">
                                            <label for="all_pt_chk">전체</label>
                                        </span>
                                        </th>
                                        <th class="text-center">이미지</th>
                                        <th class="text-center">상품명</th>
                                        <th class="text-center">가격</th>
                                        <th class="text-center">수량</th>
                                        <th class="text-center">합계</th>
                                       <!-- <th class="text-center">삭제</th>-->
                                    </tr>
                                    </thead>
                                    <tbody id="item-list">
									   <?php
										$sql="select * from g5_item order by orderby desc";
										$result=sql_query($sql);
										for($i=0;$row=sql_fetch_array($result);$i++){
									   ?>
									   <input type="hidden" name="price[<?php echo $i?>]" value="<?php echo $row[price]?>" id="price<?php echo $i?>">
									   <input type="hidden" name="item_name[<?php echo $i?>]" value="<?php echo $row[item_name]?>">
									   <input type="hidden" name="idx[<?php echo $i?>]" value="<?php echo $row[idx]?>">
									   <input type="hidden" name="item_idx[<?php echo $i?>]" value="<?php echo $row[idx]?>">
                                       <tr class="category_no<?php echo $row[category_no]?>">
                                            <td class="checkbox_custom">
                                            <span>
                                               <!-- <input type="hidden" class="tar_idx0" name="item_idx[0]" value="332">
                                                <input type="hidden" class="opt_target0" name="price[0]" value="1000">
                                                <input type="hidden" class="opt_total0" value="1000">
                                                <input type="hidden" class="opt_tot_price0" name="opt_tot_price[0]" value="1000">-->
                                                <input type="checkbox" class="form-check-input" id="pt_chk<?php echo $i?>" name="chk_no[]" onclick="chkSelected('<?php echo $i?>')" value="<?php echo $i?>">
                                                <label for="pt_chk<?php echo $i?>">선택</label>
                                            </span>
                                            </td>
                                            <td class="text-center" onclick="window.open('<?php echo G5_DATA_URL?>/item/<?php echo $row[item_image]?>','images','width=800;height=600,scrollbars=yes')">
                                                <div class="proimg" style="background:url(<?php echo $row[item_image]!=""?G5_DATA_URL."/item/thumb/".$row[item_image]:G5_THEME_URL."/img/noimg.png"?>) no-repeat center center; cursor:pointer">
													
                                                </div>
                                            </td>
                                            <td class="text-center"><?php echo $row[item_name]?></td>
                                            <td class="text-center"><?php echo number_format($row[price])?>원</td>
                                            <td class="text-center in_de" id="eaCount<?php echo $i;?>">
                                                <div class="in_de_Area disableCommon">
                                                    <button type="button" class="" onclick="eaDown('<?php echo $i?>','<?php echo $row[price]?>')" disabled><i class="far fa-minus"></i><!-- 수량감소 --></button>
                                                    <input type="text" onkeyup="opt_number_chk(this,'0')" onblur="" value="1" title="상품수량" name="ea[<?php echo $i?>]" class="opt_cnt_frm<?php echo $i?>" id="ea<?php echo $i?>" data-sale_poss_qty="7" data-buy_limit_qty="50" readonly>
                                                    <button type="button" class="" onclick="eaUp('<?php echo $i?>','<?php echo $row[price]?>');" disabled><i class="far fa-plus" ></i><!-- 수량증가 --></button>
													
                                                </div>
                                            </td>
                                            <td class="text-center"><span class="opt_total_price<?php echo $i?>" id="opt_total_price<?php echo $i?>"><?php echo number_format($row[price])?></span>원</td>
                                            <!--<td class="text-center">
                                                <button type="button" onclick="select_del(332)" id="PopoverCustomT-1" class="btn btn-primary btn-sm">삭제</button>
                                            </td>-->
                                        </tr>
										<?php }?>
                                                                             
                                    </tbody>
									
                                </table>
                    </div><!--//.table-->
                    <!--총금액-->
                    <div class="totPrice text-right t_margin10">
							<span>상품가격</span>
							<span id="item_price_txt">0</span><span>원</span>
							<span>+</span>
							<span>배송비</span>
							<span id="tax_price_txt">4,100</span><span>원</span>
                            <span>총 금액</span>
                            <span id="total_price_txt">0</span> <span>원</span>
                    </div>
                    <div class="account text-right t_margin15 b_margin10">신한은행 (주)케이에이치코리아 140-011-275750<br /><span>꼭! 매장명으로 입금해주세요 개인이름으로 입금하시면 입금자를 찾기 힘들어요.</span></div>
    </div><!--//#Wrap_list-->
	<?php }?>
    <!--//상품리스트-->

    <!--등록폼-->
    <div class="form">
         <!--제목//공지작성시 입력(관리자 전용)-->
         <div><input type="text" name="wr_subject" value="<?php echo $subject ?>" id="wr_subject" required class="frm_input required" maxlength="255" placeholder="제목을 입력해주세요."<?php echo !$is_admin?" readonly":"";?>></div>
         <!--기타메모-->
         <div><textarea placeholder="<?php echo $is_admin?"공지사항 내용을 입력하세요":"발주에 필요한 기타 메모 사항을 입력하세요.";?>" name="wr_content"><?php echo $write[wr_content]?></textarea></div>
    </div>
     
    <div class="btn_confirm">
        <input type="submit" value="<?php echo $is_admin?"공지사항 작성완료":"발주서 작성완료";?>" id="btn_submit" accesskey="s" class="btn_submit">
        <a href="./board.php?bo_table=<?php echo $bo_table ?>" class="btn_cancel">취소</a>
    </div>
    </form>

    <script type="text/javascript">
	//전체 체크 해제하기
	document.querySelector("#all_pt_chk").addEventListener("click",(e)=>{
		var checked=document.getElementById("all_pt_chk").checked;
		for(var i=0;i < document.getElementsByName("chk_no[]").length;i++){
			document.getElementsByName("chk_no[]")[i].checked=checked;
			chkSelected(i);
		}
	});
	//선택했을 시
	function chkSelected(no){
		const isChecked=$(`#pt_chk${no}`).prop("checked");
		for(var i=0;i < $(`#eaCount${no}`).find("button").length;i++){
			$(`#eaCount${no}`).find("button").eq(i).attr("disabled",!isChecked);
		}
		totPrice();
	}
	let totalPrice=0;
	//갯수 내리기
	function eaDown(no,price){
		let ea=parseInt(document.getElementById(`ea${no}`).value);
		if(ea==1){
			alert("더 이상 내릴 수 없습니다.");
			return;
		}
		ea--;
		let pr=parseInt(price);
		const item_price=ea*parseInt(price);
		document.getElementById(`ea${no}`).value=ea;
		$(`#opt_total_price${no}`).html(number_format(item_price.toString()));
		totPrice();
		
	}
	//갯수 올리기
	function eaUp(no,price){
		let ea=parseInt(document.getElementById(`ea${no}`).value);
		ea++;
		document.getElementById(`ea${no}`).value=ea;
		const item_price=ea*parseInt(price);
		document.getElementById(`opt_total_price${no}`).innerHTML=number_format(item_price.toString());
		totPrice();
	}
	//총 금액 계산
	function totPrice(){
		for(var i=0;i < document.getElementsByName("chk_no[]").length;i++){
			if(document.getElementsByName("chk_no[]")[i].checked){
				totalPrice+=parseInt($(`#price${i}`).val())*parseInt($(`#ea${i}`).val());
			}
		}
		document.getElementById("item_price_txt").innerHTML=number_format(totalPrice.toString());
		totalPrice+=4100;
		document.getElementById("total_price_txt").innerHTML=number_format(totalPrice.toString());
		totalPrice=0;
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
    <?php if($write_min || $write_max) { ?>
    // 글자수 제한
    var char_min = parseInt(<?php echo $write_min; ?>); // 최소
    var char_max = parseInt(<?php echo $write_max; ?>); // 최대
    check_byte("wr_content", "char_count");

    $(function() {
        $("#wr_content").on("keyup", function() {
            check_byte("wr_content", "char_count");
        });
    });

    <?php } ?>
    function html_auto_br(obj)
    {
        if (obj.checked) {
            result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
            if (result)
                obj.value = "html2";
            else
                obj.value = "html1";
        }
        else
            obj.value = "";
    }

    function fwrite_submit(f)
    {

        var subject = "";
        var content = "";
        $.ajax({
            url: g5_bbs_url+"/ajax.filter.php",
            type: "POST",
            data: {
                "subject": f.wr_subject.value,
                "content": f.wr_content.value
            },
            dataType: "json",
            async: false,
            cache: false,
            success: function(data, textStatus) {
                subject = data.subject;
                content = data.content;
            }
        });

        if (subject) {
            alert("제목에 금지단어('"+subject+"')가 포함되어있습니다");
            f.wr_subject.focus();
            return false;
        }

        if (content) {
            alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
            if (typeof(ed_wr_content) != "undefined")
                ed_wr_content.returnFalse();
            else
                f.wr_content.focus();
            return false;
        }

        if (document.getElementById("char_count")) {
            if (char_min > 0 || char_max > 0) {
                var cnt = parseInt(check_byte("wr_content", "char_count"));
                if (char_min > 0 && char_min > cnt) {
                    alert("내용은 "+char_min+"글자 이상 쓰셔야 합니다.");
                    return false;
                }
                else if (char_max > 0 && char_max < cnt) {
                    alert("내용은 "+char_max+"글자 이하로 쓰셔야 합니다.");
                    return false;
                }
            }
        }


		if(confirm("발주를 신청하시겠습니까?")){
			return true;
		}else{
			return false;
		}
        
    }
    </script>
</section>
<!-- } 게시물 작성/수정 끝 -->