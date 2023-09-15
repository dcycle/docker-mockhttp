<?php

namespace myproject\Response;

/**
 * A not found response.
 */
class ResponseNotFound extends Response {

  /**
   * {@inheritdoc}
   */
  public function code() : int {
    return 404;
  }

}
