<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(defined('G5_THEME_PATH')) {
    require_once(G5_THEME_PATH.'/index.php');
    return;
}

include_once(G5_MOBILE_PATH.'/head.php');
?>

<!--메인롤링 시작-->


<script src="<?php echo G5_URL ?>/js/owl.carousel.min.js"></script>
    <div class="m_banner" style="background:url(../img/main_bg.gif) no-repeat center top;)">
        <div id="owl-demo" class="owl-carousel">
            <div class="item"> <iframe width="100%" height="100%" src="https://www.youtube.com/embed/3PidC9N4Ees" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="position:absolute; right:0px; top:0px; z-index:999"></iframe><img src="<?php echo G5_IMG_URL ?>/main_img_1.png" border="0" width="100%" height="180px"></div>
            <div class="item"><img src="<?php echo G5_IMG_URL ?>/main_img_2.png" border="0" width="100%" height="180px"></div>
            <div class="item"><img src="<?php echo G5_IMG_URL ?>/main_img_3.png" border="0" width="100%" height="180px"></div>
			<div class="item"><img src="<?php echo G5_IMG_URL ?>/main_img_4.png" border="0" width="100%" height="180px"></div>
        </div>
    </div>
	<script type="text/javascript">
            $(document).ready(function() {
          var owl = $('.owl-carousel');
          owl.owlCarousel({
            items: 1,
            loop: true,
            margin: 0,
            autoplay: true,
            dots: true,
            lazyLoad:true,
            autoplayTimeout: 4000,
            autoplayHoverPause: true
          });
          $('.play').on('click', function() {
            owl.trigger('play.owl.autoplay', [5000])
          });
          $('.stop').on('click', function() {
            owl.trigger('stop.owl.autoplay')
          });
        });
    </script>

<!--메인텍스트 시작-->
	<script>
	$(document).ready(function(){
			$('#m_slogan').animate({
				 //height:'200px',
				 //width:'565px',
				 top:'20px',
				 //marginLeft:'-535px'
			     },1500);	
		});	
    </script>
    
	
	
	
<div id="mdl_btn">

   	<ul>
	  <li><a href="https://www.ggoomgil.go.kr" target="_blank"><img src="<?php echo G5_IMG_URL ?>/main_icon_1.png" /><span>꿈길</span><br />체험처</a></li>
      <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=pro_jung03"><img src="<?php echo G5_IMG_URL ?>/main_icon_2.png" /><span>직업인</span><br />특강&체험</a></li>
      <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=pro_tuk03"><img src="<?php echo G5_IMG_URL ?>/main_icon_3.png" /><span>캠프</span><br />진로/직업</a></li>
      <li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=counsel"><img src="<?php echo G5_IMG_URL ?>/main_icon_4.png" /><span>상담</span><br />진로/진학</a></li>
      <li><a href="https://www.career.go.kr/cnet/front/examen/examenMain.do" target="_blank"><img src="<?php echo G5_IMG_URL ?>/main_icon_5.png" /><span>진로</span><br />적성검사</a></li>
	  <!--li><a href="https://www.work.go.kr/consltJobCarpa/jobPsyExamNew/jobPsyExamYouthList.do" target="_blank"><img src="<?php echo G5_IMG_URL ?>/main_icon_6.png" /><span>직업</span><br />유형검사</a></li-->
	  <li><a href="<?php echo G5_BBS_URL ?>/write.php?bo_table=push"><img src="<?php echo G5_IMG_URL ?>/main_icon_7.png" /><span>행사</span><br />문자알림신청</a></li>
  </ul>

</div>




    <!--div id="m_txt">
        <div id="m_slogan">
            <img src="<?php echo G5_IMG_URL ?>/mobile/main_text.png" border="0" usemap="#m_slogan_link" />
        </div>
    </div--><!--#m_txt-->

<!--동그라미아이콘-->
      <!--div id="cont02">
      	<div class="subject">
         <div class="p1">
              <div class="conticon"><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=counsel">
              <div class="img"><img src="<?php echo G5_IMG_URL ?>/mobile/consile.png" /></div>
              <h1>진로검사/상담예약</h1>
              <p>진로검사 및 상담을
                원하시면 미리 상담예약이
                필요합니다.</p>       </a>
            </div>
            <div class="conticon"><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=counsel&mode=identify">
            <div class="img"><img src="<?php echo G5_IMG_URL ?>/mobile/consile2.png" /></div>
              <h1>상담예약확인</h1>
              <p>예약자명과 휴대폰번호를 입력하시면<br />
                예약자 정보 조회가 가능합니다.</p>       </a>
            </div>
               
          </div-->
			
		<!-- 프로그램 신청 목록 -->
		<?php
			$sql="select * from g5_write_program order by wr_id desc limit 10";
			$result=sql_query($sql);
		?>
		<table class="program-latest">
			<thead>
				<tr>
					<th>프로그램 / 장소</th>
					<th>기간 / 인원</th>
					<th>현황</th>
				</tr>
			</thead>
			<tbody>
				<?php
					while($row=sql_fetch_array($result)){?>
				<tr>
					<td class="pro-data" style="width:40%"><a href="<?=G5_BBS_URL?>/board.php?bo_table=program&wr_id=<?=$row[wr_id]?>"><strong>
				    <?=$row[wr_subject]?></strong>
				    (<?=$row[wr_3]?>)</a><a href="<?=G5_BBS_URL?>/board.php?bo_table=program&wr_id=<?=$row[wr_id]?>"></a></td>
					<td class="pro-data" style="width:40%"><a href="<?=G5_BBS_URL?>/board.php?bo_table=program&wr_id=<?=$row[wr_id]?>"><?=$row[wr_1]?> ~ <br />
				    <?=$row[wr_2]?>
					    <strong> (<?=$row[wr_5]?>명</strong></a><strong><a href="<?=G5_BBS_URL?>/board.php?bo_table=program&wr_id=<?=$row[wr_id]?>">)</a></strong></td>
					<td style="border-right:0px">
					<?php
					$now=strtotime(date("Y-m-d"));
					if($now<strtotime($row['wr_1'])){
						echo "<a href='javascript:alert(\'프로그램 수강신청일이 아닙니다.'\);' class='btn btn_submit' style='color:white'>신청전</a>";
					}else if(strtotime($row['wr_1'])<=$now&&$now<=strtotime($row['wr_2'])){
						$sql="select count(wr_id) as cnt from g5_write_apply where wr_1='".$row['wr_id']."'";
						$cRow=sql_fetch($sql);
						if($cRow[cnt]<$row['wr_5']){
							echo "<a href='".G5_BBS_URL."/write.php?bo_table=apply&wr_1=".$row['wr_id']."' class='btn btn_request' style='color:white; 	font-weight:bold;'>접수</a>";
						}else{
							echo "<a href='javascript:alert(\'신청마감되었습니다.'\);' class='btn btn_finish' style='color:white; font-weight:bold;'>마감</a>";
						}
					}else{
						echo "<a href='javascript:;' class='btn btn_finish' style='color:white'>마감</a>";
					}
					?>					</td>
				</tr>
				
				<?php }?>
			</tbody>
		</table>
		<!-- 프로그램 신청 목록 -->
      	</div><!--/subject-->
      </div><!--cont2-->



    <div class="mcall"><a href="tel:055-785-0151">
            <div class="img"><img src="<?php echo G5_IMG_URL ?>/mobile/m_call.jpg" /></div>
              </a>
</div> 


<?php
include_once(G5_MOBILE_PATH.'/tail.php');
?>