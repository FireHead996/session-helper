<?php

declare(strict_types=1);

namespace Firehead996\SessionHelper\Tests;

use PHPUnit\Framework\TestCase;

use Firehead996\SessionHelper\SessionInterface;
use Firehead996\SessionHelper\SessionHelper;

class SessionHelperTest extends TestCase
{
    private SessionInterface $helper;

    protected function setUp(): void {
        $_SESSION = [
            'a' => 'a',
            'b' => 'b',
            'c' => 'c'
        ];

        $this->helper = new SessionHelper();
    }

    public function testExists(): void
    {
        $this->assertTrue($this->helper->exists('a'));
        $this->assertFalse($this->helper->exists('aa'));

        $this->assertTrue(isset($this->helper->b));
        $this->assertFalse(isset($this->helper->bb));

        $this->assertTrue(isset($this->helper['c']));
        $this->assertFalse(isset($this->helper['cc']));
    }

    public function testGet(): void
    {
        $this->assertSame('a', $this->helper->get('a'));
        $this->assertNull($this->helper->get('aa'));
        $this->assertSame('aaa', $this->helper->get('aaa', 'aaa'));

        $this->assertSame('b', $this->helper->b);
        $this->assertNull($this->helper->bb);

        $this->assertSame('c', $this->helper['c']);
        $this->assertNull($this->helper['cc']);
    }

    public function testSet(): void
    {
        $_SESSION = [];

        $this->helper->set('a', 'a');
        $this->assertSame(['a' => 'a'], $_SESSION);

        $this->helper->b = 'b';
        $this->assertSame(['a' => 'a', 'b' => 'b'], $_SESSION);

        $this->helper['c'] = 'c';
        $this->assertSame(['a' => 'a', 'b' => 'b', 'c' => 'c'], $_SESSION);
    }

    public function testDelete(): void
    {
        $this->helper->delete('aa');
        $this->assertSame(['a' => 'a', 'b' => 'b', 'c' => 'c'], $_SESSION);

        $this->helper->delete('a');
        $this->assertSame(['b' => 'b', 'c' => 'c'], $_SESSION);

        unset($this->helper->bb);
        $this->assertSame(['b' => 'b', 'c' => 'c'], $_SESSION);

        unset($this->helper->b);
        $this->assertSame(['c' => 'c'], $_SESSION);

        unset($this->helper['cc']);
        $this->assertSame(['c' => 'c'], $_SESSION);

        unset($this->helper['c']);
        $this->assertSame([], $_SESSION);
    }

    public function testClear(): void
    {
        $this->helper->clear();
        $this->assertEmpty($_SESSION);
    }
}