<?php
$pid = "note";
include_once("./app_head.php");

?>
    <div id="note">
        <div class="slogan">
            <h5>결단노트쓰기는, 주일예배의 결단 내용을 어떻게<br class="visible-xs"> 실천할 것인지를 다짐하고,<br class="hidden-xs">
                생활속에서 실천한 <br class="visible-xs">내용을 성도들과 나누는 코이노니아의 장입니다.</h5>
            <button type="button" class="btn btn_color btn-large" onclick="location.href='./note_form'">결단노트 작성하기</button>
        </div>
        <div class="box_radius box_white">
            <h6>남의 험담을 하지 않겠습니다.
                <span>2024 IMC <b>0</b>번째 결단</span>
            </h6>
            <div class="table">
                <table>
                    <thead>
                    <tr>
                        <th>번호</th>
                        <th>이름</th>
                        <th>결단 및 실천</th>
                        <th>응원해요</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1</td>
                        <td>전민웅 집사</td>
                        <td><p class="cut" onclick="location.href='./note_view'">남의 험담을 하지 않겠습니다</p></td>
                        <td><a onclick="showToast('응원해요!🙌')"><i class="fa-duotone fa-solid fa-hands-clapping"></i> 0</a></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>전민웅 집사</td>
                        <td><p class="cut" onclick="showToast('비공개 노트입니다.')"><i class="fa-solid fa-lock-keyhole txt_red"></i> 제 입에 재갈을 채우겠습니다</p></td>
                        <td><a onclick="showToast('이미 응원했어요')"><i class="fa-duotone fa-solid fa-hands-clapping"></i> 0</a></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="b-pagination-outer">
                <ul id="border-pagination">


                    <li><a href="javascript:void(0)" class="active">1</a></li>
                    <li><a href="?page=2&amp;" class="">2</a></li>
                    <li><a href="?page=3&amp;" class="">3</a></li>
                    <li><a href="?page=4&amp;" class="">4</a></li>


                    <li><a href="?page=4&amp;">»</a></li>

                </ul>
            </div>
        </div>
    </div>

<?php
include_once("./app_tail.php");
?>