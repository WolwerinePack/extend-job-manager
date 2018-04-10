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
		$resultats=$wpdb->get_results("SELECT * FROM itga_postmeta WHERE meta_key LIKE 'geolocation_state_long' GROUP BY meta_value ORDER BY meta_value ASC ");
		foreach ($resultats as $resultat) {
			$region[]=$resultat->meta_value;
		}
		
		$this->_region = $region;	
			
	}

	public function getZone() 
	{ 
		return $this->_region; 
	}
}