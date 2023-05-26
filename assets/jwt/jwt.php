<?php

/*
* JWT para encriptografar as chaves 
* Key para decriptografar as chaves
*/
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

require "../../vendor/autoload.php";

/*
*chave da criptografia
*orientado guardar em .env
*/
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
*/
$headers = [
    'x-forwarded-for' => 'guilhermenunes.com.br'
];

// Codificar cabeçalhos na string JWT
$jwt = JWT::encode($payload, $key, 'HS256', null, $headers);

// Decodificando JWT
$decoded = JWT::decode($jwt, new Key($key,'HS256'));

//Print na tela com as informações do exemplo
echo "<strong>Exemplo simples, backend PHP com biblioteca JWT</strong><br><br>";

//print do JWT
echo "<strong> Print do JWT:</strong><br>";
echo $jwt."<br><br>" ;

//print decodificado do conteúdo
echo "<strong> Print do conteúdo no JWT decodificado:</strong><br>";
echo $json_decoded = json_encode($decoded)."<br>";

//Data de criação do token
$created_at_key2 = date("Y-m-d H:i:s", $created_at_key);
//Data de expiração do token
$exp2 = date("Y-m-d H:i:s", $exp);
//print das informações de criação, expiração e chave de criptografia
echo $payload_infos = json_encode(array('Criado em'=>$created_at_key2,'Expira em'=>$exp2,'Key Utilizada:'=>$key));
