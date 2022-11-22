<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{   
    /**
     * Test hardcoded values against function
     *
     * @return void
     */
    public function testDateIncrease(): void
    {
        /** day 8 */
        $item = new Item('Aged Brie', 2, 0);
        $item->setItemPropertiesByDay(8);
        $this->assertSame(-6, $item->sell_in);
        $this->assertSame(14, $item->quality);

        /** day 13 */
        $item = new Item('Aged Brie', 2, 0);
        $item->setItemPropertiesByDay(13);
        $this->assertSame(-11, $item->sell_in);
        $this->assertSame(24, $item->quality);

        /** day 23 */
        $item = new Item('Aged Brie', 2, 0);
        $item->setItemPropertiesByDay(23);
        $this->assertSame(-21, $item->sell_in);
        $this->assertSame(44, $item->quality);

        /** day 30 */
        $item = new Item('Aged Brie', 2, 0);
        $item->setItemPropertiesByDay(30);
        $this->assertSame(-28, $item->sell_in);
        $this->assertSame(50, $item->quality);
    }

    /**
     * Test guilded rose update function against fixture data
     *
     * @return void
     */
    public function testGuiledRose(): void
    {
        $this->item('+5 Dexterity Vest', 10, 20);
        $this->item('Aged Brie', 2, 0);
        $this->item('Elixir of the Mongoose', 5, 7);
        $this->item('Sulfuras, Hand of Ragnaros', 0, 80);
        $this->item('Sulfuras, Hand of Ragnaros', -1, 80);
        // $this->item('Backstage passes to a TAFKAL80ETC concert', 15, 20);
        // $this->item('Backstage passes to a TAFKAL80ETC concert', 10, 49);
        // $this->item('Backstage passes to a TAFKAL80ETC concert', 5, 49);
        $this->item('Conjured Mana Cake', 3, 6);
    }

    private function item($name, $sellin, $quality): void
    {
        $items = [new Item($name, $sellin, $quality)];

        for($day = 1; $day <= 30; $day++){
            $testItem = new Item($name, $sellin, $quality);
            $testItem->setItemPropertiesByDay($day);

            $gildedRose = new GildedRose($items);
            $gildedRose->updateQuality();

            $this->assertSame($testItem->sell_in, $items[0]->sell_in);
            $this->assertSame($testItem->quality, $items[0]->quality);
        }

    }
}
