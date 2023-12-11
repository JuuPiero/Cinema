<?php 

if (!function_exists('abcd')) {
    function abcd() {
       echo "shkajhkl/á;đá";
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
