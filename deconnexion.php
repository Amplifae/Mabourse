<?php
session_start();
session_unset(); // vider le contenu des variables de session avant de detruire la session
session_destroy();
header("location: menu.html");