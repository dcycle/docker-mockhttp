<?php

namespace myproject;

use myproject\traits\DependencyInjection;
use myproject\traits\Environment;
use myproject\traits\Singleton;

/**
 * Encapsulated code for the application.
 */
class App {

  use DependencyInjection;
  use Environment;
  use Singleton;

  const DEBUG_FLAG = 'DEBUG';

  /**
   * Prints the square root of the number of files in a directory.
   *
   * This method is admittedly useless, but it is meant to demonstrate how
   * a method which uses externalities via the Environment trait can be
   * tested.
   *
   * @throws \Exception
   */
  public function run() {
    $request = $this
      ->requestFactory()
      ->fromCurrent();
    $this
      ->responseFactory()
      ->getResponse($request)
      ->run();
  }

  /**
   * Check whether a given request is in memory.
   *
   * @param array $argv
   *   The command line arguments.
   *
   * @throws \Exception
   */
  public function check(array $argv) {
    $pathAndGet = $this->commandLineArgs()->get($argv, 1);
    $post = $this->commandLineArgs()->get($argv, 2, required: FALSE);
    $debug = $this->commandLineArgs()->get($argv, 3, required: FALSE);

    $request = $this
      ->requestFactory()
      ->fromPathAndGetAndPost($pathAndGet, $post);

    $this->requestList()
      ->assertRequestInMemory($request, $debug == self::DEBUG_FLAG);
  }

}
