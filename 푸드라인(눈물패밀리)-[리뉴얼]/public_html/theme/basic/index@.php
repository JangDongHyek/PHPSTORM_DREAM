<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}
include_once(G5_THEME_PATH.'/head.php');
$gubuns = array("병원/학교이사","관공서이사","사무실이사","가정포장이사","일반이사","반포장/보관이사");
?>
<div id="content">
    <div id="idx_price">
        <div class="inr">
            <div class="bn">
                <p class="txt">아직도<br>아무데서나<br>금거래하세요?</p>
                <p class="logo"><img src="<?php echo G5_THEME_IMG_URL ?>/common/logo_white.svg"></p>
                <p class="tel">043.212.2825</p>
            </div>
            <div class="today_price">
                <h4>
                    오늘의 금 매입시세 <p><span><?php echo date("Y년 m월 d일")?> 기준</span>
                        <?php if ($is_admin) {  ?><a class="btn" id="qoute-btn">시세변경</a><?php }  ?></p>
                    <script type="text/javascript">
                        $(function(){
                            $("#qoute-btn").click(function(){
                                if($("#qoute-btn").html()=="시세변경"){
                                    $("#qoute-btn").html("시세저장");
                                    $(".form").css("display","");
                                }else{
                                    $.ajax({
                                        url:`${g5_bbs_url}/ajax.qoute.update.php`,
                                        data:{
                                            k24_1:$("#k24_1").val(),
                                            k24_2:$("#k24_2").val(),
                                            k24_3:$("#k24_3").prop("checked")?"1":"",
											k24_4:$("#k24_4").val(),
                                            k18_1:$("#k18_1").val(),
                                            k18_2:$("#k18_2").val(),
                                            k18_3:$("#k18_3").prop("checked")?"1":"",
											k18_4:$("#k18_4").val(),
                                            k14_1:$("#k14_1").val(),
                                            k14_2:$("#k14_2").val(),
                                            k14_3:$("#k14_3").prop("checked")?"1":"",
											k14_4:$("#k14_4").prop("checked")?"1":"",
                                            white_1:$("#white_1").val(),
                                            white_2:$("#white_2").val(),
                                            white_3:$("#white_3").prop("checked")?"1":"",
											white_4:$("#white_4").val(),
                                            silver_1:$("#silver_1").val(),
                                            silver_2:$("#silver_2").val(),
                                            silver_3:$("#silver_3").prop("checked")?"1":"",
											silver_4:$("#silver_4").val(),
                                            today_1:$("#today_1").val(),
                                            today_2:$("#today_2").val(),
                                            today_3:$("#today_3").prop("checked")?"1":"",
											today_4:$("#today_4").val(),
                                        },
                                        type:"post",
                                        dataType:"html",
                                        success:function(data){
                                            $("#qoute").html(data);
                                        }
                                    });
                                    $("#qoute-btn").html("시세변경");
                                    $(".form").css("display","none");
                                }
                            });
                        });
						//시세변경시 변동금액 
						function siseChange(id){
							if($(`#${id}_2`).val()==='fa-solid fa-hyphen'){
								$(`#${id}_4`).attr('readonly',true);
							}else{
								$(`#${id}_4`).attr('readonly',false);
							}
						}
                    </script>
                </h4>
                <?php
                $sql="select * from g5_qoute";
                $row=sql_fetch($sql);
                ?>
                <div id="qoute">
                    <div class="today_buy">
                        <dl>
                            <dt>순금시세<span>Gold24k</span></dt>
                            <dd>3.75g</dd>
                            <dd class="view">
                                <?php echo $row[k24_3]==""?number_format($row[k24_1])."원":"전화문의"?>
                            </dd>
                            <dd class="change">
                                <span>변동</span>
                                <?php if($row[k24_3]==""){?>
                                    <i class="<?php echo $row[k24_2]?>"></i>
									<?php echo $row[k24_2]!="fa-solid fa-hyphen"?number_format($row[k24_4])."원":"변동없음"?>
                                <?php }?>
                            </dd>
                            <?php if ($is_admin) {  ?>
                                <dd class="form" style="display:none">
                                    <div class="flex">
                                        <input type="text" value="<?php echo $row[k24_1]?>" id="k24_1">원
                                        <select id="k24_2" onchange="siseChange('k24')">
                                            <option value="fa-solid fa-triangle"<?php echo $row[k24_2]=="fa-solid fa-triangle"?" selected":"";?>>오름</option>
                                            <option value="fa-solid fa-triangle fa-rotate-180"<?php echo $row[k24_2]=="fa-solid fa-triangle fa-rotate-180"?" selected":"";?>>내림</option>
                                            <option value="fa-solid fa-hyphen"<?php echo $row[k24_2]=="fa-solid fa-hyphen"?" selected":"";?>>변동없음</option>
                                        </select>
                                        <!--변동없음 일 때 변동금액 input readonly 로 변경-->
                                        <input type="text" value="<?php echo $row[k24_4]?>" id="k24_4" placeholder="변동금액" <?php echo $row[k24_2]!="fa-solid fa-hyphen"?"":"readonly";?>>원
                                    </div>
                                    <input type="checkbox" name="tel" value="1" id="k24_3"<?php echo $row[k24_3]=="1"?" checked":"";?>><label for="k24_3">전화문의</label>
                                    <!--전화문의 체크시 전체 readonly 로 변경-->
                                </dd>
                            <?php }  ?>
                        </dl>
                        <dl>
                            <dt>18K 금시세<span>Gold18k</span></dt>
                            <dd>3.75g</dd>
                            <dd class="view">
                                <?php echo $row[k18_3]==""?number_format($row[k18_1])."원":"전화문의"?>
                            </dd>
                            <dd class="change">
                                <span>변동</span>
                                <?php if($row[k18_3]==""){?>
                                    <i class="<?php echo $row[k18_2]?>"></i>
									<?php echo $row[k18_2]!="fa-solid fa-hyphen"?number_format($row[k18_4])."원":"변동없음"?>
                                <?php }?>
                            </dd>
                            <?php if ($is_admin) {  ?>
                                <dd class="form" style="display:none">
                                    <div class="flex">
                                        <input type="text" value="<?php echo $row[k18_1]?>" id="k18_1">원
                                        <select id="k18_2" onchange="siseChange('k18')">
                                            <option value="fa-solid fa-triangle"<?php echo $row[k18_2]=="fa-solid fa-triangle"?" selected":"";?>>오름</option>
                                            <option value="fa-solid fa-triangle fa-rotate-180"<?php echo $row[k18_2]=="fa-solid fa-triangle fa-rotate-180"?" selected":"";?>>내림</option>
                                            <option value="fa-solid fa-hyphen"<?php echo $row[k18_2]=="fa-solid fa-hyphen"?" selected":"";?>>변동없음</option>
                                            <input type="text" value="<?php echo $row[k18_4]?>" id="k18_4" placeholder="변동금액" <?php echo $row[k18_2]!="fa-solid fa-hyphen"?"":"readonly";?>>원
                                        </select>
                                    </div>
                                    <input type="checkbox" name="tel" value="1" id="k18_3"<?php echo $row[k18_3]=="1"?" checked":"";?>><label for="k18_3">전화문의</label>
                                </dd>
                            <?php }  ?>
                        </dl>
                        <dl>
                            <dt>14K 금시세<span>Gold14k</span></dt>
                            <dd>3.75g</dd>
                            <dd class="view">
                                <?php echo $row[k14_3]==""?number_format($row[k14_1])."원":"전화문의"?>

                            </dd>
                            <dd class="change">
                                <span>변동</span>
                                <?php if($row[k14_3]==""){?>
                                    <i class="<?php echo $row[k14_2]?>"></i>
									<?php echo $row[k14_2]!="fa-solid fa-hyphen"?number_format($row[k14_4])."원":"변동없음"?>
                                <?php }?>
                            </dd>
                            <?php if ($is_admin) {  ?>
                                <dd class="form" style="display:none">
                                    <div class="flex">
                                        <input type="text" value="<?php echo $row[k14_1]?>" id="k14_1">원
                                        <select id="k14_2" onchange="siseChange('k14')">
                                            <option value="fa-solid fa-triangle"<?php echo $row[k14_2]=="fa-solid fa-triangle"?" selected":"";?>>오름</option>
                                            <option value="fa-solid fa-triangle fa-rotate-180"<?php echo $row[k14_2]=="fa-solid fa-triangle fa-rotate-180"?" selected":"";?>>내림</option>
                                            <option value="fa-solid fa-hyphen"<?php echo $row[k14_2]=="fa-solid fa-hyphen"?" selected":"";?>>변동없음</option>
                                            <input type="text" value="<?php echo $row[k14_4]?>" id="k14_4" placeholder="변동금액"  <?php echo $row[k14_2]!="fa-solid fa-hyphen"?"":"readonly";?>>원
                                        </select>
                                    </div>
                                    <input type="checkbox" name="tel" value="1" id="k14_3"<?php echo $row[k14_3]=="1"?" checked":"";?>><label for="k14_3">전화문의</label>
                                </dd>
                            <?php }  ?>

                        </dl>
                        <dl>
                            <dt>백금시세(99%)<span>Platinum</span></dt>
                            <dd>3.75g</dd>
                            <dd class="view">
                                <?php echo $row[white_3]==""?number_format($row[white_1])."원":"전화문의"?>
                            </dd>
                            <dd class="change">
                                <?php if($row[white_3]==""){?>
                                    <i class="<?php echo $row[white_2]?>"></i>
									<?php echo $row[white_2]!="fa-solid fa-hyphen"?number_format($row[white_4])."원":"변동없음"?>
                                <?php }?>
                            </dd>
                            <?php if ($is_admin) {  ?>
                                <dd class="form" style="display:none">
                                    <div class="flex">
                                        <input type="text" value="<?php echo $row[white_1]?>" id="white_1">원
                                        <select id="white_2" onchange="siseChange('white')">
                                            <option value="fa-solid fa-triangle"<?php echo $row[white_2]=="fa-solid fa-triangle"?" selected":"";?>>오름</option>
                                            <option value="fa-solid fa-triangle fa-rotate-180"<?php echo $row[white_2]=="fa-solid fa-triangle fa-rotate-180"?" selected":"";?>>내림</option>
                                            <option value="fa-solid fa-hyphen"<?php echo $row[white_2]=="fa-solid fa-hyphen"?" selected":"";?>>변동없음</option>
                                        </select>
                                        <input type="text" value="<?php echo $row[white_4]?>" id="white_4" placeholder="변동금액" <?php echo $row[white_2]!="fa-solid fa-hyphen"?"":"readonly";?>>원
                                    </div>
                                    <input type="checkbox" name="tel" value="1" id="white_3"<?php echo $row[white_3]=="1"?" checked":"";?>><label for="white_3">전화문의</label>
                                </dd>
                            <?php }  ?>

                        </dl>
                        <dl>
                            <dt>은시세(99%)<span>Silver</span></dt>
                            <dd>3.75g</dd>
                            <dd class="view">
                                <?php echo $row[silver_3]==""?number_format($row[silver_1])."원":"전화문의"?>
                            </dd>
                            <div class="change">
                                <?php if($row[silver_3]==""){?>
                                    <i class="<?php echo $row[silver_2]?>"></i>
									<?php echo $row[silver_2]!="fa-solid fa-hyphen"?number_format($row[silver_4])."원":"변동없음"?>
                                <?php }?>
                            </div>
                            <?php if ($is_admin) {  ?>
                                <dd class="form" style="display:none">
                                    <div class="flex">
                                        <input type="text" value="<?php echo $row[silver_1]?>" id="silver_1">원
                                        <select id="silver_2" onchange="siseChange('silver')">
                                            <option value="fa-solid fa-triangle"<?php echo $row[silver_2]=="fa-solid fa-triangle"?" selected":"";?>>오름</option>
                                            <option value="fa-solid fa-triangle fa-rotate-180"<?php echo $row[silver_2]=="fa-solid fa-triangle fa-rotate-180"?" selected":"";?>>내림</option>
                                            <option value="fa-solid fa-hyphen"<?php echo $row[silver_2]=="fa-solid fa-hyphen"?" selected":"";?>>변동없음</option>
                                        </select>
                                        <input type="text" value="<?php echo $row[silver_4]?>" id="silver_4" placeholder="변동금액" <?php echo $row[silver_2]!="fa-solid fa-hyphen"?"":"readonly";?>>원
                                    </div>
                                    <input type="checkbox" name="tel" value="1" id="silver_3"<?php echo $row[silver_3]=="1"?" checked":"";?>><label for="silver_3">전화문의</label>
                                </dd>
                            <?php }  ?>

                        </dl>
                    </div>
                    <div class="today_sale">
                        <h5>오늘의 금 판매시세 (VAT미포함)</h5>
                        <dl>
                            <dt>순금시세<span>Gold24k</span></dt>
                            <dd>3.75g</dd>
                            <dd class="view">
                                <strong><?php echo $row[today_3]==""?number_format($row[today_1])."원":"전화문의"?> </strong>
                            </dd>
                            <dd class="change">
                                <span>변동</span>
                                <?php if($row[today_3]==""){?>
                                    <i class="<?php echo $row[today_2]?>"></i>
									<?php echo $row[today_2]!="fa-solid fa-hyphen"?number_format($row[today_4])."원":"변동없음"?>
                                <?php }?>
                            </dd>
                                <?php if ($is_admin) {  ?>
                                    <dd class="form" style="display:none">
                                        <div class="flex">
                                            <input type="text" value="<?php echo $row[today_1]?>" id="today_1">원
                                            <select id="today_2" onchange="siseChange('today')">
                                                <option value="fa-solid fa-triangle"<?php echo $row[today_2]=="fa-solid fa-triangle"?" selected":"";?>>오름</option>
                                                <option value="fa-solid fa-triangle fa-rotate-180"<?php echo $row[today_2]=="fa-solid fa-triangle fa-rotate-180"?" selected":"";?>>내림</option>
                                                <option value="fa-solid fa-hyphen"<?php echo $row[today_2]=="fa-solid fa-hyphen"?" selected":"";?>>변동없음</option>
                                            </select>
                                            <input type="text"  value="<?php echo $row[today_4]?>" id="today_4" placeholder="변동금액"<?php echo $row[today_2]!="fa-solid fa-hyphen"?"":"readonly";?>>원
                                        </div>
                                        <input type="checkbox" id="today_3" name="tel" value="1"<?php echo $row[today_3]=="1"?" checked":"";?>><label for="today_3">전화문의</label>
                                    </dd>
                                <?php }  ?>

                            </dt>


                        </dl>
                        <!--<p class="ref text-right">
                            <i class="fa-duotone fa-circle-exclamation"></i> 24K(순금), 18K, 14K, 백금, 은 등을 녹이면 중량이 줄지 않습니다.
                        </p>-->
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
<div id="idx_wrapper" xmlns="http://www.w3.org/1999/html">
    <!--메인슬라이더 시작-->
    <div id="visual" class="wow fadeInDown animated">
		<ul class="sliderbx">
        	<li class="mv01">
                <div class="txt left">
                    <h3><span class="orenge">GOLD</span> TRADING</h3>
                    <p>
                        믿음과 신뢰를 바탕으로<br>
                        고객님을 모시겠습니다.
                    </p>
                </div>
            </li>
            <li class="mv02">
                <div class="txt left">
                    <h3><span class="orenge">GOLD</span> TRADING</h3>
                    <p>
                        정확한 감정, 신뢰있는 감정으로<br>
                        최선을 다하는 청주금거래소
                    </p>
                </div>
            </li>
            <li class="mv03">
                <div class="txt left">
                    <h3><span class="orenge">GOLD</span> TRADING</h3>
                    <p>
                        정확한 감정, 신뢰있는 감정으로<br>
                        최선을 다하는 청주금거래소
                    </p>
                </div>
            </li>
            <!--<li class="mv04">
                <div class="txt center">
                    <h3><strong>고품격 포장이사 전문업체 현대이사몰</strong>
                        고객 99.9% 만족에 최선을 다합니다</h3>
                    <p>
                        <strong>포장에서 운반/정리/<br class="visible-md visible-sm visible-xs">이삿짐보관 정돈까지</strong>
                        <br>전국방방곡곡에서 <br class="visible-md visible-sm visible-xs">해외이사까지!
                    </p>
                    <span>부산<i class="fa-light fa-arrows-left-right"></i>서울<i class="fa-light fa-arrows-left-right"></i> 제주 각지방 운행</span>
                </div>
            </li>-->
        </ul><!--.sliderbx-->
        
		<!--<div class="scrolldown">
			<a href="#content"><i>SCROLL DOWN</i>&nbsp;&nbsp;<i class="fal fa-mouse-alt" style="color:#fff"></i></a>
		</div>-->


    </div><!-- //visual -->
	
