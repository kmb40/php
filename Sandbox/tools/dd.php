<?php

function DD()
{
  foreach (func_get_args() as $arg) {
    var_dump($arg);
  }
  exit();
}

DD("Hello World!", 123, ["a", "b", "c"]);