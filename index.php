<?php

	/**
	 * ==============================
	 * Aegis Framework | MIT License
	 * http://www.aegisframework.com/
	 * ==============================
	 */

 	// Uncomment on Production
    //error_reporting(0);

	include("lib/aegis.php");
	$session = new Session();


	$router = new Router("monogatari.io");

	$meta = [
		"title" => "Monogatari",
		"description" => "Monogatari is a simple web visual novel engine, created to bring Visual Novels to the web.",
		"keywords" => "monogatari,vn,visual,novel,visual novel,rpg,renpy,web,create,html5,game,adventure",
		"author" => "Diego Islas Ocampo",
		"twitter" => "@HyuchiaDiego",
		"google" => "+HyuchiaDiego",
		"domain" => $router -> getBaseUrl(),
		"route" => 	$router -> getFullUrl(),
		"year" => date("Y"),
		"shareimage" => "monogatari.png"
	];

	$Parsedown = new Parsedown();

	$router -> registerRoute("/", new View("main", ["main" => ["year" => $meta["year"]]], $meta));

	// Documentation

	$router -> registerRoute("/documentation", new View("documentation", ["documentation" => ["content" => $Parsedown->text(file_get_contents("docs/main.md")),"year" => $meta["year"]]], $meta));

	// Script
	switch($router -> getRoute()){
		case "/documentation/script":
			$router -> registerRoute("/documentation/script", new View("script", ["script" => ["content" => $Parsedown->text(file_get_contents("docs/script/script.md")), "year" => $meta["year"]]], $meta));
			break;
		case "/documentation/script/audio":
			$router -> registerRoute("/documentation/script/audio", new View("script", ["script" => ["content" => $Parsedown->text(file_get_contents("docs/script/audio.md")), "year" => $meta["year"]]], $meta));
			break;
		case "/documentation/script/characters":
			$router -> registerRoute("/documentation/script/characters", new View("script", ["script" => ["content" => $Parsedown->text(file_get_contents("docs/script/characters.md")), "year" => $meta["year"]]], $meta));
			break;
		case "/documentation/script/choices":
			$router -> registerRoute("/documentation/script/choices", new View("script", ["script" => ["content" => $Parsedown->text(file_get_contents("docs/script/choices.md")), "year" => $meta["year"]]], $meta));
			break;
		case "/documentation/script/images":
			$router -> registerRoute("/documentation/script/images", new View("script", ["script" => ["content" => $Parsedown->text(file_get_contents("docs/script/images.md")), "year" => $meta["year"]]], $meta));
			break;
		case "/documentation/script/input":
			$router -> registerRoute("/documentation/script/input", new View("script", ["script" => ["content" => $Parsedown->text(file_get_contents("docs/script/input.md")), "year" => $meta["year"]]], $meta));
			break;
		case "/documentation/script/javascript":
			$router -> registerRoute("/documentation/script/javascript", new View("script", ["script" => ["content" => $Parsedown->text(file_get_contents("docs/script/javascript.md")), "year" => $meta["year"]]], $meta));
			break;
		case "/documentation/script/labels":
			$router -> registerRoute("/documentation/script/labels", new View("script", ["script" => ["content" => $Parsedown->text(file_get_contents("docs/script/labels.md")), "year" => $meta["year"]]], $meta));
			break;
		case "/documentation/script/messages":
			$router -> registerRoute("/documentation/script/messages", new View("script", ["script" => ["content" => $Parsedown->text(file_get_contents("docs/script/messages.md")), "year" => $meta["year"]]], $meta));
			break;
		case "/documentation/script/notifications":
			$router -> registerRoute("/documentation/script/notifications", new View("script", ["script" => ["content" => $Parsedown->text(file_get_contents("docs/script/notifications.md")), "year" => $meta["year"]]], $meta));
			break;
		case "/documentation/script/particles":
			$router -> registerRoute("/documentation/script/particles", new View("script", ["script" => ["content" => $Parsedown->text(file_get_contents("docs/script/particles.md")), "year" => $meta["year"]]], $meta));
			break;
		case "/documentation/script/scenes":
			$router -> registerRoute("/documentation/script/scenes", new View("script", ["script" => ["content" => $Parsedown->text(file_get_contents("docs/script/scenes.md")), "year" => $meta["year"]]], $meta));
			break;
		case "/documentation/script/split":
			$router -> registerRoute("/documentation/script/split", new View("script", ["script" => ["content" => $Parsedown->text(file_get_contents("docs/script/split.md")), "year" => $meta["year"]]], $meta));
			break;
		case "/documentation/script/text":
			$router -> registerRoute("/documentation/script/text", new View("script", ["script" => ["content" => $Parsedown->text(file_get_contents("docs/script/text.md")), "year" => $meta["year"]]], $meta));
			break;
		case "/documentation/script/vibration":
			$router -> registerRoute("/documentation/script/vibration", new View("script", ["script" => ["content" => $Parsedown->text(file_get_contents("docs/script/vibration.md")), "year" => $meta["year"]]], $meta));
			break;
		case "/documentation/script/video":
			$router -> registerRoute("/documentation/script/video", new View("script", ["script" => ["content" => $Parsedown->text(file_get_contents("docs/script/video.md")), "year" => $meta["year"]]], $meta));
			break;
		case "/documentation/design":
			$router -> registerRoute("/documentation/design", new View("design", ["design" => ["content" => $Parsedown->text(file_get_contents("docs/design/design.md")), "year" => $meta["year"]]], $meta));
			break;
		case "/documentation/design/classes":
			$router -> registerRoute("/documentation/design/classes", new View("design", ["design" => ["content" => $Parsedown->text(file_get_contents("docs/design/classes.md")), "year" => $meta["year"]]], $meta));
			break;
		case "/documentation/design/data-attributes":
			$router -> registerRoute("/documentation/design/data-attributes", new View("design", ["design" => ["content" => $Parsedown->text(file_get_contents("docs/design/data-attributes.md")), "year" => $meta["year"]]], $meta));
			break;
		case "/documentation/design/icons":
			$router -> registerRoute("/documentation/design/icons", new View("design", ["design" => ["content" => $Parsedown->text(file_get_contents("docs/design/icons.md")), "year" => $meta["year"]]], $meta));
			break;
		case "/documentation/design/image-menus":
			$router -> registerRoute("/documentation/design/image-menus", new View("design", ["design" => ["content" => $Parsedown->text(file_get_contents("docs/design/image-menus.md")), "year" => $meta["year"]]], $meta));
			break;
		case "/documentation/configuration":
			$router -> registerRoute("/documentation/configuration", new View("configuration", ["configuration" => ["content" => $Parsedown->text(file_get_contents("docs/configuration/configuration.md")), "year" => $meta["year"]]], $meta));
			break;
		case "/documentation/configuration/saving":
			$router -> registerRoute("/documentation/configuration/saving", new View("configuration", ["configuration" => ["content" => $Parsedown->text(file_get_contents("docs/configuration/saving.md")), "year" => $meta["year"]]], $meta));
			break;
		case "/documentation/configuration/skip-menu":
			$router -> registerRoute("/documentation/configuration/skip-menu", new View("configuration", ["configuration" => ["content" => $Parsedown->text(file_get_contents("docs/configuration/skip-menu.md")), "year" => $meta["year"]]], $meta));
			break;
		case "/documentation/configuration/internationalization":
				$router -> registerRoute("/documentation/configuration/internationalization", new View("configuration", ["configuration" => ["content" => $Parsedown->text(file_get_contents("docs/configuration/internationalization.md")), "year" => $meta["year"]]], $meta));
			break;
		case "/documentation/release":
			$router -> registerRoute("/documentation/release", new View("release", ["release" => ["content" => $Parsedown->text(file_get_contents("docs/release/release.md")), "year" => $meta["year"]]], $meta));
			break;
		case "/documentation/release/chrome":
			$router -> registerRoute("/documentation/release/chrome", new View("release", ["release" => ["content" => $Parsedown->text(file_get_contents("docs/release/chrome.md")), "year" => $meta["year"]]], $meta));
			break;
		case "/documentation/release/desktop":
			$router -> registerRoute("/documentation/release/desktop", new View("release", ["release" => ["content" => $Parsedown->text(file_get_contents("docs/release/desktop.md")), "year" => $meta["year"]]], $meta));
			break;
		case "/documentation/release/mobile":
			$router -> registerRoute("/documentation/release/mobile", new View("release", ["release" => ["content" => $Parsedown->text(file_get_contents("docs/release/mobile.md")), "year" => $meta["year"]]], $meta));
			break;
		case "/documentation/release/web":
			$router -> registerRoute("/documentation/release/web", new View("release", ["release" => ["content" => $Parsedown->text(file_get_contents("docs/release/web.md")), "year" => $meta["year"]]], $meta));
			break;
		case "/documentation/port":
			$router -> registerRoute("/documentation/port", new View("port", ["port" => ["content" => $Parsedown->text(file_get_contents("docs/port/port.md")),"year" => $meta["year"]]], $meta));
			break;
		case "/documentation/port/renpy":
			$router -> registerRoute("/documentation/port/renpy", new View("port", ["port" => ["content" => $Parsedown->text(file_get_contents("docs/port/renpy.md")),"year" => $meta["year"]]], $meta));
			break;

	}

	$router -> listen();

?>
