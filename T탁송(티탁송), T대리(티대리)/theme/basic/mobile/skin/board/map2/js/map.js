var _sendUrl	= "",
	_target		= "",
	_params		= "",
	_urlLength  = 0;

$(document).ready(function(){
	// get Url, target of iframe
	_sendUrl    = $("input[name='sendURL']").val().split("|");
	_target     = $("input[name='target']").val().split("|");
	_urlLength  = _sendUrl.length;

	var pNames = $("input[name='fVn']").val().split("|"),
		 pValues = $("input[name='fVd']").val().split("|"),
		 max = pNames.length,
		 i = 0;
	for (i = 0; i < max ; i++ )
	{
		_params += "&" + pNames[i] + "=" + pValues[i];
	}

	// apply selected data
	var jiyok = ($("input[name='jbname']").val() || "") + " " + ($("input[name='jsname']").val() || "") +  " " + ($("input[name='guname']").val() || ""),
        data_id = "",
        infos   = "";

	if (jiyok.length >= 2 && jiyok != "  ")
	{
        jiyok = jiyok.trim();
		var $area   = $("area[alt='" +jiyok+ "']");

        $area.each(function(){
            if ($(this).attr("data-id").indexOf('near') < 0) {
                data_id = $(this).attr("data-id");
            }
        });
	}

    if (data_id) {
        infos = data_id.split("_");

        if ($area.attr("is-last") == 'Y') {
            data_id = data_id.substring(0,data_id.lastIndexOf('_'));
        }
        applyMap(data_id,(infos.length > 1? infos[0]: "map_country"), $area.parent().attr("data-depth"));
        sendData(jiyok, 'N');
    } else {
        bindMap("map_country");
    }

    // button event
	$(".btn_country").click(function(){
		applyMap("country", $(this).prop("data-id"), "0");
		getAjaxList(1);
	});
	$(".btn_pre").click(function(){
		applyMap($(this).prop("data-pid").replace("map_", ""), $(this).prop("data-id"), "3");
	});
});

function bindMap(map_id){
    if (!map_id) return;
	$('#' + map_id + ' > area').each(function(){
		var data_id = $(this).attr("data-id"),
            curr_id	= $(this).parent().prop("id"),
            alt		= $(this).attr("alt"),
            infos	= data_id.split("_"),
            depth   = $(this).parent().attr("data-depth"),
            ver     = '',
            folder  = "";

		$(this).off().hover(function(){
            if ( infos[0] == 'kg' || infos[1] == 'kg' || infos[2] == 'kg' ) {
                ver = '?v=200325';
            }
            if (depth == 2 && data_id.indexOf('near') > 0) {
                // 주변지역 처리
                imgname = data_id.replace('_near', '');
                if (infos.length > 3) {
                    img = "../../theme/basic/mobile/skin/board/map/img/" + infos[2] + "/" + imgname + "_on.png";
                } else {
                    img = "../../theme/basic/mobile/skin/board/map/img/" + infos[1] + "/" + imgname + "_on.png";
                }
            } else if (infos && infos.length > 1) {
                img = "../../theme/basic/mobile/skin/board/map/img/" + infos[0] + "/" + data_id + "_on.png";
            } else {
                img = "../../theme/basic/mobile/skin/board/map/img/" + data_id + "_on.png";
            }
			$over_img = $("#map_over");
            $over_img.prop("src", img + ver);
			$over_img.prop("alt", alt);
			$over_img.show();
		}, function(){
			$("#map_over").hide();

		}).click(function(){
            var is_last = $(this).attr("is-last");

			// iframe src
			// 서울, 인천, 경기만 나오게 수정
			if (data_id.substring(0, 2) == "su" && data_id.length > 2) {
				seltdGu($(this), data_id.substring(0, 2));
			} else if (data_id.substring(0, 2) == "ic" && data_id.length > 2) {
				seltdGu($(this), data_id.substring(0, 2));
			} else if (data_id.substring(0, 2) == "kg" && data_id.length > 2) {
				seltdGu($(this), data_id.substring(0, 2));
			} else {
				var href = $(this).attr("href");
				location.href = href;
			}
			return false;

			if (is_last == "Y")
			{
				return;
			}
			$over_img = $("#map_over");
			$over_img.hide();

			applyMap(data_id, curr_id, depth);
		});
	});
}

function unbindMap(map_id) {
    if (!map_id) return;
	$('#' + map_id + ' > area').each(function(){
		$(this).unbind();
	});
}

function applyMap(data_id, curr_id, depth) {
	// 맵 설정
    var infos   = data_id.split("_"),
        ver     = '',
        img     = "";

    if (data_id.indexOf('near') > 0) {
        // 주변지역 클릭으로 이동한 경우
        if (infos.length > 3) {
            data_id = infos[0] + "_" + infos[1];
        } else {
            data_id = infos[0];
        }
    }
    folder  = (depth > 0) ? infos[0] + "/" : "";
    img     = "../../theme/basic/mobile/skin/board/map/img/" + folder + data_id;

	if ( folder == 'kg/' ) {
        ver = '?v=200325';
    }

	$("#map").hide();
	$("#map_title").prop("src", img + "_title.gif");
	$("#map_over").prop("usemap", "#map_" + data_id);
    $("#map").prop("src", img + "_bg.gif" + ver).prop("usemap", "#map_" + data_id).fadeIn(500);

	// 맵 이벤트 설정
	unbindMap(curr_id);
	bindMap("map_" + data_id);

	// 버튼 설정
	switch (depth)
	{
		case "1":
			$(".btn_country").prop("data-id", "map_" + data_id);
			$(".btnArea").show();
			break;
		case "2":
			$(".btn_pre").prop("data-pid", curr_id);
			$(".btn_pre").prop("data-id", "map_" + data_id);
            $(".btnArea").show();
			$(".btn_pre").show();
			break;
		case "3":
			$(".btn_country").prop("data-id", "map_" + data_id);
            $(".btnArea").show();
			$(".btn_pre").hide();
			break;
		default:
			$(".btnArea").hide();
			$(".btn_pre").hide();
			break;
	}
}

function sendData(data, is_last) {
    var i = 0,
        jiyok = data.split(" "),
        jiyokParam = "?";

	if (data == "서울") {
		$("#map").attr("src", "../../theme/basic/mobile/skin/board/map/img/su_bg.gif");
	}

	/*
    jiyokParam += "jbname=" + jiyok[0];
    jiyokParam += "&jsname=" + (jiyok[1] || "");
    jiyokParam += "&guname=" + (jiyok[2] || "");

    if ((vfrom == 'main_jiyok' || is_mobile) && is_last == 'Y') {
        if (is_mobile) {
            $('#addr_1').val(jiyok[0]);
            $('#addr_2').val(jiyok[1] || "");
            $('#addr_3').val(jiyok[2] || "");
            $('#f_map').submit();
        } else {
            $('#jbname').val(jiyok[0]);
            $('#jsname').val(jiyok[1] || "");
            $('#guname').val(jiyok[2] || "");
            $('#f_map').submit();
        }
    } else {
        for (i = 0; i < _urlLength; i++)
        {
            $("iframe[name='"+_target[i]+"']").attr("src", encodeURI(_sendUrl[i] + jiyokParam + _params));
        }
    }
	*/
}

// IE9 이하는 trim을 지원않하므로 추가처리
if(typeof String.prototype.trim !== 'function') {
  String.prototype.trim = function() {
    return this.replace(/^\s+|\s+$/g, '');
  }
}