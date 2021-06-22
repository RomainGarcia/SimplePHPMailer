<?php

$config = [
    "host"     => "smtp.gmail.com",
    "auth"     => true,
    "username" => "mail@domain.com",
    "password" => "password",
    "port"     => 587,
    "debug"    => true,
    "tls"      => true,
    "fromEmail" => "mail@domain.com",
    "fromName"  => "Sender name",
    "recipientEmail" => "recept@domain.com",
    "recipientName" => "Recipient name",
    "contentInHTML" => true,
    "subject" => "Mail subject",
    "bodyFile" => "../content/body.html",
    "attachmentFile" => "../content/join.txt",
    "altBody" => 'Alternative body for non-HTML mail clients'
];