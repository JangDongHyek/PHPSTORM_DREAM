<style>
    header, footer, #show-sidebar, #sidebar  {display: none}
    .page-wrapper.toggled .page-content {padding-left: 0}
</style>

<div class="task-form">
    <div class="flex ai-c jc-sb">
        <button class="btn btn-blue" onclick="utils.showConfirm('해당 구역의 전체 작업이 완료되었나요?')">작업 전체 완료</button>
        <button class="btn btn-darkblue male-auto">저장</button>
    </div>
    <div class="flex gap20">
        <div class="left">
            <div class="sticky">

                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#scheduled-task" aria-controls="all-list" role="tab" data-toggle="tab" aria-expanded="true">전체 <strong class="txt-red">10일</strong></a>
                    </li>
                    <li role="presentation" class="">
                        <a href="#week-list" aria-controls="week-list" role="tab" data-toggle="tab" aria-expanded="false">금주 <strong>0일</strong></a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="scheduled-task">
                        <ul class="list">
                            <li><button type="button" class="btn btn-large btn-gray">일정 추가</button></li>
                            <li class="active"><a><span>1일차</span> 25.03.01 (토)</a></li>
                            <li><a><span>2일차</span> 25.03.02 (일)</a></li>
                            <li><a><span>3일차</span> 25.03.03 (월)</a></li>
                            <li><a><span>4일차</span> 25.03.04 (화)</a></li>
                            <li><a><span>5일차</span> 25.03.05 (수)</a></li>
                            <li><a><span>6일차</span> 25.03.06 (목)</a></li>
                            <li><a><span>7일차</span> 25.03.07 (금)</a></li>
                            <li><a><span>8일차</span> 25.03.08 (토)</a></li>
                            <li><a><span>9일차</span> 25.03.09 (일)</a></li>
                            <li><a><span>10일차</span> 25.03.10 (월)</a></li>
                        </ul>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="week-list">
                        <ul class="list">
                            <li><button type="button" class="btn btn-large btn-gray">일정 추가</button></li>
                            <li class="empty">금주 해당 일정이 없습니다.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div id="scrollableTable" class="table-wrap">

            <h4>101동 - 1층 - A 구역 <b class="txt-blue">25.03.01 (토)</b></h4>
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