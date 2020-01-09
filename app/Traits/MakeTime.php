<?php
namespace App\Traits;

trait MakeTime
{
    /**
     * @param $time
     * @return string
     */
    public function makeTime($time_start)
    {
        $time_end = microtime(true);
        $execution_time = $time_end - $time_start;

        $minutes = (int) floor($execution_time / 60);
        $seconds = (int) $execution_time % 60;
        if ($minutes > 0) {
            return $minutes.'m '.$seconds.'s';
        }
        return $seconds.' seconds';
    }
}
