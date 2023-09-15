<?php

namespace myproject\Response;

use myproject\Request\RequestInterface;
use myproject\traits\DependencyInjection;
use myproject\traits\Environment;
use myproject\traits\Singleton;

/**
 * Response factory.
 */
class ResponseFactory {

  use DependencyInjection;
  use Environment;
  use Singleton;

  /**
   * Gets an appropriate response.
   *
   * @param \myproject\Request\RequestInterface $request
   *   A request.
   *
   * @return \myproject\Response\ResponseInterface
   *   A response.
   */
  public function getResponse(RequestInterface $request) : ResponseInterface {
    if ($request->path() == '/_mockhttp/requests') {
      return new ResponseListOfRequests($request);
    }
    elseif ($request->path() == '/_mockhttp/clear') {
      return new ResponseClear($request);
    }
    elseif ($candidate = $this->mockResponseFactory()->getIfExists($request)) {
      return $candidate;
    }
    else {
      return new ResponseNotFound($request);
    }
  }

}
