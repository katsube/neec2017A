<?php
require_once('util.php');

//--------------------------
// 値を取得
//--------------------------
$userid   = $_REQUEST['userid'];
$score    = $_REQUEST['score'];

//--------------------------
// DBへ接続
//--------------------------
$dbh = connectdb();

//--------------------------
// DBへ記録
//--------------------------
$result = saveScore($dbh, $userid, $score);

// ブラウザにJSON形式に変換して返却
echo json_encode(["status"=>$result]);

exit(0);



/**
 * スコアを保存する
 * 
 * @param  $userid  string  ユーザーID (U00000)
 * @param  $score   integer スコア
 * @return bool
 */
function saveScore($dbh, $userid, $score){
	try {
		$dbh->beginTransaction();
		$sth = $dbh->exec("INSERT INTO Score(userid, score, regist_date) VALUES($userid, $score, now())");
		$dbh->commit();
	}
	catch (PDOException $e) {
		//echo 'Connection failed: ' . $e->getMessage();
		$dbh->rollBack();
		return(false);
	}

	return(true);
}
