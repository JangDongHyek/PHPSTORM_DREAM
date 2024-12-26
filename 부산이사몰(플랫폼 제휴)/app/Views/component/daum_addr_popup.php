<?php
/**
 * 다음우편번호 팝업
 */
?>
<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script>
    const openDaumAddress = (formNames = {}) => {
        <?php /*
        formNames.addr: 기본주소
        formNames.addrDetail: 상세주소
        formNames.zcode: 우편번호
        formNames.sido: 시도
        formNames.gugun: 구군
        */?>
        const setInputValue = (key, value) => {
            const inputName = (formNames[key])? formNames[key] : key;
            const inputElement = document.querySelector(`input[name=${inputName}]`);
            if (inputElement) inputElement.value = value;
        };

        new daum.Postcode({
            oncomplete: function (data) {
                const roadAddr = data.roadAddress || data.jibunAddress; // 도로명 || 지번

                setInputValue('addr', roadAddr);
                setInputValue('zcode', data.zonecode);
                setInputValue('sido', (data.sido).substring(0, 2)); // 세종특별자치시, 전북특별자치도, 강원특별자치도, 제주특별자치도
                setInputValue('gugun', data.sigungu);
            },
            onclose: function (state) {
                const inputName = formNames.addrDetail? formNames.addrDetail : 'addrDetail';
                document.querySelector(`input[name=${inputName}]`)?.focus();
            }
        }).open();
    }
</script>
