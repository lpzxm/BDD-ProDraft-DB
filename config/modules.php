<?php
include("../config/net.php");
//archivo para desarrolar diferentes modulos dentro del sistema y dividir los procesos
$process = (isset($_POST['process'])) ? $_POST['process'] : '';
$action = (isset($_POST['action'])) ? $_POST['action'] : '';

if ($process == 'login') {
    include("./process/auth/login.php");
} else if ($process == 'seleccionador_process') {
    include("./process/seleccionador_process.php");
}
