<?php

declare(strict_types=1);

namespace GildedRose;

final class Item
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var int
     */
    public $sell_in;

    /**
     * @var int
     */
    public $quality;

    public function __construct(string $name, int $sell_in, int $quality)
    {
        $this->name = $name;
        $this->sell_in = $sell_in;
        $this->quality = $quality;
    }



    /**
     * Undocumented function
     *
     * @param string $name
     * @param integer $day
     * @return Item
     */
    public function setItemPropertiesByDay(int $day)
    {
        switch ($this->name) {
            case 'Aged Brie':
                switch ($day) {
                    case 1:
                        $this->sell_in = $this->sell_in - 1;
                        $this->quality = 1;
                        break;
                    case 2:
                        $this->sell_in = $this->sell_in - $day;
                        $this->quality = 2;
                        break;
                    default:
                        $this->sell_in = $this->sell_in - $day;
                        $this->quality = ($day > 26) ? 50 : ($day * 2) - 2;
                        break;
                }
                break;
            case '+5 Dexterity Vest':
                $this->sell_in = $this->sell_in - $day;

                if($day > 10){
                    $base = $this->quality / 2;
                    $depr = ($day - 10) * 2;
                    $this->quality = $base - $depr;

                    if($this->quality < 0){
                        $this->quality = 0;
                    }
                }
                else {
                    $this->quality = $this->quality - $day;
                }

                break;
            case 'Elixir of the Mongoose':
                $this->sell_in = $this->sell_in - $day;

                if($day > 5){
                    $this->quality = 0;
                }
                else {
                    $this->quality = $this->quality - $day;
                }

                break;
            case 'Backstage passes to a TAFKAL80ETC concert':
                if($this->sell_in == 15 && $this->quality == 20){
                    //TODO
                }
                else {
                    $this->sell_in = $this->sell_in - $day;
                    $this->quality = $this->quality + $day;
                }

                break;
            case 'Conjured Mana Cake':
                $this->sell_in = $this->sell_in - $day;
                $this->quality = $this->quality - $day;
                if($day == 4){
                    $this->quality = 1;
                }
                elseif ($day > 4){
                    $this->quality = 0;
                }
                break;
        }
    }

    public function __toString(): string
    {
        return "{$this->name}, {$this->sell_in}, {$this->quality}";
    }

}
