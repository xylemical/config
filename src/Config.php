<?php

declare(strict_types=1);

namespace Xylemical\Config;

use Xylemical\Config\Exception\ImmutableException;

/**
 * Provides the base configuration class.
 */
class Config implements \ArrayAccess, \Countable, \IteratorAggregate, ConfigInterface {

  /**
   * The configuration source.
   *
   * @var \Xylemical\Config\SourceInterface
   */
  protected SourceInterface $source;

  /**
   * The name.
   *
   * @var string
   */
  protected string $name;

  /**
   * The values.
   *
   * @var array
   */
  protected array $values;

  /**
   * The dirty flag.
   *
   * @var bool
   */
  protected bool $dirty;

  /**
   * Config constructor.
   *
   * @param string $name
   *   The name.
   * @param \Xylemical\Config\SourceInterface $source
   *   The source.
   */
  public function __construct(string $name, SourceInterface $source) {
    $this->source = $source;
    $this->name = $name;
    $this->values = $source->get($name);
  }

  /**
   * Get the name of the configuration.
   *
   * @return string
   *   The name.
   */
  public function getName(): string {
    return $this->name;
  }

  /**
   * {@inheritdoc}
   */
  public function getIterator() {
    return new \ArrayIterator($this->values);
  }

  /**
   * {@inheritdoc}
   */
  public function offsetExists(mixed $offset) {
    return isset($this->values[$offset]);
  }

  /**
   * {@inheritdoc}
   */
  public function offsetGet(mixed $offset) {
    return $this->values[$offset] ?? NULL;
  }

  /**
   * {@inheritdoc}
   */
  public function offsetSet(mixed $offset, mixed $value) {
    if (!($this->source instanceof EditableSourceInterface)) {
      throw new ImmutableException("Attempting to write to {$offset} of immutable configuration.");
    }

    $this->dirty = TRUE;
    $this->values[$offset] = $value;
  }

  /**
   * {@inheritdoc}
   */
  public function offsetUnset(mixed $offset) {
    if (!($this->source instanceof EditableSourceInterface)) {
      throw new ImmutableException("Attempting to remove entry {$offset} of immutable configuration.");
    }

    $this->dirty = TRUE;
    unset($this->values[$offset]);
  }

  /**
   * {@inheritdoc}
   */
  public function count() {
    return count($this->values);
  }

  /**
   * {@inheritdoc}
   */
  public function has(string $name): bool {
    return isset($this->values[$name]);
  }

  /**
   * {@inheritdoc}
   */
  public function get(string $name): mixed {
    return $this->offsetGet($name);
  }

}
