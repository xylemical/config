<?php

declare(strict_types=1);

namespace Xylemical\Config;

use PHPUnit\Framework\TestCase;

/**
 * Tests \Xylemical\Config\ConfigFactory.
 */
class ConfigFactoryTest extends TestCase {

  /**
   * Tests sanity.
   */
  public function testSanity(): void {
    $source = $this->getMockBuilder(SourceInterface::class)->getMock();
    $factory = new ConfigFactory($source);

    $this->assertInstanceOf(Config::class, $factory->get('test'));
    $this->assertNotInstanceOf(EditableConfig::class, $factory->get('test'));
    $this->assertInstanceOf(EditableConfig::class, $factory->getEditable('test'));
  }

}
