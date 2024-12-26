/**
 * 이사업체 목록
 */

(function () {
    'use strict';
    const checkboxes = document.querySelectorAll('input[name="area[]"]');
    const type = document.querySelector('#typereg');
    const service = document.querySelector('#service');
    const listItem = document.querySelectorAll('#detailPage');

    const dt = document.getElementById("selected");
    const dropdown = document.querySelector(".dropdown");
    const dropdownList = document.querySelector(".dropdown_list");
    const dropdownLinks = document.querySelectorAll(".dropdown_list a");

    document.addEventListener('DOMContentLoaded', () => {
        eventListeners();
    });

    function eventListeners() {
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', ({target}) => {
                if (target.checked) {
                    window.location.href = `${window.location.pathname}?type=${type.value}&service=${service.value}&reg=${target.value}`;
                }
            });
        });

        listItem.forEach(item => {
            item.addEventListener('click', function () {
                const idx = this.getAttribute('data-idx'); // data-idx 속성 값 가져오기
                if (idx) {
                    window.location.href = baseUrl + `companyView?idx=${idx}`;
                }
            });
        });

        // 드롭다운을 클릭할 때 목록을 토글
        dt.addEventListener("click", function () {
            dropdownList.style.display = dropdownList.style.display === "block" ? "none" : "block";
        });

        // 목록의 항목을 클릭했을 때 dt 업데이트 및 목록 닫기
        dropdownLinks.forEach(link => {
            link.addEventListener("click", function (event) {
                event.preventDefault();  // 기본 동작 방지
                dt.textContent = this.textContent;  // 선택한 값으로 dt 업데이트
                dropdownList.style.display = "none";  // 드롭다운 닫기
                window.location.href = this.href;  // 페이지 이동
            });
        });

        // 페이지 외부를 클릭하면 드롭다운 닫기
        document.addEventListener("click", function (event) {
            if (!dropdown.contains(event.target)) {
                dropdownList.style.display = "none";
            }
        });
    }
})();