<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	//ratings
	$ratings = get_post_meta( $post->ID, "_".THEME_NAME."_ratings", true );
	$summary = get_post_meta( $post->ID, "_".THEME_NAME."_overall", true );

?>
							<?php if($ratings || $summary) { ?>
								<div class="panel-post-review" itemscope itemtype="http://data-vocabulary.org/Review">
									<h3><?php esc_html_e("Review Summary", THEME_NAME);?></h3>
									<div class="post-review-inner">
										<?php 
											if($ratings) { 
												$totalRate = array();
												$rating = explode(";", $ratings);
 
												foreach($rating as $rate) { 
													$ratingValues = explode(":", $rate);
													if(isset($ratingValues[1])) {
														$ratingPrecentage = (str_replace(",",".",$ratingValues[1]))*20;
													}
													$totalRate[] = $ratingPrecentage;
													if($ratingValues[0]) {

										?>		 	
											<div class="review-line">
												<div class="ot-star-rating right">
													<span style="width: <?php echo $ratingPrecentage;?>%;"><strong class="rating"><?php echo round($ratingPrecentage/20, 2);?></strong> <?php esc_html_e("out of 5", THEME_NAME);?></span>
												</div>
												<strong><?php echo $ratingValues[0];?></strong>
											</div>
										<?php 
													} 
												} 
											} 
									 	?>

										<?php if($summary) { ?>
											<div class="review-line">
												<p><?php echo nl2br(stripslashes($summary));?></p>
											</div>
										<?php } ?>
											<?php 
												if(!empty($totalRate)) { 
													$rateCount = count($totalRate);	
													$total = 0;
													foreach ($totalRate as $val) {
														$total = $total + $val;
													}

													$avaragePrecentage = round($total/$rateCount,2);
													$avarageRate = round((($total/$rateCount)/20),2);

													if($avarageRate>=4.75) {
														$rateText = esc_html("Excellent",THEME_NAME);
													} else if($avarageRate<4.75 && $avarageRate>=3.75) {
														$rateText = esc_html("Good",THEME_NAME);
													} else if($avarageRate<3.75 && $avarageRate>=2.75) {
														$rateText = esc_html("Average",THEME_NAME);
													} else if($avarageRate<2.75 && $avarageRate>=1.75) {
														$rateText = esc_html("Fair",THEME_NAME);
													} else if($avarageRate<1.75 && $avarageRate>=0.75) {
														$rateText = esc_html("Poor",THEME_NAME);
													} else if($avarageRate<0.75) {
														$rateText = esc_html("Very Poor",THEME_NAME);
													}
											?>
												<div class="review-summary">
													<span>
														<strong itemprop="rating"><?php echo $avarageRate;?></strong>
														<span>
															<span class="review-rating-word"><?php echo $rateText;?></span>
															<span class="ot-star-rating">
																<span style="width: <?php echo $avaragePrecentage;?>%;">
																	<strong class="rating"><?php echo $avarageRate;?></strong> <?php esc_html_e("out of 5", THEME_NAME);?></span>
															</span>
														</span>
													</span>
									                <meta itemprop="itemreviewed" content="<?php echo esc_attr(get_the_title()); ?>"/>
									                <meta itemprop="reviewer" content="<?php echo esc_attr(get_the_author());?>"/>
									                <meta itemprop="dtreviewed" content="<?php echo esc_attr(get_the_time("F d, Y")); ?>"/>
												</div>
											<?php } ?>
										</div>
									</div>
								<?php } ?>