</div><!--  #idx_wrapper -->
<div id="content">

    <!--진행과정
    <div id="idx_progress">
        <div class="inr">
            <div class="hd_title">
                <p class="eng wow fadeInDown" data-wow-delay="0.1s">Progress</p>
                <h3 class="wow fadeInDown" data-wow-delay="0.3s">매입거래 <span>진행과정</span></h3>
                <p class="wow fadeInDown" data-wow-delay="0.4s"></p>
            </div>
            <div>
                <ul>
                    <li class="mbn">
                        <div>
                            <div class="flex">
                            <i class="fa-duotone fa-ballot-check"></i>
                            <div class="text-left">
                                <strong>STEP1</strong>
                                <p>품목별구분</p>
                            </div>
                            </div>
                            <span>24K, 18K, 24K, 10K, 8K, 치금, 백금, 은, 다이아몬드 명품시계</span>
                        </div>
                    </li>
                    <li class="mbn">
                        <div>
                        <div class="flex">
                            <i class="fa-duotone fa-box-taped"></i>
                            <div class="text-left">
                                <strong>STEP2</strong>
                                <p>중량확인</p>
                            </div>
                        </div>
                        <span>단위 g으로 측정 (전자저울 0.01g)</span>
                        </div>
                    </li>
                    <li class="mbn">
                        <div>
                        <div class="flex">
                            <i class="fa-duotone fa-id-card"></i>
                            <div class="text-left">
                                <strong>STEP3</strong>
                                <p>신분증확인</p>
                            </div>
                        </div>
                        <span>고객님의 인적사항을 자필로 기재후 신분증을 확인합니다.</span>
                        </div>
                    </li>
                    <li class="mbn">
                        <div>
                        <div class="flex">
                            <i class="fa-duotone fa-comments-dollar"></i>
                            <div class="text-left">
                                <strong>STEP4</strong>
                                <p>금액확인</p>
                            </div>
                        </div>
                        <span>당일 시세로 적용하여 산출됩니다.</span>
                        </div>
                    </li>
                    <li class="mbn">
                        <div>
                        <div class="flex">
                            <i class="fa-duotone fa-money-check-dollar-pen"></i>
                            <div class="text-left">
                                <strong>STEP5</strong>
                                <p>통장/현금입금</p>
                            </div>
                        </div>
                        <span>고객님께서 원하시는 방향으로 지급 및 입금해드립니다.</span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!--//진행과정-->

    <!--금거래소 소개-->
    <div id="idx_company">
        <div class="inr">

            <div class="img">
                <img src="">
            </div>
            <div class="text-center">
                <h3 class="wow fadeInDown" data-wow-delay="0.2s">24K(순금), 18K, 14K, 백금, 은 등을 녹이면 중량이 줄지 않습니다.</h3>
                <h4 class="wow fadeInDown" data-wow-delay="0.4s"><span>늘 정확한 감정, 신뢰있는 감정</span>으로 최선을 다하겠습니다.</h4>
                <p class="wow fadeInDown" data-wow-delay="0.6s">청주금거래소는 다년간의 노하루를 가진 업체로 정직과 신용을 최우선으로 합니다.<br>
                    고객님이 <strong>소유하신 금/다이아 유색보석등을 전문적으로 평가</strong>하고, 판매하고 있습니다.</p>
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=company" class="btn wow fadeInDown" data-wow-delay="0.8s">회사소개 바로가기 &nbsp;<i class="fa-light fa-angle-right"></i></a>
            </div>

        </div>

    </div>
    <!--//금거래소 소개-->

    <!--이사후기
    <div id="idx_review">
        <div class="inr">
            <div class="hd_title">
                <p class="eng wow fadeInDown" data-wow-delay="0.1s">Best Review</p>
                <h3 class="wow fadeInDown" data-wow-delay="0.3s">현대이사몰 <span>이용후기</span></h3>
                <p class="wow fadeInDown" data-wow-delay="0.4s"></p>
            </div>
            <div class="review_list">
                <dl>
                    <dt>이사하시는 분들 친절하네요</dt>
                    <dd>이사할때 궁금한것들 물어보면 친절하게 알려주시고 정리랑 청소까지 잘 마무리해주시고 감사합니다 만족스러웠습니다.</dd>
                </dl>
                <dl>
                    <dt>너무 친철했어요</dt>
                    <dd>제가 짐이 얼마 없긴하지만 기사님들이 가서 쉬고있으라고하고 했는데
                        저도 챙길 짐들이 있고 가만히 쉬는 성격도아니여서 이삿짐 싸는거 구경하면서 좀 도와드렸어요ㅎ
                        많은 이야기도 나누고 이사하면서 삼촌같고 즐거웠습니다 !
                        이사를 자주다니는 편이라 여러업체 이용많이 해봤는데 제일 친절했던것같아요
                        원룸이고 제가 미니멀로 살고있어 짐이 많이 없긴 했지만 다른 업체들처럼 빨리하고 빨리가려고 서두르지않고
                        꼼꼼하게 잘 해주셨어요 감사합니다 !</dd>
                </dl>
                <dl>
                    <dt>최고에요!</dt>
                    <dd>부모님댁 이사하신다고해서 접수했는데 방문 보고 믿음직하시고 친절하셔서 바로 계약했어요!
                        어제 이사했는데 부모님이 너무 좋아하셔용
                        부탁드린게 좀 많았는데 끝까지 친절하시고 열심히 해주시는 모습에 너무 기분 좋게 했다고 하시네요!</dd>
                </dl>
            </div>
        </div>
    </div>
    //이사후기-->

</div>

<script charset="UTF-8" class="daum_roughmap_loader_script" src="https://ssl.daumcdn.net/dmaps/map_js_init/roughmapLoader.js"></script>
<script charset="UTF-8">
	new daum.roughmap.Lander({
		"timestamp" : "1618289682348",
		"key" : "25cfu",
		"mapWidth" : "100%",
		"mapHeight" : "400"
	}).render();

    //실시간 이사정보
    var swiper = new Swiper('#tbRealtime', {
        loop: true,
        direction: 'vertical',
        slidesPerView: 4,
        autoplay: {
            delay: 1500,
            disableOnInteraction: false,
        },
    });

    //진행과정
    setInterval(chkMbn,1000);
    function chkMbn()
    {
        if($('.mbnon').length==5){
            $(".mbnon").removeClass("mbnon");
        }else if($('.mbnon').length==0){
            $(".mbn").first().addClass("mbnon");
        }else{
            $(".mbnon").next().addClass("mbnon");
        }
    }
</script>

<?php
include_once(G5_PATH.'/tail.php');
?>