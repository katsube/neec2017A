<?php
/**
 * Echo Server
 *
 * クライアントから入力された文字列をそのまま返却する
 *
 * @author     M.katsube < katsube@winning-section.net >
 * @copyright  M.katsube All Rights reserved
 * @license    The MIT License < https://opensource.org/licenses/mit-license.php >
 */

/*--------------------------------------------------------------------
 * 定数定義
 *--------------------------------------------------------------------*/
define('IPADDRESS', '127.0.0.1');
define('PORT',       10000);

define('SOCK_BACKLOG',       1);
define('SOCK_BUFFREAD_SIZE', 2048);


/*--------------------------------------------------------------------
 * PHPの設定変更
 *--------------------------------------------------------------------*/
print "...Wake up\n";
phpinit();


/*--------------------------------------------------------------------
 * サーバ起動前処理
 *--------------------------------------------------------------------*/
print "...Socket setup\n";

// Socket作成
$sock = socket_create(
                  AF_INET           //IPv4
                , SOCK_STREAM       //通信方式(TCP)
                , SOL_TCP           //TCP
        );

// Socketのオプション設定
socket_set_option($sock, SOL_SOCKET, SO_REUSEADDR, 1);

// IPアドレスとポート番号を紐付け
socket_bind($sock, IPADDRESS, PORT);

// 接続待ち開始
socket_listen($sock, SOCK_BACKLOG);


/*--------------------------------------------------------------------
 * サーバ処理
 *--------------------------------------------------------------------*/
print "...Start Listen\n";
do {
    //------------------------------------
    // リクエストを受け付けた
    //------------------------------------
    $clientsock = socket_accept($sock);

    // 初期メッセージ
    $initmsg =   "\n"
               . "Welcome to My Echo Server.\n"
               . "[Client] ";

    // 初期メッセージ返却
    socket_write($clientsock, $initmsg, strlen($initmsg));
    print "...... Accept Request\n";

    //------------------------------------
    // リクエスト内容を処理
    //------------------------------------
    do {
        //リクエスト内容を読み込む
        $buff = socket_read($clientsock, SOCK_BUFFREAD_SIZE, PHP_NORMAL_READ);
        if( $buff === false ){
            break 2;
        }

        //内容が空ならsocket_read()に戻る
        $buff = trim($buff);
        if( empty($buff) ){
            continue;
        }

        //入力された文字列をクライアントに返却
        $talkback =   "[Server] $buff\n"
                    . "[Client] ";
        socket_write($clientsock, $talkback, strlen($talkback));

        print "...... [Client] $buff\n";
    } while (true);
    
    //------------------------------------
    // リクエストを閉じる
    //------------------------------------
    socket_close($clientsock);
    print "...... Close Request\n";

} while (true);

//------------------------------------
// Socketを閉じる
//------------------------------------
socket_close($sock);
print "... Close Socket\n";

//------------------------------------
// プログラムを終了
//------------------------------------
exit(0);



/**
 * PHP初期設定
 *
 * PHPの設定をサーバ向きに変更する。
 *
 * @access public
 * @param void
 * @return void
 */
function phpinit(){
    error_reporting(E_ALL);      //全てのエラーと警告を表示
    set_time_limit(0);           //スクリプトが実行可能な秒数 0=no limit
    ob_implicit_flush();         //自動フラッシュをオン
}
