<?php

    class contributors extends HighOrderTemplate {

        // Set what page and template should be used to render this template.
        function __construct () {
			parent::__construct ();
		}

		public $contributors = [
			[
				'name' => 'Ahmad<wbr>manga',
				'image' => 'ahmadmanga.jpeg',
				'website' => 'https://github.com/ahmadmanga',
				'contribution' => 'Code Contributor'
			],
			[
				'name' => 'Alix Lepinay',
				'image' => 'square_alix.png',
				'website' => 'https://twitter.com/AlixLepinay',
				'contribution' => 'Sponsor & Idea Contributor'
			],
			[
				'name' => 'Anthony Z',
				'image' => 'anthony_z.png',
				'website' => 'http://anthonyzing.me/',
				'contribution' => 'Code Contributor & Tester'
			],
			[
				'name' => 'Bao Nguyen',
				'image' => 'bao_nguyen.jpeg',
				'website' => 'https://github.com/baona95',
				'contribution' => 'Idea Contributor'
			],
			[
				'name' => 'Biquet',
				'image' => 'biquet.png',
				'website' => 'https://github.com/BakaKiller',
				'contribution' => 'French Translator'
			],
			[
				'name' => 'Bobokox',
				'image' => 'bobokox.png',
				'website' => 'https://github.com/bobokox',
				'contribution' => 'Idea Contributor & Tester'
			],
			[
				'name' => 'Cesar',
				'image' => 'cesar.jpeg',
				'website' => 'https://urbnanvoyeur.co',
				'contribution' => 'Sponsor, Idea Contributor & Tester'
			],
			[
				'name' => 'Darckoune',
				'image' => 'darckoune.jpeg',
				'website' => 'https://github.com/darckoune',
				'contribution' => 'Code Contributor & Tester'
			],
			[
				'name' => 'Dragoon HP',
				'image' => 'unknown.png',
				'website' => '#',
				'contribution' => 'Idea Contributor & Tester'
			],
			[
				'name' => 'Fernando Saavedra',
				'image' => 'fernando_saavedra.jpg',
				'website' => 'https://fsvdr.me',
				'contribution' => 'Consultant & Idea Contributor'
			],
			[
				'name' => 'Filipe Vieira',
				'image' => 'filipe_vieira.png',
				'website' => 'https://github.com/fsvieira',
				'contribution' => 'Portuguese Translator'
			],
			[
				'name' => 'ign1ght',
				'image' => 'ign1ght.png',
				'website' => 'https://github.com/ign1ght',
				'contribution' => 'Dutch Translator'
			],
			[
				'name' => 'Izra',
				'image' => 'izra.png',
				'website' => '#',
				'contribution' => 'Tester'
			],
			[
				'name' => 'Jiun Wei Chia',
				'image' => 'jin_wei_chia.png',
				'website' => 'http://friendsonly.org/',
				'contribution' => 'Code Contributor'
			],
			[
				'name' => 'Josh Anthony',
				'image' => 'josh_anthony.jpeg',
				'website' => 'https://github.com/Jantho1990',
				'contribution' => 'Code Contributor'
			],
			[
				'name' => 'Josh Powlison',
				'image' => 'josh_powlison.jpeg',
				'website' => 'https://joshpowlison.com/',
				'contribution' => 'Idea Contributor'
			],
			[
				'name' => 'Kagami Hiiragi',
				'image' => 'kagami_hiiragi.png',
				'website' => 'https://github.com/Kagami',
				'contribution' => 'Code Contributor & Tester'
			],
			[
				'name' => 'Kazuto Sensei',
				'image' => 'kazuto_sensei.png',
				'website' => 'https://github.com/KazutoSensei',
				'contribution' => 'Sponsor, Documentation Contributor & Tester'
			],
			[
				'name' => 'Isak Grozny',
				'image' => 'isak_grozny.png',
				'website' => 'https://github.com/ladyisak',
				'contribution' => 'Idea Contributor & Tester'
			],
			[
				'name' => 'Yi Yunseok',
				'image' => 'lee_yunseok.png',
				'website' => 'https://yi-yunseok.github.io/',
				'contribution' => 'Korean Translator'
			],
			[
				'name' => 'Maxwell P. Brickner',
				'image' => 'mbrickn.png',
				'website' => 'https://maxbrickner.com/',
				'contribution' => 'Code Contributor'
			],
			[
				'name' => 'Mdabrowski',
				'image' => 'mdabrowski.jpeg',
				'website' => 'https://github.com/mdabrowski-eu',
				'contribution' => 'Code Contributor'
			],
			[
				'name' => 'Medow',
				'image' => 'medow.png',
				'website' => '#',
				'contribution' => 'Romanian Translator'
			],
			[
				'name' => 'Michael Jay Tucker',
				'image' => 'michael_jay_tucker.jpeg',
				'website' => '#',
				'contribution' => 'Sponsor'
			],
			[
				'name' => 'Mickey Sanchez',
				'image' => 'mickey_sanchez.png',
				'website' => 'https://github.com/mickeysanchez',
				'contribution' => 'Code Contributor'
			],
			[
				'name' => 'Morf',
				'image' => 'unknown.png',
				'website' => '#',
				'contribution' => 'Tester'
			],
			[
				'name' => 'Mr. Two Hand',
				'image' => 'unknown.png',
				'website' => '#',
				'contribution' => 'Idea Contributor & Tester'
			],
			[
				'name' => 'Oluwaseun Ogedengbe',
				'image' => 'oluwaseun_odengbe.png',
				'website' => 'https://ogewan.github.io/',
				'contribution' => 'Idea Contributor & Tester'
			],
			[
				'name' => 'Patience Daur',
				'image' => 'patience_daur.png',
				'website' => 'https://github.com/patiencedaur',
				'contribution' => 'Russian Translator'
			],
			[
				'name' => 'Piiritaja',
				'image' => 'unknown.png',
				'website' => '#',
				'contribution' => 'Tester'
			],
			[
				'name' => 'Remi Autor',
				'image' => 'remi_author.gif',
				'website' => 'https://newrem.com/',
				'contribution' => 'Community Manager, Idea Contributor, Documenter & Tester'
			],
			[
				'name' => 'Renoa',
				'image' => 'renoa.jpeg',
				'website' => 'https://github.com/renoa',
				'contribution' => 'Arabic Translator'
			],
			[
				'name' => 'Ruolin Zheng',
				'image' => 'ruolin_zheng.png',
				'website' => 'https://github.com/RuolinZheng08',
				'contribution' => 'Chinese Translator'
			],
			[
				'name' => 'Sergey Kuznetsov',
				'image' => 'sergey_kuznetsov.jpeg',
				'website' => 'https://t.me/amaimersion',
				'contribution' => 'Russian Translator & Tester'
			],
			[
				'name' => 'ShinProg (Logan Tann)',
				'image' => 'shinprog.jpeg',
				'website' => 'https://kagescan.legtux.org/',
				'contribution' => 'French Translator & Code Contributor'
			],
			[
				'name' => 'Stephen Lavelle',
				'image' => 'stephen_lavelle.png',
				'website' => 'http://www.increpare.com/',
				'contribution' => 'German Translator'
			],
			[
				'name' => 'Tom Nguyen',
				'image' => 'tom_nguyen.jpg',
				'website' => 'https://www.tomnguyen.co.uk/',
				'contribution' => 'Sponsor, Idea Contributor & Tester'
			],
			[
				'name' => 'Waffle<wbr>Meido',
				'image' => 'wafflemeido.png',
				'website' => 'https://wafflemeido.art/',
				'contribution' => 'Artist commissioned for original characters'
			],
			[
				'name' => 'Xiony',
				'image' => 'xiony.png',
				'website' => 'https://github.com/xiony',
				'contribution' => 'Tester'
			],
			[
				'name' => 'Yakauleu Uladzislau',
				'image' => 'unknown.png',
				'website' => 'https://github.com/wiedymi',
				'contribution' => 'Belarusian Translator'
			],
			[
				'name' => 'Zhou Cong Art',
				'image' => 'zhou_cong.png',
				'website' => 'http://www.zhoucong.art/',
				'contribution' => 'Sponsor'
			]
		];
	}
?>
