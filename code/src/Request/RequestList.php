<?php

namespace myproject\Request;

use myproject\Request\RequestInterface;
use myproject\traits\Environment;
use myproject\traits\Singleton;

/**
 * Request list.
 */
class RequestList {

  use Environment;
  use Singleton;

  const REQUESTS_FILE = '/tmp/allRequests.json';

  /**
   * Remember the current request.
   *
   * @param \myproject\Request\RequestInterface $request
   *   A request.
   */
  public function remember(RequestInterface $request) {
    $all = $this->allRequests();
    $all[] = $request->toStruct();
    $this->save($all);
  }

  /**
   * Get all requests.
   *
   * @return array
   *   All requests.
   */
  public function allRequests() : array {
    if (!file_exists(SELF::REQUESTS_FILE)) {
      return [];
    }
    $contents = file_get_contents(SELF::REQUESTS_FILE);
    return json_decode($contents, TRUE);
  }

  /**
   * Save all requests, overwriting existing.
   *
   * @param array struct
   *   All requests to save.
   */
  public function save(array $struct) {
    file_put_contents(SELF::REQUESTS_FILE, json_encode($struct));
  }

  /**
   * Assert that a request is in memory.
   *
   * @param \myproject\Request\RequestInterface $request
   *   A request.
   * @param bool $debug
   *   Whether to print debugging information.
   *
   * @throws \Exception
   *   If a request is not found.
   */
  public function assertRequestInMemory(RequestInterface $request, bool $debug = FALSE) {
    $requests = $this->allRequests();

    foreach ($requests as $requestInMemory) {
      if ($requestInMemory == $request->toStruct()) {
        print_r('Request has been found!');
        return;
      }
      elseif ($debug) {
        print_r('' . PHP_EOL);
        print_r('We have just compared the following two requests and found them to not match.' . PHP_EOL);
        print_r('' . PHP_EOL);
        print_r('REQUEST IN MEMORY' . PHP_EOL);
        print_r('' . PHP_EOL);
        print_r($requestInMemory);
        print_r('' . PHP_EOL);
        print_r('REQUEST TO CHECK FOR' . PHP_EOL);
        print_r('' . PHP_EOL);
        print_r($request->toStruct());
        print_r('' . PHP_EOL);
      }
    }

    throw new \Exception('Request has not been found :(');
  }

  /**
   * Clear all requests.
   */
  public function clear() {
    $this->save([]);
  }

}
