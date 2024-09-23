<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_THEME_PATH.'/head.php');
?>

<style>
.tab-content{
  display: none;  
}

.tab-content.current{
  display: inherit;
}


</style>

<section id="event" class="my">
	
	<ul class="tabs">
		<li class="tab-link current" data-tab="tab-1">이용 내역</li>
		<li class="tab-link" data-tab="tab-2">찜한 클래스</li>
	</ul>
	
	
  <div id="tab-1" class="tab-content current">
	<div class="tbl_head01 tbl_wrap">
        <table>
			<thead>
			  <tr>
				<th>번호</th>
				<th>구분</th>
				<th>타입</th>
				<th>예약일시</th>
				<th>예약인원</th>
				<th>신청일</th>
				<th>상태</th>
				<th>관리</th>
			  </tr>
			</thead>
			<tbody>
			  <tr>
				<td class="td_num">01</td>
				<td class="td_center">RENT</td>
				<td class="td_center">1F DOWOON LOUNGE</td>
				<td class="td_center">2023.07.30 12시간</td>
				<td class="td_center">30명</td>
				<td class="td_date">23.07.17</td>
				<td class="td_center state1"><strong>신청</strong></td>
				<td class="td_center"><a class="btn_b01" data-toggle="modal" data-target="#reserve">확인</a></td>
			  </tr>
			  <tr>
				<td class="td_num">02</td>
				<td class="td_center">RENT</td>
				<td class="td_center">6F DOWOON SPACE</td>
				<td class="td_center">2023.07.30 3시간</td>
				<td class="td_center">30명</td>
				<td class="td_date">23.07.17</td>
				<td class="td_center state2"><strong>취소</strong></td>
				<td class="td_center"><a class="btn_b01" data-toggle="modal" data-target="#reserve">확인</a></td>
			  </tr>
			  <tr>
				<td class="td_num">03</td>
				<td class="td_center">CLASS</td>
				<td class="td_center">6F DOWOON SPACE - MASTER CLASS</td>
				<td class="td_center">2023.07.30 오전(9:00~12:00)</td>
				<td class="td_center">1명</td>
				<td class="td_date">23.07.17</td>
				<td class="td_center state3"><strong>확약</strong></td>
				<td class="td_center"><a class="btn_b01" data-toggle="modal" data-target="#reserve">확인</a></td>
			  </tr>
			</tbody>
			</table>
    </div>
  </div>
	
	  
  <div id="tab-2" class="tab-content">
  	<div id="class">
	  <div class="classBox">
		<div class="classItem">
			<div class="img">
				<img src="<?php echo G5_THEME_IMG_URL ?>/sub/3f-1.jpg">
				<h6><a><i class="fas fa-heart"></i></a></h6><!--<i class="far fa-heart"></i>-->
			</div>
			<div class="txt" onClick="location.href='./event.view.php'">
				<h2><span>준비중</span>클래스 제목입니다</h2>
				<h3><i class="fas fa-calendar-star"></i> 7월 30일 10:00 ~ 12:00 | <i class="fas fa-user-friends"></i> 정원 20명</h3>
				<h4><strong>150,000</strong> 원</h4>
			</div>
		</div>
		<div class="classItem">
			<div class="img">
				<img src="<?php echo G5_THEME_IMG_URL ?>/sub/3f-2.jpg">
				<h6><a><i class="fas fa-heart"></i></a></h6>
			</div>
			<div class="txt" onClick="location.href='./event.view.php'">
				<h2><span>준비중</span>클래스 제목입니다</h2>
				<h3><i class="fas fa-calendar-star"></i> 7월 30일 10:00 ~ 12:00 | <i class="fas fa-user-friends"></i> 정원 20명</h3>
				<h4><strong>150,000</strong> 원</h4>
			</div>
		</div>
		<div class="classItem done">
			<div class="img">
				<img src="<?php echo G5_THEME_IMG_URL ?>/sub/3f-3.jpg">
				<h6><a><i class="fas fa-heart"></i></a></h6>
			</div>
			<div class="txt">
				<h2><span>종료</span>클래스 제목입니다</h2>
				<h3><i class="fas fa-calendar-star"></i> 7월 30일 10:00 ~ 12:00 | <i class="fas fa-user-friends"></i> 정원 20명</h3>
				<h4><strong>150,000</strong> 원</h4>
			</div>
		</div>
	</div>
	  
	</div>
  </div>

</section>

<!-- Modal -->
<div class="modal fade" id="reserve" tabindex="-1" aria-labelledby="reserveModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="reserveModalLabel">예약 정보</h5>
      </div>
      <div class="modal-body">
        <table class="eo_table">
			<tbody>
			  <tr>
				<th><strong>신청타입</strong></th>
				<td>[RENT] 1F Dowoon Lounge</td>
			  </tr>
			  <tr>
				<th><strong>신청일</strong></th>
				<td>23.07.17</td>
			  </tr>
			  <tr>
				<th><strong>예약일시</strong></th>
				<td><strong>2023.07.30 3시간</strong></td>
			  </tr>
			  <tr>
				<th><strong>예약인원</strong></th>
				<td><strong>30명</strong></td>
			  </tr>
			  <tr>
				<th><strong>상태</strong></th>
				<td><strong>신청</strong></td>
			  </tr>
			  <!--tr>// CLASS 
				<th><strong>결제금액</strong></th>
				<td><strong>150,000원</strong></td>
			  </tr>
			  <tr>
				<th><strong>결제수단</strong></th>
				<td><strong>삼성카드(4916)</strong></td>
			  </tr-->
			</tbody>
			
		  </table>
		  <div class="notice">
		  	<p>※ 예약 변경은 취소 후 재신청 바랍니다.</p>
		  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary">예약 취소</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">닫기</button>
      </div>
    </div>
  </div>
</div>


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

<script>
$(document).ready(function(){
   
  $('ul.tabs li').click(function(){
    var tab_id = $(this).attr('data-tab');
 
    $('ul.tabs li').removeClass('current');
    $('.tab-content').removeClass('current');
 
    $(this).addClass('current');
    $("#"+tab_id).addClass('current');
  })
 
})
 
</script>

<?php
include_once(G5_PATH.'/tail.php');
?>
