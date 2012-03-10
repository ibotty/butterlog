<?php
/*
Copyright (c) 2011, 2012, Tobias Florek, Daniel Schwarz.  All rights reserved.

Redistribution and use in source and binary forms, with or without
modification, are permitted provided that the following conditions are met:

   1. Redistributions of source code must retain the above copyright notice,
      this list of conditions and the following disclaimer.

   2. Redistributions in binary form must reproduce the above copyright notice,
      this list of conditions and the following disclaimer in the documentation
      and/or other materials provided with the distribution.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDER ``AS IS'' AND ANY EXPRESS OR
IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO
EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT,
INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF
LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE
OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF
ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */

class ButterLog {
  const DEBUG = 0;
  const INFO = 1;
  const WARN = 2;
  const ERROR = 3;
  const FATAL = 4;

  protected static $lvl = self::DEBUG;

  static function log($severity, $msg, $object=false) {
    if ($severity >= self::$lvl) {
      // the following costs about 6ms on a amd athlon 4050e 2.1GHz
      if (PHP_VERSION_ID >= 54000)
        $backtrace = debug_backtrace(false, 2); // about 1% faster
      else
        $backtrace = debug_backtrace(false);
      $last = $backtrace[1];

      error_log("{$last['function']} ({$last['file']}:{$last['line']}) $msg");
      if ($object)
        error_log(print_r($object, true));
    }
  }

  static function set_level($lvl) {
    self::$lvl = $lvl;
  }

  static function debug($msg, $obj=false) {
    self::log(self::DEBUG, $msg, $obj);
  }

  static function info($msg, $obj=false) {
    self::log(self::INFO, $msg, $obj);
  }

  static function warn($msg, $obj=false) {
    self::log(self::WARN, $msg, $obj);
  }

  static function error($msg, $obj=false) {
    self::log(self::ERROR, $msg, $obj);
  }

  static function fatal($msg, $obj=false) {
    self::log(self::FATAL, $msg, $obj);
  }
}
?>
