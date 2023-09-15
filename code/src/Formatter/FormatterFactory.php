<?php

namespace myproject\Formatter;

use myproject\traits\Environment;
use myproject\traits\Singleton;

/**
 * Formatter factory.
 */
class FormatterFactory {

  use Environment;
  use Singleton;

  /**
   * Makes a formatter object from a formatter name.
   *
   * @param string $name
   *   A name such as 'print_r' or 'json'.
   *
   * @return \myproject\Formatter\FormatterInterface
   *   A formatter.
   */
  public function fromName(string $name) : FormatterInterface {
    switch ($name) {
      case 'print_r':
        return new PrintRFormatter();

      case 'json':
        return new JsonFormatter();

      default:
        throw new \Exception('Unknown formatter ' . $name);
    }
  }

}
