<?php
namespace app;
class find_zone
{
	private $_region;
	private $_resultats;

	public function __construct()
	{
		add_action( 'init',array ($this, 'setZone') );
		add_action( 'init',array ($this, 'getZone') );
		$this->setZone();
	}


	public function setZone()
	{
		global $wpdb;
		$region=array();
		$region[]='Auvergne-Rhône-Alpes';
		$region[]='Bourgogne Franche-Comté';
		$region[]='Bretagne';
		$region[]='Centre-Val de Loire';
		$region[]='Corse';
		$region[]='Grand Est';
		$region[]='Hauts-de-France';
		$region[]='Île-de-France';
		$region[]='Normandie';
		$region[]='Nouvelle-Aquitaine';
		$region[]='Occitanie';
		$region[]='Pays de la Loire';
		$region[]='Provence-Alpes-Côte d\'Azur';
		/*$resultats=$wpdb->get_results("SELECT * FROM itga_postmeta LEFT JOIN itga_posts ON ID = post_id WHERE meta_key LIKE 'geolocation_state_long' AND post_status LIKe 'publish' GROUP BY meta_value ORDER BY meta_value ASC ");
		foreach ($resultats as $resultat) {
			$region[]=$resultat->meta_value;
		}*/
		
		$this->_region = $region;	
			
	}

	public function getZone() 
	{ 
		return $this->_region; 
	}
}