<?php 

if (!function_exists('abcd')) {
    function abcd() {
       echo "shkajhkl/á;đá";
    }
}

if(!function_exists('generateRandomString')) {
    function generateRandomString($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
    
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
    
        return $randomString;
    }
}

if(!function_exists('execPostRequest')) {
    function execPostRequest($url, $data) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }
}
if(!function_exists('timeAgo')) {
    function timeAgo($dateString) {
        $date = new DateTime($dateString);
        $now = new DateTime();
        $timeDifference = $now->getTimestamp() - $date->getTimestamp();
    
        $seconds = floor($timeDifference);
        $minutes = floor($seconds / 60);
        $hours = floor($minutes / 60);
        $days = floor($hours / 24);
        $weeks = floor($days / 7);
        $months = floor($days / 30);
        $years = floor($days / 365);
    

        if ($years > 0) {
            return "$years " . ($years === 1 ? 'year' : 'years') . ' ago';
        } elseif ($months > 0) {
            return "$months " . ($months === 1 ? 'month' : 'months') . ' ago';
        } elseif ($weeks > 0) {
            return "$weeks " . ($weeks === 1 ? 'week' : 'weeks') . ' ago';
        } elseif ($days > 0) {
            return "$days " . ($days === 1 ? 'day' : 'days') . ' ago';
        } elseif ($hours > 0) {
            return "$hours " . ($hours === 1 ? 'hour' : 'hours') . ' ago';
        } elseif ($minutes > 0) {
            return "$minutes " . ($minutes === 1 ? 'minute' : 'minutes') . ' ago';
        } else {
            return "$seconds " . ($seconds === 1 ? 'second' : 'seconds') . ' ago';
        }
    }
}
