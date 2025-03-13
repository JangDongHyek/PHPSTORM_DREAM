<!-- 작업관리 > 금주작업 -->
</div>
<div class="week_task">
    <div class="week_top flex ai-c jc-sb">
        <div class="task_info flex ai-c">
            <h4></h4>
            <span class="icon icon-gray">담당자</span>&nbsp;&nbsp;양드림
        </div>
        <div class="week_navigation flex ai-c">
            <div class="week_date">
                <button class="prev">
                    <i class="fa-light fa-angle-left"></i>
                </button>
                <strong>2025년 3월 2번째 주</strong>
                <span>2025-03-09 ~ 2025-03-15</span>
                <button class="next">
                    <i class="fa-light fa-angle-right"></i>
                </button>
            </div>
            <button class="btn btn-darkblue">금주 작업 저장</button>
        </div>
    </div>

</div>


<div class="task-form">
    <div class="flex gap20">
        <div class="left">
            <div class="sticky">
                <ul class="list">
                    <li class="active"><a>25.03.09 (일) <span>총 1구역</span></a></li>
                    <li><a>25.03.10 (월) <span>총 1구역</span></a></li>
                    <li><a>25.03.11 (화) <span>총 1구역</span></a></li>
                    <li><a>25.03.12 (수) <span>총 1구역</span></a></li>
                    <li><a>25.03.13 (목) <span>총 1구역</span></a></li>
                    <li><a>25.03.14 (금) <span>총 1구역</span></a></li>
                    <li><a>25.03.15 (토) <span>총 1구역</span></a></li>
                </ul>
            </div>
        </div>
        <div id="scrollableTable" class="table-wrap">

            <h4><button class="btn btn-blue btn-mini" onclick="utils.showConfirm('해당 구역의 전체 작업이 완료되었나요?')">작업 전체 완료</button> 101동 - 1층 - A 구역 <b class="txt-blue">25.03.09 (일)</b></h4>
            <div class="table">
                <table>
                    <colgroup>
                        <col style="width: 120px;">
                        <col style="width: 120px;">
                    </colgroup>
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
                        <td><input type="text" value="" placeholder=""></td>
                        <td><input type="text" value="" placeholder=""></td>
                        <td><input type="text" value="" placeholder=""></td>
                        <td><input type="text" value="" placeholder=""></td>
                        <td><input type="text" value="" placeholder=""></td>
                        <td><input type="text" value="" placeholder=""></td>
                        <td><input type="text" value="" placeholder=""></td>
                        <td><input type="text" value="" placeholder=""></td>
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
                        <td><input type="text" value="" placeholder=""></td>
                        <td><input type="text" value="" placeholder=""></td>
                        <td><input type="text" value="" placeholder=""></td>
                        <td><input type="text" value="" placeholder=""></td>
                        <td><input type="text" value="" placeholder=""></td>
                        <td><input type="text" value="" placeholder=""></td>
                        <td><input type="text" value="" placeholder=""></td>
                        <td><input type="text" value="" placeholder=""></td>
                        <td><input type="text" value="" placeholder=""></td>
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
                        <td><input type="text" value="" placeholder=""></td>
                        <td><input type="text" value="" placeholder=""></td>
                        <td><input type="text" value="" placeholder=""></td>
                        <td><input type="text" value="" placeholder=""></td>
                        <td><input type="text" value="" placeholder=""></td>
                        <td><input type="text" value="" placeholder=""></td>
                        <td><input type="text" value="" placeholder=""></td>
                        <td><input type="text" value="" placeholder=""></td>
                        <td><input type="text" value="" placeholder=""></td>
                        <td><input type="text" value="" placeholder=""></td>
                        <td><input type="text" value="" placeholder=""></td>
                    </tr>
                    </tbody>
                </table>
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