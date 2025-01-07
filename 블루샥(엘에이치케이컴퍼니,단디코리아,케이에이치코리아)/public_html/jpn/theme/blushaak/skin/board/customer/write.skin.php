<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/default.js"></script>', 100);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/ui.js"></script>', 100);
$sidoArr=array("서울특별시","부산광역시","인천광역시","대전광역시","대구광역시","광주광역시","울산광역시","경기도","강원도","충청북도","충청남도","경상북도","경상남도","전라북도","전라남도","제주특별자치시");
$wr_3=explode("-",$write[wr_3]);
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.8.18/themes/base/jquery-ui.css" />

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
    
    <div class="text-right comment b_margin10"><span style="color: #F33; font-size: .8em; opacity: .8; margin: 0 3px 0 0;">*</span> は必須入力項目になります。</div>
    <div class="tbl_frm01 tbl_wrap">
        <table>
        <colgroup>
           <col style="width:15%" />
           <col style="width:auto" />
        </colgroup>
        <tbody class="cust">        
		<tr class="cust">
            <th class="cust" scope="row"><label for="wr_1"><span class="check">*</span>店舗名<strong class="sound_only">필수</strong></label></th>
            <td class="cust">
				<input type="text" name="wr_1" value="<?php echo $write['wr_1'] ?>" id="wr_1" required class="frm_input search required" size="10"> 
                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#mySearch">店舗検索</button>
            </td>
            
              <!-- Modal -->
              <div class="modal fade" id="mySearch" role="dialog">
                <div class="modal-dialog">
                
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">×</button>
                      <h4 class="modal-title">店舗検索</h4>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="" id="wr-subject" value="<?php echo $write[''] ?>" placeholder="Input the store name." id="" class="frm_input" size="10"> 
                        <button class="btn btn-primary" type="button" id="search-btn">検索</button>
                    </div>
					<script type="text/javascript">
						
						$(()=>{
							$("#search-btn").click(()=>{
								searchStore();
							});
						})
						function searchStore(){
							if($("#wr-subject").val().length<1){
								alert("매장명을 먼저 입력하세요");
								$("#wr-subject").focus();
								return;
							}
							$.ajax({
								url:`${g5_bbs_url}/ajax.store.search.php`,
								data:{wr_subject:$("#wr-subject").val()},
								dataType:"html",
								type:"post",
								success:function(data){
									$("#store-list").html(data);
								}
							});
						}
					</script>
                    <div class="result_list">
                        <ul id="store-list">
                            
                        </ul>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary" data-dismiss="modal">close</button>
                    </div>
                  </div>
                  
                </div>
              </div>

            
        </tr>

		<tr>
            <th class="cust" scope="row"><label for="wr_2_1"><span class="check">*</span>お問い合わせ種類</label></th>
            <td class="cust">
				<input type="radio" name="wr_2" id="wr_2_1" value="칭찬"<?php echo $write[wr_2]=="칭찬"||$w==""?" checked":"";?>><label for="wr_2_1">Praise</label>
				<input type="radio" name="wr_2" id="wr_2_2" value="불만"<?php echo $write[wr_2]=="불만"?" checked":"";?>> <label for="wr_2_2">Complaint</label>
				<input type="radio" name="wr_2" id="wr_2_3" value="제안"<?php echo $write[wr_2]=="제안"?" checked":"";?>> <label for="wr_2_3">Suggestion</label>
			</td>
        </tr>
		<tr>
            <th class="cust" scope="row"><label for="wr_3_1"><span class="check">*</span>利用経路</label></th>
            <td class="cust">
                <div>
                  <input type="radio" name="wr_3" id="wr_3_1" onclick="dispList('0');" value="매장방문"<?php echo $write[wr_3]=="매장방문"||$w==""?" checked":"";?>><label for="wr_3_1">店舗利用 </label>
                  <input type="radio" name="wr_3" id="wr_3_2" onclick="dispList('1');" value="매장방문 외"<?php echo $write[wr_3]=="매장방문 외"?" checked":"";?>> <label for="wr_3_2">店舗利用以外</label>
                </div>
                <!--//#visit-->
                <div id="etc">
                        <div class="route" id="delivery" style="display:none">
                          <select name="wr_4" id="wr_4"  style="width:100px">
                             <option value="">Choose</option>
                             <option value="배달"<?php echo $write['wr_4']=="배달"?" selected":"";?>>delivery</option>
                             <option value="포장"<?php echo $write['wr_4']=="포장"?" selected":"";?>>packaging</option>
                          </select>
                        </div>
                        <div class="route">
                          <span id="date">ご来店日</span> <input type="text" name="wr_5" value="<?php echo $write[wr_5] ?>" placeholder="연도-월-일" id="wr_5" required class="frm_input search required" size="10" maxlength="20">
                        </div>
                        <div class="route">
                          <span>ご来店時間</span> <input type="text" name="wr_6" value="<?php echo $write[wr_6] ?>" id="wr_6" required class="frm_input search required" size="10" maxlength="20">
                          <select name="" id="wr_6_1" required style="width:100px" onchange="$('#wr_6').val(this.value)">
                             <option value="10시"<?php echo $write['wr_6']=="10시"?" selected":"";?>>10:00</option>
                             <option value="11시"<?php echo $write['wr_6']=="11시"?" selected":"";?>>11:00</option>
                             <option value="12시"<?php echo $write['wr_6']=="12시"?" selected":"";?>>12:00</option>
                             <option value="13시"<?php echo $write['wr_6']=="13시"?" selected":"";?>>13:00</option>
                             <option value="14시"<?php echo $write['wr_6']=="14시"?" selected":"";?>>14:00</option>
                             <option value="15시"<?php echo $write['wr_6']=="15시"?" selected":"";?>>15:00</option>
                          </select>
                        </div>
                        <div class="route">
                          <span>ご注文内容</span> <input type="text" name="wr_7" value="<?php echo $write[wr_7] ?>" id="wr_7" required class="frm_input search required" size="10" maxlength="20">
                        </div>
                </div><!--//#etc-->
            </td>
        </tr>
		<tr>
            <th class="cust" scope="row"><label for="wr_8_1"><span class="check">*</span>返信通知サービス</label></th>
            <td class="cust">
				<input type="radio" name="wr_8" id="wr_8_1" value="받지 않음"<?php echo $write[wr_8]=="받지 않음"||$w==""?" checked":"";?>><label for="wr_8_1">受け取らない</label>
				<input type="radio" name="wr_8" id="wr_8_2" value="문자 답변"<?php echo $write[wr_8]=="문자 답변"?" checked":"";?>> <label for="wr_8_2">SMSで受け取る</label>
				<input type="radio" name="wr_8" id="wr_8_3" value="이메일 답변"<?php echo $write[wr_8]=="이메일 답변"?" checked":"";?>> <label for="wr_8_3">メールで受け取る</label>
			</td>
        </tr>
        
        <?php if ($is_name) { ?>
        <tr>
            <th class="cust" scope="row"><label for="wr_name"><span class="check">*</span>お名前<strong class="sound_only">필수</strong></label></th>
            <td class="cust"><input type="text" name="wr_name" value="<?php echo $name ?>" id="wr_name" required class="frm_input required" size="10" maxlength="20"></td>
        </tr>
        <?php } ?>

        <?php if ($is_email) { ?>
        <tr>
            <th class="cust" scope="row"><label for="wr_email"><span class="check">*</span>メール</label></th>
			<?php
				$wr_email = explode("@",$write[wr_email]);
			?>
            <td class="cust">
               <input type="text" name="wr_email[0]" value="<?php echo $wr_email[0] ?>" id="wr_email" class="frm_input tel"  maxlength="100"> @
               <input type="text" name="wr_email[1]" id="wr_email1" value="<?=$wr_email[1]?>" class="frm_input tel">
			   <select name="" id="wr_email_s"  style="width:100px"  onchange="$('#wr_email1').val(this.value)">
                    <option value="">Direct input</option>
					<option value="naver.com"<?php echo $wr_email[1]=="naver.com"?" selected":"";?>>naver.com</option>
					<option value="daum.net"<?php echo $wr_email[1]=="daum.net"?" selected":"";?>>daum.net</option>
                    <option value="hanmail.net"<?php echo $wr_email[1]=="hanmail.net"?" selected":"";?>>hanmail.net</option>
			   </select>
            </td>
        </tr>
        <?php } ?>
        

		<tr>
			<th class="cust"><span class="check">*</span>電話番号</th>
			<?php
				$wr_9=explode("-",$write[wr_9]);
			?>
			<td class="cust">
				<input type="text" name="wr_9[0]" value="<?=$wr_9[0]?>" class="frm_input tel"> -
				<input type="text" name="wr_9[1]" value="<?=$wr_9[1]?>" class="frm_input tel"> -
				<input type="text" name="wr_9[2]" value="<?=$wr_9[2]?>" class="frm_input tel">
			</td>
		</tr>

        <?php /* if ($is_homepage) { ?>
        <tr>
            <th scope="row"><label for="wr_homepage">홈페이지</label></th>
            <td><input type="text" name="wr_homepage" value="<?php echo $homepage ?>" id="wr_homepage" class="frm_input" ></td>
        </tr>
        <?php } ?><?php */?>

        <?php if ($option) { ?>
        <tr>
            <th class="cust" scope="row">옵션</th>
            <td class="cust"><?php echo $option ?></td>
        </tr>
        <?php } ?>

        <?php if ($is_category) { ?>
        <tr>
            <th scope="row"><label for="ca_name"><span class="check">*</span>분류<strong class="sound_only">필수</strong></label></th>
            <td class="cust">
                <select name="ca_name" id="ca_name" required class="required" >
                    <option value="">선택하세요</option>
                    <?php echo $category_option ?>
                </select>
            </td>
        </tr>
        <?php } ?>

        <tr>
            <th class="cust" scope="row"><label for="wr_subject"><span class="check">*</span>職位<strong class="sound_only">필수</strong></label></th>
            <td class="cust">
                <div id="autosave_wrapper">
                    <input type="text" name="wr_subject" value="<?php echo $subject ?>" id="wr_subject" required class="frm_input required" maxlength="255">
                    <? /*php if ($is_member) { // 임시 저장된 글 기능 ?>
                    <script src="<?php echo G5_JS_URL; ?>/autosave.js"></script>
                    <?php if($editor_content_js) echo $editor_content_js; ?>
                    <button type="button" id="btn_autosave" class="btn_frmline">임시 저장된 글 (<span id="autosave_count"><?php echo $autosave_count; ?></span>)</button>
                    <div id="autosave_pop">
                        <strong>임시 저장된 글 목록</strong>
                        <div><button type="button" class="autosave_close"><img src="<?php echo $board_skin_url; ?>/img/btn_close.gif" alt="닫기"></button></div>
                        <ul></ul>
                        <div><button type="button" class="autosave_close"><img src="<?php echo $board_skin_url; ?>/img/btn_close.gif" alt="닫기"></button></div>
                    </div>
                    <?php } */?>
                </div>
            </td>
        </tr>

        <tr>
            <th class="cust" scope="row"><label for="wr_content"><span class="check">*</span>お問い合わせ内容<strong class="sound_only">필수</strong></label></th>
            <td class="wr_content cust">
                <?php if($write_min || $write_max) { ?>
                <!-- 최소/최대 글자 수 사용 시 -->
                <p id="char_count_desc">이 게시판은 최소 <strong><?php echo $write_min; ?></strong>글자 이상, 최대 <strong><?php echo $write_max; ?></strong>글자 이하까지 글을 쓰실 수 있습니다.</p>
                <?php } ?>
                <?php echo $editor_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 ?>
                <?php if($write_min || $write_max) { ?>
                <!-- 최소/최대 글자 수 사용 시 -->
                <div id="char_count_wrap"><span id="char_count"></span>글자</div>
                <?php } ?>
            </td>
        </tr>

      

		<?php if($w==""){?>
		<tr>
			<td colspan="2">
				<table>
					<tbody>
						<tr>
							<td><p><strong>* 個人情報の収集及び利用目的</strong></p></td>
						</tr>
                        <tr>
                           <td align="right" style="border-bottom:0"><input type="checkbox" name="agree" id="agree" value="1"> 個人情報の収集及び利用目的に同意します。</td>
                        </tr>
					</tbody>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<textarea name="" class="" rows="10" readonly style="width:100%">▶ 個人情報の収集及び利用目的
- サービス利用による本人識別、本名確認、加入意思の確認、年齢制限サービス利用
- 告知事項の伝達、顧客不満足処理の連絡経路の確保、商品配送時の正確な配送先の情報確保
- 新規サービスなど最新情報のご案内および個人サービス提供のための資料
- その他、円滑かつ良質なサービスの提供など

▶ 収集する個人情報の項目
- 名前、メール、連絡先、携帯電話番号、その他の選択項目

▶ 個人情報の保有及び利用期間
- 原則として個人情報の収集または提供を受けた目的を達成する際、遅滞なく破棄します。
- ただし、円滑なサービス相談のため、相談完了後3ヶ月間は内容の保管ができ電子商取引における消費者保護に関する法律など、他法律により保存する必要がある場合には一定期間保存します。
</textarea>
			</td>
		</tr>
		<?php }?>



        <?php if ($is_orderby) { ?>
        <tr>
            <th class="cust" scope="row"><label for="wr_orderby">우선순위</label></th>
            <td class="cust"><input type="text" name="wr_orderby" value="<?php echo $wr_orderby ?>" id="wr_orderby" class="frm_input" size="4"></td>
        </tr>
        <?php } ?>

        </tbody>
        </table>
    </div>


    <div class="btn_confirm">
        <input type="submit" value="送信" id="btn_submit" accesskey="s" class="btn_submit">
        <a href="./board.php?bo_table=<?php echo $bo_table ?>" class="btn_cancel">キャンセル</a>
        <? if($is_admin){?>
        <a href="./board.php?bo_table=<?php echo $bo_table ?>" class="btn_cancel">목록보기</a>
        <? } ?>
        
    </div>
    </form>
	<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script>
	$.datepicker.setDefaults({
        dateFormat: 'yy-mm-dd',
        prevText: '이전 달',
        nextText: '다음 달',
        monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
        monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
        dayNames: ['일', '월', '화', '수', '목', '금', '토'],
        dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
        dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
        showMonthAfterYear: true,
        yearSuffix: '년'
    });

    $(function() {
        $("#wr_5").datepicker();
    });
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
        <?php echo $editor_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>

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

		if($("#agree").prop("checked")==false){
			alert("개인정보취급방침 약관에 동의하십시오");
			return false;
		}

        document.getElementById("btn_submit").disabled = "disabled";

        return true;
    }
	
	function dispList(selectList) {//라디오버튼 div 숨기기
		if(selectList==1){
			$("#delivery").css("display","");
			$("#date").html("order date");
		}else{
			$("#delivery").css("display","none");
			$("#date").html("visit date");
		}
		/*var obj1 = document.getElementById("visit"); // 매장방문
		var obj2 = document.getElementById("etc"); // 매장방문 외 
		if( selectList == "0" ) { // 상품1 리스트
			obj1.style.display = "block";    
			obj2.style.display = "none";
			alert(    obj.style.display ) ;
		} else { // 상품2 리스트
			obj1.style.display = "none";
			obj2.style.display = "block";
		}*/
	}
    </script>
</section>
<!-- } 게시물 작성/수정 끝 -->