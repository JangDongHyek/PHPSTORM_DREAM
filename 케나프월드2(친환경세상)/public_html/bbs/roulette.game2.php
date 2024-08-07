<?php
include_once('./_common.php');

check_device($board['bo_device']);


include_once(G5_PATH.'/head.sub.php');


include_once(G5_BBS_PATH.'/board_head.php');

$sql="select * from g5_roulette_config";
$row=sql_fetch($sql);

//메인 시작
?>
<div id="cha_tab" class="game">
    <ul>
		<li><a onclick="location.href='./lotto.game.php';">로또</a></li>
		<li class="selected"><a onclick="location.href='./roulette.game.php';">룰렛</a></li>
	</ul>
</div>
<div id="wrap">
<div id="title">
    <span>룰렛을 돌려 포인트를 잡으세요!</span>
    <p><strong class="red">L</strong>et's <strong class="green">g</strong>o 포인트 룰렛</p>
</div>
<div id="gameContainer">				
    <div class="board_start obj"><img src="<?php echo G5_THEME_IMG_URL ?>/roulette/roulette_btn.png" class="join"></div>
    <div class="board_bg obj"><img src="<?php echo G5_THEME_IMG_URL ?>/roulette/roulette_bg1.png"></div>
    <div class="board_on obj"></div>
    <div class="board_arrow obj"><img src="<?php echo G5_THEME_IMG_URL ?>/roulette/roulette_point.png"></div>
</div>
<div id="light">
<img src="../theme/basic/img/roulette/roulette_light.png">
</div>
<div id="popup_gift" class="popup">
	<div class="lottery_present"></div>
        <a href="javascript:;" class="close">닫기 </a>
</div>
</div>
<!-- partial -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/easing/EasePack.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenLite.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/plugins/CSSPlugin.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
<script type="text/javascript">
var roulette_idx=0;
var  present =["<p>2등</p><?=number_format($row[roulette2point])?>p",
							 "<p>꽝!</p><strong>다음기회에</strong>",
							 "<p>1등</p><?=number_format($row[roulette1point])?>p",
							 "<p>꽝!</p><strong>다음기회에</strong>",
							 "<p>3등</p><?=number_format($row[roulette3point])?>p",
							 "<p>꽝!</p><strong>다음기회에</strong>",
							 "<p>4등</p><?=number_format($row[roulette4point])?>p",
							 "<p>5등</p><?=number_format($row[roulette5point])?>p"];
