<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    public function testFoo(): void
    {
        $items = [new Item('foo', 0, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame('foo', $items[0]->name);
    }    
    
    
    /**
     * Test 'Aged Brie' quality for day 1
     *
     * @return void
     */
    public function testContentDay1(): void
    {
        $items = [new Item('Aged Brie', 2, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $this->assertSame(1, $items[0]->sell_in);
        $this->assertSame(1, $items[0]->quality);
    }
    
    /**
     * Test 'Elixir of the Mongoose' quality for day 2
     *
     * @return void
     */
    public function testContentDay2(): void
    {
        $items = [new Item('Elixir of the Mongoose', 4, 6)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $this->assertSame(3, $items[0]->sell_in);
        $this->assertSame(5, $items[0]->quality);
    }
    
    /**
     * Test 'Conjured Mana Cake' quality for day 3
     *
     * @return void
     */
    public function testContentDay3(): void
    {
        $items = [new Item('Conjured Mana Cake', 1, 4)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $this->assertSame(0, $items[0]->sell_in);
        $this->assertSame(3, $items[0]->quality);
    }
}
