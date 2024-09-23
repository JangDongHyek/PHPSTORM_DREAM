function getAjaxUrl(path){
    return `${g5_url}/API/${path}.php`;
}

function showLoadingBar() {
    
    let mask = `<div id='mask'></div>`;
    let lodingTop = window.pageYOffset;
    let loadingImg = `<div id='loadingImg' style='position: absolute; top: calc(50% + ${lodingTop}px); left: 50%; transform: translate(-50%, -50%); z-index:1051'>
                            <img src='${g5_url}/img/loading.gif'/ style='border-radius: 30%;'>
                      </div>`;

    $('body').append(mask).append(loadingImg);
    $('#mask').css({'width': '100%', 'height': '100vh', 'opacity': '0.3', position: 'absolute', top: $(window).scrollTop(), left: 0, background: '#898989'});
}

function hideLoadingBar(){
    $('#mask, #loadingImg').remove();
}

// swal 기본 스타일
function showAlert(message, destroyEvent){
    return swal.fire({
        html: message,
        confirmButtonText: '확인',
        didDestroy: () => {
            if (destroyEvent) destroyEvent;
        }
    });
}

// confirm
const showConfirm = (message) => {
    return Swal.fire({
        html: message,
        confirmButtonText: '확인',
        denyButtonText: '취소',
        showDenyButton: true
    });
}

function postJson(url, data, isLoading = true) {
    return new Promise((resolve, reject) => {
        
        if(isLoading) showLoadingBar();
        setTimeout(function(){
            $.ajax({
                type: 'post',
                url: url,
                dataType: 'json',
                contentType: "application/x-www-form-urlencoded;charset=utf-8",
                async: false,
                data: data,
                beforeSend: function(xhr) {},
                success: function(data) {                
                    resolve(data);
                },
                complete: function(){
                    if(isLoading) hideLoadingBar();
                },
                error:function(request,status,error){     
                    alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);     
                }
            });
        }, 100);
    });
}

function postFormJson(url, data) {    
    return new Promise((resolve, reject) => {
        
        showLoadingBar();
        setTimeout(function(){
            $.ajax({
                type: 'post',
                url: url,
                dataType: 'json',
                contentType: 'multipart/form-data',
                mimeType: 'multipart/form-data',
                async: false,
                data: data,
                beforeSend: function(xhr) {},
                success: function(data) {
                    resolve(data);
                },
                complete: function(){
                    hideLoadingBar();
                },
                error:function(request,status,error){     
                    alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);     
                },        
                cache: false,
                contentType: false,
                processData: false
            });
        }, 100);
    });
}

function postLocation(url, param, target = '') {
    let f = document.createElement('form');
    let objs, value;
    for (let key in param) {
        value = param[key];
        objs = document.createElement('input');
        objs.setAttribute('type', 'hidden');
        objs.setAttribute('name', key);
        objs.setAttribute('value', value);
        f.appendChild(objs)
    }    
    if (target) {
        f.setAttribute('target', target)
    }
    
    f.setAttribute('method', 'post');
    f.setAttribute('action', url);
    document.body.appendChild(f);
    f.submit();
}

function comma(str){
    str = String(str);
    return str.replace(/(\d)(?=(?:\d{3})+(?!\d))/g, '$1,');
}

function uncomma(str){
    str = String(str);
    return str.replace(/[^\d]+/g, '');
}

function nl2br(str){
    str = String(str);
    return str.replace(/\n/g, "<br />");    
}

function bizNoHyphen(str) {    
    let tmp = '';
        
    str = str.replace(/[^0-9]/g, '');    
        
   if(str.length < 4){
        return str;
    }
    else if(str.length < 6){
        tmp += str.substr(0,3);
        tmp += '-';
        tmp += str.substr(3,2);
        return tmp;
    }
    else if(str.length < 11){
        tmp += str.substr(0,3);
        tmp += '-';
        tmp += str.substr(3,2);
        tmp += '-';
        tmp += str.substr(5);
        return tmp;
    }
    else{        
        tmp += str.substr(0,3);
        tmp += '-';
        tmp += str.substr(3,2);
        tmp += '-';
        tmp += str.substr(5);
        return tmp;
    }
    return str;
}

function telNoHypen(str){
    str = String(str);
    return str.replace(/[^0-9]/g, "").replace(/(^02|^0505|^1[0-9]{3}|^0[0-9]{2})([0-9]+)?([0-9]{4})$/,"$1-$2-$3").replace("--", "-");
}

function unHypen(str){
    str = String(str);
    return str.replace(/-/g, "");
}

function validateEmail(email){
    let filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    return filter.test(email);
}

function closeDaumPostcode() {        
    kakaoLayer.style.display = 'none';
}

function openDaumPostcode($zip_code, $addr, $addr_detail, $lat, $lng){
    new daum.Postcode({
        oncomplete: function(data) {
            let addr = '';
            
            console.log(data);
            if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                addr = data.roadAddress;
            } else { // 사용자가 지번 주소를 선택했을 경우(J)
                addr = data.jibunAddress;
            }
            
            $zip_code.val(data.zonecode);
            $addr.val(`(${data.zonecode})${addr}`);
            $addr_detail.val(data.buildingName);                   
            
            var geocoder = new kakao.maps.services.Geocoder();
            var callback = function(result, status) {
                if (status === kakao.maps.services.Status.OK) {
                    $lat.val(result[0]['address']['y']);
                    $lng.val(result[0]['address']['x']);
                }
            };
            geocoder.addressSearch(addr, callback);
            
            closeDaumPostcode();
        },
        width : '100%',
        height : '100%',
        maxSuggestItems : 10
    }).embed(kakaoLayer);
    
    kakaoLayer.style.display = 'block';
}

function getRandomChar() {
  const characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
  const randomIndex = Math.floor(Math.random() * characters.length);
    
  return characters.charAt(randomIndex);
}

function getRandomString(length) {
  let randomString = '';
  for (let i = 0; i < length; i++) {
    randomString += getRandomChar();
  }
  return randomString;
}
