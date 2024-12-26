<section class="estimate">
        <!--<div class="guide">
            <i class="fa-duotone fa-circle-exclamation"></i> 이사업체 계약완료 후, 반드시 <span class="txt_red">계약완료</span> 버튼을 클릭해 주세요
        </div>-->
        <br>
        <div class="panel flex ai-c jc-sb">
            <p class="total">총 <strong class="txt_color">2</strong>개 </p>
            <div class="flex ai-c">
                <div class="select">
                    <input type="radio" id="dtr0" name="dtRange" class="red" value="0" checked="">
                    <label for="dtr0">전체</label>
                    <input type="radio" id="dtr1" name="dtRange" class="red" value="1">
                    <label for="dtr1">오늘</label>
                    <input type="radio" id="dtr2" name="dtRange" class="red" value="2">
                    <label for="dtr2">이번주</label>
                    <input type="radio" id="dtr3" name="dtRange" class="red" value="3">
                    <label for="dtr3">이번달</label>
                </div>
                <div class="flex">
                    <input type="date" name="sdt" value="">
                    <p>~</p>
                    <input type="date" name="edt" value="">
                </div>
            </div>
        </div>
        <div class="table">
        <table>
            <colgroup>
                <col width="5%">
                <col width="10%">
                <col width="*">
                <col width="*">
                <col width="10%">
                <col width="14%">
                <col width="10%">
                <col width="10%">
            </colgroup>
            <thead>
            <tr>
                <th></th>
                <th>이사서비스</th>
                <th>출발지</th>
                <th>도착지</th>
                <th>이사일</th>
                <th>연락처</th>
                <th>등록일</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>2</td>
                <td>포장이사</td>
                <td>서울 구로구 구로동</td>
                <td>서울 관악구 신림동</td>
                <td>2024-09-30</td>
                <td>050-1234-5678</td>
                <td>2024-09-30</td>
                <td><button class="btn btn_color" onclick="location.href='./estimateForm'">견적수정</button></td>
            </tr>
            <tr>
                <td>1</td>
                <td>원룸이사</td>
                <td>서울 구로구 구로동</td>
                <td>서울 관악구 신림동</td>
                <td>2024-09-30</td>
                <td>050-1234-5678</td>
                <td>2024-09-30</td>
                <td><button class="btn btn_red">계약완료</button></td>
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
</section>