<?php

$logged = (isset($_SESSION['user_id'])) ? true : false;
$view = (isset($_GET['view'])) ? $_GET['view'] : '';

if ($view == '') {
    include("./views/public.php");
} else if ($view == 'login') {
    include("./views/login.php");
} else if ($view == 'main' && $logged) {
    include("./views/view.main.php");
}
