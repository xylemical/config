<?php

declare(strict_types=1);

namespace Xylemical\Config;

/**
 * Provide a read-write configuration.
 */
interface EditableConfigInterface extends ConfigInterface {

  /**
   * Set a configuration value.
   *
   * @param string $name
   *   The name.
   * @param mixed $value
   *   The value.
   *
   * @return $this
   */
  public function set(string $name, mixed $value): static;

  /**
   * Sets multiple configuration values.
   *
   * @param array $values
   *   The values.
   *
   * @return $this
   */
  public function setMultiple(array $values): static;

  /**
   * Remove a configuration value.
   *
   * @param string $name
   *   The name.
   *
   * @return $this
   */
  public function remove(string $name): static;

  /**
   * Save the configuration.
   *
   * @return $this
   */
  public function save(): static;

  /**
   * Delete the configuration.
   *
   * @return $this
   */
  public function delete(): static;

}
