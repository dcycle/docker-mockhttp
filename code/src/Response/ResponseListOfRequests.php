<?php

namespace myproject\Response;

/**
 * A list of requests.
 */
class ResponseListOfRequests extends ResponseFormatted {

  /**
   * {@inheritdoc}
   */
  public function body() : array {
    return $this->requestList()->allRequests();
  }

}
