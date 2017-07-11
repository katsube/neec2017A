const {app, BrowserWindow} = require('electron')
const path = require('path')
const url  = require('url')
let win

/**
 * ウィンドウ作成
 */
function createWindow () {
  // 新規にウィンドウを作成
  win = new BrowserWindow({width: 800, height: 600})  // 縦横のサイズを指定
  win.loadURL(url.format({
    pathname: path.join(__dirname, 'index.html'),     // index.htmlを開く
    protocol: 'file:',
    slashes: true
  }))

  // DevTools(デベロッパーツール)を開く
  // win.webContents.openDevTools()

  // ウィンドウが閉じられたら、インスタンスを破棄。
  win.on('closed', () => {
    win = null
  })
}

//---------------------------------------
// イベント
//---------------------------------------
// 準備が整ったら createWindow() を実行
app.on('ready', createWindow)

// ウィンドウがすべて閉じられたら
app.on('window-all-closed', () => {
  // アプリケーションを終了する
  if (process.platform !== 'darwin') {  //darwin == macOS をのぞく
    app.quit()
  }
})

// macOSでDockアイコンをクリックした場合など
app.on('activate', () => {
  // 再びウィンドウを作成する
  if (win === null) {
    createWindow()
  }
})