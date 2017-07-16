<?php
//--------------------------
// 値を取得
//--------------------------
$gametype = $_REQUEST['gametype'];
if( empty($gametype) ){
	$gametype = 'KOF94.txt';
}

//--------------------------
// データファイルをそのまま返却
//--------------------------
echo exec("cat $gametype");

exit(0);