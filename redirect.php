<?php
header('Referer: ');
header('Location: '.$_GET['url'], true, 301);
?>