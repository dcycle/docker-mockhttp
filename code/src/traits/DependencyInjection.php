<?php

namespace myproject\traits;

use myproject\CommandLineArgs\CommandLineArgs;
use myproject\Formatter\FormatterFactory;
use myproject\Request\RequestFactory;
use myproject\Request\RequestList;
use myproject\Response\ResponseFactory;

/**
 * Trait allowing injection of dependency singletons.
 */
trait DependencyInjection {

  /**
   * Mockable wrapper around CommandLineArgs::instance();.
   */
  public function commandLineArgs() {
    return CommandLineArgs::instance();
  }

  /**
   * Mockable wrapper around FormatterFactory::instance();.
   */
  public function formatterFactory() {
    return FormatterFactory::instance();
  }

  /**
   * Mockable wrapper around ResponseFactory::instance();.
   */
  public function responseFactory() {
    return ResponseFactory::instance();
  }

  /**
   * Mockable wrapper around RequestFactory::instance();.
   */
  public function requestFactory() {
    return RequestFactory::instance();
  }

  /**
   * Mockable wrapper around RequestList::instance();.
   */
  public function requestList() {
    return RequestList::instance();
  }

}
