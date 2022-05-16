<?php

declare(strict_types=1);

namespace Xylemical\Config;

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Xylemical\Config\Exception\ImmutableException;

/**
 * Tests \Xylemical\Config\Config.
 */
class ConfigTest extends TestCase {

  use ProphecyTrait;

  /**
   * Tests sanity.
   */
  public function testSanity(): void {
    $source = $this->prophesize(SourceInterface::class);
    $source->get('foo')->willReturn(['foo' => TRUE]);
    $source = $source->reveal();

    $config = new Config('foo', $source);
    $this->assertEquals('foo', $config->getName());
    $this->assertTrue($config->has('foo'));
    $this->assertFalse($config->has('bar'));
    $this->assertTrue($config->get('foo'));
    $this->assertNull($config->get('bar'));
    $this->assertEquals(['foo' => TRUE], iterator_to_array($config));
    $this->assertEquals(1, count($config));
    $this->assertTrue(isset($config['foo']));
    $this->assertFalse(isset($config['bar']));

    $exception = FALSE;
    try {
      $config['bar'] = TRUE;
    }
    catch (ImmutableException $e) {
      $exception = TRUE;
    }
    $this->assertTrue($exception);

    $exception = FALSE;
    try {
      unset($config['foo']);
    }
    catch (ImmutableException $e) {/* @phpstan-ignore-line */
      $exception = TRUE;
    }
    $this->assertTrue($exception);
  }

}
