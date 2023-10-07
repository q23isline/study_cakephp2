/**
 * @type {import('@vue/cli-service').ProjectOptions}
 * @link https://cli.vuejs.org/config/
 */
module.exports = {
  pages: {
    index: {
      entry: "src/main.ts",
    },
  },
  // webroot は NGINX や Node.js コンテナでマウントしているのでディレクトリを消さないようにビルド時に --no-clean オプションをつける
  outputDir: "../webroot",
  // ビルド後にできるファイル名にハッシュ値つけない（バックエンドで固定値で呼びだせるようにする）
  filenameHashing: false,
};
