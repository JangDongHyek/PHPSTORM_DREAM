<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_THEME_PATH.'/head.php');
?>

<style></style>

<section id="class">
<ul class="tab">
<li class="active"><a href="./event6.php">클래스</a></li>
<li class=""><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=6fphoto">이용후기</a></li>
</ul>
	
	
		<div class="classInfo">
			<div class="img">
				<img src="<?php echo G5_THEME_IMG_URL ?>/sub/7f-1.jpg">
			</div>
			<div class="txt">
				<h2><span>준비중</span><em><a><i class="far fa-heart"></i></a></em></h2>
				<h2>클래스 준비중</h2>
				<h3><i class="fas fa-calendar-star"></i> 예정<br><i class="fas fa-user-friends"></i> 예정</h3>
				<h4><strong>- </strong> 원</h4>
				<div class="btnWrap">
				<button type="button" class="submit">클래스 준비중</button>
				</div>
			</div>
		</div>
		<div class="classCont">
			
			 <nav id="contnav" class="contnav">
				<ul class="nav__menu">
					<li><a href="#one"class="nav__menu--foused">클래스 정보</a></li>
					<li><a href="#two">클래스 규정</a></li>
					<li><a href="#three">클래스 문의</a></li>
					<li><a href="#four">클래스 후기</a></li>
					<div class="marker"></div>
				</ul>
			</nav>
			<section id="one">
			
				<h1><span>DOWOON SPACE </span><em>도 [萄] 운 [韻]으로 부터의 초대</em>도운에서 나만의 와인 취향을 찾기 위한 프라이빗한 Class와 공간을 경험할 수 있는 공간</h1>

				<div class="img-wrap">
						<img src="<?php echo G5_THEME_IMG_URL ?>/sub/6f-1.jpg">
						<img src="<?php echo G5_THEME_IMG_URL ?>/sub/6f-2.jpg">
				</div>

				
			</section>
			<section id="two">
				<div class="cont2">
					<div ></div>
					<h3>취소 / 환불 정책</h3>
					<p>환불 규정은 아래와 같이 적용됩니다.</p>
					<table class="eo_table">
						<thead>
							<tr>
								<th>환불 시점</th>
								<th>환불 방법</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>수업 7일 전까지</td>
								<td>100% 취소 / 환불 가능</td>
							</tr>
							<tr>
								<td>수업 7일 이내</td>
								<td>환불 불가</td>
							</tr>
						</tbody>
					</table>
					<div class="cont2 v2">
						<h5>※유의사항</h5>
						<div class="info">
							<p>취소/환불 정책인 수업 7일 전까지 100% 환불 가능하며<strong> 기간 경과 후 취소를 희망하는 경우 별도 문의 바랍니다.</strong></p>
							<br>
							<p>환불은 신청일로부터 최대 1~2주 가량 소요됩니다.</p>
							<p>수강료 환불 시 반드시 결제하신 방식(카드/입금)으로만 환불 가능합니다.</p>
							<br>
							<p>최저 수강인원에 미달하는 경우와 그 외 불가피한 상황의 경우 강의가 취소될 수 있습니다.</p>
							<p>이 경우 기간에 관계없이 100% 환불처리됩니다.</p>
							<br>
							<p><strong>문의 </strong>02-543-1529 | <i class="fab fa-instagram"></i> the_dowoon DM</p>
						</div>
					</div>
				</div>
			</section>
			<section id="three">
				<h5>클래스 진행에 대해 궁금한 점이 있으신가요?</h5>
				<p>문의를 남겨주시면 신속 정확하게 답변해드리겠습니다.</p>
				<button onClick="location.href='<?php echo G5_BBS_URL ?>/qawrite.php'" type="button">문의하기</button>
			</section>
			<section id="four">
				<?php echo latest("theme/gallery2", "6fphoto", 4, 50); ?>
				<!--?php echo latest("theme/gallery2", "6fphoto", 4, 50); ? //6층용-->
			</section>
		</div>

</section>

<script>
	const marker=document.querySelector(".marker");

//nav의 marker의 길이와 위치를 설정하는 함수
//A function to set the length and position of the nav marker.
function setMarker(e) {
    marker.style.left = e.offsetLeft+"px";
    marker.style.width = e.offsetWidth+"px";
}

const sections = document.querySelectorAll(".classCont > section");
const menus = document.querySelectorAll(".nav__menu > li > a")

//스크롤 위치에 따라 해당하는 menu의 색깔과 마커가 달라짐
//The color and marker of the corresponding menu change according to the scroll position

window.addEventListener("scroll",()=>{
    //현재 영역의 id값
    //id of the current section
    let current=""

    sections.forEach(section=>{
        //각 section의 top 위치(절대적 위치)
        // The top of each section (absolute)
        const sectionTop = window.scrollY + section.getBoundingClientRect().top;

        //누적된 스크롤이 section의 top위치에 도달했거나 section의 안에 위치할 경우
        //When the accumulated scroll reaches the top of the section or is located inside the section
        if(window.scrollY >= sectionTop) {
            current = section.getAttribute("id");
        }


        menus.forEach(menu=>{
            menu.classList.remove("nav__menu--foused");
            const href = menu.getAttribute("href").substring(1);
            if(href===current) {
                //현재 있는 영역의 id와 메뉴의 링크주소가 일치할때
                //When the Id of the current section matches the href of the menu
                menu.classList.add("nav__menu--foused");
                setMarker(menu);
            }
        })
    })
})</script>

<?php
include_once(G5_PATH.'/tail.php');
?>
