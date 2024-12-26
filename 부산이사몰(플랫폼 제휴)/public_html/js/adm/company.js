/**
 * admin. 업체관리
 */

(function () {
    'use strict';

    const checkAll = document.querySelector('#checkAll');
    const delCompany = document.querySelector('#delCompany');

    const dataIdx = document.querySelectorAll('[data-idx]');
    document.addEventListener('DOMContentLoaded', () => {

        // 검색
        if (typeof window.initSearch === 'function') window.initSearch();

        eventListeners();
    });

    function eventListeners() {
        //체크박스 선택
        checkAll.addEventListener('click', utils.checkboxes);
        //업체 삭제
        delCompany.addEventListener('click', admUtils.deleteCompany);
        dataIdx.forEach(idx => {
            idx.addEventListener('click', addition)
        });
    }

    async function addition(e) {
        const dataIdx = e.target.getAttribute('data-idx');
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
})();