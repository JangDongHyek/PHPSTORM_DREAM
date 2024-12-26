/**
 * admin. 회원등록
 */
(function () {
    'use strict';

    const form = document.forms['signup'];
    const companyButton = document.querySelector('#btnRegCompany');
    const idxNum = document.querySelector('#idxNumber');
    const checkAll = document.querySelector('#checkAll');
    const updateCompany = document.querySelectorAll('#updateCompany');
    const delCompany = document.querySelector('#delCompany');
    const add = document.querySelectorAll('#addition');

    document.addEventListener('DOMContentLoaded', async () => {
        eventListeners();
    });

    function eventListeners() {
        // 회원 가입 / 수정
        form.addEventListener('submit', handleSignUp);
        // 업체 등록 페이지 이동
        companyButton.addEventListener('click', registCompany);
        //모두 체크
        checkAll.addEventListener('click', Checkboxes);
        //수정 페이지 이동
        updateCompany.forEach(button=>{
            button.addEventListener('click', updCompany)
        })
        // 회원 삭제
        delCompany.addEventListener('click', admUtils.deleteCompany)
        //승인상태 변경
        add.forEach(button =>{
            button.addEventListener('click', addition);
        })

    }

    //승인상태 변경
    async function addition(e) {
        const dataMbid = e.target.getAttribute('data-mbid'); // 회원 idx
        const dataIdx = e.target.getAttribute('data-idx'); // company idx
        const formData = new FormData();

        const html = `
            
            <dl class="">
                <dt class="txt_bold text-left">광고 유형 선택</dt> 
                <dd>
                    <select class="w100" name="cpType" id="cpType">
                        <option value="1">일반</option>
                        <option value="2">프리미엄</option>
                        <option value="3">메인상단</option>
                        <option value="4">메인하단</option>
                    </select>
                </dd>
            </dl>
            <dl class="">
                <dt class="txt_bold text-left">지역 선택</dt> 
                <dd>
                <select name="areaSi" id="areaSi" class="w100"> 
                    <option value="">선택하세요</option>
                    <option value="부산">부산</option>
                    <option value="울산">울산</option>
                    <option value="경남">경남</option> 
                </select>
                <select name="areaGu" id="areaGu" class="w100"> 
                </select>
                </dd>
            </dl>
            
            <div class="box_gray">
            <dl class="ad_option">
                <dt class="txt_bold">서비스 선택</dt> 
                <dd class="select">
                    <input type="checkbox" id="serviceTypeP" name="serviceType" value="P"><label for="serviceTypeP">포장이사</label>
                    <input type="checkbox" id="serviceTypeH" name="serviceType" value="H"><label for="serviceTypeH">반포장이사</label>
                    <input type="checkbox" id="serviceTypeC" name="serviceType" value="C"><label for="serviceTypeC">일반이사</label>
                    <input type="checkbox" id="serviceTypeO" name="serviceType" value="O"><label for="serviceTypeO">원룸이사</label>
                    <input type="checkbox" id="serviceTypeL" name="serviceType" value="L"><label for="serviceTypeL">사다리차</label>
                </dd>
            </dl>
            </div>
        `;
        Swal.fire({
            title: '복사',
            html: html,
            showCancelButton: true,
            confirmButtonText: '완료',
            cancelButtonText: '닫기',
            didOpen: () => {
                const areaSi = document.querySelector('#areaSi');
                areaSi.addEventListener('change', async (e) => {
                    await utils.changeArea(e.target);
                })
            },
            preConfirm: async () => {
                const Si = document.querySelector('select[name="areaSi"]').value;
                const Gu = document.querySelector('select[name="areaGu"]').value;
                const cpType = document.querySelector('select[name="cpType"]').value;
                const serviceTypes = document.querySelectorAll('input[name="serviceType"]:checked');
                const selectedServices = Array.from(serviceTypes).map(checkbox => checkbox.value);
                if (!Si) {
                    Swal.showValidationMessage('지역을 상태를 선택하세요.');
                    return false;
                }
                formData.append('mbIdx', dataMbid);
                formData.append('idx', dataIdx);
                formData.append('areaSi', Si);
                formData.append('areaGu', Gu);
                formData.append('cpType', cpType);
                formData.append('service_type',selectedServices);

                const response = await API.fetchData('/api/companyAddition', formData);
                if (response['result'] === true) {
                    utils.showToast('완료 했습니다', () => location.reload());
                }
                return false;
            },
        }).then(async (result) => {
            if (result.isConfirmed) {
                //
            }
        });
        return false;
    }

    //수정 페이지 이동
    function updCompany(e) {
        e.preventDefault();
        const idx = e.target.dataset.idx;
        const idxnu = form.idxNumber.value;

        location.href = baseUrl + 'adm/companyForm/' + idxnu + '?idx=' + idx;
        return false;
    }

    // 모두 체크
    function Checkboxes() {
        const checkboxes = document.querySelectorAll('input[name="check"]');
        checkboxes.forEach(checkbox => {
            checkbox.checked = checkAll.checked;
        });
    }

    // 업체 등록 페이지 이동
    function registCompany(e) {
        e.preventDefault()
        const idx = idxNum.value;

        if (!idx) {
            utils.showToast('회원 가입후 등록 하실 수 있습니다.')
            return false
        }

        location.href = baseUrl + 'adm/companyForm/' + idx;

    }

    //회원 가입 / 수정
    async function handleSignUp(e) {
        e.preventDefault();

        const idx = idxNum.value;
        const formCheck = await checkFormData();
        if (!formCheck) return false;

        const formData = new FormData(form);
        utils.showLoading(true);

        if (!idx) {
            setTimeout(async () => {
                const response = await API.fetchData('/api/signUp', formData);
                if (response.result) {
                    utils.showAlert('회원등록이 완료되었습니다.', () => {
                        location.href = baseUrl + '/adm/member';
                    });
                } else {
                    let message = '회원등록에 실패했습니다.';
                    message += (response.message) ? `<br>(${response.message})` : `<br>잠시 후 다시 시도해 주세요.`;
                    utils.showAlert(message);
                }
            }, 800);

        } else {
            setTimeout(async () => {
                const response = await API.fetchData('/api/signUpload', formData);
                if (response.result) {
                    utils.showAlert('회원수정이 완료되었습니다.', () => {
                        location.href = baseUrl + '/adm/member';
                    });
                } else {
                    let message = '회원수정에 실패했습니다.';
                    message += (response.message) ? `<br>(${response.message})` : `<br>잠시 후 다시 시도해 주세요.`;
                    utils.showAlert(message);
                }
            }, 800);
        }
    }

    // 폼 검증
    async function checkFormData() {
        const idx = idxNum.value;

        if (form.mb_level.value === '5') {
            const company = form.company_name.value;
            if (!company) {
                utils.showToast('회사명을 입력해 주세요.');
                return false;
            }
        }

        if (!idx) {
            console.log(idx);
            const userId = utils.removeWhitespace(form.mb_id.value);
            const checkId = userValidator.validateUserId(userId);

            if (!checkId.isValid) {
                utils.showToast(checkId.message, () => form.mb_id.focus());
                return false;
            }
        }

        if (form.mb_password) {
            const pass = form.mb_password.value;

            if (pass && pass.length < 4) {
                utils.showToast('비밀번호를 4자 이상 입력해 주세요.');
                return false;
            }

        }

        const username = utils.removeWhitespace(form.mb_name.value);
        if (form.mb_level.value === '2') {
            if (!username) {
                utils.showToast('이름을 입력해 주세요.');
                return false;
            } else {
                if (!userValidator.validateUserName(username)) {
                    utils.showToast('이름을 올바르게 입력해 주세요. (한글)');
                    return false;
                }
            }
        } else if (form.mb_level.value === '5') {
            if (!username) {
                utils.showToast('대표자명을 입력해 주세요.');
                return false;
            } else {
                if (!userValidator.validateUserName(username)) {
                    utils.showToast('대표자실명을 올바르게 입력해 주세요. (한글)');
                    return false;
                }
            }
        }

        const userhp = utils.addHyphenTel(form.mb_hp.value);
        if (!userhp) {
            if (form.mb_level.value === '2') {
                utils.showToast('연락처를 입력해 주세요.');
                return false;
            } else if (form.mb_level.value === '5') {
                utils.showToast('담당자 연락처를 입력해 주세요.');
                return false;
            }

        }
        return true;
    }
})();
