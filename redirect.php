<?php
header('Referer: http://10.0.0.11/');
header('Location: '.$_GET['url'], true, 301);
?>