<?php if ($footer_type == 0) { ?>
	</div><!--wrapper-->
<?php } else  { ?>
	</div><!--wrapper-->
	</div><!--container-->
<?php } ?>

<?php
// 한약재몰 공지사항
$CI =& get_instance();
$CI->load->model('BoardModel');
$noticeData = $CI->BoardModel->getBoardList(array('page'=>1,'cate'=>'notice'));

?>

<footer id="footer">
	<div id="ft_wrapper">
		<div class="area_top flex js">
			<div class="ft_menu">
				<a href="<?=PROJECT_URL?>/greet">회사소개</a>
<!--				<a href="<?=PROJECT_URL?>/guide">이용안내</a>-->
				<a href="<?=PROJECT_URL?>/privacy">개인정보취급(처리)방침</a>
				<a href="<?=PROJECT_URL?>/provision">서비스 이용약관</a>
			</div>
            <div class="area_latest">
                <h5>공지사항</h5>
                <ul>
                    <?if(count($noticeData['listData']) == 0) {?>
                    <li class="nodata">등록된 공지가 없습니다.</li>
                    <?
                    }else{
                        foreach ($noticeData['listData'] AS $list) {
                    ?>
                    <li>
                        <p><a href="<?=PROJECT_URL?>/board/<?=$list['idx']?>?cate=notice"><?=$list['title']?></a></p>
                        <span><?=replaceDateFormat($list['reg_date'])?></span>
                    </li>
                    <?}}?>
                </ul>
            </div>
		</div>
		<div class="area_bottom">
           <div class="adr">
			<address>
				<ul>
					<li><strong>상호 :</strong> (주)청하생률</li>
					<li><strong>주소 :</strong> 부산광역시 연제구 마곡천로 46, 1층(연산동)</li><br>
					<li><strong>대표 :</strong> 박태섭</li>
					<li><strong>사업자등록번호 :</strong> 231-88-00941</li><br>
					<li><strong>통신판매 신고번호 :</strong> 제 2022-부산연제-247 호</li><br>
					<li><strong>고객센터 :</strong> 051-552-9666</li>
					<li><strong>팩스 :</strong> 051-863-7600</li><br>
					<li><strong>E-mail :</strong> bob8450624@naver.com</li>
				</ul>
			</address>
            <p class="copy">COPYRIGHT(C)2012. CHUNGHA CO.,LTD. ALL RIGHTS RESERCED.</p>
            </div>
            <div id="contact">
                    <div class="area_bank">
                        <h5>입금계좌</h5>
                        <div class="bank">
                            <p>135701-04-245744</p>
                            <span>국민은행 (주)청하생률</span>
                        </div>
                    </div>
                    <div class="area_cus">
                        <h5>고객센터</h5>
                        <div class="call">
                            <p>051-552-9666</p>
                            <span>상담시간 : 평일 09:00 ~ 16:30
                            <strong>주말,공휴일 휴무</strong></span>
                        </div>
                    </div>
            </div>
		</div>
	</div>
</footer>

<?php include_once VIEWPATH. '_common/side_navigator.php'; // 해쉬메뉴 ?>


<?php include_once VIEWPATH. '_common/modal.php'; // 모달 ?>


</body>
</html>
