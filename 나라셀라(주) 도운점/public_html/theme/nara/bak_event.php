<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_THEME_PATH.'/head.php');
?>

<style></style>

<section id="class" class="f6">
<ul class="tab">
<li class="active"><a href="./event6.php">클래스</a></li>
<li class=""><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=6fphoto">이용후기</a></li>
</ul>

	<div class="selectBox">
		<p>구분</p>
		<select>
			<option>전체</option>
			<option>준비중</option>
			<option>종료</option>
		</select>
		<select>
			<option>등록순</option>
			<option>클래스 날짜순</option>
		</select>
	</div>

	<div class="classBox">
		<div class="classItem ready"><!--오픈예정 아이템일경우 : ready-->
			<div class="img">
				<img src="<?php echo G5_THEME_IMG_URL ?>/sub/3f-1.jpg">
				<h6><a><i class="far fa-heart"></i></a></h6><!--<i class="fas fa-heart"></i>-->
				<div class="readyBox"><p>COMING SOON...</p></div> <!--오픈예정 아이템일경우-->
			</div>
			<div class="txt" onClick="location.href='./event.view.php'">
				<h2><span>준비중</span>클래스 </h2>
				<h3><i class="fas fa-calendar-star"></i> 7월 30일 10:00 ~ 12:00<span class="hidden-xs"> | </span><span class="visible-xs"><br></span><i class="fas fa-user-friends"></i> 정원 20명</h3>
				<h4><strong>150,000</strong> 원</h4>
			</div>
		</div>
		<div class="classItem">
			<div class="img">
				<img src="<?php echo G5_THEME_IMG_URL ?>/sub/3f-2.jpg">
				<h6><a><i class="far fa-heart"></i></a></h6><!--<i class="fas fa-heart"></i>-->
			</div>
			<div class="txt" onClick="location.href='./event.view.php'">
				<h2><span>준비중</span>클래스 </h2>
				<h3><i class="fas fa-calendar-star"></i> 7월 30일 10:00 ~ 12:00<span class="hidden-xs"> | </span><span class="visible-xs"><br></span><i class="fas fa-user-friends"></i> 정원 20명</h3>
				<h4><strong>150,000</strong> 원</h4>
			</div>
		</div>
		<div class="classItem done">
			<div class="img">
				<img src="<?php echo G5_THEME_IMG_URL ?>/sub/3f-3.jpg">
				<h6><a><i class="far fa-heart"></i></a></h6><!--<i class="fas fa-heart"></i>-->
			</div>
			<div class="txt">
				<h2><span>종료</span>클래스 </h2>
				<h3><i class="fas fa-calendar-star"></i> 7월 30일 10:00 ~ 12:00<span class="hidden-xs"> | </span><span class="visible-xs"><br></span><i class="fas fa-user-friends"></i> 정원 20명</h3>
				<h4><strong>150,000</strong> 원</h4>
			</div>
		</div>
	</div>

</section>

<script>
document.querySelector(".done").addEventListener('click', function(){
  Swal.fire({
    toast: true,
    icon: 'warning',
    title: '클래스가 종료됐어요!',
    animation: false,
    position: 'middle',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })
});

</script>

<?php
include_once(G5_PATH.'/tail.php');
?>
