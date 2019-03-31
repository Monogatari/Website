<?php

    class main extends HighOrderTemplate {
		public $random_color;
        // Set what page and template should be used to render this template.
        function __construct () {
			parent::__construct ();
			$colors = ['#57C76A', '#FF80AB', '#80CBC4', '#ff872e', '#424242', '#FBC02D', '#F16272'];

			$this -> random_color = $colors[array_rand ($colors)];
		}

		public $features = [
			[
				'title' => 'Simple Syntax',
				'image' => 'circular-white.svg',
				'description' => 'You don\'t need to be a developer to start creating a game, Monogatari features a friendly language designed to be incredibly simple and yet very powerful, which will allow you to write your story as easy as if you where just writing it.'
			],
			[
				'title' => 'Multimedia Support',
				'image' => 'gallery.svg',
				'description' => "Want to show images or videos? Maybe even play some music and sound effects! With Monogatari, you can use all sorts of media to enhance the experience on your game and provide a richer content and experience."
			],
			[
				'title' => 'Multi-language',
				'image' => 'language.svg',
				'description' => "Break any language barrier! Monogatari comes with built in functionality for you to translate your game to multiple languages and let your players choose what language they want to play it on."
			],
			[
				'title' => 'Feature Full',
				'image' => 'features.svg',
				'description' => "Monogatari comes pre-loaded with features you and your players will love such as load and save support, animations, ability to go back to previous states, auto play mode, ability to skip text and more!"
			],
			[
				'title' => 'Customizable',
				'image' => 'custom.svg',
				'description' => 'With Monogatari, you are in control of your visual novel like never before! You can change, add and remove anything you need. Think of your game as a website, everything you\'ve seen before on any website is now within your reach!'
			],
			[
				'title' => 'Responsive',
				'image' => 'responsive.svg',
				'description' => 'Wouldn\'t it be awesome if anyone could play your game from any device? Monogatari is responsive out off the box and will adapt to any screen size so that anyone can play your game from any device they want!'
			],
			[
				'title' => 'Progressive Web App',
				'image' => 'rocket.svg',
				'description' => 'Responsiveness is not the only benefit from the web, any Monogatari game is a Progressive Web App that can be installed as if it where a native app on any mobile device and computer right from your browser, bringing benefits such as offline play!'
			],
			[
				'title' => 'Open Source',
				'image' => 'embed.svg',
				'description' => "Monogatari is an open source project released under the MIT License which means you can use it for any commercial or non-commercial project without any limitation and it's completely free! "
			],
			[
				'title' => 'Multi-Platform',
				'image' => 'web.svg',
				'description' => 'Not only can you release your game to the web where anyone will be able to play it from their browser, you can also build your game for Windows, macOS, Linux, Android and iOS!'
			]
		];
	}
?>
