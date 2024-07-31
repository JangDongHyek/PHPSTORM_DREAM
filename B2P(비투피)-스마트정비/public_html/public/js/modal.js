function comingsoon_modal() {

    Swal.fire({
        title: "알려드립니다!",
        html: `
<div class="text_form">
    <p>내용 준비중입니다.</p>
</div>
  `,
        showCloseButton: true,
        showCancelButton: false,
        focusConfirm: false,
        confirmButtonText: `확인`,
        //        cancelButtonText: ``,

        closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
    });
}

function confirm_modal() {

    Swal.fire({
        title: "다시 확인해주세요!",
        html: `
<div class="text_form">
    <p>정말 삭제하시겠어요?</p>
</div>
  `,
        showCloseButton: true,
        showCancelButton: false,
        focusConfirm: false,
        confirmButtonText: `확인`,
        //        cancelButtonText: ``,

        closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
    });
}


function shipping01_modal() {

    Swal.fire({
        title: "송장번호 확인",
        html: `
<div class="shipping_write">
    <div class="modal_form">
        <p>배송업체</p>
        <div class="input_select">
            
            <select class="border_gray" disabled>
                <option value="CJ 대한통운" selected>CJ 대한통운</option>
                <option value="CJ 대한통운">CJ 대한통운</option>
                <option value="CJ 대한통운">CJ 대한통운</option>
            </select>
        </div>
    </div>
    <div class="modal_form">
        <p>송장번호</p>
        <div class="input_select">
            <input type="text" class="border_gray" placeholder="입력하세요" value='11530204274888' disabled>
        </div>
    </div>
</div>
  `,
        showCloseButton: true,
        showCancelButton: false,
        focusConfirm: false,
        confirmButtonText: `확인`,
        //        cancelButtonText: ``,

        closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
    });
}



function shipping02_modal() {

    Swal.fire({
        title: "송장번호 입력",
        html: `
<div class="shipping_write">
    <div class="modal_form">
        <p>배송업체</p>
        <div class="input_select">
            
            <select class="border_gray">
                <option value="CJ 대한통운" selected>CJ 대한통운</option>
                <option value="CJ 대한통운">CJ 대한통운</option>
                <option value="CJ 대한통운">CJ 대한통운</option>
            </select>
        </div>
    </div>
    <div class="modal_form">
        <p>송장번호</p>
        <div class="input_select">
            <input type="text" class="border_gray" placeholder="입력하세요" value=''>
        </div>
    </div>
</div>
  `,
        showCloseButton: true,
        showCancelButton: false,
        focusConfirm: false,
        confirmButtonText: `등록하기`,
        //        cancelButtonText: ``,

        closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
    });
}

function select_shop_modal() {

    Swal.fire({
        html: `
<div class="modal_con">
    <h6 class="title">지점선택</h6>
    
    <input type="radio" id="store01" name="store">
    <label for="store01" class="select-box">
        <h6>영등포점</h6>
        <p>서울시 영동포구 신기로 43길</p>
    </label>
    <input type="radio" id="store02" name="store">
    <label for="store02" class="select-box">
        <h6>영등포 2점</h6>
        <p>서울시 영동포구 신기로 43길</p>
    </label>
    <input type="radio" id="store03" name="store">
    <label for="store03" class="select-box">
        <h6>영등포 3점</h6>
        <p>서울시 영동포구 신기로 43길</p>
    </label>
</div>
  `,
        showCloseButton: true,
        showCancelButton: false,
        focusConfirm: false,
        confirmButtonText: `확인`,
        //        cancelButtonText: ``,

        closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
    });
}

function rv_agr_modal() {

    Swal.fire({
        html: `
<div class="modal_con modal_agr">
    <div class="all_agr">
      <input type="checkbox" id="agr_all">
      <label for="agr_all">
           <i class="fa-solid fa-square-check"></i>
            <h6>아래 내용에 전체 동의합니다.</h6>
            <p class="color-gray">전체 동의가 되어야 예약확정이 이루어집니다.</p>
        </label>
    </div>
    <ul class='agr_wrap'>
        <li>
           <input type="checkbox" id="agr_01">
           <label for="agr_01">
                <i class="fa-solid fa-square-check"></i>
                <p>공임표는 상세페이지 하단에서 확인 후 예약 진행해주세요.</p>
            </label>
        </li>
        <li>
           <input type="checkbox" id="agr_02">
           <label for="agr_02">
                <i class="fa-solid fa-square-check"></i>
                <p>공임 비용은 현장에서 지불합니다.</p>
            </label>
        </li>
        <li>
           <input type="checkbox" id="agr_03">
           <label for="agr_03">
                <i class="fa-solid fa-square-check"></i>
                <p>정비소 예약을 취소하시면 주문하신 제품도 같이 취소됩니다.</p>
            </label>
        </li>
        <li>
           <input type="checkbox" id="agr_04">
           <label for="agr_04">
                <i class="fa-solid fa-square-check"></i>
                <p>예약 확정 후에는 제품 교환 및 정비소 지점 변경이 불가합니다.</p>
            </label>
        </li>
        <li>
           <input type="checkbox" id="agr_05">
           <label for="agr_05">
                <i class="fa-solid fa-square-check"></i>
                <p>제품 교환 및 지점 변경을 원할 경우 제품을 구매한 쇼핑몰에서 주문 취소후 재구매 부탁드립니다.</p>
            </label>
        </li>
    </ul>
</div>
  `,
        showCloseButton: true,
        showCancelButton: false,
        focusConfirm: false,
        confirmButtonText: `<a href='./rvConfirm'>예약 완료하기</a>`,
        //        cancelButtonText: ``,

        closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
    });
}


function file_upload_modal() {
    Swal.fire({
        title: "사업자등록증 추가",
        html: `
        <div class="file_write">
            <div class="modal_form">
                <p>
                    개인/법인/해외/중국사업자 : 사업자등록증<br>
                    비영리단체/국가/지자체 : 고유번호증
                </p>
                <div class="box__toggle-wrap">
                    <div class="box__toggle-layer" role="dialog">
                        <div class="box__layer-cont">
                            <strong class="text__guide-title">서류 제출 가이드</strong>
                            <ul class="list__dot-guide">
                                <li class="list-item">서류상 정보가 명확히 보이도록 촬영해주세요.</li>
                                <li class="list-item">jpg, jpeg, png 형식의 5MB 이하의 파일만 첨부할 수 있으며 여러장의 이미지는 하나로 합쳐서 제출합니다.</li>
                                <li class="list-item">3개월 이내에 발급된 문서로 제출해야 하며 유효기간이 지난 서류는 제출이 불가합니다.</li>
                                <!-- 중국 사업자 문구
                                <li class="list-item"><strong class="text__emphasis">중국 사업자등록증은 중문(원본)과 영문 번역본을 합쳐서</strong> 제출합니다.</li>
                                -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="file" id="cp_file" style="display:none"/>
    `,
        showCloseButton: true,
        showCancelButton: false,
        focusConfirm: false,
        confirmButtonText: '파일선택',
        closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기',
        didRender: function() {
            $('.swal2-confirm').on('click', function() {
                $('#cp_file').click();
            });
        }
    });
}
