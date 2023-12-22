<?php

echo "Inicio do login  <br> \n ";
echo "Verificações e etc <br> \n";

include("../../assets/jwt/jwt.php");

$sessions = array(
    "id_user" => $id_user,
    "celular_user" => $celular_user,
    "nome_user" => $nome_user,
    "email_user" => $email_user,
    "ordem_user" => $ordem_user,
    "teste_user" => $teste_user,
    "grupo_user" => $grupo_user,
    "unidade_user" => $unidade_user,
    "remotas_user" => $remotas_user,
    "jwt_user" => $jwt,
    "url" => 'demanda'
);

echo json_encode($sessions, JSON_UNESCAPED_UNICODE);

session_start();
$_SESSION['jwt']=$jwt;