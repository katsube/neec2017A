<?php
$file = file_get_contents('neec.png');
echo base64_encode($file);