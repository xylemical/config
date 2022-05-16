<?php

declare(strict_types=1);

namespace Xylemical\Config;

/**
 * Provides a generic editable configuration.
 */
class EditableConfig extends Config implements EditableConfigInterface {

  /**
   * {@inheritdoc}
   */
  public function set(string $name, mixed $value): static {
    $this->offsetSet($name, $value);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setMultiple(array $values): static {
    foreach ($values as $key => $value) {
      $this->offsetSet($key, $value);
    }
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function remove(string $name): static {
    $this->offsetUnset($name);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function save(): static {
    if ($this->dirty && $this->source instanceof EditableSourceInterface) {
      $this->source->put($this->getName(), $this->values);
    }
    $this->dirty = FALSE;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function delete(): static {
    if ($this->source instanceof EditableSourceInterface) {
      $this->source->remove($this->getName());
    }
    $this->dirty = FALSE;
    return $this;
  }

}
