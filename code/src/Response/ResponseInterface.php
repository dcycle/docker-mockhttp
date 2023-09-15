<?php

namespace myproject\Response;

/**
 * A response.
 */
interface ResponseInterface {

  /**
   * Run this response, printing anything necessary to the screen.
   */
  public function run();

}
