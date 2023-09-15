<?php

namespace myproject\MockResponse;

use myproject\Request\RequestInterface;
use myproject\Response\Response;

/**
 * A mock response.
 */
class MockResponse extends Response {

  /**
   * The parsed YAML.
   *
   * @var array
   */
  protected $yaml;

  /**
   * The response.
   *
   * @var string
   */
  protected $response;

  /**
   * Constructor.
   *
   * @param \myproject\Request\RequestInterface $request
   *   The request.
   * @param array $yaml
   *   The YAML file for metadata.
   * @param string $response
   *   The response as a string.
   */
  public function __construct(RequestInterface $request, array $yaml, string $response) {
    $this->yaml = $yaml;
    $this->response = $response;
    parent::__construct($request);
  }

  /**
   * {@inheritdoc}
   */
  public function code() : int {
    if (array_key_exists('code', $this->yaml)) {
      return $this->yaml['code'];
    }
    return 200;
  }

  /**
   * {@inheritdoc}
   */
  public function printBody() {
    print($this->response);
  }

}
