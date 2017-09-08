<?php
$login = "/zone_1/login";
$logout = "/zone_1/logout";
echo(isset($user) ? $logout : $login );