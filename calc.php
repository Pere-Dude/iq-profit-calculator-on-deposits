<?php
$startDateFormat = $_POST['startDate'];//Дата открытия
$sum = $_POST['sum'];//Сумма вклада
$term = $_POST['term'];//Срок вклада в месяцах
$percent = $_POST['percent'];//процентная ставка
$sumAdd = $_POST['sumAdd'];//Сумма поплнения вклада

$startDate = strtotime($startDateFormat);//Дата открытия timestamp
$daysY = 365;//дни в году

$result_value = 0;
for ($i = 0; $i < $term; $i++) {
    if ($result_value == 0) {
        $curMonthDays = cal_days_in_month(CAL_GREGORIAN, date('m', $startDate), date('Y', $startDate));//кол-во дней в месяце
        $result_value = (int)($sum + ($sum + $sumAdd) * $curMonthDays * ($percent / $daysY));//результат
        $DateFormat = strtotime("+1 MONTH", strtotime($startDateFormat));
    } else {
        $curMonthDays = cal_days_in_month(CAL_GREGORIAN, date('m', $DateFormat), date('Y', $DateFormat));//кол-во дней в месяце
        $result_value = (int)($result_value + ($result_value + $sumAdd) * $curMonthDays * ($percent / $daysY));//результат
        $DateFormat = strtotime("+1 MONTH", $DateFormat);
    }
}

echo $result_value;
