'use strict';

const { $_ready, $_, Platform } = Artemis;

// Register the service worker
if (Platform.serviceWorkers ()) {
	//navigator.serviceWorker.register ('service-worker.js');
}

$_ready (() => {

	$_('.nav').on ('click', '*', function () {
		console.log ($_(this).closest ('ul'));
		$_(this).closest ('ul').toggleClass ('nav__content-list--active');
		$_(this).toggleClass ('fa-bars fa-times');
	});

	$_('.nav li').click (function () {
		if ($_('.nav__menu-icon').isVisible ()) {
			$_('.nav__menu-icon').toggleClass ('fa-bars fa-times');
			$_(this).closest ('ul').toggleClass ('nav__content-list--active');
		}
	});

	var colors = ['#57C76A', '#FF80AB', '#80CBC4', '#ff872e', '#424242', '#FBC02D', '#F16272'];
	$_('.phrase').style('background', colors[Math.floor(Math.random() * colors.length)]);

	$_(".mailto").each(function(element){
		element.href =  "mailto:" + element.href.replace("(dot)", ".").replace("(at)", "@").replace(window.location.href, "");
	});

	$_(".modal [data-action='close']").click(function(){
		$_(".modal").removeClass("modal--active");
	});

	var easter_egg = new Konami(function(){
		$_(".modal").addClass("modal--active");
	});
});