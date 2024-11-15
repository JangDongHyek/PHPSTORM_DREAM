jQuery.noConflict();

jQuery(document).ready(function(){
	jQuery('.menu > li > ul, .submenu > li > ul').each(function(i,li) {
		jQuery(li).parent('li').addClass('dropdown');
	});
	
	jQuery('.menu > li > ul, .submenu > li > ul').each(function(i,li) {
		jQuery(li).parent('li').addClass('dropdown');
	});

	jQuery(".menu > li,.submenu > li").hover(
	function(){
		var menu = jQuery(this).children(':parent > ul');
		var offset = jQuery(this).offset();
		var bodywidth = jQuery('body').width();
		
		if(offset.left + 160 > bodywidth) {
			menu.css({
				left: 'auto',
				right: '0px'
			});
		}
		
		menu.css({visibility: "visible",display: "none"}).slideDown(268);
	},
	function() {
		var menu = jQuery(this).children(':parent > ul');
		menu.css({visibility: "hidden"});
	});
	
	jQuery(".menu > li > ul > li, .submenu > li > ul > li").hover(
	function(){
		var menu = jQuery(this).children(':parent > ul');
		var offset = jQuery(this).offset();
		var bodywidth = jQuery('body').width();
		
		if(offset.left + 378 > bodywidth) {
			menu.css({
				left: '-160px'
			});
		}
		
		menu.css({visibility: "visible",display: "none"}).slideDown(268)
	},
	function() {
		var menu = jQuery(this).children(':parent > ul');
		menu.css({visibility: "hidden"});
	});
	
	var items = jQuery('.featured li');
	var item_width = 630;
	var max_margin = items.length * item_width - item_width;
	var animstatus = false;
	var user_click = false;
	var animation_speed = 1000;
	var auto_speed = 7500;
	
	
	jQuery('.featured .fthumbs a').each(function(i,link) {
		var index = i+1;
		jQuery(link).click(function(e) {
			e.preventDefault();
			user_click = true;
			
			moveFeature(index);
		});
	});
});
