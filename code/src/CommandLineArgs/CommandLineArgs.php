<?php

namespace myproject\CommandLineArgs;

use myproject\traits\Environment;
use myproject\traits\Singleton;

/**
 * Command line arguments.
 */
class CommandLineArgs {

  use Environment;
  use Singleton;

  /**
   * Get a command line argument, or return an empty string.
   *
   * @param array $argv
   *   The command line arguments.
   * @param int $position
   *   A position such as 1 or 2 (0 being the script name).
   * @param bool $required
   *   Whether this argument is required.
   *
   * @return string
   *   The value.
   */
  public function get(array $argv, int $position, bool $required = TRUE) : string {
    if (empty($argv[$position])) {
      if ($required) {
        throw new \Exception('An argument in position ' . $position . ' is required.');
      }
      return '';
    }
    return $argv[$position];
  }

}
