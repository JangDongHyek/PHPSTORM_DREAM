<!-- 작업관리 > 계획공정표 -->
</div>
<div class="schedule">
    <div class="flex ai-c jc-sb">
        <div class="area_filter">
            <input type="search" name="stx" placeholder="검색어 입력" value=""><button type="submit" class="btn-search"><i class="fa-regular fa-magnifying-glass"></i></button>
        </div>
        <div class="btn-wrap">
            <button class="btn btn-small btn-blueline" data-toggle="modal" data-target="#sectionModal">작업구역관리</button>
            <button class="btn btn-small btn-darkblue"><img src="<?=base_url()?>img/common/excel_blue.svg"> 가져오기</button>
            <button class="btn btn-small btn-line"><img src="<?=base_url()?>img/common/excel_green.svg"> 내보내기</button>
        </div>
    </div>
    <div class="grid grid2">
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
        <section class="schedule_gant">
            <div class="gant_header">
                <div class="period_wrap">
                    <div class="month">
                        <p>2024-07</p>
                    </div>
                    <div class="day">
                        <ul>
                            <!-- Dates will be inserted here by JavaScript -->
                        </ul>
                    </div>
                </div>
                <div class="period_wrap">
                    <div class="month">
                        <p>2024-08</p>
                    </div>
                    <div class="day">
                        <ul>
                            <!-- Dates will be inserted here by JavaScript -->
                        </ul>
                    </div>
                </div>
            </div>
            <div class="gant_cont">
                <div class="column_wrap">
                    <div class="section_title"></div>
                    <div class="day">
                        <ul>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li class="weekend"></li>
                            <li class="weekend"></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li class="weekend"></li>
                            <li class="weekend"></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li class="weekend"></li>
                            <li class="weekend"></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li class="weekend"></li>
                            <li class="weekend"></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li class="weekend"></li>
                            <li class="weekend"></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li class="weekend"></li>
                            <li class="weekend"></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li class="weekend"></li>
                            <li class="weekend"></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li class="weekend"></li>
                            <li class="weekend"></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li class="weekend"></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<style>
    .title_wrap{padding: 14px 40px 0; margin-bottom: 0;}
    .title_wrap h2{margin-bottom: 14px;}
    .page-wrapper .page-content > div{padding: 0;}
    .container-fluid .lnb{margin-bottom: 0;}
    footer{display: none;}
