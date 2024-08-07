<?php
$pid = "admin";
include_once("../app/app_head.php");
include_once("./admin_head.php");
?>

	<div id="admcent">
		<div class="header">
			<p>운송 관리 시스템 관리자</p>
			<button type="button" class="green">로그아웃</button>
			<button type="button" class="blue"   data-toggle="modal" data-target="#Modal1"><i class="fa-duotone fa-truck"></i> 배차하기</button>
		</div>
		
		<div class="wrap">
			<div class="cate flex">
				<div class="select">
					<input type="radio" id="select1" name="shop" checked><label for="select1">전체</label><input type="radio" id="select2" name="shop"><label for="select2">대기</label><input type="radio" id="select3" name="shop"><label for="select3">배차</label>
					<button type="button" class="btn-del">선택삭제</button>
					<button type="button" class="btn-plus"  data-toggle="modal" data-target="#Modal9">차량등록</button>
				</div>
				<div class="select2">
					<p><input type="text" id="keyword" name="keyword" placeholder="검색어를 입력하세요."></p>
					<button type="button" class="btn-srch"><i class="fa-light fa-magnifying-glass"></i></button>
				</div>
			</div>
			<!-- Button trigger modal -->

			<div class="table">
				<table id="table_id" class="display">
								<colgroup>
									<col width="10px">
									<col width="50px">
									<col width="50px">
									<col width="">
									<col width="50px">
									<col width="50px">
								</colgroup>
					<thead>
						<tr>
							<th><input type="checkbox" name="" value=""></th>
							<th>No.</th>
							<th>상태</th>
							<th>차량번호</th>
							<th>배차기록</th>
							<th>기타</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><input type="checkbox" name="" value=""></td>
							<td>1</td>
							<td><span class="ty4">대기</span></td>
							<td>51너1563</td>
							<td><button type="button" class="btn-4"  data-toggle="modal" data-target="#Modal8">확인</button></td>
							<td><button type="button" class="btn-3">삭제</button></td>
						</tr>
						<tr>
							<td><input type="checkbox" name="" value=""></td>
							<td>2</td>
							<td><span class="ty2">배차</span></td>
							<td>51너1563</td>
							<td><button type="button" class="btn-4"  data-toggle="modal" data-target="#Modal8">확인</button></td>
							<td><button type="button" class="btn-3">삭제</button></td>
						</tr>

					</tbody>
				</table>
			</div>
			
			<nav aria-label="Page navigation">
			  <ul class="pagination justify-content-center">
				<li class="page-item disabled">
					<a class="page-link" href="#" aria-label="Previous">
						<span aria-hidden="true">&laquo;</span>
						<span class="sr-only">Previous</span>
					</a>
				</li>
				<li class="page-item active"><a class="page-link" href="#">1</a></li>
				<li class="page-item"><a class="page-link" href="#">2</a></li>
				<li class="page-item"><a class="page-link" href="#">3</a></li>
				<li class="page-item">
				  <a class="page-link" href="#" aria-label="Next">
					<span aria-hidden="true">&raquo;</span>
					<span class="sr-only">Next</span>
				  </a>
				</li>
			  </ul>
			</nav>
		</div>
	</div>
</div>

<script>
	$(document).ready( function () {
    $('#table_id').DataTable({
		
	// 페이징 기능 숨기기
	paging: false,
	// 표시 건수기능 숨기기
	lengthChange: false,
	// 검색 기능 숨기기
	searching: false,
	// 정렬 기능 숨기기
	ordering: false,

	// 정보 표시 숨기기
	info: false
	});
} );
</script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
  
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>



<?php include_once("./admin_modal.php") ?>


<?php
include_once ("../app/tail.sub.php");
?>