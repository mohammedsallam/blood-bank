<?php

/**
 * Return costume response JSON
 * @param $status
 * @param $message
 * @param null $data
 * @return \Illuminate\Http\JsonResponse
 */
function responseJson($status, $message, $data=null){

    $response = [
        'status' => $status,
        'msg' => $message,
        'data' => $data
    ];

    return response()->json($response);

}

/**
 * Send reset password code by sms misr gateway
 * @param $to
 * @param $message
 * @return \Illuminate\Http\JsonResponse|mixed
 */
function smsMisr($to, $message){

    $url = 'https://smsmisr.com/api/webapi/?';

    $smsInfo = [

        'username' => 'yPG7II9I',
        'password' => 'BttePFZQtU',
        'language' => 2,
        'sender' => 'Sallam',
        'mobile' => '2'.$to,
        'message' => $message

    ];


    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url.http_build_query($smsInfo));
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $smsInfo);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, ["Content-Type" => "application/x-www-form-urlencoded"]);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $response = curl_exec($curl);
    $error = curl_error($curl);

    curl_close($curl);

    if ($error) {
        return responseJson(0,"cURL Error #:" . $error);
    }

    return $response;
}

/**
 * Send notifications by fire base api
 * @param $title
 * @param $body
 * @param $tokens
 * @param array $data
 * @return mixed
 */
function notifyByFireBase($title,$body,$tokens,$data = []){
    // https://gist.github.com/rolinger/d6500d65128db95f004041c2b636753a

    $registrationIDs = $tokens;

    $fcmMsg = array(
        'body' => $body,
        'title' => $title,
        'sound' => "default",
        'color' => "#203E78"
    );

    $fcmFields = array(
        'registration_ids' => $registrationIDs,
        'priority' => 'high',
        'notification' => $fcmMsg,
        'data' => $data
    );

    $headers = array(
        'Authorization: key='.env('FIRE_BASE_API_ACCESS_KEY'),
        'Content-Type: application/json'
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmFields));
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}