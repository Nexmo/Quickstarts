$(document).ready(function(e) {
	//Video Toggle
    $('.watch-screencast .btn').click(function(e) {
        $('.vimeo-video').toggleClass('hide');
		$('span', this).toggleClass('glyphicon-play');
		$('span', this).toggleClass('glyphicon-chevron-down');
    });
	
	//Cookie code preference
	$('.code-snippets .nav-tabs li a').click(function(e) {
        document.cookie = "codepref=" + $(e.target).text();
    });
	
	//On page load, get code preference
	var choice = C("codepref");
	if (choice == "cURL") {
		$('.nav-tabs .PHP').removeClass('active');
		$('.tab-content #PHP').removeClass('active');
		$('.nav-tabs .cURL').addClass('active');
		$('.tab-content #cURL').addClass('active');
	} else {
		$('.nav-tabs .cURL').removeClass('active');
		$('.tab-content #cURL').removeClass('active');
		$('.nav-tabs .PHP').addClass('active');
		$('.tab-content #PHP').addClass('active');
	}
	
	//Function to return cookie by k = key
	function C(k){return(document.cookie.match('(^|; )'+k+'=([^;]*)')||0)[2]}
});