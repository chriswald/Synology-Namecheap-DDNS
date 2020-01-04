#!/usr/bin/php -d open_basedir=/usr/syno/bin/ddns
<?php

if ($argc !== 5) {
  echo 'badparam';
  exit();
}

$account = (string)$argv[1];
$pwd = (string)$argv[2];
$hostname = (string)$argv[3];
$ip = (string)$argv[4];

// check the hostname contains '.'
if (strpos($hostname, '.') === false) {
  echo 'badparam';
  exit();
}

// only for IPv4 format
if (!filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
  echo "badparam";
  exit();
}

$url = 'https://dynamicdns.park-your-domain.com/update?host='.$account.'&domain='.$hostname.'&password='.$pwd.'&ip='.$ip;
$req = curl_init();
curl_setopt($req, CURLOPT_URL, $url);
curl_setopt($req, CURLOPT_RETURNTRANSFER, true);
$res = curl_exec($req);
curl_close($req);

$xml = new SimpleXMLElement($res);
if ($xml->ErrCount > 0) {
	$error = $xml->errors[0]->Err1;
	
	if (strcmp($error, "Domain name not found") === 0) {
		echo "nohost";
	} elseif (strcmp($error, "Passwords do not match") === 0) {
		echo "badauth";
	} elseif (strcmp($error, "No Records updated. A record not Found;") === 0) {
		echo "nohost";
	} else {
		echo "911 [".$error."]";
	}
} else {
	echo "good";
}
