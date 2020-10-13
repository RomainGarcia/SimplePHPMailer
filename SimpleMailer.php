<?php
require 'vendor/autoload.php';
require 'class/SimpleMailer.class.php';
require 'config/config.php';

$simpleMailer = new SimpleMailer($config);
$simpleMailer->send();