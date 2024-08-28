<?php
$title['sm_name'] = '렌터카 예약하기';
$g5['title'] = '렌터카 예약하기';
$co_id="rent_pay";
include_once('./_common.php');

//if ($is_guest)
//    alert('로그인 한 회원만 접근하실 수 있습니다.', G5_BBS_URL.'/login.php');

include_once('./_head.php');

$url = clean_xss_tags($_GET['url']);

// url 체크
check_url_host($url);

$url = get_text($url);


?>

<script type="text/javascript">
	function payEdit(no){
		window.open(g5_bbs_url+"/pop_model_write2.php?no="+no,"pop"+no,"width:800,height:600,scrollbars=yes");
	}
</script>
<div id="subContainer">
    <section class="sstion w1200">
        <div class="titBox">
            <h3 class="car01">단기대여<p>범아렌터카의 단기대여 서비스입니다.</p>
            </h3>
        </div>
        <div class="contBox">
            <div class="ssBox">
                <h4>대여자격</h4>
                <ul class="baselist">
                    <li>
                        <h5>~9인승</h5>
                        <p>면허 2종보통 이상</p>
                        <p>승용 : 만 26세 이상(대여일기준)</p>
                        <p>승합 : 만 26세 이상(대여일기준)</p>
                    </li>
                    <li>
                        <h5>11~12인승</h5>
                        <p>면허 1종 보통이상</p>
                        <p>승용 : 만 26세 이상(대여일기준)</p>
						<p>승합 : 만 26세 이상(대여일기준)</p>
                    </li>
                    <li>
                        <h5>취득후 기간</h5>
						<p>승용 : 면허 취득일로부터 1년 이상 경과</p>
						<p>승합 : 면허 취득일로부터 3년 이상 경과</p>
						<p>수입 : 면허 취득일로부터 3년 이상 경과</p>
                    </li>
                </ul>
            </div>
            <!-- /ssBox -->

            <div class="ssBox">
                <h4>유의사항</h4>
                <ul class="baselist all">
                    <li>
                        <b>휴차보상료　:　</b><span>대여중 발생한 자차사고로 인해 차량수리가 필요한 경우, 차량수리 기간동안 발생한 영업손실에 대해 차량수리비 외에 표준대여료의 50% 휴차보상료 발생</span>
                    </li>
                    <li>
                        <b>보험조건　: </b><span>[대인] 무한 / [대물] 2,000만원 / [자손] 1,500만원</span>
                    </li>
                    <li>
                        <b>면책금　: </b><span>자차보험에 가입한 경우 면책금(국산: 50만원/수입:100만원)부담 후 초과되는 수리비는 부담하지 않습니다.</span>
                    </li>
                    <li>
                        <b>수리비　: </b><span>차량의 손망실이 발생한 경우 수리비는 고객 부담이며, 특별한 사유를 제외하고 당사가 지정한 곳에서 수리를 해야 합니다.</span>
                    </li>
                    <li>
                        <b>범칙금　: </b><span>대여중 발생한 범칙금과 통행료 등은 고객부담입니다.</span>
                    </li>
                    <li>
                        <b>유류비　: </b><span>차량은 최초 대여당시의 주유상태로 반납하여야합니다. 반납시 미달된 주유는 실비정산 됩니다.</span>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /contBox -->
    </section>

    <section class="sstion w1200">
        <div class="titBox">
            <h3 class="car02">대여요금<p>범아렌터카의 단기대여 요금입니다.</p>
            </h3>
        </div>
        <div class="contBox">

            <!-- 0 경차/소형차량 1준대형/대형차량 2SUV/승합차량 3수입차량 -->
			<?php
				for($no=0;$no<count($ca_nameArr);$no++){
			?>
            <div class="tblBox">
                <span class="s_info">
					사용일수 x 해당요금(단위:원)	
					<?php
						if($is_admin&&!preg_match($mobile_agent, $_SERVER['HTTP_USER_AGENT'])){?>
					<button class="btn btn-primary" onclick="payEdit('<?=$no?>')">수정하기</button>
					<?php }?>
				</span>
                <div class="row-horizon">
                    <table class="to_table">
                        <caption>범아렌트카 대여요금안내</caption>
                        <colgroup>
                            <col width="*">
                            <col width="9%">
                            <col width="9%">
                            <col width="9%">
                            <col width="9%">
                            <col width="9%">
                            <col width="9%">
                            <col width="9%">
                        </colgroup>

                        <thead>
                            <tr>
                                <th rowspan="2" class="tit">
                                    <?=$ca_nameArr[$no]?>
                                </th>
                                <th colspan="4">대여기간별 일일요금</th>
                                <th colspan="3">대여시간별요금</th>
                            </tr>
                            <tr>
                                <th>1~2일</th>
                                <th>3~4일</th>
                                <th>5~6일</th>
                                <th>7일이상</th>
                                <th>6시간</th>
                                <th>10시간</th>
                                <th>12시간</th>
                            </tr>
                        </thead>
                        <!--<tbody>
							<?php
								for($i=0;$i<count($modelArr[$no]);$i++){
									$sql="select * from g5_rental_fee where model='".$modelArr[$no][$i]."'";
									$row=sql_fetch($sql);
							?>
                            <tr>
                                <td><?=$modelArr[$no][$i]?></td>
                                <td><?=$row[day1]?></td>
                                <td><?=$row[day3]?></td>
                                <td><?=$row[day5]?></td>
                                <td><?=$row[day7]?></td>
                                <td><?=$row[hour6]?></td>
                                <td><?=$row[hour10]?></td>
                                <td><?=$row[hour12]?></td>
                            </tr>
                           <?php }?>

                        </tbody>-->
						<tbody>
							<?php
								$sql="select * from g5_rental_fee where ca_name='".$ca_nameArr[$no]."' order by idx asc";
								$result=sql_query($sql);
								for($i=0;$row=sql_fetch_array($result);$i++){

							?>
                            <tr>
                                <td><?=$row[model]?></td>
                                <td><?=$row[day1]?></td>
                                <td><?=$row[day3]?></td>
                                <td><?=$row[day5]?></td>
                                <td><?=$row[day7]?></td>
                                <td><?=$row[hour6]?></td>
                                <td><?=$row[hour10]?></td>
                                <td><?=$row[hour12]?></td>
                            </tr>
                           <?php }?>

                        </tbody>
                    </table>
                </div>
            </div>
			<?php }?>
            
        </div>
        <!-- /contBox -->
    </section>
</div>
<!-- /subContainer -->



<?
include_once('./_tail.php');
?>
