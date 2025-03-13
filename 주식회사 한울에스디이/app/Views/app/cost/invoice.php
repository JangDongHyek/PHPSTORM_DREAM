<!-- 내역서 -->
</div>
<?php
if(!$project) return false;
?>
<div class="invoice">
    <div class="flex ai-c jc-sb">
        <button class="btn btn-line"><img src="<?=base_url()?>img/common/excel_green.svg"> 업로드</button>
        <button class="btn btn-gray" data-toggle="modal" data-target="#uploadListModal">업로드 내역</button>
        <button class="btn btn-darkblue male-auto">저장</button>
    </div>
    <div class="flex">
        <div class="left">
            <div class="sticky">
                <ul>
                    <!-- 101동 -->
                    <li class="active" onclick="toggleMenu(this, event)">
                        <p><i class="fas fa-caret-right toggle-icon rotate"></i>&nbsp;101동</p>
                        <ul class="nested">
                            <!-- 101동 - 1층 -->
                            <li class="active" onclick="toggleMenu(this, event)">
                                <p><i class="fas fa-caret-right toggle-icon rotate"></i>&nbsp;101동 - 1층</p>
                                <ul class="nested zone">
                                    <!-- A, B, C 구역 -->
                                    <li class="active"><a href="#zone1" onclick="event.stopPropagation()">
                                            <i class="fas fa-th"></i>&nbsp;101동 - 1층 - A 구역
                                        </a>
                                    </li>
                                    <li><a href="#zone2" onclick="event.stopPropagation()">
                                            <i class="fas fa-th"></i>&nbsp;101동 - 1층 - B 구역
                                        </a>
                                    </li>
                                    <li><a href="#zone3" onclick="event.stopPropagation()">
                                            <i class="fas fa-th"></i>&nbsp;101동 - 1층 - C 구역
                                        </a>
                                    </li>
                                    <li><a href="#zone1-1-total" class="third" onclick="event.stopPropagation()">
                                            <i class="fa-solid fa-square-poll-vertical"></i>&nbsp;101동 1층 합계
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- 101동 - 1층 -->
                            <li class="active" onclick="toggleMenu(this, event)">
                                <p><i class="fas fa-caret-right toggle-icon rotate"></i>&nbsp;101동 - 2층</p>
                                <ul class="nested zone">
                                    <li><a href="#zone3" onclick="event.stopPropagation()">
                                            <i class="fas fa-th"></i>&nbsp;101동 - 2층 - A 구역
                                        </a>
                                    </li>
                                    <li><a href="#zone1-2-total" class="third" onclick="event.stopPropagation()">
                                            <i class="fa-solid fa-square-poll-vertical"></i>&nbsp;101동 2층 합계
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="#zone1-total" class="second" onclick="event.stopPropagation()">
                                    <i class="fa-solid fa-square-poll-vertical"></i>&nbsp;101동 합계
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="#total" class="first">
                            <i class="fa-solid fa-square-poll-vertical"></i>&nbsp;총 합계
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div id="scrollableTable" class="table-wrap">
            <div class="table"  id="zone1">
                <table>
                    <colgroup>
                        <col style="width: 120px;">
                        <col style="width: 120px;">
                    </colgroup>
                    <thead>
                    <tr>
                        <th colspan="2">
                            <h4>101동 - 1층 - A 구역</h4>
                        </th>
                        <th colspan="50">
                            <div class="flex ai-c">
                                <b>시작일</b>
                                <input type="date" class="w150px"/>
                                <b>마감일</b>
                                <input type="date" class="w150px"/>
                            </div>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th colspan="8">
                            콘크리트
                        </th>
                    </tr>
                    <tr>
                        <th>C18</th>
                        <th>C24</th>
                        <th>C27</th>
                        <th>C27(PC보)</th>
                        <th>C27S/내진</th>
                        <th>C27S/내진(PC보)</th>
                        <th>C35</th>
                        <th>헌치</th>
                    </tr>
                    <tr>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                    </tr>
                    <tr>
                        <th colspan="9">
                            거푸집
                        </th>
                    </tr>
                    <tr>
                        <th>Rib-Lath</th>
                        <th>경사</th>
                        <th>계단실</th>
                        <th>기둥</th>
                        <th>기초</th>
                        <th>벽,보측면(유로폼)</th>
                        <th>보하부</th>
                        <th>슬래브</th>
                        <th>합판거푸집</th>
                    </tr>
                    <tr>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                    </tr>
                    <tr>
                        <th colspan="11">
                            철근
                        </th>
                    </tr>
                    <tr>
                        <th>SD500 - SHD10</th>
                        <th>SD500 - SHD13</th>
                        <th>SD500 - SHD16</th>
                        <th>SD600 - UHD16</th>
                        <th>SD600 - UHD19</th>
                        <th>SD600 - UHD22</th>
                        <th>SD600 - UHD25</th>
                        <th>SD600S - UHD16</th>
                        <th>SD600S - UHD19</th>
                        <th>SD600S - UHD22</th>
                        <th>SD600S - UHD25</th>
                    </tr>
                    <tr>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="table"  id="zone2">
                <table>
                    <colgroup>
                        <col style="width: 120px;">
                        <col style="width: 120px;">
                    </colgroup>
                    <thead>
                    <tr>
                        <th colspan="2">
                            <h4>101동 - 1층 - B 구역</h4>
                        </th>
                        <th colspan="50">
                            <div class="flex ai-c">
                                <b>시작일</b>
                                <input type="date" class="w150px"/>
                                <b>마감일</b>
                                <input type="date" class="w150px"/>
                            </div>
                        </th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr>
                        <th colspan="8">
                            콘크리트
                        </th>
                    </tr>
                    <tr>
                        <th>C18</th>
                        <th>C24</th>
                        <th>C27</th>
                        <th>C27(PC보)</th>
                        <th>C27S/내진</th>
                        <th>C27S/내진(PC보)</th>
                        <th>C35</th>
                        <th>헌치</th>
                    </tr>
                    <tr>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                    </tr>
                    <tr>
                        <th colspan="9">
                            거푸집
                        </th>
                    </tr>
                    <tr>
                        <th>Rib-Lath</th>
                        <th>경사</th>
                        <th>계단실</th>
                        <th>기둥</th>
                        <th>기초</th>
                        <th>벽,보측면(유로폼)</th>
                        <th>보하부</th>
                        <th>슬래브</th>
                        <th>합판거푸집</th>
                    </tr>
                    <tr>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                    </tr>
                    <tr>
                        <th colspan="11">
                            철근
                        </th>
                    </tr>
                    <tr>
                        <th>SD500 - SHD10</th>
                        <th>SD500 - SHD13</th>
                        <th>SD500 - SHD16</th>
                        <th>SD600 - UHD16</th>
                        <th>SD600 - UHD19</th>
                        <th>SD600 - UHD22</th>
                        <th>SD600 - UHD25</th>
                        <th>SD600S - UHD16</th>
                        <th>SD600S - UHD19</th>
                        <th>SD600S - UHD22</th>
                        <th>SD600S - UHD25</th>
                    </tr>
                    <tr>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="table hide" id="zone1-1-total">
                <table>
                    <colgroup>
                        <col style="width: 120px;">
                        <col style="width: 120px;">
                    </colgroup>
                    <thead class="third-total">
                    <tr>
                        <th colspan="2"><h4>101동 1층 합계</h4></th>
                        <th colspan="99"><button type="button" class="btn btn-white btn-mini" onclick="hideTable(event)">합계 숨기기</button></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th colspan="8">
                            콘크리트
                        </th>
                    </tr>
                    <tr>
                        <th>C18</th>
                        <th>C24</th>
                        <th>C27</th>
                        <th>C27(PC보)</th>
                        <th>C27S/내진</th>
                        <th>C27S/내진(PC보)</th>
                        <th>C35</th>
                        <th>헌치</th>
                    </tr>
                    <tr>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                    </tr>
                    <tr>
                        <th colspan="9">
                            거푸집
                        </th>
                    </tr>
                    <tr>
                        <th>Rib-Lath</th>
                        <th>경사</th>
                        <th>계단실</th>
                        <th>기둥</th>
                        <th>기초</th>
                        <th>벽,보측면(유로폼)</th>
                        <th>보하부</th>
                        <th>슬래브</th>
                        <th>합판거푸집</th>
                    </tr>
                    <tr>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                    </tr>
                    <tr>
                        <th colspan="11">
                            철근
                        </th>
                    </tr>
                    <tr>
                        <th>SD500 - SHD10</th>
                        <th>SD500 - SHD13</th>
                        <th>SD500 - SHD16</th>
                        <th>SD600 - UHD16</th>
                        <th>SD600 - UHD19</th>
                        <th>SD600 - UHD22</th>
                        <th>SD600 - UHD25</th>
                        <th>SD600S - UHD16</th>
                        <th>SD600S - UHD19</th>
                        <th>SD600S - UHD22</th>
                        <th>SD600S - UHD25</th>
                    </tr>
                    <tr>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="table"  id="zone3">
                <table>
                    <colgroup>
                        <col style="width: 120px;">
                        <col style="width: 120px;">
                    </colgroup>
                    <thead>
                    <tr>
                        <th colspan="2">
                            <h4>101동 - 2층 -  A 구역</h4>
                        </th>
                        <th colspan="50">
                            <div class="flex ai-c">
                                <b>시작일</b>
                                <input type="date" class="w150px"/>
                                <b>마감일</b>
                                <input type="date" class="w150px"/>
                            </div>
                        </th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr>
                        <th colspan="8">
                            콘크리트
                        </th>
                    </tr>
                    <tr>
                        <th>C18</th>
                        <th>C24</th>
                        <th>C27</th>
                        <th>C27(PC보)</th>
                        <th>C27S/내진</th>
                        <th>C27S/내진(PC보)</th>
                        <th>C35</th>
                        <th>헌치</th>
                    </tr>
                    <tr>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                    </tr>
                    <tr>
                        <th colspan="9">
                            거푸집
                        </th>
                    </tr>
                    <tr>
                        <th>Rib-Lath</th>
                        <th>경사</th>
                        <th>계단실</th>
                        <th>기둥</th>
                        <th>기초</th>
                        <th>벽,보측면(유로폼)</th>
                        <th>보하부</th>
                        <th>슬래브</th>
                        <th>합판거푸집</th>
                    </tr>
                    <tr>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                    </tr>
                    <tr>
                        <th colspan="11">
                            철근
                        </th>
                    </tr>
                    <tr>
                        <th>SD500 - SHD10</th>
                        <th>SD500 - SHD13</th>
                        <th>SD500 - SHD16</th>
                        <th>SD600 - UHD16</th>
                        <th>SD600 - UHD19</th>
                        <th>SD600 - UHD22</th>
                        <th>SD600 - UHD25</th>
                        <th>SD600S - UHD16</th>
                        <th>SD600S - UHD19</th>
                        <th>SD600S - UHD22</th>
                        <th>SD600S - UHD25</th>
                    </tr>
                    <tr>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="table hide" id="zone1-2-total">
                <table>
                    <colgroup>
                        <col style="width: 120px;">
                        <col style="width: 120px;">
                    </colgroup>
                    <thead class="third-total">
                    <tr>
                        <th colspan="2"><h4>101동 2층 합계</h4></th>
                        <th colspan="99"><button type="button" class="btn btn-white btn-mini" onclick="hideTable(event)">합계 숨기기</button></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th colspan="8">
                            콘크리트
                        </th>
                    </tr>
                    <tr>
                        <th>C18</th>
                        <th>C24</th>
                        <th>C27</th>
                        <th>C27(PC보)</th>
                        <th>C27S/내진</th>
                        <th>C27S/내진(PC보)</th>
                        <th>C35</th>
                        <th>헌치</th>
                    </tr>
                    <tr>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                    </tr>
                    <tr>
                        <th colspan="9">
                            거푸집
                        </th>
                    </tr>
                    <tr>
                        <th>Rib-Lath</th>
                        <th>경사</th>
                        <th>계단실</th>
                        <th>기둥</th>
                        <th>기초</th>
                        <th>벽,보측면(유로폼)</th>
                        <th>보하부</th>
                        <th>슬래브</th>
                        <th>합판거푸집</th>
                    </tr>
                    <tr>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                    </tr>
                    <tr>
                        <th colspan="11">
                            철근
                        </th>
                    </tr>
                    <tr>
                        <th>SD500 - SHD10</th>
                        <th>SD500 - SHD13</th>
                        <th>SD500 - SHD16</th>
                        <th>SD600 - UHD16</th>
                        <th>SD600 - UHD19</th>
                        <th>SD600 - UHD22</th>
                        <th>SD600 - UHD25</th>
                        <th>SD600S - UHD16</th>
                        <th>SD600S - UHD19</th>
                        <th>SD600S - UHD22</th>
                        <th>SD600S - UHD25</th>
                    </tr>
                    <tr>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="table hide" id="zone1-total">
                <table>
                    <colgroup>
                        <col style="width: 120px;">
                        <col style="width: 120px;">
                    </colgroup>
                    <thead class="second-total">
                    <tr>
                        <th colspan="2"><h4>101동 합계</h4> </th>
                        <th colspan="99"><button type="button" class="btn btn-white btn-mini" onclick="hideTable(event)">합계 숨기기</button></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th colspan="8">
                            콘크리트
                        </th>
                    </tr>
                    <tr>
                        <th>C18</th>
                        <th>C24</th>
                        <th>C27</th>
                        <th>C27(PC보)</th>
                        <th>C27S/내진</th>
                        <th>C27S/내진(PC보)</th>
                        <th>C35</th>
                        <th>헌치</th>
                    </tr>
                    <tr>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                    </tr>
                    <tr>
                        <th colspan="9">
                            거푸집
                        </th>
                    </tr>
                    <tr>
                        <th>Rib-Lath</th>
                        <th>경사</th>
                        <th>계단실</th>
                        <th>기둥</th>
                        <th>기초</th>
                        <th>벽,보측면(유로폼)</th>
                        <th>보하부</th>
                        <th>슬래브</th>
                        <th>합판거푸집</th>
                    </tr>
                    <tr>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                    </tr>
                    <tr>
                        <th colspan="11">
                            철근
                        </th>
                    </tr>
                    <tr>
                        <th>SD500 - SHD10</th>
                        <th>SD500 - SHD13</th>
                        <th>SD500 - SHD16</th>
                        <th>SD600 - UHD16</th>
                        <th>SD600 - UHD19</th>
                        <th>SD600 - UHD22</th>
                        <th>SD600 - UHD25</th>
                        <th>SD600S - UHD16</th>
                        <th>SD600S - UHD19</th>
                        <th>SD600S - UHD22</th>
                        <th>SD600S - UHD25</th>
                    </tr>
                    <tr>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="table hide" id="total">
                <table>
                    <colgroup>
                        <col style="width: 120px;">
                        <col style="width: 120px;">
                    </colgroup>
                    <thead class="first-total">
                    <tr>
                        <th colspan="2"><h4>총 합계</h4></th>
                        <th colspan="99"><button type="button" class="btn btn-white btn-mini" onclick="hideTable(event)">합계 숨기기</button></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th colspan="8">
                            콘크리트
                        </th>
                    </tr>
                    <tr>
                        <th>C18</th>
                        <th>C24</th>
                        <th>C27</th>
                        <th>C27(PC보)</th>
                        <th>C27S/내진</th>
                        <th>C27S/내진(PC보)</th>
                        <th>C35</th>
                        <th>헌치</th>
                    </tr>
                    <tr>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                    </tr>
                    <tr>
                        <th colspan="9">
                            거푸집
                        </th>
                    </tr>
                    <tr>
                        <th>Rib-Lath</th>
                        <th>경사</th>
                        <th>계단실</th>
                        <th>기둥</th>
                        <th>기초</th>
                        <th>벽,보측면(유로폼)</th>
                        <th>보하부</th>
                        <th>슬래브</th>
                        <th>합판거푸집</th>
                    </tr>
                    <tr>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                    </tr>
                    <tr>
                        <th colspan="11">
                            철근
                        </th>
                    </tr>
                    <tr>
                        <th>SD500 - SHD10</th>
                        <th>SD500 - SHD13</th>
                        <th>SD500 - SHD16</th>
                        <th>SD600 - UHD16</th>
                        <th>SD600 - UHD19</th>
                        <th>SD600 - UHD22</th>
                        <th>SD600 - UHD25</th>
                        <th>SD600S - UHD16</th>
                        <th>SD600S - UHD19</th>
                        <th>SD600S - UHD22</th>
                        <th>SD600S - UHD25</th>
                    </tr>
                    <tr>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                        <td class="text_right">0</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- -->
