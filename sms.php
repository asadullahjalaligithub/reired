<?php
require("Database.php");

session_start();
if(isset($_POST['actionString']) && $_POST['actionString']=='sendToConsulateSms')
{
    $invoiceArray=$_POST['invoiceArray'];
    foreach($invoiceArray as $invoiceNo)
    {
        $query="select point_of_contact.poc_mobileno1 from point_of_contact 
        inner join application on application.application_poc_id=point_of_contact.poc_id
        inner join invoice on invoice.invoice_no=application.application_Invoice_no
        where invoice.invoice_no=$invoiceNo";
        $result=mysqli_query($connection,$query);
        $phone=mysqli_fetch_array($result);
        // echo $phone[0];
        sendToConsulateSms($phone[0]);
    }
}  else if(isset($_POST['actionString']) && $_POST['actionString']=='receiveFromConsulateSms')
    {
        $invoiceArray=$_POST['invoiceArray'];
        foreach($invoiceArray as $invoiceNo)
        {
            $query="select point_of_contact.poc_mobileno1 from point_of_contact 
            inner join application on application.application_poc_id=point_of_contact.poc_id
            inner join invoice on invoice.invoice_no=application.application_Invoice_no
            where invoice.invoice_no=$invoiceNo";
            $result=mysqli_query($connection,$query);
            $phone=mysqli_fetch_array($result);
            // echo $phone[0];
            receiveFromConsulateSms($phone[0]);
        }        
    }
    else if(isset($_POST['actionString']) && $_POST['actionString']=="markPaidSms")
    {
        $invoiceArray=$_POST['invoiceArray'];
        foreach($invoiceArray as $invoiceNo)
        {
            $query="select point_of_contact.poc_mobileno1 from point_of_contact 
            inner join application on application.application_poc_id=point_of_contact.poc_id
            inner join invoice on invoice.invoice_no=application.application_Invoice_no
            where invoice.invoice_no=$invoiceNo";
            $result=mysqli_query($connection,$query);
            $phone=mysqli_fetch_array($result);
            // echo $phone[0];
            markPaidSms($phone[0]);
        }  
    }
    function markPaidSms($phone){
        global $apiKey;
        $finalPhone=validatePhoneNumber($phone);    
        $curl = curl_init();
    
        $headers = ["Content-Type: application/json",
                "Accept: application/json",
                "Authorization: Bearer ".$apiKey];
        
        $params = ['to' =>"$finalPhone","bypass_optout" => true,
                'message' => "Dear Mr / Mrs\nYour application has been submitted to Reired Tourism.",
                //'callback_url' => "https://example.com/callback/handler",
                'sender_id' => 'REIRED'];
            //    print_r($params);
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.sms.to/sms/send",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => json_encode($params),  
          CURLOPT_HTTPHEADER => $headers,
        ));
        
        $response = curl_exec($curl);
        curl_close($curl);
        echo $response;   
    }
    function receiveFromConsulateSms($phone)
    {
        global $apiKey;
        $finalPhone=validatePhoneNumber($phone);    
        $curl = curl_init();
    
        $headers = ["Content-Type: application/json",
                "Accept: application/json",
                "Authorization: Bearer ".$apiKey];
        
        $params = ['to' =>"$finalPhone","bypass_optout" => true,
                'message' => "Dear Mr / Mrs\nYour application has been received from Turkish embassy consulate section.\nPlease come & collect.",
                //'callback_url' => "https://example.com/callback/handler",
                'sender_id' => 'REIRED'];
            //    print_r($params);
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.sms.to/sms/send",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => json_encode($params),  
          CURLOPT_HTTPHEADER => $headers,
        ));
        
        $response = curl_exec($curl);
        curl_close($curl);
        echo $response;   
    }
function sendToConsulateSms($phone)
{
    global $apiKey;
       $finalPhone=validatePhoneNumber($phone);    
	$curl = curl_init();

	$headers = ["Content-Type: application/json",
			"Accept: application/json",
			"Authorization: Bearer ".$apiKey];
	
	$params = ['to' =>"$finalPhone","bypass_optout" => true,
			'message' => "Dear Mr / Mrs \nYour application has been sent to Turkish embassy consulate section.",
			//'callback_url' => "https://example.com/callback/handler",
			'sender_id' => 'REIRED'];
           print_r($params);
	
	curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://api.sms.to/sms/send",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => json_encode($params),  
	  CURLOPT_HTTPHEADER => $headers,
	));
	
	$response = curl_exec($curl);
	curl_close($curl);
	echo $response;
}
function validatePhoneNumber($phone)
{
    if(strlen($phone)==10 && $phone[0]=="0")
    {
        $newPhone=substr($phone,1);
        $newPhone="+93".$newPhone;
       return $newPhone;
    }
}
?>