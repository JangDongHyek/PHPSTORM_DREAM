<?php
include_once('./_common.php');

check_device($board['bo_device']);


include_once(G5_PATH.'/head.sub.php');
/*
$saturday=date("w",strtotime("2019-12-29"));
$secTime=date("His",strtotime("00:00:00"));*/
$saturday=date("w");
$secTime=date("His");

//if(date("Y-m-d")==$lastSaturday){
if(185959<intval($secTime)&&intval($secTime)<=235959){
	$disabled="disabled";
}else{
	$disabled="";
}
/*}else{
	$disabled="";
}*/

include_once(G5_BBS_PATH.'/board_head.php');
$sql="select * from g5_lotto_config where turn='$prevTurn'";
$row=sql_fetch($sql);
$dangchum=explode(",",",".$row[lotto_num]);
//메인 시작
?>
<style>
/*1등당첨*/
#lotto_result{ text-align:center; margin:20px 0; padding:20px 20px; border:1px solid #ccc; border-radius:5px; box-shadow:0 0 5px rgba(0,0,0,0.2);}
#lotto_result .title{ font-size:1.5em; font-weight:bold;}
#lotto_result .title span{ color:#42c12c;}
#lotto_result .title i{ color:#42c12c; padding-right:5px;}
#lotto_result .number{ margin:10px 0 20px 0;}
#lotto_result .number span{ display:inline-block; width:35px; height:35px; border-radius:50%; line-height:35px; color:#fff; font-weight:bold; font-size:15px; 
text-align:center; margin:0 1px;}
#lotto_result .number span:first-child{ background:#e4a716;}
#lotto_result .number span:nth-child(2){ background:#e4a716;}
#lotto_result .number span:nth-child(3){ background:#e96353;}
#lotto_result .number span:nth-child(4){ background:#e96353;}
#lotto_result .number span:nth-child(5){ background:#8f8f8f;}
#lotto_result .number span:nth-child(6){ background:#8f8f8f;}
#lotto_result .number span:last-child{ background:#5bb544;}
#lotto_result .money{ background:#f5f5f5; line-height:40px; font-size:14px; color:#222; letter-spacing:0;}

/*2등당첨*/
#lotto_result2{ margin-bottom:40px;}
#lotto_result2 dl{ padding:10px 0 10px 5px; border-bottom:1px dotted #ddd; position:relative;}
#lotto_result2 dl:after{ display:block; content:""; clear:both;}
#lotto_result2 dt{ float:left; width:35px; font-size:1.2em;}
#lotto_result2 dd{ float:left; font-size:12px;}
#lotto_result2 dd span{ display:inline-block; width:22px; height:22px; border-radius:50%; padding:3px 0; background:#eee; text-align:center; margin-right:3px;}
#lotto_result2 .money2{ position:absolute; top:15px; right:0px; font-size:12px; color:#888; letter-spacing:0;}

/*내가 응모한 로또 번호*/
#lotto_result3{ margin-bottom:40px;}
#lotto_result3 dl{ padding:10px 0 10px 5px; border-bottom:1px dotted #ddd; position:relative;}
#lotto_result3 dl:after{ display:block; content:""; clear:both;}
#lotto_result3 dt{ float:left; width:35px; font-size:1.2em;}
#lotto_result3 dd{ float:left; font-size:12px;}
#lotto_result3 dd span{ display:inline-block; width:22px; height:22px; border-radius:50%; padding:3px 0; background:#eee; text-align:center; margin-right:3px;}
#lotto_result3 .money2{ position:absolute; top:15px; right:0px; font-size:12px; color:#888; letter-spacing:0;}


