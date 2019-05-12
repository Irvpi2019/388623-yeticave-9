<?php
    function get_time_in_hours_minutes(string $time) : array
    {

        $diff_time = strtotime($time) - time();
        if ($diff_time <= 0) {
        return [0, 0];
        }
        return [floor($diff_time / 3600), floor($diff_time % 3600 / 60)];
    }

        /**
      * Функция определяющая остаток времени для закрытия лота
      * @param string $lot_time
      * @return string
      */

    function get_time_to_timer(string $lot_time) : string
    {

        list($hours, $minutes) = get_time_in_hours_minutes($lot_time);
        return sprintf("%02d:%02d", $hours, $minutes);
    }

          /**
      * Функция определяющая осталось ли времени меньше часа до закрытия лота
      * @param string $lot_time
      * @return bool
      */

    function is_last_hour(string $lot_time) : bool
    {

        list($hours, $minutes) = get_time_in_hours_minutes($lot_time);
        return $hours < 1;
    }
     ?>
