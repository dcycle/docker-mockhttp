<?php

namespace myproject\Formatter;

/**
 * A formatter.
 */
interface FormatterInterface {

  /**
   * Print data in this format.
   *
   * @param array $data
   *   Arbitrary data.
   */
  public function print(array $data);

}
