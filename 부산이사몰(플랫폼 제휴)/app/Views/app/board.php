<div id="board">

    <div class="panel flex ai-c jc-sb">
        <div class="flex">
            <select>
                <option>제목</option>
                <option>내용</option>
                <option>작성자</option>
            </select>
            <div class="search">
                <input type="search" placeholder="검색어를 입력하세요">
                <button class="btn_search"><i class="fa-regular fa-magnifying-glass"></i></button>
            </div>
        </div>
        <div class="btn_wrap">
            <a class="btn btn_small btn_color" href="./boardForm">
                등록
            </a>
        </div>
    </div>
    <div class="board_list">
        <p>총 <strong class="txt_color">4</strong>개 </p>
        <ul>
            <li class="notice" onclick="location.href='./boardView'">
                <p class="p_num"><span class="icon icon_line">공지</span></p>
                <p class="p_title">'국군의 날' 임시 공휴일 안내 <span class="new">N</span></p>
                <p class="p_user">관리자</p>
                <p class="p_date">2023.05.06</p>
            </li>
            <li onclick="location.href='./boardView'">
                <p class="p_num">4</p>
                <p class="p_title"><i class="fa-solid fa-lock-keyhole"></i> 광고서비스 문의 안내 <span class="comment">1</span> <span class="new">N</span>  <span class="icon icon_color">답변완료</span></p>
                <p class="p_user">관리자</p>
                <p class="p_date">2023.05.06</p>
            </li>
            <li>
                <p class="p_num">3</p>
                <p class="p_title">부처님 오신 날 대체 공휴일 이사 안내</p>
                <p class="p_user">관리자</p>
                <p class="p_date">2023.05.06</p>
            </li>
            <li>
                <p class="p_num">2</p>
                <p class="p_title">고객센터의 연결이 어려울때 게시판 이용바랍니다.</p>
                <p class="p_user">관리자</p>
                <p class="p_date">2023.05.06</p>
            </li>
            <li>
                <p class="p_num">1</p>
                <p class="p_title">부산이사몰 홈페이지 리뉴얼 오픈하였습니다.</p>
                <p class="p_user">관리자</p>
                <p class="p_date">2023.05.06</p>
            </li>
        </ul>
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



</div>
