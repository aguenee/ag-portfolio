<?php

    /* Vérification du prénom/nom */
    function checkName($name) {
        $regex = '#^[a-zA-Zàâäéèêëùûüîïôö-\s\']{3,30}$#';
        if(preg_match($regex, $name)) {
            // Nom correct
            return true;
        }
        else {
            // Nom incorrect
            return false;
        }
    }

    /* Vérification du message */
    function checkMessage($message) {
        if(strlen($message) >= 5) {
            // Message correct
            return true;
        }
        else {
            // Message incorrect
            return false;
        }
    }

	   /* Vérification du mail */
   	function checkEmail($email) {
        $regex = '#^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$#';
        if(preg_match($regex, $email)) {
            // Mail correct
            return true;
        }
        else {
            // Mail incorrect
            return false;
        }
    }

    /* Envoi d'un mail */
    function sendEmail($name, $email, $subject, $message) {
    	  // Filtrage des serveurs qui rencontrent des bogues
        if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", "hello@audreyguenee.com")) {
            $passage_ligne = "\r\n";
        } else {
            $passage_ligne = "\n";
        }

        // Déclaration du message aux formats texte et HTML
        $message_txt = "$subject\n\n $message\n\n $name\n$email";
        $message_html =
            "<html>
                <body>
                    <p><strong>Objet :</strong>$subject</p>
                    <p>$message</p>
                    <p>$name<br />$email<br />$website</p>
                </body>
            </html>";

        $boundary = "-----=".md5(rand());

        // Création du header de l'e-mail
        $header = "From: \"$name\"<$email>".$passage_ligne;
        $header.= "MIME-Version: 1.0".$passage_ligne;
        $header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;

        $message = $passage_ligne."--".$boundary.$passage_ligne;
        // Format texte
        $message.= "Content-Type: text/plain; charset=\"UTF-8\"".$passage_ligne;
        $message.= "Content-Transfer-Encoding: 8bits".$passage_ligne;
        $message.= $passage_ligne.$message_txt.$passage_ligne;
        $message.= $passage_ligne."--".$boundary.$passage_ligne;
        // Format HTML
        $message.= "Content-Type: text/html; charset=\"UTF-8\"".$passage_ligne;
        $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
        $message.= $passage_ligne.$message_html.$passage_ligne;
        $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
        $message.= $passage_ligne."--".$boundary."--".$passage_ligne;

        return mail("hello@audreyguenee.com", "[audreyguenee.com] Nouveau message", $message, $header);
    }
