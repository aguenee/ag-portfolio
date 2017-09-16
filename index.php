<!DOCTYPE HTML>
<!--
	Astral by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<?php
	header('X-UA-Compatible: IE=edge,chrome=1');
  require 'php/conf/top.php';
?>
<html>
	<head>
		<title>Audrey Guénée | Portfolio</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<link rel="icon" href="assets/images/favicon/<?php echo rand(1, 4); ?>.ico" />
	</head>
	<body>

		<!-- Wrapper-->
			<div id="wrapper">

				<!-- Nav -->
					<nav id="nav">
						<a href="#me" class="icon fa-home active"><span>Hello</span></a>
						<a href="#work" class="icon fa-star"><span>Projets</span></a>
						<a href="#contact" class="icon fa-paper-plane"><span>Contact</span></a>
						<a href="CV_Audrey_GUENEE.pdf" target="_blank" class="icon fa-file"><span>CV</span></a>
					</nav>

				<!-- Main -->
					<div id="main">

						<!-- Me -->
							<article id="me" class="panel">
								<header>
									<h1>Audrey Guénée</h1>
									<p>Développeuse web front &amp; back</p>
								</header>
								<a href="#work" class="jumplink pic">
									<img src="assets/images/me.jpg" alt="" />
								</a>
							</article>

						<!-- Work -->
							<article id="work" class="panel">
								<header>
									<h2>Observatoire Photographique des Pôles</h2>
								</header>
								<p>
									Phasellus enim sapien, blandit ullamcorper elementum eu, condimentum eu elit.
									Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia
									luctus elit eget interdum.
								</p>
								<section>
									<div class="row">
										<div class="4u 12u$(mobile)">
											<a href="#" class="image fit"><img src="assets/images/pic02.jpg" alt=""></a>
										</div>
										<div class="4u 12u$(mobile)">
											<a href="#" class="image fit"><img src="assets/images/pic02.jpg" alt=""></a>
										</div>
										<div class="4u$ 12u$(mobile)">
											<a href="#" class="image fit"><img src="assets/images/pic02.jpg" alt=""></a>
										</div>
									</div>
								</section>
								<header>
									<h2>Data Gare</h2>
								</header>
								<p>
									Phasellus enim sapien, blandit ullamcorper elementum eu, condimentum eu elit.
									Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia
									luctus elit eget interdum.
								</p>
								<section>
									<div class="row">
										<div class="12u">
											<div class="vimeo-embed-container">
												<iframe
													src="https://player.vimeo.com/video/94057697?color=00AB6A&byline=0&portrait=0"
													frameborder="0"
													webkitallowfullscreen mozallowfullscreen allowfullscreen
												></iframe>
											</div>
										</div>
									</div>
								</section>
							</article>

						<!-- Contact -->
						<?php
							$messages = [];
							if (isset($_POST['email']) && isset($_POST['message'])) {
								$name = $_POST['name'];
								$email = $_POST['email'];
								$subject = $_POST['subject'];
								$message = trim($_POST['message']);
								if(empty($email) || empty($message)) {
									$messages['errors'] = "Tous les champs obligatoires (*) n'ont pas été remplis.";
								} elseif (!checkEmail($email) || !checkMessage($message)) {
									if(!checkEmail($email)) {
										$messages['email'] = "Veuillez saisir une adresse e-mail valide.";
									}
									if(!checkMessage($message)) {
										$messages['message'] = "Le message doit comporter au moins 5 caractères.";
									}
								}
								if (checkEmail($email) && checkMessage($message)) {
									sendEmail($name, $email, $subject, $message);
									$messages['success'] = "Bien reçu ! Je fais tout pour vous répondre dans les meilleurs délais. A bientôt !";
									unset($name);
									unset($email);
									unset($subject);
									unset($message);
								}
							}
						?>
							<article id="contact" class="panel">
								<?php if (isset($messages['success'])) { ?>
									<p class="12u success"><?php echo $messages['success']; ?></p>
								<?php } ?>
								<header>
									<h2>Contact</h2>
									<?php if (isset($messages['errors'])) { ?>
										<p class="12u error"><?php echo $messages['errors']; ?></p>
									<?php } ?>
								</header>

								<form id="contact-form" action="#contact" method="post">
										<div class="row">
											<div class="6u 12u$(mobile)">
												<input type="text" name="name" placeholder="Nom"
															 value="<?php echo isset($name) ? $name : ''; ?>" />
											</div>
											<div class="6u$ 12u$(mobile)">
												<input type="text" name="email" placeholder="E-mail*"
															 value="<?php echo isset($email) ? $email : ''; ?>" />
											 	<?php if (isset($messages['email'])) { ?>
													<p class="error error-email"><?php echo $messages['email']; ?></p>
											 	<?php } ?>
											</div>
											<div class="12u$">
												<input type="text" name="subject" placeholder="Objet"
															 value="<?php echo isset($subject) ? $subject : ''; ?>" />
											</div>
											<div class="12u$">
												<textarea name="message" placeholder="Message*" rows="8"><?php echo isset($message) ? $message : ''; ?></textarea>
												<?php if (isset($messages['message'])) { ?>
													<p class="error error-message"><?php echo $messages['message']; ?></p>
												<?php } ?>
											</div>
											<div class="12u$">
												<input type="submit" value="Envoyer !" />
											</div>
										</div>
								</form>
							</article>

					</div>

				<!-- Footer -->
					<div id="footer">
						<ul class="copyright">
							<li>&copy; Audrey Guénée</li><li>Design: <a href="http://html5up.net" target="_blank">HTML5 UP</a></li>
						</ul>
					</div>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/skel-viewport.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>
