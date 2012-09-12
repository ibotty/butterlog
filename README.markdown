PHP Logging with slightly less butter than you might like
==================

ButterLog is a simple logging facility distributed under the 2-claused BSD license.

In the current incarnation it only logs to the errorlog. In the future it will most likely support logging to external databases.

Example
---------

In the following example, the logging function will capture the context: the calling function, the filename and the linenumber. This is surprisingly performant and does only add fractions of a microsecond to the calling time (on my amd athlon 4050e on 2.1GHz). 

```php
<?php
// all severities more urgent than INFO will be printed.
ButterLog::set_level(ButterLog::INFO);

ButterLog::debug("Where is that stick? Ah there it is!"); // will not print
ButterLog::info("This is for your information. I have a big pointy stick!");

// here we pass an additional object that will be var_dumped.
ButterLog::warn("This is a warning! Please see my big pointy stick", $pointy_stick);

ButterLog::error("Heh! That's not fair. Not a banana!");
ButterLog::fatal("Where is my stick again?");

?>
