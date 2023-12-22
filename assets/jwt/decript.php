<?php

require "../../vendor/autoload.php";

/*
* JWT para encriptografar as chaves 
* Key para decriptografar as chaves
*/
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;
$dotenv = Dotenv\Dotenv::createUnsafeImmutable('../../env');
$dotenv->load();

//chave da criptografia
$key = getenv('jwt_key');

session_start();
$jwt = $_SESSION['jwt'];

// Decodificando JWT
$decoded = JWT::decode($jwt, new Key($key,'HS256'));
$json_decoded = json_encode($decoded);

