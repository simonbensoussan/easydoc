<?php
	//classe herite de form : Permet de faire un formulaire
	// avec le css de bootstrap :)
	
	class BootstrapForm extends Form
{
			protected function tag($html)
			{
				//idee de la function: <tag>html</tag>
				//$this->tag => variable $tag de notre classe
				return "<div class='form-group'>".$html."</div class='form-group'>";		
			}
			
			public function label($titreLabel)
			{
				return "<label>".$titreLabel."</label>";
			}
			/*public function input($name)
			{
				return $this->tag($this->label($name)."<input type = 'text' class='form-control' name  = '".$name. "'value =".(isset($_POST[$name]) ? $_POST[$name] : '').">") ;
			}*/
			
			public function submit($name_btn)
			{
				return "<button type = 'submit' class='btn btn-primary'>".$name_btn."</button>";
			}
}