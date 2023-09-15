<?php

use myproject\Request\RequestFactory;
use PHPUnit\Framework\TestCase;

/**
 * Test RequestFactory.
 *
 * @group myproject
 */
class RequestFactoryTest extends TestCase {

  /**
   * Test for pathAndGetToGet().
   *
   * @param string $message
   *   The test message.
   * @param string $input
   *   The input.
   * @param array $expected
   *   The expected result.
   *
   * @cover ::pathAndGetToGet
   * @dataProvider providerPathAndGetToGet
   */
  public function testPathAndGetToGet(string $message, string $input, array $expected) {
    $object = $this->getMockBuilder(RequestFactory::class)
      // NULL = no methods are mocked; otherwise list the methods here.
      ->setMethods([
        'getStringToArray',
      ])
      ->disableOriginalConstructor()
      ->getMock();

    $object->method('getStringToArray')
      ->willReturn(['extra' => 'params']);

    $output = $object->pathAndGetToGet($input);

    if ($output != $expected) {
      print_r([
        'message' => $message,
        'output' => $output,
        'expected' => $expected,
      ]);
    }

    $this->assertTrue($output == $expected, $message);
  }

  /**
   * Provider for testPathAndGetToGet().
   */
  public function providerPathAndGetToGet() {
    return [
      [
        'message' => 'Happy path',
        'input' => '/a/b/c?d=f&a=b',
        'expected' => [
          '_mockhttp_path' => 'a/b/c',
          'extra' => 'params',
        ],
      ],
    ];
  }

  /**
   * Test for getStringToArray().
   *
   * @param string $message
   *   The test message.
   * @param string $input
   *   The input.
   * @param array $expected
   *   The expected result.
   *
   * @cover ::getStringToArray
   * @dataProvider providerGetStringToArray
   */
  public function testGetStringToArray(string $message, string $input, array $expected) {
    $object = $this->getMockBuilder(RequestFactory::class)
      // NULL = no methods are mocked; otherwise list the methods here.
      ->setMethods(NULL)
      ->disableOriginalConstructor()
      ->getMock();

    $output = $object->getStringToArray($input);

    if ($output != $expected) {
      print_r([
        'message' => $message,
        'output' => $output,
        'expected' => $expected,
      ]);
    }

    $this->assertTrue($output == $expected, $message);
  }

  /**
   * Provider for testGetStringToArray().
   */
  public function providerGetStringToArray() {
    return [
      [
        'message' => 'Happy path',
        'input' => 'post_b=c&post_a=z',
        'expected' => [
          'post_b' => 'c',
          'post_a' => 'z',
        ],
      ],
    ];
  }

}
