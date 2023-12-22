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
$add_dia = '21600';//valor de 6 horas em segundos

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

/*

                        "id_user" => $id_user,
                        "celular_user" => $celular_user,
                        "nome_user" => $nome_user,
                        "email_user" => $email_user,
                        "ordem_user" => $ordem_user,
                        "status_user" => $status_user,
                        "teste_user" => $teste_user,
                        "grupo_user" => $grupo_user,
                        "senha_user" => $senha_user,
                        "unidade_user" => $unidade_user,
                        "remotas_user" => $remotas_user,

*/

$id_user = "1";
$celular_user = "14997917919";
$nome_user = "Guilherme Nunes";
$email_user = "guilherme.nunes@jmduque.com.br";
$ordem_user = "DESC";
$teste_user = "s";
$grupo_user = "JM DUQUE";
$unidade_user = "0035";
$remotas_use = "0035";
$senhaHash = md5('senhaHash');


$payload = [
    'id_user' => '0001',
    'nome_user' => 'Guilherme Nunes',
    'status_user' => '4',
    'senha_user' => $senhaHash,
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
//$decoded = JWT::decode($jwt, new Key($key,'HS256'));

//Print na tela com as informações do exemplo
//#echo "<strong>Exemplo simples, backend PHP com biblioteca JWT</strong><br><br>";

//print do JWT
//#echo "<strong> Print do JWT:</strong><br>";
//########################################################????????????? JWT que será utilizado
//# echo $jwt."<br><br>" ;

//###############################################
//print decodificado do conteúdo
//#echo "<strong> Print do conteúdo no JWT decodificado:</strong><br>";
//$json_decoded = json_encode($decoded)."<br>";

//Data de criação do token
//$created_at_key2 = date("Y-m-d H:i:s", $created_at_key);
//Data de expiração do token
//$exp2 = date("Y-m-d H:i:s", $exp);
//print das informações de criação, expiração e chave de criptografia
//$payload_infos = json_encode(array('Criado em'=>$created_at_key2,'Expira em'=>$exp2,'Key Utilizada:'=>$key));
