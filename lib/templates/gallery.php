<?php

    /**
     * Class for the main template
     *
     * Any information requested by the template will be provided by this class
     * as well as it's behaviour.
     */
    class gallery extends Template {

        // Set Meta Tags Information.
		public $_title = 'Monogatari';
		public $_description = 'Monogatari is a simple web visual novel engine, created to bring Visual Novels to the web.';

		public $_keywords = 'monogatari,vn,visual,novel,visual novel,rpg,renpy,web,create,html5,game,adventure';

		public $_author = 'Diego Islas Ocampo';
		public $_color = '#f16272';
		public $_shareimage = 'sharing.png';
		public $_twitter = '@Hyuchia';
		public $_google = '+HyuchiaDiego';


		public $_year;

		public $games;




        // Set what page and template should be used to render this template.
        function __construct () {
			$Parsedown = new ParsedownExtra ();
			$this -> _year = date ('Y');

			$this -> games = [
				[
					'name' => 'Arizona 9',
					'description' => 'Arizona 9 is a casual game that reworks the event of Brisenia Flores’s death at the hands of border vigilantes into a hopeful tale.',
					'url' => 'http://www.arizona9.com/',
					'website' => 'http://www.arizona9.com/',
					'cover' => 'arizona-9.png',
					'creator' => 'Tran. T. Kim-Trang',
					'tags' => ''
				],

				[
					'name' => 'Citizen Witch',
					'description' => 'Explore the city, meet monsters and try to help folks!',
					'url' => 'https://cybergnose-cafe.itch.io/citizen-witch',
					'website' => 'https://cybergnose-cafe.itch.io/',
					'cover' => 'citizen-witch.png',
					'creator' => 'Lucas Vially',
					'tags' => 'Casual, Ghosts, Hand-drawn, Kinetic Novel, Monsters, Vampire, Zombies'
				],

				[
					'name' => 'Gavel',
					'description' => '',
					'url' => 'https://ded.increpare.com/~locus/gavel/',
					'website' => 'https://www.increpare.com/',
					'cover' => 'gavel.png',
					'creator' => 'Stephen Lavelle',
					'tags' => ''
				],
				[
					'name' => 'Urban Voyeur',
					'description' => 'You play as a young successful male doctor who has just moved in to New York to work in a private clinic.
					The game starts after your first week at New York with you exploring a brand new neighborhood.
					Soon you\'ll be sucked into different situations that involve your co-workers, patients and neighbors...',
					'url' => 'http://urbanvoyeur.co/',
					'website' => 'https://www.patreon.com/cesargames',
					'cover' => 'urban-voyeur.png',
					'creator' => 'Cesar Games',
					'tags' => 'NSFW, Voyeurism'
				]
			];


            $this -> setPage ('home.html');
            $this -> setTemplate ('gallery.html');
        }
    }

?>