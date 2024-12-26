/**
 * 회원정보 검증 모듈
 */
const userValidator = (function () {
    // 이름 유효성
    function validateUserName(name) {
        if (!/^[가-힣]+$/.test(name)) return false;

        // 단독으로 사용된 한글 자음 또는 모음 체크
        // 유니코드 범위: ㄱ-ㅎ(3131-314E), ㅏ-ㅣ(314F-3163)
        if (/[\u3131-\u314E\u314F-\u3163]/.test(name)) {
            return false;
        }

        return true;
    }

    // 아이디 유효성
    function validateUserId(id) {
        // 1. 길이 검사 (4자 이상)
        if (id.length < 4) {
            return {
                isValid: false,
                message: '아이디를 4자 이상 입력해 주세요.'
            };
        }

        // 2. 영소문자와 숫자만 포함되어 있는지 검사
        const regex = /^[a-z0-9]+$/;
        if (!regex.test(id)) {
            return {
                isValid: false,
                message: '아이디는 영소문자, 숫자만 가능해요.'
            };
        }

        // 3. 중복확인
        const response = checkDuplicateInput(id, 'checkId');
        if (!response.result) {
            return {
                isValid: false,
                message: response.message ? response.message : '아이디 중복조회에 실패했습니다.<br>다시 시도해 주세요.'
            }
        }

        return {
            isValid: true,
            message: '',
        };
    }

    // 닉네임 유효성
    function validateNickName(nick) {
        if (nick.length < 2) {
            return {
                isValid: false,
                message: '닉네임을 2자 이상 입력해 주세요.'
            };
        }

        // 중복확인
        const response = checkDuplicateInput(nick, 'checkNick');
        if (!response.result) {
            return {
                isValid: false,
                message: response.message ? response.message : '닉네임 중복조회에 실패했습니다.<br>다시 시도해 주세요.'
            }
        }

        return {
            isValid: true,
            message: ''
        }
    }

    // 중복확인: 닉네임, 아이디
    function checkDuplicateInput(input = '', endPoint = '', addInput = '') {
        if (!input) return false;

        let resultData = {result: false, message: '서버와의 통신에 실패했습니다.<br>잠시 후 다시 시도해 주세요.'};
        // const domain = (baseUrl.endsWith('/')) ? baseUrl.slice(0, -1) : baseUrl;

        // FIXME: smart wizard 에서 비동기 실행이 안되는 문제로 jquery ajax 처리
        $.ajax({
            method: 'POST',
            url: baseUrl+`/api/${endPoint}`,
            data: JSON.stringify({input, addInput}),
            async: false,
            success: function (data) {
                resultData = data;
            },
            error: function (error) {
            }
        });

        return resultData;
    }

    return {
        validateUserName: validateUserName,
        validateNickName: validateNickName,
        validateUserId: validateUserId,
    };

})();