<?php
$home = "/zone_2/home";
$login = "/zone_2/login";
echo(isset($user) ? $home : $login);