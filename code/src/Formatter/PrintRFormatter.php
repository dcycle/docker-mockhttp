<?php

namespace myproject\Formatter;

/**
 * A print_r formatter.
 */
class PrintRFormatter implements FormatterInterface {

  /**
   * {@inheritdoc}
   */
  public function print(array $data) {
    print_r($data);
  }

}
