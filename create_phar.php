<?php

// php.ini: phar.readonly = Off
// usage: php create_phar.php hu

$filename = "funlock";

if (count($argv) == 2) {
  $suffix = $argv[1];
} else {
  $suffix = time();
}

$phar = new Phar("phar/".$filename."_".$suffix.".phar", 0, $filename.".phar");

$phar->buildFromDirectory(
  dirname(__FILE__), "/(\.php)|(\.png)|(\.jpg)|(\.gif)/"   // |(\.html)|(\.htaccess)
);

$phar->setStub($phar->createDefaultStub("index.php"));
