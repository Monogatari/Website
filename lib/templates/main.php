<?php

    /**
     * Class for the main template
     *
     * Any information requested by the template will be provided by this class
     * as well as it's behaviour.
     */
    class main extends Template {

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


		public $contributors = [
			[
				'name' => 'Ahmadmanga',
				'image' => 'https://avatars2.githubusercontent.com/u/9417511?s=460&v=4',
				'website' => 'https://github.com/ahmadmanga'
			],
			[
				'name' => 'Anthony Z',
				'image' => 'https://avatars1.githubusercontent.com/u/12903732?s=460&v=4',
				'website' => 'http://anthonyzing.me/'
			],
			[
				'name' => 'Biquet',
				'image' => 'https://avatars0.githubusercontent.com/u/13369055?s=460&v=4',
				'website' => 'https://github.com/BakaKiller'
			],
			[
				'name' => 'ign1ght',
				'image' => 'https://avatars3.githubusercontent.com/u/34086115?s=460&v=4',
				'website' => 'https://github.com/ign1ght'
			],
			[
				'name' => 'Jiun Wei Chia',
				'image' => 'https://avatars3.githubusercontent.com/u/118945?s=460&v=4',
				'website' => 'http://friendsonly.org/'
			],
			[
				'name' => 'Josh Anthony',
				'image' => 'https://avatars0.githubusercontent.com/u/20214977?s=460&v=4',
				'website' => 'https://github.com/Jantho1990'
			],
			[
				'name' => 'Kagami Hiiragi',
				'image' => 'https://avatars0.githubusercontent.com/u/533383?s=460&v=4',
				'website' => 'https://github.com/Kagami'
			],
			[
				'name' => 'KazutoSensei',
				'image' => 'https://avatars0.githubusercontent.com/u/41479462?s=460&v=4',
				'website' => 'https://github.com/KazutoSensei'
			],
			[
				'name' => 'Sergey Kuznetsov',
				'image' => 'https://avatars1.githubusercontent.com/u/20613502?s=460&v=4',
				'website' => 'https://t.me/amaimersion'
			],
			[
				'name' => 'Stephen Lavelle',
				'image' => 'https://avatars1.githubusercontent.com/u/465632?s=460&v=4',
				'website' => 'http://www.increpare.com/'
			]
		];


        // Set what page and template should be used to render this template.
        function __construct () {
			$this -> _year = date ('Y');
            $this -> setPage ('home.html');
            $this -> setTemplate ('main.html');
        }
    }

?>