<?php

    /**
     * Class for the main template
     *
     * Any information requested by the template will be provided by this class
     * as well as it's behaviour.
     */
    class documentation extends Template {

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

		public $doc;
		public $menu;
		public $back;




        // Set what page and template should be used to render this template.
        function __construct ($category = "", $article = "README") {
			$Parsedown = new ParsedownExtra ();
			$this -> _year = date ('Y');
			$this -> menu = FileSystem::read(__DIR__."/../../templates/{$category}Menu.html");

			if ($category !== "") {
				$this -> back = '/documentation';
				$this -> doc = $Parsedown->text(FileSystem::read(__DIR__."/../../docs/$category/$article.md"));
			} else {
				$this -> back = '/';
				$this -> doc = $Parsedown->text(FileSystem::read(__DIR__."/../../docs/$article.md"));
			}

            $this -> setPage ('home.html');
            $this -> setTemplate ('documentation.html');
        }
    }

?>