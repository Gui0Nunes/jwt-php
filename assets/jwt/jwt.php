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

//Tratamentos de datas
date_default_timezone_set('America/Sao_Paulo');
$dia = date('Y-m-d H:i:s');
$add_dia = '86400';//valor de 24 horas em segundos

//função para acrescer tempo em segundos
function acresceTempo($valor, $tempo)
{
    $data = (strtotime($valor)) + $tempo; //+acrescenta tempo (24h)
    $resultado = date('Y-m-d H:i:s', $data);
    return $resultado;
}

//Cria a data de expiração para 24h, após a data atual
$fim = acresceTempo($dia, $add_dia);

//data criação token
$created_at_key = strtotime($dia);

//data expiração token
$exp = strtotime($fim);

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
