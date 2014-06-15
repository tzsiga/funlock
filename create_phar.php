<?php

$filename = "funlock";
$lang = "hu";

$phar = new Phar(
  "phar/".$filename."_".$lang.".phar",
  0,
  $filename.".phar"
);

$phar->buildFromDirectory(
  dirname(__FILE__), 
  "/(\.php)|(\.png)|(\.jpg)|(\.gif)/"   // |(\.html)|(\.htaccess)
);

$phar->setStub($phar->createDefaultStub("index.php"));
