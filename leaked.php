<?php

$str = "teste";
$sha1 = sha1($str);
$pass = substr($sha1, 0, 5);

$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://api.pwnedpasswords.com/range/".strtoupper($pass),
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "deu ruim" . $err;
} else {
	echo $response;
}

$pos = strpos($response, strtoupper($pass));

if ($pos === false) {
    echo "a senha nao foi vazada";
}  else {
    echo "a senha foi vazada";
}

?>