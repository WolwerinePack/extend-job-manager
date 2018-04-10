<?php

	//fonts
	$google_font_1 = get_option(THEME_NAME."_google_font_1");
	$google_font_2 = get_option(THEME_NAME."_google_font_2");
	$google_font_3 = get_option(THEME_NAME."_google_font_3");
	
	$font_size_1 = get_option(THEME_NAME."_font_size_1");
?>


/* Body */
body {
	font-size: <?php echo $font_size_1;?>px;
	font-family: '<?php echo $google_font_1;?>', sans-serif;
}

/* Titles */
h1, h2, h3,
h4, h5, h6,
.header #main-menu a,
.header #top-sub-menu a,
.header-topmenu ul li a,
.header-2-content .header-weather strong,
.widget-contact li strong,
.item-block-4 .item-header strong,
.photo-gallery-grid .item .category-photo {
	font-family: '<?php echo $google_font_2;?>', sans-serif;
}

/* Main menu */
.header .main-menu > ul {
	font-family: '<?php echo $google_font_3;?>', sans-serif;
}