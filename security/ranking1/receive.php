<?php
require_once('config.php');

//--------------------------
// 値を取得
//--------------------------
$userid = $_REQUEST['userid'];
$score  = $_REQUEST['score'];

//--------------------------
// データファイルに書き込む
//--------------------------
$result1 = saveScore(DATA_FILE, $userid, $score);

//--------------------------
// ランキング集計
//--------------------------
if($result1){
	$result2 = makeRanking(DATA_FILE, RANKING_FILE);
}

// ブラウザにJSON形式に変換して返却
echo json_encode(["status"=>$result1 && $result2]);

exit(0);



/**
 * スコアを保存する
 * 
 * @param  $file    string  ファイルのパス
 * @param  $userid  string  ユーザーID (U00000)
 * @param  $score   integer スコア
 * @return void
 */
function saveScore($file, $userid, $score, $separate="\t"){
	$fp = fopen($file, 'a');
	if(!$fp){
		return(false);
	}

	flock($fp, LOCK_EX);
	fprintf($fp, implode($separate, [time(), $userid, $score]));
	fprintf($fp, "\n");
	flock($fp, LOCK_UN);
	fclose($fp);

	return(true);
}

/**
 * ランキング集計
 * 
 * @param  $datafile    string  データファイルのパス
 * @param  $rankingfile string  ランキング保存用ファイルのパス
 * @return void
 */
function makeRanking($datafile, $rankingfile, $separate="\t"){
	//----------------------------
	//ファイル全体を配列に格納
	//----------------------------
	$data = file($datafile, FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES);  //http://php.net/manual/ja/function.file.php
	
	//----------------------------
	// ユーザーIDがキーの連想配列を作成
	//----------------------------
	$ranking = [];
	for($i=count($data)-1; $i>=0; $i--){
		list($time, $userid, $score) = explode($separate, $data[$i]);
		
		// すでに連想配列にユーザーIDが存在する場合
		if( array_key_exists($userid, $ranking) ){
			if( $ranking[$userid] > (int)$score ){	//連想配列内のスコアの方が大きければ次へ
				continue;
			}
		}

		$ranking[$userid] = (int)$score;
	}

	//----------------------------
	// 連想配列の値でソートする (キーと値の関係は壊れない)
	//----------------------------
	arsort($ranking);
	$result = [];
	$rank   = 1;
	foreach ($ranking as $key => $value) {
		array_push($result, ['rank'=>$rank, 'userid'=>$key, 'score'=>$value]);
		$rank++;	//同スコアの場合でもランクアップする(手抜き)
	}

	//----------------------------
	// JSONに変換して保存
	//----------------------------
	return(
		file_put_contents($rankingfile, json_encode($result) )
	);
}
