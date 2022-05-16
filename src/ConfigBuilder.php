<?php

declare(strict_types=1);

namespace Xylemical\Config;

/**
 * Provides the configuration builder.
 */
final class ConfigBuilder {

  /**
   * The configuration source.
   *
   * @var \Xylemical\Config\SourceInterface
   */
  protected SourceInterface $source;

  /**
   * The configuration factory class.
   *
   * @var string
   */
  protected string $class;

  /**
   * The configuration factory.
   *
   * @var \Xylemical\Config\ConfigFactoryInterface
   */
  protected ConfigFactoryInterface $factory;

  /**
   * ConfigBuilder constructor.
   *
   * @param \Xylemical\Config\SourceInterface $source
   *   The source.
   * @param string $class
   *   The configuration factory class.
   */
  public function __construct(SourceInterface $source, string $class = ConfigFactory::class) {
    $this->source = $source;
    $this->class = $class;
  }

  /**
   * Get the factory.
   *
   * @return \Xylemical\Config\ConfigFactoryInterface
   *   The configuration factory.
   */
  public function getFactory(): ConfigFactoryInterface {
    if (!isset($this->factory)) {
      $this->factory = new ($this->class)($this->source);
    }
    return $this->factory;
  }

}
