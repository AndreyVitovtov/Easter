<?php


class Easter
{
    private $year;
    private $arr = [];

    private function calculations()
    {
        $this->arr['a'] = $this->year % 19;
        $this->arr['b'] = $this->year % 4;
        $this->arr['c'] = $this->year % 7;
        $this->arr['d'] = (19 * $this->arr['a'] + 15) % 30;
        $this->arr['e'] = (2 * $this->arr['b'] + 4 * $this->arr['c'] + 6 * $this->arr['d'] + 6) % 7;
        $this->arr['f'] = $this->arr['d'] + $this->arr['e'];
        $this->arr['g'] = 22 + $this->arr['f'];
    }

    public function getDate(int $year, bool $timestamp = false)
    {
        $this->year = intval($year);
        $this->calculations();
        if ($this->arr['g'] > 31) {
            $this->arr['g'] = $this->arr['d'] + $this->arr['e'] - 9;
            $day = $this->arr['g'] + 13;
            if ($day >= 31) {
                $day -= 30;
                $date = strtotime($day . '.05.' . $this->year);
            } else {
                $date = strtotime($day . '.04.' . $this->year);
            }
        } else {
            $day = $this['g'] + 13;
            if ($day > 31) {
                $day = $day - 31;
                $date = strtotime($day . '.04.' . $this->year);
            } else {
                $date = strtotime($day . '.03.' . $this->year);
            }
        }
        return ($timestamp) ? $date : date('d.m.Y', $date);
    }
}
