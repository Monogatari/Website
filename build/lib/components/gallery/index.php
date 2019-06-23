<?php

    class gallery extends HighOrderTemplate {
		public $random_color;
		public $games;

        // Set what page and template should be used to render this template.
        function __construct () {
			parent::__construct ();

			$this -> games = [
				[
					'name' => 'Arizona 9',
					'description' => 'Arizona 9 is a casual game that reworks the event of Brisenia Flores’s death at the hands of border vigilantes into a hopeful tale.',
					'url' => 'http://www.arizona9.com/',
					'website' => 'http://www.arizona9.com/',
					'cover' => 'arizona-9.png',
					'creator' => 'Tran. T. Kim-Trang',
					'tags' => ['kinetic novel']
				],

				[
					'name' => 'Citizen Witch',
					'description' => 'Explore the city, meet monsters and try to help folks!',
					'url' => 'https://cybergnose-cafe.itch.io/citizen-witch',
					'website' => 'https://cybergnose-cafe.itch.io/',
					'cover' => 'citizen-witch.png',
					'creator' => 'Lucas Vially',
					'tags' => ['casual', 'ghosts', 'hand drawn', 'kinetic novel', 'monster', 'vampire', 'zombies']
				],

				[
					'name' => 'Dreams of Desire',
					'description' => 'This is a story about power and corruption with a mystery to solve!
					You play as the so called Main Character!

					Due to unfortunate circumstances, it looks like he is forced to go to military school.
					Our hero however, has other ideas. He never wanted to be a soldier. As things start to look inevitable, he stumbles upon an old book about the ways of the mind.
					With the help of newfound knowledge he can change the course of his life. But how will he do it, and what\'s the price he has to pay? ',
					'url' => 'https://www.gamesofdesire.com/3d/dreams-of-desire-episode-1/',
					'website' => 'https://www.patreon.com/lewdlab/',
					'cover' => 'dreams-of-desire.jpg',
					'creator' => 'Lewdlab\'s Dr. Sin',
					'tags' => ['nsfw']
				],

				[
					'name' => 'Gavel',
					'description' => '',
					'url' => 'https://games.increpare.com/gavel/',
					'website' => 'https://www.increpare.com/',
					'cover' => 'gavel.png',
					'creator' => 'Stephen Lavelle',
					'tags' => ['hand drawn']
				],

				[
					'name' => 'Melody',
					'description' => 'You will be spending time with Melody every day. Aside from one-on-one lessons you will have with her, you will also be accompanying her at various music related activities. If all goes well, you may even be able to go out on a date with her. And if that goes well too, it could lead to something even better!',
					'url' => 'https://www.gamesofdesire.com/quest/melody-porn-game/',
					'website' => 'https://www.patreon.com/mrdotsgames/',
					'cover' => 'melody.jpg',
					'creator' => 'Mr. Dots',
					'tags' => ['nsfw']
				],

				[
					'name' => 'Milfy City',
					'description' => 'A university student moves to a new city to study. He rents a house with a couple of other students and local business owners. Following on from this he asks his university Professor out on a date, but is rejected. The game begins here as a dating simulator, with options to pursue romantic relationships with another student, a couple of local business owners, and a couple of University staff.',
					'url' => 'https://www.gamesofdesire.com/3d/milfy-city-v0-4/',
					'website' => 'https://www.patreon.com/icstor/',
					'cover' => 'milfy-city.png',
					'creator' => 'ICSTOR',
					'tags' => ['nsfw', 'dating simulator']
				],

				[
					'name' => 'Urban Voyeur',
					'description' => 'You play as a young successful male doctor who has just moved in to New York to work in a private clinic.
					The game starts after your first week at New York with you exploring a brand new neighborhood.
					Soon you\'ll be sucked into different situations that involve your co-workers, patients and neighbors...',
					'url' => 'https://urbanvoyeur.co/',
					'website' => 'https://www.patreon.com/cesargames',
					'cover' => 'urban-voyeur.png',
					'creator' => 'Cesar Games',
					'tags' => ['nsfw']
				],

				[
					'name' => 'Warm Marble',
					'description' => 'A historical Bruce Lee fan-fiction visual novel dating simulator.',
					'url' => 'https://newbeings.itch.io/warm-marble',
					'website' => 'https://twitter.com/mickanio',
					'cover' => 'warm-marble.jpg',
					'creator' => 'Mickey Sanchez',
					'tags' => ['dating simulator']
				]
			];

		}

	}
?>