var rank = ["2","99","1","99","3","99","4","5"];
$(document).ready(function() {
	 var gift;	

   
	var rotationPos = new Array(0, -50, -90, -150, -180, -230, -270, -320);
	iniGame = function(num){
		gift = num;
		console.log(gift);
                   
		//$(".board_start").html('<img src="images/roulette_board_go.png">');
		TweenLite.killTweensOf($(".board_on"));
		TweenLite.to($(".board_on"), 0, {css:{rotation:rotationPos[gift]}});
		TweenLite.from($(".board_on"),5, {css:{rotation:-3000}, onComplete:endGame, ease:Sine.easeOut});
               console.log("gift 숫자 : "+ (gift +1) );
	}
	
	
	
	
	
	function endGame(){
              var  copImg= "//img.babathe.com/upload/specialDisplay/htmlImage/2019/test/coupon"+( gift +1) + ".png";
                console.log("이미지 : " + copImg );
							
                  	 $("#popup_gift .lottery_present" ).html(function( ) {   

											

											 var presentStr=0<=present[gift ].indexOf("꽝")?'아쉽지만 꽝입니다. 다음 기회에 다시 도전하십시오':'<div class="wow zoomIn animated" data-wow-delay="2s" data-wow-duration="2s"><img src="<?php echo G5_THEME_IMG_URL ?>/roulette/roulette_win.png"></div>축하드립니다. '+present[gift]+' 당첨되셨습니다.';
											$.ajax({
													url:"./ajax.roulette.update2.php",
													dataType:"html",
													data:{"ro_rank":rank[gift],"idx":roulette_idx},
													type:"POST",
													success:function(data){
														console.log(data);
													},
													error:function(request,status,error){
													alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
												 }
												});
											 return presentStr;    
											});
                     //     $( '<img  src="' + copImg+ '" />' ).prependTo("#popup_gift .lottery_present");

  setTimeout(function() {openPopup("popup_gift");	}, 1000);
}
	
	$(".popup .btn").on("click",function(){
		location.reload();
	});
	function openPopup(id) {
		closePopup();
		$('.popup').slideUp(0);
		var popupid = id
		$('body').append('<div id="fade"></div>');
		$('#fade').css({
		'filter' : 'alpha(opacity=60)'
		}).fadeIn(300);
		var popuptopmargin = ($('#' + popupid).height()) / 2;
		var popupleftmargin = ($('#' + popupid).width()) / 2;
		$('#' + popupid).css({
			'margin-left' : -popupleftmargin
		});
		$('#' + popupid).slideDown(500);
	}
	function closePopup() {
		$('#fade').fadeOut(300, function() {
			location.reload();
			// $(".player").html('');
		});
		$('.popup').slideUp(400);
		return false
	}
	$(".close").click(closePopup);

});



			$(function() {
				var clicked  =0;
				for(i=1; i<9; i++){

					var  pictures = "//img.babathe.com/upload/specialDisplay/htmlImage/2019/test/coupon"+ i  + ".png"; 
					$(".board_on").append('<span>'+present[i-1]+'</span>');

				}
				$(".join").on("mousedown",function(){    
					if("<?=$member[mb_id]?>"==""){
						alert("회원로그인 후 이용이 가능합니다.");
						return;
					}
					if(parseInt("<?=$member[mb_point_l]?>")<1000){
						alert("포인트 충전 후에 게임을 할 수 있습니다.");
						return;
					}
					if( clicked <= 0){    
						//게임횟수 구하기
						$.ajax({
							url:"./ajax.roulette.count2.php",
							dataType:"json",
							type:"POST",
							success:function(data){
								console.log(data);
								var data2=JSON.stringify(data);
								var json=JSON.parse(data2);

								var ro_no=json.ro_no;
								
								roulette_idx=json.idx;
								var num=0;
								var noNumArr=[1,3,5];
								console.log("총 카운터 수 :"+data);
								
								if(ro_no=="<?=$row[roulette1]?>"){
									num=2;
								}else if(ro_no=="<?=$row[roulette2]?>"){
									num=0;
								}else if(ro_no=="<?=$row[roulette3]?>"){
									num=4;
								}else if(ro_no=="<?=$row[roulette4]?>"){
									num=6;
								}else if(ro_no=="<?=$row[roulette5]?>"){
									num=7;
								}else{
									num=noNumArr[Math.floor(Math.random()*3)];
								}

								alert(num);
								
								
								iniGame(num);    
							},
							error:function(request,status,error){
							alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
						 }
						});
						clicked ++;
					}

					else  if( clicked >=1 ){    event.preventDefault(); 
						//alert( "이벤트 참여 하셨씁니다.");
					}                                           
					
				});
			})
</script>
<?/*
<?php if ($member[mb_id]=="lets080") {  ?>
<!--꽝일때 -->
<div id="popup_gift" class="popup" style="display:block;">
	<div class="lottery_present">
    	<p>아쉽지만, <strong>꽝</strong>입니다.</p>
        다음기회에 도전하십시오.
        <a href="javascript:;" class="close">닫기</a>
    </div>
</div>
<!--//꽝일때 -->

<!--당첨됬을때 -->
<div id="popup_gift" class="popup" style="display:block;">
	<div class="lottery_present">
        <div class="wow zoomIn animated" data-wow-delay="2s" data-wow-duration="2s">
    			<img src="<?php echo G5_THEME_IMG_URL ?>/roulette/roulette_win.png">
        </div>
    	<p>축하드립니다</p>
        4등 <strong>3,000포인트</strong><br>
        당첨되셨습니다.
        <a href="javascript:;" class="close">닫기</a>
    </div>
</div>
<!--//당첨됬을때 -->

<?php }  ?>*/?>

<?
//메인끝
include_once(G5_BBS_PATH.'/board_tail.php');
echo "\n<!-- 사용스킨 : ".(G5_IS_MOBILE ? $board['bo_mobile_skin'] : $board['bo_skin'])." -->\n";
include_once(G5_PATH.'/tail.sub.php');
set_session("pjax", "");
?>
