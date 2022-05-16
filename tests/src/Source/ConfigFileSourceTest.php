<?php

declare(strict_types=1);

namespace Xylemical\Config\Source;

use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use PHPUnit\Framework\TestCase;

/**
 * Tests \Xylemical\Config\Source\ConfigFileSource.
 */
class ConfigFileSourceTest extends TestCase {

  /**
   * The root directory.
   *
   * @var \org\bovigo\vfs\vfsStreamDirectory
   */
  protected vfsStreamDirectory $root;

  /**
   * {@inheritdoc}
   */
  public function setUp(): void {
    vfsStream::setup();
    $this->root = vfsStream::create([
      'config.php' => '<?p' . "hp\nreturn ['foo' => ['foo' => TRUE]];\n",
    ]);
  }

  /**
   * Test sanity.
   */
  public function testSanity(): void {
    $baseUrl = $this->root->url();
    $source = new ConfigFileSource("{$baseUrl}/config.php");
    $this->assertTrue($source->has('foo'));
    $this->assertFalse($source->has('bar'));
    $this->assertEquals(['foo' => TRUE], $source->get('foo'));
    $this->assertEquals([], $source->get('bar'));

    $source = new ConfigFileSource("{$baseUrl}/config1.php");
    $this->assertFalse($source->has('foo'));
    $this->assertFalse($source->has('bar'));
    $this->assertEquals([], $source->get('foo'));
    $this->assertEquals([], $source->get('bar'));
  }

}
