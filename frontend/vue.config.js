/**
 * @type {import('@vue/cli-service').ProjectOptions}
 * @link https://cli.vuejs.org/config/
 */
module.exports = {
    pages: {
        index: {
            entry: 'src/main.ts'
        }
    },
    // ビルド後にできるファイルを webroot/assets に指定すると img 等のパスがズレて読み込めなくなるので webroot にする
    // （ビルド時に webroot 全消しを防ぐために --no-clean オプションをつけておく）
    // outputDir: '../webroot/assets',
    outputDir: '../webroot',
    // ビルド後にできるファイルは webroot の assets に置く（ただ frontend/public に置いたものは webroot にできる）
    assetsDir: 'assets',
    indexPath: 'assets/index.html',
    // Vue で生成された URL にまで assets が出てくるようになるので指定しない
    // publicPath: 'assets',
    // ビルド後にできるファイル名にハッシュ値つけない（バックエンドで固定値で呼びだせるようにする）
    filenameHashing: false
}
