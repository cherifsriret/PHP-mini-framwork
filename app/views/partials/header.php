<!DOCTYPE html>

<html>
<head>
	<title><?= htmlentities($title) ?></title>
	<link rel="stylesheet" href="/<?=  App::get('config')['base_uri']?>/public/style.css">
</head>

<body>
	<!-- Navbar -->
	<nav >
		<a href="/<?=  App::get('config')['base_uri']?>" class="logo">
			<img src="/<?=  App::get('config')['base_uri']?>/public/logo.jpg" alt="" srcset="">
		</a>
		<div class="menu">
		<a href="/<?=  App::get('config')['base_uri']?>/">Home</a>
		<a href="/<?=  App::get('config')['base_uri']?>/about">About</a>

		<?php 
		  if( !empty($_SESSION['user'])) :
		?>
		<a href="/<?=  App::get('config')['base_uri']?>/notes">My Notes</a>
		<a href="/<?=  App::get('config')['base_uri']?>/note_add_form">Add Note</a>
		<form class="logout-form" action="logout" method="post">
			<div class="form-group">
				<button class="logout-btn"  type="submit">Logout</button>
			</div>
		</form>
		<?php 
			endif;
		?>
			
		</div>
	</nav>

	