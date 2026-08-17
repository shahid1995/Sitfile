
if(jQuery('.stickyloactionwrap').length){

	var win = jQuery(window),
	nav = jQuery('.stickyloactionwrap'),
	pos = jQuery('.stickyloactionwrap').offset().top,
	sticky = function(){ 
	win.scrollTop() > pos ?
	  jQuery('.stickyloactionwrap').addClass('sticky')
	: jQuery('.stickyloactionwrap').removeClass('sticky')
	}
	win.scroll(sticky);

	var lastScrollTop = 0;
	$(window).scroll(function(){
		var st = window.pageYOffset || document.documentElement.scrollTop; // Credits: "https://github.com/qeremy/so/blob/master/so.dom.js#L426"
		   if (st > lastScrollTop){
		      // console.log('down')
		      $('.desktopviewnavigation').addClass('scrolling');
		   } else {
		      //console.log('up')
		      if($(this).scrollTop() < 5){
		      	$('.desktopviewnavigation').removeClass('scrolling');
		      }
		      
		   }
		   lastScrollTop = st <= 0 ? 0 : st;
	});
}
