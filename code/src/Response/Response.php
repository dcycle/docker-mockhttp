<?php

namespace myproject\Response;

use myproject\Request\RequestInterface;
use myproject\traits\DependencyInjection;

/**
 * A response.
 */
abstract class Response implements ResponseInterface {

  use DependencyInjection;

  /**
   * The request.
   *
   * @var \myproject\Request\RequestInterface
   */
  protected $request;

  /**
   * Constructor.
   *
   * @param type $x
   *   What
   */
  public function __construct(RequestInterface $request) {
    $this->request = $request;
  }

  /**
   * {@inheritdoc}
   */
  public function run() {
    if ($this->remember()) {
      $this
      ->requestList()
      ->remember($this->request);
    }

    http_response_code($this->code());
    $this->printBody();
  }

  /**
   * Get the response code for this request.
   *
   * @return int
   *   The response code for this request.
   */
  abstract public function code() : int;

  /**
   * Whether this response should be remembered.
   */
  public function remember() : bool {
    return TRUE;
  }

  /**
   * Print the body of the response;
   */
  public function printBody() {
    // By default responses print nothing.
  }

}
