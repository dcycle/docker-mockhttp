<?php

namespace myproject\Request;

/**
 * A request.
 */
interface RequestInterface {

  /**
   * Get the path of this request.
   *
   * @return string
   *   A path like '/', or '/hello/world'.
   */
  public function path() : string;

  /**
   * Get a representation of this request as a struct.
   *
   * @return array
   *   An array representing this file.
   */
  public function toStruct() : array;

}
