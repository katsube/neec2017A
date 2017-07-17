<?php
// コードとファイルの連想配列を用意する
$files = [
     'KOF94' => 'KOF94.txt'
   , 'KOF95' => 'KOF95.txt'
   , 'KOF96' => 'KOF96.txt'
];

// コードを連想配列内のファイルパスに置き換える
$key = $_REQUEST['gametype'];
if( array_key_exists($key, $files) ){
  $gametype = $files[$key];
}
else{
   echo "error";
   exit(1);
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