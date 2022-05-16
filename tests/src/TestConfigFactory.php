<?php

declare(strict_types=1);

namespace Xylemical\Config;

/**
 * A test configuration factory.
 */
class TestConfigFactory implements ConfigFactoryInterface {

  /**
   * The source.
   *
   * @var \Xylemical\Config\SourceInterface
   */
  protected SourceInterface $source;

  /**
   * {@inheritdoc}
   */
  public function __construct(SourceInterface $source) {
    $this->source = $source;
  }

  /**
   * {@inheritdoc}
   */
  public function get(string $name): ConfigInterface {
    return new Config($name, $this->source);
  }

  /**
   * {@inheritdoc}
   */
  public function getEditable(string $name): EditableConfigInterface {
    return new EditableConfig($name, $this->source);
  }

}
