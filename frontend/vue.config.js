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
    outputDir: '../webroot',
    // ビルド後にできるファイル名にハッシュ値つけない（バックエンドで固定値で呼びだせるようにする）
    filenameHashing: false
}
