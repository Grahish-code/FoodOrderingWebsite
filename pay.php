
<?php
$product_name = $_POST['food'];
$product_price = $_POST['price'];
$name = $_POST['full-name'];
$email = $_POST['email'];
$phone = $_POST['contact'];

session_start();
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER,
            array("X-Api-Key:test_2c6f4e7a013ca16a88da3f33d11",
                  "X-Auth-Token:test_696994360f7da14301879065ee4"));

  
        $payload = Array(
            "purpose" => $product_name,
            "amount" => $product_price,
            "send_email" => true,
            "email" => $email,
            "buyer_name"=>$name,
            "phone"=>$phone,
            "send_sms"=>true,
            "allow_repeated_payments"=>false,
            "redirect_url" => "http://www.example.com/handle_redirect.php",
            'webhook' => 'http://www.example.com/webhook/',
            );
            curl_setopt($ch,CURLOPT_POST,true);
            curl_setopt($ch,CURLOPT_POSTFIELDS,http_build_query($payload));
       
$response = curl_exec($ch);
curl_close($ch);
$response=json_decode($response);

$_SESSION['TID']=$response->payment_request->id;
header('location:'.$response->payment_request->longurl);
die();
?>