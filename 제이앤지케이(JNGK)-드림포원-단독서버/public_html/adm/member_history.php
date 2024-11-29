<?php
//$sub_menu = "210100";
include_once('./_common.php');

//$g5['title'] = '';
include_once('./admin.head.php');

?>

<div id="mem_his_wrap">
	<!--회원정보-->
    <div id="mem_his_info">
        <div class="mh_name">
            
            <span class="mh_state"><span class="mhs mhs_01">신규</span></span><!--회원상태-->
            <!--회원상태에 따른 클래스명
            신규 mhs_01
            재등록 mhs_02
            휴면/미등록/온라인 mhs_03
            -->
            
            <span class="mh_num">123456</span><!--회원번호-->
            <span class="mh_t">홍길동<?=$mb['mb_category']?> 회원님</span><!--회원이름-->
        </div><!--.mh_name-->
        
        <div class="mh_info">
            <ul>
               <li><strong>담당프로</strong> 나길동</li><!--담당프로-->
               <li><strong>휴대전화</strong> 010-1111-2222</li>
               <li><strong>주소</strong> 부산시 해운대구 센텀북대로 55, 부산디자인진흥원 707호</li>
               <li><strong>이메일</strong> abc123@naver.com</li>
               <li><strong>생년월일</strong> 1980.05.01</li>
            </ul>
        </div><!--.mh_info-->
    </div><!--#mem_his_info-->
    
    
    <div class="mem_his_tit">레슨내역</div>
    
	<!--회원 레슨내역-->
    <div class="guideBox">
        <div class="mem_his_bt">
            <div class="mhb_t">정기레슨 24회/3개월</div><!--레슨명-->
            <div class="mhb_d">등록일 2020-05-02</div><!--등록일-->
        </div><!--.mem_his_bt-->
        
        <div class="mh_open"><span class="textbtn">세부내역 <i class='fal fa-angle-down'></i></span></div><!--세부내역보기 버튼-->
        <div style="display:none">
            <div class="tbl_mh">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <thead>
                  <tr>
                    <th scope="col" width="10%">회차</th>
                    <th scope="col" width="20%">날짜</th>
                    <th scope="col" width="50%">레슨내용</th>
                    <th scope="col" width="10%">동영상</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1회차</td>
                    <td>2020-05-02</td>
                    <td>레슨내용입니다.</td>
                    <td>
                    <!--동영상 있을때-->
                    <div class="mh_movie"><img src="<?php echo G5_IMG_URL ?>/ico_movie.gif" alt=""/></div>
                    </td>
                  </tr>
                  <tr>
                    <td>2회차</td>
                    <td>2020-05-03</td>
                    <td>레슨내용입니다.</td>
                    <td>-</td>
                  </tr>
                </tbody>  
                </table>
            </div><!--.tbl_mh-->
        </div><!--display:none-->
	</div><!--.guideBox-->  
    
    
</div><!--#mem_his_wrap-->





<script>
//세부내역 열기 닫기 버튼
$(document).on("click",".guideBox .mh_open",function(){
      if($(this).next().css("display")=="none"){
        $(this).next().show();
        $(this).children("span").html("내역닫기 <i class='fal fa-angle-up'></i>");
      }else{
        $(this).next().hide();
        $(this).children("span").html("세부내역 <i class='fal fa-angle-down'></i>");
      }
});

</script>

<?php
include_once ('./admin.tail.php');
?>
