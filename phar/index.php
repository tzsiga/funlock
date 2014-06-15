<?php

foreach (glob("*.phar") as $filename) {
  require_once $filename;
}
