<?php
$home = "/zone_1/home";
$login = "/zone_1/login";
echo(isset($user) ? $home : $login);