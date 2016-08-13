$_ready(function(){

    $_(".nav .menu-icon").click(function(){
		$_(this).parent().find("ul").toggleClass("active");
		$_(this).toggleClass('fa-bars fa-times');
	});

	$_(".nav li").click(function(){
	    if($_(".menu-icon").isVisible()){
	      $_(".menu-icon").toggleClass('fa-bars fa-times');
	      $_(this).parent().parent().find("ul").toggleClass("active");
	    }
	});

	var colors = ['#57C76A', '#FF80AB', '#80CBC4', '#ff872e', '#424242', '#FBC02D', '#F16272'];
	$_('.phrase').style('background', colors[Math.floor(Math.random() * colors.length)]);

	$_(".mailto").each(function(element){
		element.href =  "mailto:" + element.href.replace("(dot)", ".").replace("(at)", "@").replace(window.location.href, "");
	});

	$_(".modal [data-action='close']").click(function(){
		$_(".modal").removeClass("active");
	});

	var easter_egg = new Konami(function(){
		$_(".modal").addClass("active");
	});

});
