<?php

declare(strict_types=1);

namespace Xylemical\Config\Source;

use Xylemical\Config\EditableSourceInterface;

/**
 * Provides an editable configuration using a file.
 */
class EditableConfigFileSource extends ConfigFileSource implements EditableSourceInterface {

  /**
   * {@inheritdoc}
   */
  public function put(string $name, array $value): bool {
    $this->values[$name] = $value;
    return $this->write();
  }

  /**
   * {@inheritdoc}
   */
  public function remove(string $name): bool {
    if (isset($this->values[$name])) {
      unset($this->values[$name]);
      return $this->write();
    }
    return TRUE;
  }

  /**
   * Writes to the file.
   *
   * @return bool
   *   The result.
   */
  protected function write(): bool {
    $contents = '<?' . "php\nreturn ";
    $contents .= var_export($this->values, TRUE);
    $contents .= ";\n";
    return (bool) @file_put_contents($this->filename, $contents);
  }

}