<div class="modal fade" id="uploadListModal" tabindex="-1" aria-labelledby="uploadListModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-wide">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa-light fa-close"></i></button>
                <h5 class="modal-title" id="uploadListModalLabel">업로드 내역</h5>
            </div>
            <div class="modal-body">
                <div class="table">
                    <table>
                        <colgroup>
                            <col style="width: 5%">
                            <col style="width: auto">
                            <col style="width: 120px">
                            <col style="width: auto">
                            <col style="width: 150px">
                            <col style="width: 40px">
                        </colgroup>
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>업로드 파일</th>
                            <th>업로드 일시</th>
                            <th>적용 구역</th>
                            <th>적용 기간</th>
                            <th>관리</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>파일명.excel</td>
                            <td>25.01.01 11:20</td>
                            <td>101동 - 1층 - A구역</td>
                            <td>25.01.01 ~ 25.01.01</td>
                            <td><button type="button" class="btn btn-mini btn-line">삭제</button></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="paging">
                    <div class="pagingWrap">
                        <a class="first disabled"><i class="fa-light fa-chevrons-left"></i></a>
                        <a class="prev disabled"><i class="fa-light fa-chevron-left"></i></a>
                        <a class="active">1</a>
                        <a>2</a>
                        <a>3</a>
                        <a>4</a>
                        <a>5</a>
                        <a>6</a>
                        <a>7</a>
                        <a class="next disabled"><i class="fa-light fa-chevron-right"></i></a>
                        <a class="last disabled"><i class="fa-light fa-chevrons-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">저장</button>
            </div>
        </div>
    </div>
