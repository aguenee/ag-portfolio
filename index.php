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
						<a href="/docs/CV_Audrey_GUENEE.pdf" target="_blank" class="icon fa-file"><span>CV</span></a>
					</nav>

				<!-- Main -->
					<div id="main">

						<!-- Me -->
							<article id="me" class="panel">
								<header>
									<h1>Audrey Guénée</h1>
									<p>Développeuse web front &amp; back</p>
									<p class="social-link">
										<a class="linkedin" href="https://www.linkedin.com/in/audrey-gu%C3%A9n%C3%A9e-4a990855/" target="_blank"><i class="fa fa-linkedin-square" aria-hidden="true"></i></i></a>
										<a class="github" href="https://github.com/aguenee" target="_blank"><i class="fa fa-github-square" aria-hidden="true"></i></a>
										<a class="twitter" href="https://twitter.com/aguenee" target="_blank"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
									</p>
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
									L'Observatoire Photographique des Pôles est une association, créée à l’initiative de Nicolas Mingasson,
									dont le but est de constituer un fonds photographique de référence afin de sensibiliser le grand public
									aux changements en cours dans les régions Arctique et en Antarctique.
								</p>
								<p>
									J'ai conçu et réalisé le site de l'association avec WordPress.<br />
									<strong>Site :</strong> <a class="external-link" href="http://observatoirephotographiquedespoles.org/" target="_blank">observatoirephotographiquedespoles.org</a>
								</p>
								<section>
									<div class="row">
										<div class="4u 12u$(mobile)">
											<span href="#" class="image fit"><img src="/docs/opp-home-top.png" alt="Observatoire Photographique des Pôles"></span>
										</div>
										<div class="4u 12u$(mobile)">
											<span href="#" class="image fit"><img src="/docs/opp-home-middle.png" alt="Observatoire Photographique des Pôles"></span>
										</div>
										<div class="4u$ 12u$(mobile)">
											<span href="#" class="image fit"><img src="/docs/opp-home-bottom.png" alt="Observatoire Photographique des Pôles"></span>
										</div>
									</div>
								</section>
								<header>
									<h2>Data Gare</h2>
								</header>
								<p>
									Data Gare est un projet de visualisation des données de la SNCF, s'inscrivant dans le cadre du programme Data Shaker
									mis en place par le NUMA.
								</p>
								<p>
									Il s'agit d'une application interactive et ludique de comparaison et de visualisation animée des données
									sur les gares Transilien. Le dispositif est projeté en grand format sur un mur de plusieurs mètres (10x3m).
									L'un des principaux enjeux a été de créer une expérience utilisateur unique, d'une part en tactilisant le mur,
									et d'autre part, en donnant vie à des jeux de données statiques.
								</p>
								<p>
									Le projet s'appuie sur un logiciel graphique 2D/3D en temps réel, AAASeed, basé sur du LUA et du C, conçu par
									l'artiste programmeur Mâa Berriet.
								</p>
								<p>
									<strong>Équipe :</strong> Marine Dos, Audrey Guénée, Maxime Kharlamoff et Lionel Mullot.
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
