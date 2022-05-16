<?php

declare(strict_types=1);

namespace Xylemical\Config;

use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\PhpUnit\ProphecyTrait;

/**
 * Tests \Xylemical\Config\EditableConfig.
 */
class EditableConfigTest extends TestCase {

  use ProphecyTrait;

  /**
   * Tests sanity.
   */
  public function testSanity(): void {
    $values = NULL;

    $source = $this->prophesize(EditableSourceInterface::class);
    $source->get('foo')->willReturn(['foo' => TRUE]);
    $source->put('foo', Argument::any())->will(function ($args) use (&$values) {
      $values = $args[1];
      return TRUE;
    });
    $source->remove('foo')->will(function ($args) use (&$values) {
      $values = NULL;
      return TRUE;
    });

    $source = $source->reveal();

    $config = new EditableConfig('foo', $source);
    $this->assertEquals('foo', $config->getName());
    $this->assertTrue($config->has('foo'));
    $this->assertFalse($config->has('bar'));
    $this->assertTrue($config->get('foo'));
    $this->assertNull($config->get('bar'));
    $this->assertEquals(['foo' => TRUE], iterator_to_array($config));
    $this->assertEquals(1, count($config));
    $this->assertTrue(isset($config['foo']));
    $this->assertFalse(isset($config['bar']));

    $config['bar'] = TRUE;
    unset($config['foo']);
    $this->assertEquals(['bar' => TRUE], iterator_to_array($config));

    $this->assertNull($values);
    $config->save();
    $this->assertEquals(['bar' => TRUE], $values);

    $config->set('foo', TRUE)
      ->remove('bar');
    $this->assertEquals(['foo' => TRUE], iterator_to_array($config));

    $config->delete();
    $this->assertNull($values);

    $values = ['foo' => TRUE, 'bar' => TRUE];
    $config->setMultiple($values);
    $this->assertEquals($values, iterator_to_array($config));
  }

}