</div>

<script>
    const scrollableTable = document.getElementById('scrollableTable');

    let isDragging = false;
    let startX;
    let scrollLeft;

    scrollableTable.addEventListener('mousedown', (e) => {
        isDragging = true;
        startX = e.pageX - scrollableTable.offsetLeft;
        scrollLeft = scrollableTable.scrollLeft;
        scrollableTable.style.cursor = 'grabbing';
    });

    scrollableTable.addEventListener('mouseleave', () => {
        isDragging = false;
        scrollableTable.style.cursor = 'grab';
    });

    scrollableTable.addEventListener('mouseup', () => {
        isDragging = false;
        scrollableTable.style.cursor = 'grab';
    });

    scrollableTable.addEventListener('mousemove', (e) => {
        if (!isDragging) return;
        e.preventDefault();
        const x = e.pageX - scrollableTable.offsetLeft;
        const walk = (x - startX) * 1.5; // 드래그 속도 조절 (1.5배 빠르게)
        scrollableTable.scrollLeft = scrollLeft - walk;
    });


</script>


<script>
    function toggleMenu(element, event) {
        // 이벤트 버블링 방지
        event?.stopPropagation();

        // 현재 요소의 활성화 상태를 확인
        const isActive = element.classList.contains('active');

        // 같은 부모 내의 모든 하위 메뉴 닫기
        const parent = element.parentElement;
        parent.querySelectorAll(':scope > li').forEach(li => li.classList.remove('active'));
        parent.querySelectorAll('.toggle-icon').forEach(icon => icon.classList.remove('rotate'));

        // 현재 요소가 비활성화 상태였다면 활성화 (닫혀 있던 것을 연다)
        if (!isActive) {
            element.classList.add('active');
            element.querySelector('.toggle-icon')?.classList.add('rotate');
        }
    }

    // 'div.left' 내의 링크를 모두 선택
    document.querySelectorAll('.left a').forEach(link => {
        link.addEventListener('click', (event) => {
            event.preventDefault(); // 링크의 기본 동작을 막기
            event.stopPropagation(); // 이벤트 버블링 방지

            // 모든 합계 테이블에 'hide' 클래스를 추가하여 숨김
            document.querySelectorAll('.table[id*="total"]').forEach(table => {
                table.classList.add('hide');
            });

            // 클릭된 링크의 href 속성을 사용하여 해당 테이블만 표시
            const targetId = link.getAttribute('href');
            const targetTable = document.querySelector(targetId);

            if (targetTable) {
                targetTable.classList.remove('hide'); // 'hide' 클래스를 제거하여 표시

                // 해당 합계 테이블 위치로 스크롤 이동 (부드럽게)
                targetTable.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    // '합계 숨기기' 버튼을 눌렀을 때 처리
    function hideTable(event) {
        event.stopPropagation(); // 이벤트 버블링 방지
        const table = event.target.closest('.table'); // 버튼이 속한 가장 가까운 .table 요소 선택
        if (table) {
            table.classList.add('hide'); // hide 클래스를 추가하여 숨김 처리
        }
    }


</script>