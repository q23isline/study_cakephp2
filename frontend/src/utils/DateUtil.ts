export default class DateUtil {
  /**
   * yyyy/m/d HH:MM:SS 形式の文字列に変換する
   * @param dateTime 日付
   */
  static toDateTimeString(dateTime: Date): string {
    return (
      dateTime.toLocaleDateString("ja-JP") +
      " " +
      dateTime.toLocaleTimeString("ja-JP")
    );
  }
}
