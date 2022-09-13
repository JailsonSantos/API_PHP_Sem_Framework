<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

date_default_timezone_set("America/Sao_Paulo");

$GLOBALS['secretJWT'] = '123456';

# Autoload
include_once "classes/autoload.class.php";
new Autoload();

# Rotas
$rota = new Rotas();
$rota->add('POST', '/users/login', 'Users::login', false);
$rota->add('GET', '/urls/listar', 'Urls::listarTodos', true);
$rota->add('GET', '/urls/listar/[PARAM]', 'Urls::listarUnico', true);
$rota->add('PUT', '/urls/atualizar/[PARAM]', 'Urls::atualizar', true);
$rota->ir($_GET['path']);
