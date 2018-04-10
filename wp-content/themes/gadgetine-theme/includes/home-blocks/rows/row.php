<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	$OT_builder = new OT_home_builder; 
	//get block data
	$dataArray = $OT_builder->get_data(); 

?>

<!-- BEGIN .split-blocks -->
<div class="paragraph-row row">
<?php
	//foreach row columns
	foreach ($dataArray[0]->columns as $columns) {
?>
	<div class="<?php echo $columns->columnID;?>">
		<?php
			if(!empty($columns->contentBlocks)) { 
				//foreach column blocks
				foreach ($columns->contentBlocks as $blocks) {
					$block = $blocks->blocksContentName;
					$OT_builder->$block($blocks,$columns->columnID);
				} 
			} else {
				echo "&nbsp;";
			}
		?>
	</div>
<?php } ?>
<!-- END .split-blocks -->
</div>