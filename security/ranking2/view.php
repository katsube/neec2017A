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
$ret = file_get_contents($gametype);
if(!$ret){
	echo json_encode(['status'=>'error, file_get_contents()']);
}
else{
	echo $ret;	
}

exit(0);