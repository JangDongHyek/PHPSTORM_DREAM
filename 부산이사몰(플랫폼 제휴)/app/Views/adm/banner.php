<!--광고배너 관리-->
<section class="banner">
    <div class="panel flex ai-c jc-sb">
        <div class="flex">
            <p class="total">총 <strong class="txt_color">163</strong>개 </p>
            <div class="panel_box">
                <div class="select">
                    <input type="radio" id="all" name="banner" value="0" checked="">
                    <label for="all">전체</label>
                    <input type="radio" id="main-banner" name="banner" value="1">
                    <label for="main-banner">메인 배너</label>
                    <input type="radio" id="sub-banner" name="banner" value="2">
                    <label for="sub-banner">서브 배너</label>
                </div>
            </div>
        </div>
        <div class="btn_wrap">
            <button type="button" class="btn btn_gray" >배너 삭제</button>
            <button type="button" class="btn btn_color" onclick="location.href='./bannerForm'">배너 등록</button>
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
            <col width="10%">
        </colgroup>
        <thead>
        <tr>
            <th><input type="checkbox" /></th>
            <th>구분</th>
            <th>PC 이미지</th>
            <th>모바일 이미지</th>
            <th>기간</th>
            <th>메모</th>
            <th>등록일</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><input type="checkbox" /></td>
            <td>매인 베너</td>
            <td><img src="<?=base_url()?>img/main_slider01.jpg" alt=""></td>
            <td><img src="<?=base_url()?>img/main_slider_m01.jpg" alt=""></td>
            <td>2024-09-30 ~ 2024-10-30</td>
            <td>-</td>
            <td>2024-09-30</td>
            <td><button class="btn btn_line">관리</button></td>
        </tr>
        <tr>
            <td><input type="checkbox" /></td>
            <td>매인 베너</td>
            <td><img src="<?=base_url()?>img/main_slider02.jpg" alt=""></td>
            <td><img src="<?=base_url()?>img/main_slider_m02.jpg" alt=""></td>
            <td>2024-09-30 ~ 2024-10-30</td>
            <td>-</td>
            <td>2024-09-30</td>
            <td><button class="btn btn_line">관리</button></td>
        </tr>
        <tr>
            <td><input type="checkbox" /></td>
            <td>서브 베너</td>
            <td><img src="<?=base_url()?>img/sub_banner01.jpg" alt=""></td>
            <td><img src="<?=base_url()?>img/sub_banner_m01.jpg" alt=""></td>
            <td>2024-09-30 ~ 2024-10-30</td>
            <td>-</td>
            <td>2024-09-30</td>
            <td><button class="btn btn_line">관리</button></td>
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