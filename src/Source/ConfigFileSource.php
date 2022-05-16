<?php

declare(strict_types=1);

namespace Xylemical\Config\Source;

use Xylemical\Config\SourceInterface;

/**
 * Provides a basic configuration file.
 */
class ConfigFileSource implements SourceInterface {

  /**
   * The filename.
   *
   * @var string
   */
  protected string $filename;

  /**
   * The values.
   *
   * @var array
   */
  protected array $values;

  /**
   * ConfigFileSource constructor.
   *
   * @param string $filename
   *   The filename.
   */
  public function __construct(string $filename) {
    $this->filename = $filename;
  }

  /**
   * Get the values.
   *
   * @return array
   *   The values.
   */
  protected function getValues(): array {
    if (isset($this->values)) {
      return $this->values;
    }

    if (!file_exists($this->filename)) {
      $this->values = [];
      return $this->values;
    }

    $this->values = include $this->filename;
    return $this->values;
  }

  /**
   * {@inheritdoc}
   */
  public function has(string $name): bool {
    $values = $this->getValues();
    return isset($values[$name]);
  }

  /**
   * {@inheritdoc}
   */
  public function get(string $name): array {
    $values = $this->getValues();
    return $values[$name] ?? [];
  }

}
