function showLoadingBar() {    
        
    let mask = `<div id='mask'></div>`;    
    let lodingTop = window.pageYOffset;
    let loadingImg = `<div id='loadingImg' style='position: absolute; top: calc(50% + ${lodingTop}px); left: 50%; transform: translate(-50%, -50%); z-index:1051'>
                            <img src='${rootUrl}/img/loading.gif'/ style='border-radius: 30%;'>
                      </div>`;

    $('body').append(mask).append(loadingImg);
    $('#mask').css({'width': '100%', 'height': '100vh', 'opacity': '0.3', position: 'absolute', top: $(window).scrollTop(), left: 0, background: '#898989'});
}

function hideLoadingBar() {    
    $('#mask, #loadingImg').remove();    
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