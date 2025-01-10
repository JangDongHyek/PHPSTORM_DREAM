/**
 * 모듈 외 공통함수
 */

// swal 기본 스타일
function showAlert(message, callback, timer) {
    if (timer == undefined) timer = 0;

    swal.fire({
        html: message,
        confirmButtonText: '확인',
        timer: (timer > 0)? timer : 0,
        timerProgressBar: (timer > 0)? true : false,
        didDestroy: () => {
            if (callback) callback();
        }
    });
}

// confirm
function showConfirm(message) {
    return Swal.fire({
        html: message,
        confirmButtonText: '확인',
        denyButtonText: '취소',
        showDenyButton: true
    });
}

// toast 팝업
function showToast(message, callback = null, duration = 1200) {
    const Toast = Swal.mixin({
        toast: true,
        // position: 'top-center',
        showConfirmButton: false,
        timer: duration,
        timerProgressBar: true,
    });

    Toast.fire({
        //icon: 'success',
        title: message,
        didDestroy: () => {
            if (callback) callback();
        }
    });
}

// 캐싱 방지
// function importJSModule(modulePath) {
//     const timestamp = new Date().getTime();
//     const moduleUrl = `${baseUrl}/js/${modulePath}?t=${timestamp}`;
//     import(moduleUrl)
//         .then(module => {
//             console.log('Module loaded:', module);
//         })
//         .catch(err => {
//             console.error('Error loading module:', err);
//         });
// }
