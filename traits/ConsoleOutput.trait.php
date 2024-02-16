<?php
/**
 * Trait with helper methods to print colored messages to console
 * 
 * @method clog
 * @method clog_success
 * @method clog_info
 * @method clog_error
 * @method clog_warning
 */
trait ConsoleOutput {
  public static function clog_success(string $msg) {print "\n\033[32m[SUCCESS]\033[0m $msg";}
  public static function clog_info(string $msg) {print "\n\033[36m[INFO]\033[0m $msg";}
  public static function clog_error(string $msg) {print "\n\033[31m[ERROR]\033[0m $msg";}
  public static function clog_warning(string $msg) {print "\n\033[33m[WARNING]\033[0m $msg";}
  public static function clog(string $msg) {print "\n$msg"; }
}
?>