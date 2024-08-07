/* webview post 메세지 보내기(boolean) */
function webViewPostMsg(data){
    let postData = JSON.stringify(data);
    console.log('webViewPostMsg : ' + postData);
    
    if(window.ReactNativeWebView){
        window.ReactNativeWebView.postMessage(postData);
    }else{
        console.log('Not ReactNative');
    }
}

/* 새로고침 할 건지 여부(boolean) */
function setIsRefresh(isRefresh){
    webViewPostMsg({ type: 'setRefresh', isRefresh: isRefresh });
}

/* 뒤로가기 막기 */
function clearHistory(){
    webViewPostMsg({ type: 'clearHistory' });
}

async function setDeviceToken(deviceToken){
    
    const tokenRes = await postJson(getAjaxUrl('setting'), {
        mode : 'setDeviceToken',
        deviceToken : deviceToken
    }, false);
    
    if(!tokenRes.result){
        swal(tokenRes.msg);
    }
}

$(function(){
    
    var varUA = navigator.userAgent.toLowerCase(); //userAgent 값 얻기    
    // 앱 => 웹 브릿지
    (() => {
        window.__WEBVIEW_BRIDGE__={
            init: function(){
                try{
                    let windowType = (varUA.indexOf('android') > -1)? document : window;
                                        
                    windowType.addEventListener(  
                        "message", 
                        e=>
                        {             
                            if(!window.ReactNativeWebView) return false;
                            
                            let data = JSON.parse(e.data);
                            
                            switch(data.type){
                                    
                                /* 디바이스 토큰 업데이트 */
                                case 'getDeviceToken':
                                    setDeviceToken(data.deviceToken);                                    
                                    return false;
                                break;
                            }
                        }
                    );
                }catch(err){
                    console.log(err);
                }
            }
        };

        window.__WEBVIEW_BRIDGE__.init();
    })();
    
});