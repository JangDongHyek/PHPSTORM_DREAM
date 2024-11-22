<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <section class="schedule_task">
        <div class="task_header colgroup">
            <div class="border">공종명 및 상세</div>
            <div class="border">담당자</div>
            <div class="border">상태</div>
            <div class="border">시작예정일</div>
            <div class="border">마감예정일</div>
            <div class="border">시작일</div>
            <div class="border">마감일</div>
        </div>
        <div class="section_title">
            <i class="fa-solid fa-caret-down"></i> 콘크리트 타설
        </div>
        <div class="section_content">
            <div class="task_content_dl">
                <div class="zone_title">
                    101동 [27F] A-1
                </div>
                <dl class="dropdown_dl">
                    <dt class="colgroup">
                        <div class="border task_title"><i class="fa-light fa-angle-down"></i> 거푸집</div>
                        <div class="border"><input class="inputPm" type="text" name="" id="" placeholder="담당자 지정" value="김설주" data-toggle="modal" data-target="#pmSearchModal"/></div>
                        <div class="border">
                            <select class="statusSelect">
                                <option value="gray">예정</option>
                                <option value="green">진행</option>
                                <option value="blue" selected>완료</option>
                                <option value="black">보류</option>
                            </select>
                        </div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                    </dt>
                    <dd class="colgroup">
                        <div class="border task_item">현장 준비 및 기초 작업</div>
                        <div class="border"></div>
                        <div class="border">
                            <select class="statusSelect">
                                <option value="gray">예정</option>
                                <option value="green">진행</option>
                                <option value="blue" selected>완료</option>
                                <option value="black">보류</option>
                            </select>
                        </div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                    </dd>
                    <dd class="colgroup">
                        <div class="border task_item">거푸집 설치 및 보강</div>
                        <div class="border"></div>
                        <div class="border">
                            <select class="statusSelect">
                                <option value="gray">예정</option>
                                <option value="green">진행</option>
                                <option value="blue" selected>완료</option>
                                <option value="black">보류</option>
                            </select>
                        </div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                    </dd>
                    <dd class="colgroup">
                        <div class="border task_item">관통부 및 매립물 설치</div>
                        <div class="border"></div>
                        <div class="border">
                            <select class="statusSelect">
                                <option value="gray">예정</option>
                                <option value="green">진행</option>
                                <option value="blue" selected>완료</option>
                                <option value="black">보류</option>
                            </select>
                        </div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                    </dd>
                </dl>
                <dl class="dropdown_dl">
                    <dt class="colgroup">
                        <div class="border task_title"><i class="fa-light fa-angle-down"></i> 철근</div>
                        <div class="border"><input class="inputPm" type="text" name="" id="" placeholder="담당자 지정" value="조민석" data-toggle="modal" data-target="#pmSearchModal"/></div>
                        <div class="border">
                            <select class="statusSelect">
                                <option value="gray">예정</option>
                                <option value="green" selected>진행</option>
                                <option value="blue">완료</option>
                                <option value="black">보류</option>
                            </select>
                        </div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="" placeholder="-"/></div>
                    </dt>
                    <dd class="colgroup">
                        <div class="border task_item">철근 배치 및 체크</div>
                        <div class="border"></div>
                        <div class="border">
                            <select class="statusSelect">
                                <option value="gray">예정</option>
                                <option value="green" selected>진행</option>
                                <option value="blue">완료</option>
                                <option value="black">보류</option>
                            </select>
                        </div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="" placeholder="-"/></div>
                    </dd>
                    <dd class="colgroup">
                        <div class="border task_item">철근 연결 및 보강</div>
                        <div class="border"></div>
                        <div class="border">
                            <select class="statusSelect">
                                <option value="gray" selected>예정</option>
                                <option value="green">진행</option>
                                <option value="blue">완료</option>
                                <option value="black">보류</option>
                            </select>
                        </div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="" placeholder="-"/></div>
                    </dd>
                    <dd class="colgroup">
                        <div class="border task_item">철근 검수 및 조정</div>
                        <div class="border"></div>
                        <div class="border">
                            <select class="statusSelect">
                                <option value="gray" selected>예정</option>
                                <option value="green">진행</option>
                                <option value="blue">완료</option>
                                <option value="black">보류</option>
                            </select>
                        </div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="" placeholder="-"/></div>
                    </dd>
                </dl>
                <dl class="dropdown_dl">
                    <dt class="colgroup">
                        <div class="border task_title"><i class="fa-light fa-angle-right"></i> 레미콘</div>
                        <div class="border"><input class="inputPm" type="text" name="" id="" placeholder="담당자 지정" value="" data-toggle="modal" data-target="#pmSearchModal"/></div>
                        <div class="border">
                            <select class="statusSelect">
                                <option value="gray">예정</option>
                                <option value="green">진행</option>
                                <option value="blue">완료</option>
                                <option value="black" selected>보류</option>
                            </select>
                        </div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="" placeholder="-"/></div>
                    </dt>
                </dl>
            </div>
            <div class="task_content_dl">
                <div class="zone_title">
                    101동 [27F] A-2
                </div>
                <dl class="dropdown_dl">
                    <dt class="colgroup">
                        <div class="border task_title"><i class="fa-light fa-angle-down"></i> 거푸집</div>
                        <div class="border"><input class="inputPm" type="text" name="" id="" placeholder="담당자 지정" value="김설주" data-toggle="modal" data-target="#pmSearchModal"/></div>
                        <div class="border">
                            <select class="statusSelect">
                                <option value="gray">예정</option>
                                <option value="green">진행</option>
                                <option value="blue" selected>완료</option>
                                <option value="black">보류</option>
                            </select>
                        </div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                    </dt>
                    <dd class="colgroup">
                        <div class="border task_item">현장 준비 및 기초 작업</div>
                        <div class="border"></div>
                        <div class="border">
                            <select class="statusSelect">
                                <option value="gray">예정</option>
                                <option value="green">진행</option>
                                <option value="blue" selected>완료</option>
                                <option value="black">보류</option>
                            </select>
                        </div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                    </dd>
                    <dd class="colgroup">
                        <div class="border task_item">거푸집 설치 및 보강</div>
                        <div class="border"></div>
                        <div class="border">
                            <select class="statusSelect">
                                <option value="gray">예정</option>
                                <option value="green">진행</option>
                                <option value="blue" selected>완료</option>
                                <option value="black">보류</option>
                            </select>
                        </div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                    </dd>
                    <dd class="colgroup">
                        <div class="border task_item">관통부 및 매립물 설치</div>
                        <div class="border"></div>
                        <div class="border">
                            <select class="statusSelect">
                                <option value="gray">예정</option>
                                <option value="green">진행</option>
                                <option value="blue" selected>완료</option>
                                <option value="black">보류</option>
                            </select>
                        </div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                    </dd>
                </dl>
            </div>
        </div>
        <div class="section_title">
            <i class="fa-solid fa-caret-down"></i> 콘크리트 타설
        </div>
        <div class="section_content">
            <div class="task_content_dl">
                <div class="zone_title">
                    101동 [27F] A-1
                </div>
                <dl class="dropdown_dl">
                    <dt class="colgroup">
                        <div class="border task_title"><i class="fa-light fa-angle-down"></i> 거푸집</div>
                        <div class="border"><input class="inputPm" type="text" name="" id="" placeholder="담당자 지정" value="김설주" data-toggle="modal" data-target="#pmSearchModal"/></div>
                        <div class="border">
                            <select class="statusSelect">
                                <option value="gray">예정</option>
                                <option value="green">진행</option>
                                <option value="blue" selected>완료</option>
                                <option value="black">보류</option>
                            </select>
                        </div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                    </dt>
                    <dd class="colgroup">
                        <div class="border task_item">현장 준비 및 기초 작업</div>
                        <div class="border"></div>
                        <div class="border">
                            <select class="statusSelect">
                                <option value="gray">예정</option>
                                <option value="green">진행</option>
                                <option value="blue" selected>완료</option>
                                <option value="black">보류</option>
                            </select>
                        </div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                    </dd>
                    <dd class="colgroup">
                        <div class="border task_item">거푸집 설치 및 보강</div>
                        <div class="border"></div>
                        <div class="border">
                            <select class="statusSelect">
                                <option value="gray">예정</option>
                                <option value="green">진행</option>
                                <option value="blue" selected>완료</option>
                                <option value="black">보류</option>
                            </select>
                        </div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                    </dd>
                    <dd class="colgroup">
                        <div class="border task_item">관통부 및 매립물 설치</div>
                        <div class="border"></div>
                        <div class="border">
                            <select class="statusSelect">
                                <option value="gray">예정</option>
                                <option value="green">진행</option>
                                <option value="blue" selected>완료</option>
                                <option value="black">보류</option>
                            </select>
                        </div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                    </dd>
                </dl>
                <dl class="dropdown_dl">
                    <dt class="colgroup">
                        <div class="border task_title"><i class="fa-light fa-angle-down"></i> 철근</div>
                        <div class="border"><input class="inputPm" type="text" name="" id="" placeholder="담당자 지정" value="조민석" data-toggle="modal" data-target="#pmSearchModal"/></div>
                        <div class="border">
                            <select class="statusSelect">
                                <option value="gray">예정</option>
                                <option value="green" selected>진행</option>
                                <option value="blue">완료</option>
                                <option value="black">보류</option>
                            </select>
                        </div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="" placeholder="-"/></div>
                    </dt>
                    <dd class="colgroup">
                        <div class="border task_item">철근 배치 및 체크</div>
                        <div class="border"></div>
                        <div class="border">
                            <select class="statusSelect">
                                <option value="gray">예정</option>
                                <option value="green" selected>진행</option>
                                <option value="blue">완료</option>
                                <option value="black">보류</option>
                            </select>
                        </div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="" placeholder="-"/></div>
                    </dd>
                    <dd class="colgroup">
                        <div class="border task_item">철근 연결 및 보강</div>
                        <div class="border"></div>
                        <div class="border">
                            <select class="statusSelect">
                                <option value="gray" selected>예정</option>
                                <option value="green">진행</option>
                                <option value="blue">완료</option>
                                <option value="black">보류</option>
                            </select>
                        </div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="2024-05-02" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="" placeholder="-"/></div>
                    </dd>
                    <dd class="colgroup">
                        <div class="border task_item">철근 검수 및 조정</div>
                        <div class="border"></div>
                        <div class="border">
                            <select class="statusSelect">
                                <option value="gray" selected>예정</option>
                                <option value="green">진행</option>
                                <option value="blue">완료</option>
                                <option value="black">보류</option>
                            </select>
                        </div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="" placeholder="-"/></div>
                    </dd>
                </dl>
                <dl class="dropdown_dl">
                    <dt class="colgroup">
                        <div class="border task_title"><i class="fa-light fa-angle-right"></i> 레미콘</div>
                        <div class="border"><input class="inputPm" type="text" name="" id="" placeholder="담당자 지정" value="" data-toggle="modal" data-target="#pmSearchModal"/></div>
                        <div class="border">
                            <select class="statusSelect">
                                <option value="gray">예정</option>
                                <option value="green">진행</option>
                                <option value="blue">완료</option>
                                <option value="black" selected>보류</option>
                            </select>
                        </div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="" placeholder="-"/></div>
                        <div class="border"><input type="text" class="datePicker" name="" id="" value="" placeholder="-"/></div>
                    </dt>
                </dl>
            </div>
        </div>
    </section>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            primary : {type : String, default : ""}
        },
        data: function(){
            return {
                jl : null,
                component_idx : "",
                filter : {
                    page : 1,
                    limit : 1,
                    count : 0,
                    order_by_desc : "insert_date",
                },

                data : [],
                modal : false,
            };
        },
        created: function(){
            this.jl = new Jl('<?=$componentName?>');
            this.component_idx = this.jl.generateUniqueId();

            //this.getData();
        },
        mounted: function(){
            this.$nextTick(() => {
                //스케줄 내 접고 펼치기 스크립트
                document.querySelectorAll('.section_title').forEach(title => {
                    title.addEventListener('click', () => {
                        // 현재 클릭된 제목의 다음 형제 요소인 .section_content를 찾습니다.
                        const content = title.nextElementSibling;

                        // 아이콘을 변경할 .fa-caret-down 요소를 찾습니다.
                        const icon = title.querySelector('i');

                        // content의 현재 display 속성을 가져옵니다.
                        const currentDisplay = window.getComputedStyle(content).display;

                        // .section_content의 display 속성을 토글합니다.
                        if (currentDisplay === 'none') {
                            content.style.display = 'block';
                            icon.classList.remove('fa-caret-right'); // 오른쪽 아이콘 제거
                            icon.classList.add('fa-caret-down'); // 아래쪽 아이콘 추가
                        } else {
                            content.style.display = 'none';
                            icon.classList.remove('fa-caret-down'); // 아래쪽 아이콘 제거
                            icon.classList.add('fa-caret-right'); // 오른쪽 아이콘 추가
                        }
                    });
                });

                document.querySelectorAll('.task_title').forEach(title => {
                    title.addEventListener('click', () => {
                        const dtElement = title.closest('dt');
                        let currentDd = dtElement.nextElementSibling;

                        // 현재 섹션의 모든 dd를 열거나 닫는 로직
                        let isAnyDdVisible = false;
                        let tempDd = currentDd;

                        // 현재 섹션의 dd가 있는지 확인
                        while (tempDd && tempDd.tagName === 'DD') {
                            if (tempDd.style.display === 'flex' || getComputedStyle(tempDd).display === 'flex') {
                                isAnyDdVisible = true;
                                break;
                            }
                            tempDd = tempDd.nextElementSibling;
                        }

                        // dd가 없는 경우, 닫힘 상태로 설정
                        if (!currentDd || currentDd.tagName !== 'DD') {
                            const icon = title.querySelector('i');
                            if (icon) {
                                icon.classList.remove('fa-angle-down');
                                icon.classList.add('fa-angle-right');
                            }
                            return;
                        }

                        tempDd = currentDd;
                        while (tempDd && tempDd.tagName === 'DD') {
                            if (isAnyDdVisible) {
                                tempDd.style.display = 'none'; // 닫기
                            } else {
                                tempDd.style.display = 'flex'; // 열기
                            }
                            tempDd = tempDd.nextElementSibling;
                        }

                        // 아이콘을 토글합니다.
                        const icon = title.querySelector('i');
                        if (icon) {
                            if (isAnyDdVisible) {
                                icon.classList.remove('fa-angle-down');
                                icon.classList.add('fa-angle-right');
                            } else {
                                icon.classList.remove('fa-angle-right');
                                icon.classList.add('fa-angle-down');
                            }
                        }
                    });
                });
            });
        },
        methods: {
            changePage(page) {
                this.filter.page = page;

                this.getData();
            },
            async getData() {
                try {
                    let res = await this.jl.ajax("get",this.filter,"/api/user");
                    this.data = res.data
                    this.filter.count = res.count;
                }catch (e) {
                    alert(e.message)
                }
            }
        },
        computed: {

        },
        watch : {

        }
    });
</script>

<style>

</style>