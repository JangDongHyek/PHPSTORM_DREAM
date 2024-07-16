$(function(){

	// list.skin.php

	$('#list-skin [name="btn_select"]').on('click', function(){
		if($(this).attr('data-checked') == 'true'){
			$('#list-skin [name="btn_select"]').attr('data-checked', 'false');
			$('#list-skin [name="chk_wr_id[]"]').prop('checked', false);
		} else{
			$('#list-skin [name="btn_select"]').attr('data-checked', 'true');
			$('#list-skin [name="chk_wr_id[]"]').prop('checked', true);
		}
    });

	$('#list-skin button.submit').on('click', function(){
		if($('#list-skin [name="chk_wr_id[]"]:checked').length == 0){
			window.alert('게시글을 선택해주세요.');
			return false;
		}
		if($(this).val() == '선택삭제' && window.confirm('정말로 삭제하시겠습니까?') == true){
			$('#list-skin [method="post"]').removeAttr('target');
			$('#list-skin [method="post"]').attr('action', 'board_list_update.php');
			$('#list-skin [name="flist"]').submit();
		}
		if($(this).val() == '선택복사' || $(this).val() == '선택이동'){
			window.open('', 'move', 'top=0, left=0, width=600, height=600, scrollbars=yes');
			if($(this).val() == '선택복사'){
				$('#list-skin [name="sw"]').val('copy');
			} else{
				$('#list-skin [name="sw"]').val('move');
			}
			$('#list-skin [name="flist"]').attr('target', 'move');
			$('#list-skin [name="flist"]').attr('action', 'move.php');
			$('#list-skin [name="flist"]').submit();
		}
		return false;
    });

	// view.skin.php

	$('#view-skin a.copy, #view-skin a.move').on('click', function(e){
		e.preventDefault();
		window.open($(this).attr('href'), 'win_board', 'top=0, left=0, width=600, height=600, scrollbars=yes');
	});

	$('#view-skin a.delete').on('click', function(e){
		e.preventDefault();
		if(window.confirm('정말로 삭제하시겠습니까?') == true){
			location.href = $(this).attr('href');
		}
	});

	$('#view-skin a.good, #view-skin a.nogood').on('click', function(e){
		e.preventDefault();
		var $object = $(this);
		if($object.hasClass('good')){
			var $msg = '정말로 좋아요 하시겠습니까?';
		} else{
			var $msg = '정말로 싫어요 하시겠습니까?';
		}
		if(window.confirm($msg) == true){
			$.post(
				$object.attr('href'),
				{js: 'on'},
				function(data){
					if(data.error){
						window.alert(data.error);
						return false;
					}
					if(data.count){
						$object.find('span').text(number_format(String(data.count)));
					}
				}, 'json'
			);
		}
	});

	$('#view-skin a.scrap').on('click', function(e){
		e.preventDefault();
		window.open($(this).attr('href'), 'win_scrap', 'top=0, left=0, width=600, height=600, scrollbars=yes');
	});

	$('#view-skin a.view_image').on('click', function(e){
		e.preventDefault();
		window.open($(this).attr('href'), 'win_image', 'top=0, left=0, width=100, height=100, scrollbars=no');
	});

	$('#view-skin .btn_share').on('click', function(){
		$('#bo_v_sns').fadeIn();
	});

	// view_comment.skin.php

	$fviewcomment = $('#fviewcomment').html();

	$('#view-comment-skin a.delete').on('click', function(e){
		e.preventDefault();
		if(window.confirm('정말로 삭제하시겠습니까?') == true){
			location.href = $(this).attr('href');
		}
    });

	$('#view-comment-skin span.update').on('click', function(){
		var $wr_id = $(this).attr('data-wr-id');
		var $wr_content = $('#wr_content' + $wr_id).val();
		var $wr_secret = $('#wr_secret' + $wr_id).prop('checked');
		$('.fviewcomment').hide();
		$('.fviewcomment').html('');
		$('#fviewcomment' + $wr_id).show();
		$('#fviewcomment' + $wr_id).html($fviewcomment);
		$('#wr_content').val($wr_content);
		$('#wr_secret').prop('checked', $wr_secret);
		$('#w').val('cu');
		$('#comment_id').val($wr_id);
		$('#captcha_reload').trigger('click');
    });

	$('#view-comment-skin span.reply').on('click', function(){
		var $wr_id = $(this).attr('data-wr-id');
		$('.fviewcomment').hide();
		$('.fviewcomment').html('');
		$('#fviewcomment' + $wr_id).show();
		$('#fviewcomment' + $wr_id).html($fviewcomment);
		$('#wr_content').val('');
		$('#wr_secret').prop('checked', false);
		$('#w').val('c');
		$('#comment_id').val($wr_id);
		$('#captcha_reload').trigger('click');
    });

});