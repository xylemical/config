<?php

declare(strict_types=1);

namespace Xylemical\Config;

/**
 * Provides a configuration source.
 */
interface SourceInterface {

  /**
   * Check the source contains configuration by name.
   *
   * @param string $name
   *   The name.
   *
   * @return bool
   *   The result.
   */
  public function has(string $name): bool;

  /**
   * Get the configuration.
   *
   * @param string $name
   *   The name.
   *
   * @return array
   *   The contents.
   */
  public function get(string $name): array;

}
