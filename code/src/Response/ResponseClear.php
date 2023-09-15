<?php

namespace myproject\Response;

/**
 * Clear requests.
 */
class ResponseClear extends ResponseFormatted {

  /**
   * {@inheritdoc}
   */
  public function body() : array {
    $this->requestList()->clear();
    return [
      'All responses cleared',
    ];
  }

}
