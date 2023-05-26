<?php

/*
* JWT para encriptografar as chaves 
* Key para decriptografar as chaves
*
*/
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

require "../../vendor/autoload.php";

//chave da criptografia
$key = hash('sha256','Minha_chave_secreta');

//data criação token
$created_at_key = strtotime("2023-05-25 20:08:00");

//data expiração token
$exp = strtotime("2023-05-26 20:08:00");

/*
* Inserimos no payload o conteúdo
* que será encriptografado
* Nesse exeplo guardamos o id, nome, 
* status para nivel de permissões, 
* iat data de criação da chave e 
* exp data de expiração da chave
*
*/
$payload = [
    'id' => '0001',
    'nome' => 'Guilherme Nunes',
    'status' => '5',
    'iat' => $created_at_key,
    'exp' => $exp
];

/*
* X-Forwarded-For ajuda você a identificar o endereço IP de um cliente 
* quando usar um balanceador de carga HTTP ou HTTPS
*
*/
$headers = [
    'x-forwarded-for' => 'guilhermenunes.com.br'
];

// Codificar cabeçalhos na string JWT
$jwt = JWT::encode($payload, $key, 'HS256', null, $headers);

// $decoded = JWT::decode($jwt, new Key($publicKey, 'RS256'));
$decoded = JWT::decode($jwt, new Key($key,'HS256'));
// $decoded = json_encode($decoded);

//print do JWT codificado
echo "<strong> Print do JWT codificado:</strong><br>";
echo $jwt ;

//print decodificado do conteúdo
echo "<br><br><strong> Print do conteúdo no JWT decodificado:</strong><br>";
print_r($decoded);


//Data de criação do token
echo "<hr>";
$created_at_key2 = date("d/m/Y H:i:s", $created_at_key);
echo "<strong>Criado em:</strong><br>".$created_at_key2;

//Data de expiração do token
echo "<hr>";
$exp2 = date("d/m/Y H:i:s", $exp);
echo "<strong>Expira em:</strong><br>".$exp2;

//orientado guardar em .env
echo "<hr>";
echo "<strong>Chave secreta:</strong><br>".$key;
