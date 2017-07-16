<?php
require_once('util.php');

//--------------------------
// 値を取得
//--------------------------
$userid = $_REQUEST['userid'];


//--------------------------
// SQL準備
//--------------------------
// http://localhost:8080/security/ranking3/person.php?userid=U00001' or 1=1 --'
$sql  =  'SELECT * '
		. 'FROM   Score '
		. sprintf("WHERE  userid='%s'", $userid);

//--------------------------
// DBへ接続
//--------------------------
$dbh = connectdb();

//--------------------------
// DBから集計
//--------------------------
try{
	$sth  = $dbh->prepare($sql);				//準備
	$sth->execute();							//実行
	$buff = $sth->fetchAll(PDO::FETCH_ASSOC);	//データ取得
}
catch (PDOException $e) {
	echo 'Connection failed: ' . $e->getMessage();
	die();
}

//--------------------------
// ブラウザへ返却
//--------------------------
array_unshift($buff, ['sql'=>$sql]);	//デバッグ用に実行したSQLも返す
echo json_encode( $buff );

exit(0);