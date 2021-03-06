<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>

	<!-- Meta Descriptions -->
	<meta charset='utf-8' />
	<meta http-equiv="cleartype" content="on">
    <meta name="MobileOptimized" content="320">
    <meta name="HandheldFriendly" content="True">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="title" content="VapeBox PH | Philippines' Monthly E-Juice Subscription">
	<meta name="description" content="VapeBox is a monthly e-juice subscription box for vapers. Discover the best e-juice and best vape liquid based on your taste profile.">

	<meta property="og:title" content="VapeBox PH | Philippines' Monthly E-Juice Subscription" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="http://www.vapebox.ph" />
	<meta property="og:image" content="<?php echo base_url("assets/images/vapebox-logo-200.png"); ?>" />
	<meta property="og:site_name" content="VapeBox PH | Philippines' Monthly E-Juice Subscription" />
	<meta id="meta-description" property="og:description" content="VapeBox is a monthly e-juice subscription box for vapers. Discover the best e-juice and best vape liquid based on your taste profile.">

	<meta name='twitter:card' content='VapeBox is a monthly e-juice subscription box for vapers. Discover the best e-juice and best vape liquid based on your taste profile.' />
	<meta name='twitter:title' content="VapeBox PH | Philippines' Monthly E-Juice Subscription" />
	<meta name='twitter:description' content='VapeBox is a monthly e-juice subscription box for vapers. Discover the best e-juice and best vape liquid based on your taste profile.' />
	<meta name='twitter:url' content='http://www.vapebox.ph' />

	<link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url("favicon/apple-icon-57x57.png"); ?>">
	<link rel="apple-touch-icon" sizes="60x60" href="<?php echo base_url("favicon/apple-icon-60x60.png"); ?>">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url("favicon/apple-icon-72x72.png"); ?>">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url("favicon/apple-icon-76x76.png"); ?>">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url("favicon/apple-icon-114x114.png"); ?>">
	<link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url("favicon/apple-icon-120x120.png"); ?>">
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url("favicon/apple-icon-144x144.png"); ?>">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url("favicon/apple-icon-152x152.png"); ?>">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url("favicon/apple-icon-180x180.png"); ?>">
	<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo base_url("favicon/android-icon-192x192.png"); ?>">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url("favicon/favicon-32x32.png"); ?>">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url("favicon/favicon-96x96.png"); ?>">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url("favicon/favicon-16x16.png"); ?>">
	<link rel="manifest" href="<?php echo base_url("favicon/manifest.json"); ?>">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="<?php echo base_url("favicon/ms-icon-144x144.png"); ?>">
	<meta name="theme-color" content="#ffffff">
	
	<title><?php echo $title ?> | VapeBox PH | Philippines' Monthly E-Juice Subscription</title>
	<link rel="stylesheet" href="<?php echo base_url("assets/css/style.min.css"); ?>" />

	<link href="<?php echo base_url('favicon.ico'); ?>" rel="icon" type="image/x-icon" />
	
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-73201526-3', 'auto');
	  ga('send', 'pageview');

	</script>

	<!--Start of Zopim Live Chat Script-->
	<script type="text/javascript">
	window.$zopim||(function(d,s){var z=$zopim=function(c){
	z._.push(c)},$=z.s=
	d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
	_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');
	$.src='//v2.zopim.com/?4DG3pb0Qnh1uayVezkYnXdBpRoqxIPX7';z.t=+new Date;$.
	type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');
	</script>
	<!--End of Zopim Live Chat Script-->

</head>
<body class="topmost page-<?php echo strtolower(str_replace(' ', '-', $title)); ?>">

	<!-- <div class="toggle-button visible-xs visible-sm">
		<div class="line-container">
			<div class="line line-1"></div>
			<div class="line line-2"></div>
			<div class="line line-3"></div>
		</div>
	</div>
	<nav id="menu">
	  	<ul class="list-none clearfix">
			<li><a href="<?php echo site_url('home'); ?>">Home</a></li>
			<li><a href="<?php echo site_url('seller'); ?>">Seller</a></li>
			<li><a href="<?php echo site_url('buyer'); ?>">Buyer</a></li>
			<li><a href="<?php echo site_url('broker'); ?>">Broker</a></li>
			<!-- <li><a href="http://www.redlist.ph/blog">Blog</a></li> -->
			<!-- <li><a href="<?php echo site_url('about-us'); ?>">About Us</a></li>
			<li><a href="<?php echo site_url('contact-us'); ?>">Contact Us</a></li>
		</ul>
	</nav> -->

	<main id="panel">
		<header>
			<div class="brand col-xs-6">
				<a href="http://www.vapebox.ph"><img src="<?php echo base_url("assets/images/vapebox-logo-full.png"); ?>" class="logo" alt="VapeBox PH Logo" /></a>
			</div>
			<nav class="col-xs-6 text-right">
				<div class="centering">
					<ul class="list-none stack-left hidden-xs hidden-sm clearfix">
						<li><a href="#howitworks">How It Works</a></li>
						<li><a href="#contact">Contact Us</a></li>
						<li class="btn-container"><a href="#order" class="btn">Order Now</a></li>
					</ul>
				</div>
			</nav>
		</header>

