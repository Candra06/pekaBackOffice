<?php
class Helper
{
    public static function sendNotif($deviceToken, $title, $body)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $serverKey = 'AAAAiv-Km-g:APA91bHal7e9L7VWKNb4FRJIf2oN8fMe5EwXszx7ng6WKFHLFAKvEiihKS8tI9_xiMMGa_-wh3yZTGOV8nqbfp_AokuPLMmKAFoqsUaCWb-kOSsNyfUTio9mxWIbTSqSRUSfDzANZiRV';

        $headers = [
            'Authorization: key=' . $serverKey,
            'Content-Type: application/json',
        ];

        $notification = [
            'title' => $title,
            'body' => $body,
            'sound' => 'default',
        ];

        $data = [
            'key' => 'value',
        ];

        $payload = [
            'to' => $deviceToken,
            'notification' => $notification,
            'data' => $data,
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));

        $result = curl_exec($ch);

        if ($result === false) {
            echo 'FCM request failed: ' . curl_error($ch);
        }
        curl_close($ch);
        return $result;
    }
}
