<?php
//3秒待つ
sleep(3);

//ファイルをそのまま返す
header('Content-type: audio/mpeg');
echo file_get_contents('bearintheforest.mp3');
