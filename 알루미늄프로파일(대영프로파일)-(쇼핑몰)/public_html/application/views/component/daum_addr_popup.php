<?php
/**
 * 다음지도 팝업
 */
?>
<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script>
    const openDaumAddress = (formNames=[]) => {
        <?/*
        formNames[0] = 기본주소
        formNames[1] = 우편번호
        formNames[2] = 상세주소
        */?>
        // console.log(formNames, formNames.length);

        new daum.Postcode({
            oncomplete: function(data) {
                let roadAddr = data.roadAddress; // 도로명 주소
                let zipcode = data.zonecode;     // 우편번호

                if(roadAddr == '') roadAddr = data.jibunAddress;

                if (formNames.length == 0) {
                    if (document.querySelector('input[name=addr]')) {
                        document.querySelector('input[name=addr]').value = roadAddr;
                    }
                    if (document.querySelector('input[name=zipCode]')) {
                        document.querySelector('input[name=zipCode]').value = zipcode;
                    }
                    // if (document.querySelector('input[name=lat]')) {
                    //     const geocoder = new kakao.maps.services.Geocoder();
                    //     geocoder.addressSearch(roadAddr, function (result, status) {
                    //         if (status === kakao.maps.services.Status.OK) {
                    //             document.querySelector('input[name=lat]').value = result[0].y; // 위도
                    //             document.querySelector('input[name=lng]').value = result[0].x; // 위도
                    //         }
                    //     });
                    // }
                } else {
                    if (document.querySelector(`input[name=${formNames[0]}]`)) {
                        document.querySelector(`input[name=${formNames[0]}]`).value = roadAddr;
                    }
                    if (document.querySelector(`input[name=${formNames[1]}]`)) {
                        document.querySelector(`input[name=${formNames[1]}]`).value = zipcode;
                    }
                }

            },
            onclose: function(state) {
                if (formNames.length == 0) {
                    if (document.querySelector('input[name=addrDetail]')) {
                        document.querySelector('input[name=addrDetail]').focus();
                    }
                } else {
                    if (document.querySelector(`input[name=${formNames[2]}]`)) {
                        document.querySelector(`input[name=${formNames[2]}]`).focus();
                    }
                }
            }
        }).open();
    }
</script>
