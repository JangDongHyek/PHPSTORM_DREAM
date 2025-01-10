<?php
$pid = "class_list";
include_once("./app_head.php");

?>
    <div id="class" class="list">
        <button class="btn btn_large btn_back" type="button" onclick="location.href='./class'"><i class="fa-solid fa-arrow-left"></i> 속회방 메인</button>
        <div class="slogan">
            <h6>n교구 속회예배 현황
            <span>이번주 예배 드린 속 <b>0</b>개속 / 전체 0개속 중</span>
        </div>
        <div class="box_radius box_white">
            <div class="table">
                <table>
                    <thead>
                    <tr>
                        <th>속</th>
                        <th>속장</th>
                        <th>속회보고</th>
                        <th>특이사항</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>4</td>
                        <td>김성은 권사</td>
                        <td>
                            <button type="button" class="btn btn_mini btn_color" data-toggle="modal" data-target="#classViewModal">보기</button>
                            <button type="button" class="btn btn_mini btn_line">수정</button>
                        </td>
                        <td class="color">유</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>김성은 권사</td>
                        <td>
                            <button type="button" class="btn btn_mini btn_color" data-toggle="modal" data-target="#classViewModal">보기</button>
                            <button type="button" class="btn btn_mini btn_line">수정</button>
                        </td>
                        <td class="">무</td>
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


    <div class="modal fade" id="classViewModal" tabindex="-1" role="dialog" aria-labelledby="classViewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="classViewModalLabel">속회보고</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="table">
                        <table>
                            <tbody>
                            <tr class="top">
                                <td>소속</td>
                                <td>
                                    <div class="flex ai-c gap5">
                                        <input type="text" readonly> 교구
                                        <input type="text" readonly> 속
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>속장</td>
                                <td>
                                    <div class="flex ai-c gap5">
                                        <input type="text" placeholder="이름" readonly>
                                        <input type="text" placeholder="직분" readonly>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>일시 <span class="txt_color">*</span></td>
                                <td>
                                    <input type="date" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td>장소 <span class="txt_color">*</span></td>
                                <td>
                                    <input type="text" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td>인원 <span class="txt_color">*</span></td>
                                <td>
                                    <div class="flex ai-c gap5">
                                        <input type="number" readonly> 명
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>헌금 <span class="txt_color">*</span></td>
                                <td>
                                    <div class="flex ai-c gap5">
                                        <input type="number" readonly> 만원
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">특이사항 <span class="txt_color">*</span></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <textarea readonly></textarea>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
include_once("./app_tail.php");
?>