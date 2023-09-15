<?php

namespace myproject\Request;

use myproject\traits\Environment;
use myproject\traits\Singleton;

/**
 * Request factory.
 */
class RequestFactory {

  use Environment;
  use Singleton;

  /**
   * Makes a request object from the current request.
   *
   * @return \myproject\Request\RequestInterface
   *   A request.
   */
  public function fromCurrent() : RequestInterface {
    return $this->fromGetAndPost(get: $_GET, post: $_POST);
  }

  /**
   * Makes a request object from the current request.
   *
   * @param string $get
   *   Get parameters.
   * @param string $post
   *   Post parameters.

   * @return \myproject\Request\RequestInterface
   *   A request.
   */
  public function fromGetAndPost(array $get, array $post) : RequestInterface {
    return new Request(get: $get, post: $post);
  }

  /**
   * Get request from a path and get and post parameters from the command line.
   *
   * @param string $pathAndGet
   *   A path and get parameters, for example /a/b/c?d=f&a=b.
   * @param string $post
   *   Post parameters such as post_b=c&post_a=z or an empty string.
   *
   * @return \myproject\Request\RequestInterface
   *   A request.
   */
  public function fromPathAndGetAndPost(string $pathAndGet, string $post = '') : RequestInterface {
    return new Request(
      get: $this->pathAndGetToGet($pathAndGet),
      post: $this->getStringToArray($post),
    );
  }

  /**
   * Get an array from path and get parameters from the command line.
   *
   * @param string $pathAndGet
   *   A path and get parameters, for example /a/b/c?d=f&a=b.
   *
   * @return array
   *   The path and get parameters as an array.
   */
  public function pathAndGetToGet(string $pathAndGet) : array {
    $ret = [];
    $parts = explode('?', $pathAndGet);

    $path = $parts[0];
    if (str_starts_with($path, '/')) {
      $path = substr($path, strlen('/'));
    }

    return array_merge([
      '_mockhttp_path' => $path,
    ], $this->getStringToArray($parts[1]));
  }

  /**
   * Get an array from parameters as a string
   *
   * @param string $string
   *   String parameters such as post_b=c&post_a=z or an empty string.
   *
   * @return array
   *   The post parameters as an array.
   */
  public function getStringToArray(string $string) : array {
    $ret = [];

    $parts = explode('&', $string);

    foreach ($parts as $part) {
      $partParts = explode('=', $part);
      $ret[$partParts[0]] = $partParts[1];
    }

    return $ret;
  }

}
