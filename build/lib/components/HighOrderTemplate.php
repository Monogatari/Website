<?php

	use Ikaros\Template;
	use Ikaros\Configuration;

    /**
     * Class for the main template
     *
     * Any information requested by the template will be provided by this class
     * as well as it's behaviour.
     */
    class HighOrderTemplate extends Template {

        // Set Meta Tags Information.
		public $_title = "Monogatari";
		public $_description = 'Monogatari is a simple web visual novel engine, created to bring Visual Novels to the web.';
		public $_keywords = 'monogatari,vn,visual,novel,visual novel,rpg,renpy,web,create,html5,game,adventure,engine,framework';
		public $_twitter = '@monogatari';
		public $_author = 'Diego Islas Ocampo';

		public $_color = "#f16272";

		public $_space;

		public $_year;

        // Set what page and template should be used to render this template.
        function __construct () {
			parent::__construct ();

			$this -> page ('home.html');

			$this -> scripts ([
				'./js/index.js'
			]);

			$this -> styles ([
				'./style/index.css'
			]);

			$this -> _year = date ('Y');

			$this -> _space = Configuration::space ();
		}
    }

?>
