<?php

use \Firebase\JWT\JWT;

require "../../vendor/autoload.php";

//chave da criptografia
$key = 'Minha_chave_secreta';
$payload = [
    'id' => '0001',
    'nome' => 'Guilherme Nunes',
    'iat' => 1356999524,
    'nbf' => 1357000000
];

$headers = [
    'x-forwarded-for' => 'www.google.com'
];

// Codificar cabeçalhos na string JWT
$jwt = JWT::encode($payload, $key, 'HS256', null, $headers);

// Decode headers from the JWT string WITHOUT validation
// **IMPORTANTE**: Esta operação está vulnerável a ataques, pois o JWT ainda não foi verificado.
// Esses cabeçalhos podem ser qualquer valor enviado por um invasor.
list($headersB64, $payloadB64, $sig) = explode('.', $jwt);
$decoded = json_decode(base64_decode($headersB64), true);

//print decodificado do conteúdo
echo "<strong> Print do JWT codificado:</strong><br>";
echo $jwt ;

//print decodificado do conteúdo
echo "<br><br><strong> Print do conteúdo no JWT decodificado:</strong><br>";
print_r($decoded);
