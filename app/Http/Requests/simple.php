<?php

$params = array(
    'transaction_id' => '20170808124800123',
    'msisdn' => '0991245823',
    'sender' => 'truemoveh',
    'name' => 'samark chai',
);
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "http://local.ebirthday.com/api/v1/gen-url",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => http_build_query($params),
    CURLOPT_HTTPHEADER => array(
        "authorization: Basic YmRheXVzZXJ6OiFzayoqM2VnZw==",
        "cache-control: no-cache",
        "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    echo $response;
}
