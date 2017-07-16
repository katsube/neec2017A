# READ ME

Vagrantフォルダ内のhtdocsにすべてコピーし、ブラウザ経由で閲覧してください。

### example
Vagrantを起動し、 http://localhost:8080/security/example へアクセスしてください。
※このファイルの目的は授業内でお話します。

### ranking1
Vagrantを起動、`vagrant ssh`でログインしパーミション(実行権)の設定を行ってください。
```bash
$ cd /vagrant/htdocs/security/ranking1
$ chmod 0666 *.txt
```
その後 http://localhost:8080/security/ranking1 へアクセスしてください。

### ranking2
Vagrantを起動、`vagrant ssh`でログインしパーミション(実行権)の設定を行ってください。
```bash
$ cd /vagrant/htdocs/security/ranking2
$ chmod 0666 *.txt
```
その後 http://localhost:8080/security/ranking2 へアクセスしてください。

### ranking3
Vagrantを起動、`vagrant ssh`でログインし所定のSQLを実行してください。
```bash
$ cd /vagrant/htdocs/security/ranking3
$ mysql -u root -p < init.sql
Password: Neec2017!
```
その後 http://localhost:8080/security/ranking3 へアクセスしてください。

