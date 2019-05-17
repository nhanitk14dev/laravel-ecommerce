<?php
return [
  "driver"   => "smtp",
  "host"     => "smtp.mailtrap.io",
  "port"     => 2525,
  "from"     => array(
    "address" => "from@example.com",
    "name"    => "Example",
  ),
  "username" => "a36f7b5f64f090",
  "password" => "86bca8fe8a3bbd",
  "sendmail" => "/usr/sbin/sendmail -bs",
];