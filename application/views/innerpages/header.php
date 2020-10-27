<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

<head>
	<title>Canabia</title>
	<meta charset="utf-8">
	<!--[if IE]>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<![endif]-->
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/animations.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/fonts.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/main.css" class="color-switcher-link">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/shop.css" class="color-switcher-link">
	<script src="<?php echo base_url();?>assets/js/vendor/modernizr-2.6.2.min.js"></script>
	<!--[if lt IE 9]>
		<script src="js/vendor/html5shiv.min.js"></script>
		<script src="js/vendor/respond.min.js"></script>
		<script src="js/vendor/jquery-1.12.4.min.js"></script>
	<![endif]-->
</head>

<body>
	<!--[if lt IE 9]>
		<div class="bg-danger text-center">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/" class="highlight">upgrade your browser</a> to improve your experience.</div>
	<![endif]-->
	<!--<div class="preloader">
		<div class="preloader_image"></div>
	</div>-->
	<!-- search modal -->
	<div class="modal" tabindex="-1" role="dialog" aria-labelledby="search_modal" id="search_modal"> <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">
			<i class="rt-icon2-cross2"></i>
		</span>
	</button>
		<div class="widget widget_search">
			<form method="get" class="searchform search-form form-inline" action="http://webdesign-finder.com/html/canabia/">
				<div class="form-group bottommargin_0"> <input type="text" value="" name="search" class="form-control" placeholder="Search keyword" id="modal-search-input"> </div> <button type="submit" class="theme_button no_bg_button">Search</button> </form>
		</div>
	</div>
	<!-- Unyson messages modal -->
	<div class="modal fade" tabindex="-1" role="dialog" id="messages_modal">
		<div class="fw-messages-wrap ls with_padding">
			<!-- Uncomment this UL with LI to show messages in modal popup to your user: -->
			<!--
		<ul class="list-unstyled">
			<li>Message To User</li>
		</ul>
		-->
		</div>
	</div>
	<!-- eof .modal -->
	<!-- wrappers for visual page editor and boxed version of template -->
	<div id="canvas">
		<div id="box_wrapper">
			<!-- template sections -->
			<section class="page_topline ls ms table_section table_section_md">
				<div class="container">
                    <div class="row">
                        <div class="col-sm-7 col-lg-7 text-center text-sm-left">
                            <div class="inline-content big-spacing">
                                <span>
                                    <i class="fa fa-map-marker highlight2 rightpadding_5" aria-hidden="true"></i>
                                    123 Abshire Circle, Colorado
                                </span>
                                <span class="greylinks">
                                    <i class="fa fa-pencil highlight2 rightpadding_5" aria-hidden="true"></i>
                                    <a href="mailto:marijuana@example.com">marijuana@example.com</a>
                                </span>
                                <span>
                                    <i class="fa fa-clock-o highlight2 rightpadding_5" aria-hidden="true"></i>
                                    Working Hours: 24/7
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-3 col-lg-3 text-center text-sm-right"><a href="contacts.html" class="theme_button color3 block_button margin_0">Request a call back free</a></div>
                        <!--<div class="col-sm-2 col-lg-2 text-center"><a href="<?php echo base_url();?>English/home">English</a> <a href="<?php echo base_url();?>Hindi/home">Hindi</a> <a href="<?php echo base_url();?>Marathi/home">Marathi</a> <a href="<?php echo base_url();?>Gujarati/home">Gujarati</a></div>-->
                        <div class="col-sm-2 col-lg-2 text-center">
                            <select onchange="location = this.value;">
                                <option>Language</option>
                                <option value="<?php echo base_url();?>en/home">English</option>
                                <option value="<?php echo base_url();?>hn/home">Hindi</option>
                                <option value="<?php echo base_url();?>mr/home">Marathi</option>
                                <option value="<?php echo base_url();?>gj/home">Gujarati</option>
                            </select>	
                        </div>
                    </div>
                </div>
			</section>
			<header class="page_header header_white toggler_right">
				<div class="container">
					<div class="row">
						<div class="col-sm-12 display_table">
							<div class="header_left_logo display_table_cell"> <a href="index-2.html" class="logo logo_with_text">
                        <img src="<?php echo base_url();?>images/logo.png" alt="">
                        <span class="logo_text">
                            Canabia
                            <small>Colorado dispensary</small>
                        </span>
                    </a> </div>
							<div class="header_mainmenu display_table_cell text-right">
								<!-- main nav start -->
								<nav class="mainmenu_wrapper">
                                    <ul class="mainmenu nav sf-menu">
                                        <?php
                                            $uri=$this->uri->segment(1);
                                            if($uri==""){
                                                $uri="english";
                                            }
                                        ?>
                                        <li class="active">
                                            <a href="<?php echo base_url()?><?php echo $uri?>/home"><?php echo $this->lang->line('menu_link_home')?></a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url()?><?php echo $uri?>/about"><?php echo $this->lang->line('menu_link_about_us')?></a>
                                        </li>
                                        <!-- eof pages -->
                                        <li>
                                            <a href="<?php echo base_url()?><?php echo $uri?>/gallary"><?php echo $this->lang->line('menu_link_gallary')?></a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url()?><?php echo $uri?>/sampling"><?php echo $this->lang->line('menu_link_sampling')?></a>
                                        </li>
                                        <li>
                                            <a href="#"><?php echo $this->lang->line('menu_link_portfolio')?></a>
                                            <ul>
                                                <li><a href="<?php echo base_url()?><?php echo $uri?>/services"><?php echo $this->lang->line('menu_link_services')?></a></li>
                                                <li><a href="<?php echo base_url()?><?php echo $uri?>/testimonials"><?php echo $this->lang->line('menu_link_testimonials')?></a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url()?><?php echo $uri?>/downloads"><?php echo $this->lang->line('menu_link_downloads')?></a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url()?><?php echo $uri?>/contact"><?php echo $this->lang->line('menu_link_contact')?></a>
                                            <!-- eof mega menu -->
                                        </li>
                                        <!-- eof features -->
                                    </ul>
                                </nav>
								<!-- eof main nav -->
								<!-- header toggler --><span class="toggle_menu"><span></span></span>
							</div>
						</div>
					</div>
				</div>
			</header>

