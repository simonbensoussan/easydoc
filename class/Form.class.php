<?php
	/*documenter la classe : pour faire un formulaire
	
	*/
	class Form
		{
			protected $data;
			
			public $tag = "p";

			//get() => de $data
			public function getData()
			{
				$this->data = $data;
			}
			
			//constructeur
			public function __construct($data)
			{
				$this->data = $data;
			}

			//comment organiser les éléments <p>/<td>/<able>...
			protected function tag($html)
			{
				//idee de la function: <tag>html</tag>
				//$this->tag => variable $tag de notre classe
				return "<$this->tag>".$html."</$this->tag>";		
			}
			
			//@param prend le name="" dans le input utile pour $_POST["name"]
			public function label($titreLabel)
			{
				return "<label>".$titreLabel."</label>";
			}
			public function input($name)
			{
				return $this->tag("<input type = 'text' name  = '".$name. "' list  = '".$name. "' size = '20'  value ='".(isset($_POST[$name]) ? $_POST[$name] : '')."'>") ;	
			}
			
			public function submit($name_btn)
			{
				return $this->tag("<button type = 'submit'>".$name_btn."</button>");
			}
			
		}