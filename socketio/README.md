# README

## セットアップ
ネットワークにつながっている環境で、以下のコマンドを実行してください。
```bash
# カレントディレクトリを移動
$ cd socketio

# Node.jsが必要とするライブラリ群をすべてダウンロード (14M程度)
$ npm install
```

## 実行方法
### example, chat, charmove
appディレクトリに下にあるJavaScript(xxx.js)をNode.jsを通して実行してください。
```bash
$ cd socketid
$ node app/charmove/charmove.js
listening on *:3000
```

次にGoogleChromeなどのWebブラウザを開き、`http://localhost:3000` へアクセスすると実行結果が閲覧できます。chat, charmoveは複数のウィンドウ(タブ)を開いて動作を確認してください。

### mysql
Node.jsで実行する前に、事前にVagrantの設定が必要です。
`app/mysql/mysql1.js`の冒頭に記載してある設定を行った後に、Node.jsを実行してください。

事前準備の手順は以下。
<pre>
  1. Vagrantfileに以下の行を追加
       config.vm.network "forwarded_port", guest: 3306, host: 13306

2. Vagrant起動
       PowerShellを起動しvagrantのディレクトリまで移動。
       コマンドを打って起動する。
           まだ起動していない場合→ vagrant up      (起動)
           すでに起動している場合→ vagrant reload  (再起動)

  3. Vagrantへログイン
	   vagrant ssh

  4. MySQLを起動しデータベース、テーブル作成、サンプルデータを挿入する
	   $ mysql -u root -p
	   Enter password: Neec2017!

	   mysql> create database sample;
	   mysql> use sample;
	   mysql> create table books (id int not null AUTO_INCREMENT, title varchar(64), PRIMARY KEY(id)); 
	   mysql> insert into books(title) values('羊をめぐる冒険');
 	   mysql> insert into books(title) values('ねじまき鳥クロニクル');
	   mysql> insert into books(title) values('海辺のカフカ');

	   mysql> select * from books;
	   +----+--------------------------------+
	   | id | title                          |
	   +----+--------------------------------+
	   |  1 | 羊をめぐる冒険                 |
	   |  2 | ねじまき鳥クロニクル           |
	   |  3 | 海辺のカフカ                   |
	   +----+--------------------------------+

5. 新規にユーザーを作成し権限付与する
	   mysql> CREATE USER vagrant@'%' IDENTIFIED BY 'V@grant2017';
	   mysql> GRANT ALL ON sample.* TO vagrant@'%';

6. vagrantを抜ける
	   mysql> \q
	   $ exit
</pre>

事前準備が終わったら、他と同様に実行します。
```bash
$ cd socketid
$ node app/mysql/mysql1.js
1:羊をめぐる冒険
2:ねじまき鳥クロニクル
3:海辺のカフカ

$ node app/mysql/mysql2.js 
Suuceess insert!

$ node app/mysql/mysql1.js 
1:羊をめぐる冒険
2:ねじまき鳥クロニクル
3:海辺のカフカ
4:騎士団長殺し
```
サンプル`mysql`はブラウザを使用せず、コマンドラインで完結します。
