<?php

namespace myproject\Formatter;

/**
 * A json formatter.
 */
class JsonFormatter implements FormatterInterface {

  /**
   * {@inheritdoc}
   */
  public function print(array $data) {
    print(json_encode($data));
  }

}
