<?php

declare(strict_types=1);

namespace Xylemical\Config;

/**
 * Provides a configuration factory.
 */
interface ConfigFactoryInterface {

  /**
   * ConfigFactoryInterface constructor.
   *
   * @param \Xylemical\Config\SourceInterface $source
   *   The source.
   */
  public function __construct(SourceInterface $source);

  /**
   * Get the configuration.
   *
   * @param string $name
   *   The name.
   *
   * @return \Xylemical\Config\ConfigInterface
   *   The configuration.
   */
  public function get(string $name): ConfigInterface;

  /**
   * Get an editable configuration.
   *
   * @param string $name
   *   The name.
   *
   * @return \Xylemical\Config\EditableConfigInterface
   *   The editable configuration.
   */
  public function getEditable(string $name): EditableConfigInterface;

}
