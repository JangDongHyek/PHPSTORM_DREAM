<?php
$pid = "benecafe";
$sub_menu = '200000';
include_once ('./admin.head.php');

header('Location: '.G5_URL."/admin/userlist.php?type=복지몰");
exit; // 항상 header 호출 후에는 스크립트의 실행을 종료해야 합니다.
?>

<div class="memberlist">
   <h4>이제너두 캐쉬백고객</h4>
   
   <div class="table_cap">
       <div>
           <strong>상담결과 <span class="color-red">8개</span></strong> / 총 100개
       </div>
       
       <select class="border_gray">
           <option value="4개씩보기">4개씩보기</option>
           <option value="8개씩보기">8개씩보기</option>
           <option value="12개씩보기">12개씩보기</option>
       </select>
   </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>캐쉬백 신청일자</th>
                <th>신청인 성명</th>
                <th>신청인 휴대폰</th>
                <th>신청인 고객사명</th>
                <th>해피라이프 이용일자</th>
                <th>이용인 성명</th>
                <th>비고</th>
            </tr>
        </thead>
        <tbody>
            <tr>
               <td>01</td>
                <td>2024-05-02</td>
                <td>김드림</td>
                <td>010-1234-6789</td>
                <td>드림포원</td>
                <td>2024-05-03</td>
                <td>김포원</td>
                <td>-</td>
            </tr>
            <tr>
               <td>02</td>
                <td>2024-05-02</td>
                <td>김드림</td>
                <td>010-1234-6789</td>
                <td>드림포원</td>
                <td>2024-05-03</td>
                <td>김포원</td>
                <td>-</td>
            </tr>
            <tr>
               <td>03</td>
                <td>2024-05-02</td>
                <td>김드림</td>
                <td>010-1234-6789</td>
                <td>드림포원</td>
                <td>2024-05-03</td>
                <td>김포원</td>
                <td>-</td>
            </tr>
            <tr>
               <td>04</td>
                <td>2024-05-02</td>
                <td>김드림</td>
                <td>010-1234-6789</td>
                <td>드림포원</td>
                <td>2024-05-03</td>
                <td>김포원</td>
                <td>-</td>
            </tr>
            <tr class="nodata">
               <td colspan="8">자료가 없습니다.</td>
            </tr>
        </tbody>
    </table>
    
    <div class="page-controller">
        <a class="arrow left"><i class="fa-light fa-angle-left"></i></a>
        <span class="paging">1 / 1</span>
        <a class="arrow right"><i class="fa-light fa-angle-right"></i></a>
    </div>
</div>

<?php
include_once ('./admin.tail.php');
?>
