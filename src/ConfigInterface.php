<?php

declare(strict_types=1);

namespace Xylemical\Config;

/**
 * Provide read only configuration.
 */
interface ConfigInterface {

  /**
   * Get the name of the configuration.
   *
   * @return string
   *   The name.
   */
  public function getName(): string;

  /**
   * Check the configuration has a value.
   *
   * @param string $name
   *   The name.
   *
   * @return bool
   *   The result.
   */
  public function has(string $name): bool;

  /**
   * Get a configuration value.
   *
   * @param string $name
   *   The configuration name.
   *
   * @return mixed
   *   The value or NULL.
   */
  public function get(string $name): mixed;

}