/*응모하기*/
#lotto_go{/* margin-top:20px; padding-top:20px; border-top:1px dotted #ddd;*/ margin-bottom:70px; }	
#lotto_go .title{ font-size:1.5em; font-weight:bold;}	
#lotto_go .title span{ font-size:12px; color:#888; font-weight:normal;}	
#lotto_go .step1{ margin:15px 0 10px 0;}
#lotto_go .step1 button{ width:calc(50% - 4px); height:40px; line-height:40px; padding:0 15px;}
.step2 ul{ text-align:center;}
.step2 ul:after{ display:block; content:""; clear:both;}
.step2 ul li{ display:inline-block; vertical-align:top; width:10%;text-align:center;border:1px solid #ccc; height:45px;line-height:45px; margin-bottom:5px; color:#777; font-size:13px;}
.step2 ul li.active-check{ background-color:#444; border-color:#222; color:#fff;}
.step2 .btn-default{ width:100%; height:40px; line-height:40px; padding:0 15px; margin-top:20px;}
.step3{ margin:5px 0 10px 0; padding:10px 15px; background:#f2f2f2; border-radius:4px; font-size:13.5px; color:#555; line-height:1.8em; letter-spacing:0;}
#lotto_go .button-ui{ margin-top:20px;}	
#lotto_go .button-ui button{ width:100%; line-height:40px; height:40px; color:#fff; font-size:1.2em; font-weight:bold; background:#444; border:1px solid #222; border-radius:4px; padding:0 0;}	
	
	
/*상품*/
#giveaway{margin-bottom:20px;  position:relative;}
#giveaway .swiper-container{ height:auto;}
#giveaway .swiper-slide{ text-align:center; padding:10px 0; background:#F7F7F7;}
#giveaway .num{position:relative; margin-top:-10px;}
#giveaway .num p{font-size:25px; font-weight:600; color:#fff; text-shadow:1px 1px 0 #64A05A; width:100%; position:absolute; text-align:center; z-index:10;}
#giveaway .num:before{content:""; display:block; position:absolute; top:0px; left:50%; transform:translateX(-50%); width:0; height:0; 
					border-left:80px solid transparent; border-right:80px solid transparent; border-top:45px solid #86D578;
					border-radius:10px;}
#giveaway .pro{font-weight:600; font-size:15px;}
#giveaway .img{background:#fff; width:200px; height:150px; border-radius:20px; overflow:hidden; margin:30px auto 10px auto;}
#giveaway .img img{width:100%; min-height:180px;}
#giveaway .swiper-button-prev,
#giveaway .swiper-button-next{width:30px; height:30px; transform:rotate(-135deg); background:none; border-radius:3px;}
#giveaway .swiper-button-prev{border-top:4px solid #ddd; border-right:4px solid #ddd; left:20px;}
#giveaway .swiper-button-next{border-left:4px solid #ddd; border-bottom:4px solid #ddd; right:20px;}



</style>
<script type="text/javascript">
	function checkNo(no){
		

		if(!$("#lotto-num"+no).prop("checked")){
			var checkSu=0;
			for(var i=0;i<45;i++){
				if($("#lotto-num"+i).prop("checked")){
					checkSu++;		
				}
			}
			if(5<checkSu){
				alert("최대 6개까지 체크를 하실 수 있습니다.");
				return;
			}


			$("#lotto-num"+no).prop("checked",true);
			$("#lotto-num-li"+no).addClass("active-check");
		}else{
			$("#lotto-num"+no).prop("checked",false);
			$("#lotto-num-li"+no).removeClass("active-check");
		}

	}
	$(function(){
		//자동 버튼을 눌렀을 때
		$("#auto-btn").click(function(){
			$(".step2").slideUp();
			$.ajax({
				url:"./ajax.auto.lotto.number.php",
				dataType:"html",
				type:"POST",
				success:function(data){
					$(".step3").append(data+"<br/>");
				},
			 error:function(request,status,error){
        alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
       }
			});
		});
		//수동에서 추가 버튼을 눌렀을 때
		$("#add-btn").click(function(){
			var checkNo=0;
			var checkNumber="";
			for(var i=0;i<$("input[type='checkbox']").size();i++){
				if($("input[type='checkbox']").eq(i).prop("checked")){
					checkNumber+=$("input[type='checkbox']").eq(i).val()+",";
					checkNo++;
				}
			}
			if(checkNo<6){
				alert("6개 번호를 체크하셔야 합니다.");
				return;
			}else{
				checkNumber=checkNumber.substring(0,checkNumber.length-1);
				var strHtml="<input type='hidden' name='lotto_num_txt[]' value='"+checkNumber+"'>";
				strHtml+=checkNumber;
				$(".step3").append(strHtml+"<br/>");
				$("input[type='checkbox']").prop("checked",false);
				$(".lotto-num-li").removeClass("active-check");
			}
		});
		//수동 응모
		$(".btn-danger").click(function(){
			$(".step2").slideToggle();
		});
	});
</script>
<div id="cha_tab" class="game">
    <ul>
		<li class="selected"><a onclick="location.href='./lotto.game.php';">로또</a></li>
		<li><a onclick="location.href='./roulette.game.php';">룰렛</a></li>
	</ul>
</div>

<div class="container">
	
<!-----------------이번주 당첨번호 시작------------------>
    <div id="lotto_result">
        <div class="title"><i class="far fa-crown"></i><span>지난 회차</span> 1등 당첨번호</div>
        <div class="number">
						<?
							for($i=1;$i<count($dangchum);$i++){
						?>
            <span><?=$dangchum[$i]?></span><!--<span>45</span><span>23</span><span>12</span><span>10</span><span>8</span>-->
						<? }?>
        </div><!--.lotto_num-->
        <div class="money">당첨상품 
					<? for($i=1;$i<=5;$i++){
						if($row[rank.$i.point]){?>
					<div style="width:100%;text-align:left;padding-left:10px;overflow:hidden;height:30px">	
					<?=$i?>등 - <?=$row[rank.$i.point]?><br/>
					</div>
					<? }}?>
				</div><!--.money-->
    </div><!--#lotto_result-->

<!-----------------2~5등순위 시작------------------>
<? /*
	<div id="lotto_result2">
    	<dl>
        	<dt>2등</dt>
            <dd><?
							for($i=1;$i<count($dangchum);$i++){
						?>
            <span><?=$dangchum[$i]?></span><!--<span>45</span><span>23</span><span>12</span><span>10</span><span>8</span>-->
						<? }?></dd>
            <div class="money2">당첨금 <?=$row[rank2point]?></div>
      </dl>	
    	<dl>
        	<dt>3등</dt>
            <dd><?
							for($i=1;$i<count($dangchum);$i++){
						?>
            <span><?=$dangchum[$i]?></span><!--<span>45</span><span>23</span><span>12</span><span>10</span><span>8</span>-->
						<? }?></dd>
            <div class="money2">당첨금 <?=$row[rank3point]?></div>
        </dl>	
    	<dl>
        	<dt>4등</dt>
            <dd><?
							for($i=1;$i<count($dangchum);$i++){
						?>
            <span><?=$dangchum[$i]?></span><!--<span>45</span><span>23</span><span>12</span><span>10</span><span>8</span>-->
						<? }?></dd>
            <div class="money2">당첨금 <?=$row[rank4point]?></div>
        </dl>	
    	<dl>
        	<dt>5등</dt>
            <dd><?
							for($i=1;$i<count($dangchum);$i++){
						?>
            <span><?=$dangchum[$i]?></span><!--<span>45</span><span>23</span><span>12</span><span>10</span><span>8</span>-->
						<? }?></dd>
            <div class="money2">당첨금 <?=$row[rank5point]?></div>
        </dl>	
    </div><!--#lotto_result2-->*/?>
    
<?php //if ($member[mb_id]=="lets080") {  ?>
    <!--당첨상품 -->
    <div id="giveaway">
          <!-- Swiper -->
          <div class="swiper-container">
            <div class="swiper-wrapper">
              <div class="swiper-slide" data-swiper-autoplay="2000">
              	<div class="num"><p>1등</p></div>
                <div class="img"><img src="<?php echo $row["rank1Img"]?G5_DATA_URL."/lotto/".$row["rank1Img"]:G5_URL."/img/no_img.png";?>"></div>
                <div class="pro"><?=$row[rank1Point]?></div>
              </div>
              <div class="swiper-slide" data-swiper-autoplay="2000">
              	<div class="num"><p>2등</p></div>
                <div class="img"><img src="<?php echo $row["rank2Img"]?G5_DATA_URL."/lotto/".$row["rank2Img"]:G5_URL."/img/no_img.png";?>"></div>
                <div class="pro"><?=$row[rank2Point]?></div>
              </div>
              <div class="swiper-slide" data-swiper-autoplay="2000">
              	<div class="num"><p>3등</p></div>
                <div class="img"><img src="<?php echo $row["rank3Img"]?G5_DATA_URL."/lotto/".$row["rank3Img"]:G5_URL."/img/no_img.png";?>"></div>
                <div class="pro"><?=$row[rank3Point]?></div>
              </div>
              <div class="swiper-slide" data-swiper-autoplay="2000">
              	<div class="num"><p>4등</p></div>
                <div class="img"><img src="<?php echo $row["rank4Img"]?G5_DATA_URL."/lotto/".$row["rank4Img"]:G5_URL."/img/no_img.png";?>"></div>
                <div class="pro"><?=$row[rank4Point]?></div>
              </div>
              <div class="swiper-slide" data-swiper-autoplay="2000">
              	<div class="num"><p>5등</p></div>
                <div class="img"><img src="<?php echo $row["rank5Img"]?G5_DATA_URL."/lotto/".$row["rank5Img"]:G5_URL."/img/no_img.png";?>"></div>
                <div class="pro"><?=$row[rank5Point]?></div>
              </div>
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
            <!-- Add Arrows -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
          </div>
  
		  <script>
			var swiper = new Swiper('.swiper-container', {
			  effect: 'cube',
			  grabCursor: true,
			  cubeEffect: {
				shadow: true,
				slideShadows: true,
				shadowOffset: 5,
				shadowScale: 0.94,
			  },
			  pagination: {
				el: '.swiper-pagination',
			  },
              autoplay: {
                delay: 5000,
                disableOnInteraction: true,
              },
			});
			
			  /*
			var swiper = new Swiper('.swiper-container', {

			  effect: 'coverflow',
			  grabCursor: true,
			  centeredSlides: true,
			  slidesPerView: 'auto',
			  coverflowEffect: {
				rotate: 50,
				stretch: 0,
				depth: 100,
				modifier: 1,
				slideShadows : true,
			  },
			  pagination: {
				el: '.swiper-pagination',
			  },
              spaceBetween: 30,
              centeredSlides: true,
              pagination: {
                el: '.swiper-pagination',
                clickable: true,
              },
              navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
              },
            });
			  */
          </script>
  
        </div>
    <!--//당첨상품 -->
<?php// }  ?>

<!-----------------복권응모하기 시작------------------>
<form name="form" method="get" action="<?=G5_BBS_URL?>/lotto.game.update.php" onsubmit="return checkLotto()">
	
    <div id="lotto_go">
			<div>직접입력을 누르시면 번호를 체크하고 추가하시면 됩니다.</div>
				<div>자동생성을 누르시면 아래에 번호가 추가된 것을 확인하실 수 있습니다.</div>
    	<div class="title">
				<? if($disabled){?>
				<span style="color:red;font-size:20px">이번주 로또 응모는 마감하였습니다.</span>
				<? }else{?>
				응모하기 <span>(1회 응모시 1,000P 차감)</span>
				<? }?>
			</div>
        <!-- 수동 자동 버튼 시작-->
				

        <div class="step1">
            <button type="button" class="btn btn-warning"<?php echo " ".$disabled;?> id="auto-btn">자동생성</button>
						<button type="button" class="btn btn-danger"<?php echo " ".$disabled;?>>직접입력</button>
        </div>
        <!-- 수동 자동 버튼 끝-->
        <!-- 수동 체크 폼 시작-->
        <div class="step2" style="display:none"?>
            <?
                $no=1;
                for($i=1;$i<=5;$i++){
            ?>
            <ul>
                <?
                    for($j=1;$j<=9;$j++){
    
                        if($i==5&&45<$no){
                            break;
                        }
                ?>
                
                <li onclick="checkNo('<?=$no?>')" id="lotto-num-li<?=$no?>" class="lotto-num-li">
                    <?=$no?>
                    <input type="checkbox" name="lotto_num[<?=$no-1?>]" id="lotto-num<?=$no?>" value="<?=$no?>" style="display:none">
                </li>
                <? $no++;}?>
            </ul>
            <? }?>
    
            <button type="button" id="add-btn" class="btn btn-default">추가</button>
            
        </div>
        <!-- 수동 체크 폼 끝 -->
        <!-- 결과번호 시작 -->
        <div class="step3" id="step3">
            
        </div>
        <!-- 결과번호 끝-->
        <div class="button-ui">
           <button type="submit"<?php echo " ".$disabled;?>>응모하기</button>
        </div>

				<!-- 내가 응모한 로또 번호 -->
					<?
						$sql="select * from g5_lotto where mb_id='$member[mb_id]' and turn='$currentTurn' order by idx desc";
						$result=sql_query($sql);
						
					?>
				<div class="title" style="margin-top:30px"><?=$currentTurn?>회차 응모내역</div>
				<div id="lotto_result3">
					<? 
					$no=1;
					while($row=sql_fetch_array($result)){
							$lotto_num=explode(",",$row[lotto_num]);

						?>
					<dl>
							<dt><?=$no?></dt>
							<dd><?
									for($i=0;$i<count($lotto_num);$i++){
								?>
								<span><?=$lotto_num[$i]?></span><!--<span>45</span><span>23</span><span>12</span><span>10</span><span>8</span>-->
								<? }?></dd>
							<div class="money2"><?=str_replace("/","년",$row[turn])?>회차</div>
							
					</dl>	
					<? $no++;}?>

					<? if($no==1){?>
					<dl>
						<dd>응모한 내용이 없습니다.</dd>
					</dl>
					<? }?>
				</div>
				<!-- 내가 응모한 로또 번호 -->
				<div class="title"><?=$prevTurn?>회차 당첨내역</div>
				<!-- 내가 응모한 당첨 로또 번호 -->
					<?
						$sql="select * from g5_lotto where mb_id='$member[mb_id]' and turn='$prevTurn' and rank<=5 order by idx desc";
						$result=sql_query($sql);
						
					?>
				<div id="lotto_result3">
					
					<? 
					$no=1;
					while($row=sql_fetch_array($result)){
							$lotto_num=explode(",",$row[lotto_num]);

						?>
					<dl>
							<dt><?=$no?></dt>
							<dd><?
									for($i=0;$i<count($lotto_num);$i++){
								?>
								<span><?=$lotto_num[$i]?></span><!--<span>45</span><span>23</span><span>12</span><span>10</span><span>8</span>-->
								<? }?></dd>
<!--							<div class="money2"><?=str_replace("/","년",$row[turn])?>주차</div>-->
							
					</dl>	
					<? $no++;}?>
					<? if($no==1){?>
					<dl>
						<dd>당첨내용이 없습니다.</dd>
					</dl>
					<? }?>
				</div>
				<!-- 내가 응모한 로또 번호 -->
    </div><!--#lotto_go-->
		

</div>
</form>
<script type="text/javascript">
	function checkLotto(){
		if($("#step3").html().trim()==""){
			alert("로또 번호가 없습니다. 자동생성을 하거나 직접 입력 후 추가를 하십시오.");
			return false;
		}
		return true;
	}
</script>
<?
//메인끝
include_once(G5_BBS_PATH.'/board_tail.php');
echo "\n<!-- 사용스킨 : ".(G5_IS_MOBILE ? $board['bo_mobile_skin'] : $board['bo_skin'])." -->\n";
include_once(G5_PATH.'/tail.sub.php');
set_session("pjax", "");
?>
