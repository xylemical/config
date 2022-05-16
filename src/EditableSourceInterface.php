<?php

declare(strict_types=1);

namespace Xylemical\Config;

/**
 * Provides an editable source.
 */
interface EditableSourceInterface extends SourceInterface {

  /**
   * Put the editable source.
   *
   * @param string $name
   *   The name.
   * @param array $value
   *   The values.
   *
   * @return bool
   *   The success result.
   */
  public function put(string $name, array $value): bool;

  /**
   * Removes a configuration value.
   *
   * @param string $name
   *   The name.
   *
   * @return bool
   *   The success result.
   */
  public function remove(string $name): bool;

}
