<?php

declare(strict_types=1);

namespace Xylemical\Config;

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

/**
 * Tests \Xylemical\Config\ConfigBuilder.
 */
class ConfigBuilderTest extends TestCase {

  use ProphecyTrait;

  /**
   * Tests sanity.
   */
  public function testSanity(): void {
    $source = $this->prophesize(SourceInterface::class);
    $builder = new ConfigBuilder($source->reveal(), TestConfigFactory::class);

    $factory = $builder->getFactory();
    $this->assertInstanceOf(TestConfigFactory::class, $factory);
  }

}