</style>
<script>
    //스케줄 슬라이드
    document.addEventListener('DOMContentLoaded', function() {
        const menuWrapper = document.querySelector('.schedule_wrapper');
        let isDragging = false;
        let startX;
        let scrollLeft;

        menuWrapper.addEventListener('mousedown', (e) => {
            isDragging = true;
            startX = e.pageX - menuWrapper.offsetLeft;
            scrollLeft = menuWrapper.scrollLeft;
            menuWrapper.style.cursor = 'grabbing';
        });

        menuWrapper.addEventListener('mouseleave', () => {
            isDragging = false;
            menuWrapper.style.cursor = 'grab';
        });

        menuWrapper.addEventListener('mouseup', () => {
            isDragging = false;
            menuWrapper.style.cursor = 'grab';
        });

        menuWrapper.addEventListener('mousemove', (e) => {
            if (!isDragging) return;
            e.preventDefault();
            const x = e.pageX - menuWrapper.offsetLeft;
            const walk = (x - startX) * 3; // 스크롤 속도 조절
            menuWrapper.scrollLeft = scrollLeft - walk;
        });

        // 마우스 휠 이벤트 추가
        menuWrapper.addEventListener('wheel', (e) => {
            e.preventDefault();
            menuWrapper.scrollLeft += e.deltaY;
        });
    });

    //진행상태 셀렉트박스 색상 표기
    // 선택된 옵션에 따라 클래스를 업데이트하는 함수
    function updateSelectClass(selectElement) {
        var selectedValue = selectElement.value;

        // 기존 클래스 제거
        selectElement.classList.remove('gray', 'green', 'blue', 'black');

        // 새로운 클래스 추가
        if (selectedValue) {
            selectElement.classList.add(selectedValue);
        }
    }

    // 모든 .statusSelect 요소를 선택
    var statusSelects = document.querySelectorAll('.statusSelect');

    // 각 요소에 대해 클래스 업데이트
    statusSelects.forEach(function(selectElement) {
        // 선택 이벤트 리스너 추가
        selectElement.addEventListener('change', function() {
            updateSelectClass(this);
        });

        // 초기 클래스 설정
        updateSelectClass(selectElement);
    });

    //달력 불러오기
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr(".datePicker", {
            dateFormat: "Y-m-d", // 원하는 날짜 형식으로 설정
            locale: "ko" // 한국어 로케일 설정
        });
    });


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

    //gant 일별
    function fillDays() {
        // Get all the period_wrap elements
        const periods = document.querySelectorAll('.period_wrap');

        periods.forEach(period => {
            // Get the month element and its text
            const monthText = period.querySelector('.month p').innerText;
            const [year, month] = monthText.split('-').map(Number);

            // Get the day ul element
            const dayUl = period.querySelector('.day ul');

            // Clear existing days
            dayUl.innerHTML = '';

            // Get the first and last day of the month
            const firstDay = new Date(year, month - 1, 1);
            const lastDay = new Date(year, month, 0);

            // Iterate over all days in the month
            for (let day = 1; day <= lastDay.getDate(); day++) {
                const currentDate = new Date(year, month - 1, day);
                const dayOfWeek = currentDate.getDay(); // 0 (Sunday) to 6 (Saturday)

                // Create a new list item
                const li = document.createElement('li');
                li.textContent = day;

                // Add the 'weekend' class if the day is Saturday or Sunday
                if (dayOfWeek === 0 || dayOfWeek === 6) {
                    li.classList.add('weekend');
                }

                // Append the list item to the ul
                dayUl.appendChild(li);
            }
        });
    }

    // Call the function to fill the days when the script loads
    fillDays();

    //가로스크롤 휠적용
    document.querySelector('.schedule_gant').addEventListener('wheel', function(event) {
        if (event.deltaY !== 0) {
            this.scrollLeft += event.deltaY;
            event.preventDefault();
        }
    });

</script>

<!--달력관련-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ko.js"></script>


<?/*<!-- 작업관리 > 계획공정표 -->
</div>
<div class="schedule">
    <div class="flex ai-c jc-sb">
        <div class="area_filter">
            <input type="search" name="stx" placeholder="검색어 입력" value=""><button type="submit" class="btn-search"><i class="fa-regular fa-magnifying-glass"></i></button>
        </div>
        <div class="btn-wrap">
            <button class="btn btn-small btn-blueline" data-toggle="modal" data-target="#sectionModal">작업구역관리</button>
            <button class="btn btn-small btn-darkblue"><img src="<?=base_url()?>img/common/excel_blue.svg"> 가져오기</button>
            <button class="btn btn-small btn-line"><img src="<?=base_url()?>img/common/excel_green.svg"> 내보내기</button>
        </div>
    </div>
<section class="any_gantt">
    <!--간트 차트-->
    <script src="https://cdn.anychart.com/releases/v8/js/anychart-bundle.min.js"></script>
    <link href="https://cdn.anychart.com/releases/v8/css/anychart-ui.min.css" type="text/css" rel="stylesheet">
    <link href="https://cdn.anychart.com/releases/v8/fonts/css/anychart-font.min.css" type="text/css" rel="stylesheet">
  <script src="<?=base_url()?>js/gantt-chart.js"></script>

    <div id="container"></div>

</section>
<style>
    .title_wrap{padding: 14px 40px 0; margin-bottom: 0;}
    .title_wrap h2{margin-bottom: 14px;}
    .page-wrapper .page-content > div{padding: 0;}
    .container-fluid .lnb{margin-bottom: 0;}
    footer{display: none;}
</style>

*/?>