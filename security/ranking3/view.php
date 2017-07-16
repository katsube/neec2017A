<?php
require_once('util.php');

//--------------------------
// DBへ接続
//--------------------------
$dbh = connectdb();

//--------------------------
// DBから集計
//--------------------------
try{
	$sql  =  'SELECT userid, max(score) as score '
	       . 'FROM   Score '
		   . 'GROUP BY userid '
		   . 'ORDER BY max(score) desc';

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
echo json_encode($buff);

exit(0);