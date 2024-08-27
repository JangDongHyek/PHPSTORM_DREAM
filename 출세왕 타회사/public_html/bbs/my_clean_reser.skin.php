<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
?>



<!-- 청소서비스 신청내역 -->

<div id="my_reser" class="clean">
    <!--내용부분--> 
    <div class="in">
    	<!--<div class="service_none"><span><i class="fas fa-smile"></i></span>신청하신 청소서비스가 없습니다.</div>--><!--신청하신 청소서비스가 없을때 띄움-->
		<div class="cslist">
			<div class="bx">
            	<h2 class="tit">월 세차<strong class="size">소형/중형</strong></h2>
                <div class="tx">
                    <dl class="tx_m">
                        <dt>접수일</dt>
                        <dd>2020년 08월 13일 21:46</dd>
                    </dl>
                    <dl class="tx_m">
                        <dt>차량정보</dt>
                        <dd>12가 1234 / 아반떼XD / 흰색</dd>
                    </dl>
                    <dl class="tx_m">
                        <dt>세차일정</dt>
                        <dd>2020년 11월 12일(목) 18:30</dd>
                    </dl>
                    <dl class="tx_m">
                        <dt>내부세차</dt>
                        <dd class="ins"><span><i class="far fa-check-circle"></i> 포함</span></dd>
                    </dl>
                    <dl class="tx_m">
                        <dt>이용금액</dt>
                        <dd><span class="price">55,000</span>원</dd>
                    </dl>
                </div><!--tx-->
                <div class="mini_btn cf">
                    <a href="<?php echo G5_BBS_URL ?>/my_reser_view.php" class="bt view">자세히보기</a><!--해당 예약의 상세뷰 화면으로 바로 이동-->
                	<a data-toggle="modal" data-target="#myModal" class="bt cancel">예약취소</a>
                    <!--모든 페이지의 예약취소("해당 예약을 정말 취소하시겠습니까?"경고창 필요)시 현재 목록에서 사라지고 예약취소 목록으로 이동-->
                </div>
            </div><!--bx-->
            
			<div class="bx">
            	<h2 class="tit">월 세차<strong class="size">소형/중형</strong></h2>
                <div class="tx">
                    <dl class="tx_m">
                        <dt>접수일</dt>
                        <dd>2020년 08월 13일 21:46</dd>
                    </dl>
                    <dl class="tx_m">
                        <dt>차량정보</dt>
                        <dd>12가 1234 / 아반떼XD / 흰색</dd>
                    </dl>
                    <dl class="tx_m">
                        <dt>세차일정</dt>
                        <dd>2020년 11월 12일(목) 18:30</dd>
                    </dl>
                    <dl class="tx_m">
                        <dt>내부세차</dt>
                        <dd class="ins"><span><i class="far fa-times-circle"></i> 포함안함</span></dd>
                    </dl>
                    <dl class="tx_m">
                        <dt>이용금액</dt>
                        <dd><span class="price">45,000</span>원</dd>
                    </dl>
                    <dl class="tx_m manager"><!--관리자가 담당매니저 정해주면 고객쪽에 뜨게 됨-->
                        <dt>담당매니저</dt>
                        <dd>박나무 <span class="info"><a data-toggle="modal" data-target="#myModal2" class="info"><i class="fas fa-user-circle"></i> 매니저 정보</a></span></dd>
                    </dl>
                </div><!--tx-->
                <div class="mini_btn cf">
                    <a href="<?php echo G5_BBS_URL ?>/my_reser_view.php" class="bt view">자세히보기</a><!--해당 예약의 상세뷰 화면으로 바로 이동-->
                	<a data-toggle="modal" data-target="#myModal" class="bt cancel">예약취소</a>
                    <!--모든 페이지의 예약취소("해당 예약을 정말 취소하시겠습니까?"경고창 필요)시 현재 목록에서 사라지고 예약취소 목록으로 이동-->
                </div>
            </div><!--bx-->
            
			<div class="bx">
            	<h2 class="tit">월 세차<strong class="size">대형</strong></h2>
                <div class="tx">
                    <dl class="tx_m">
                        <dt>접수일</dt>
                        <dd>2020년 08월 13일 21:46</dd>
                    </dl>
                    <dl class="tx_m">
                        <dt>차량정보</dt>
                        <dd>12가 1234 / 아반떼XD / 흰색</dd>
                    </dl>
                    <dl class="tx_m">
                        <dt>세차일정</dt>
                        <dd>2020년 11월 12일(목) 18:30</dd>
                    </dl>
                    <dl class="tx_m">
                        <dt>내부세차</dt>
                        <dd class="ins"><span><i class="far fa-times-circle"></i> 포함안함</span></dd>
                    </dl>
                    <dl class="tx_m">
                        <dt>이용금액</dt>
                        <dd><span class="price">45,000</span>원</dd>
                    </dl>
                    <dl class="tx_m manager"><!--관리자가 담당매니저 정해주면 고객쪽에 뜨게 됨-->
                        <dt>담당매니저</dt>
                        <dd>박나무 <span class="info"><a data-toggle="modal" data-target="#myModal2" class="info"><i class="fas fa-user-circle"></i> 매니저 정보</a></span></dd>
                    </dl>
                </div><!--tx-->
                <div class="mini_btn cf">
                    <a href="<?php echo G5_BBS_URL ?>/my_reser_view.php" class="bt view">자세히보기</a><!--해당 예약의 상세뷰 화면으로 바로 이동-->
                	<a data-toggle="modal" data-target="#myModal" class="bt cancel">예약취소</a>
                    <!--모든 페이지의 예약취소("해당 예약을 정말 취소하시겠습니까?"경고창 필요)시 현재 목록에서 사라지고 예약취소 목록으로 이동-->
                </div>
            </div><!--bx-->            
            
        </div>
    </div><!--in-->
</div><!--my_reser-->

<!-- 청소서비스 신청내역 -->