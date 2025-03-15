<?php
//NOTE: ipgeocoding uses a heavily modified table from db-ip.com,
//the compression script will be available in a future update
//geocoding will not work without the large_ranges.csv file
//but will fail gracefully and fallback to random node selection

function ipToInt($ip) {
    return sprintf('%u', ip2long($ip)); // Convert IP to unsigned integer
}

function loadIpRanges($csvFile) {
    //validate file
    if (!file_exists($csvFile)) {
        return [];
    }

    //load ranges
    static $ranges = null; // Cache the ranges to avoid reloading every call
    if ($ranges === null) {
        $ranges = [];
        if (($handle = fopen($csvFile, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                list($startIp, $endIp, $location) = $data;
                $ranges[] = [
                    'start' => $startIp,
                    'end' => $endIp,
                    'location' => $location
                ];
            }
            fclose($handle);
        }
    }
    return $ranges;
}

function getIpLocation($ip, $csvFile = "large_ranges.csv") {
    $ranges = loadIpRanges($csvFile);
    $ipInt = ipToInt($ip);
    foreach ($ranges as $range) {
        if ($ipInt >= $range['start'] && $ipInt <= $range['end']) {
            return $range['location'];
        }
    }
    return "UK";
}
?>