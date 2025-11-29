<?php
namespace Src\Application\Utils;
function orderningWeekDayAnalytics($data){
    $days_order = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                            $ordered = array_fill(0, 7, 0);
                            foreach ($data as $row) {
                                    $day = $row['day_name'] ?? '';
                                    $views = (int)($row['total'] ?? 0);
                                    $index = array_search($day, $days_order);
                                    $ordered[$index] = $views;
                            }

    return $ordered;
}
?>
