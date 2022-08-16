<?php
class Calculator {
    public $start_date_format;//Дата открытия
    public $sum;//Сумма вклада
    public $term;//Срок вклада в месяцах
    public $percent;//процентная ставка
    public $sum_add;//Сумма поплнения вклада
    
    public $start_date;//Дата открытия timestamp
    public $days_year = 365;//дни в году

    
    function validateDate($date, $format = 'd.m.Y')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    public function getResult(){
        $result_value = 0;
        if(
        $this->validateDate($this->start_date_format) &&
        (filter_var($this->sum, FILTER_VALIDATE_INT) && $this->sum >= 1000 && $this->sum <= 3000000) &&
        (filter_var($this->term, FILTER_VALIDATE_INT) && $this->term >= 1 && $this->term <= 60) &&
        (filter_var($this->percent, FILTER_VALIDATE_INT) && $this->percent >= 3 && $this->percent <= 100)
        ){
            if($this->sum_add == 0 || !($this->sum_add >= 0 && $this->sum_add <= 3000000)){
                $this->sum_add = 0;
            } 
            $date_format = $this->start_date;
            for ($i = 0; $i < $this->term; $i++) {
                if ($result_value == 0) {
                    $cur_month_days = cal_days_in_month(CAL_GREGORIAN, date('m', $this->start_date), date('Y', $this->start_date));//кол-во дней в месяце
                    $result_value = (int)($this->sum + ($this->sum + $this->sum_add) * $cur_month_days * ($this->percent / $this->days_year));//результат
                    $date_format = strtotime("+1 MONTH", strtotime($this->start_date_format));
                } else {
                    $cur_month_days = cal_days_in_month(CAL_GREGORIAN, date('m', $date_format), date('Y', $date_format));//кол-во дней в месяце
                    $result_value = (int)($result_value + ($result_value + $this->sum_add) * $cur_month_days * ($this->percent / $this->days_year));//результат
                    $date_format = strtotime("+1 MONTH", $date_format);
                }
            }
            
            $result_sum = [
                "sum" => $result_value
                
            ];
            return json_encode($result_sum);
        } else {
            $result_sum = [
                "sum" => $result_value
                
            ];
            return json_encode($result_sum);
        }

        
    }   
}

$start_date_format = $_POST['startDate'];//Дата открытия
$sum = $_POST['sum'];//Сумма вклада
$term = $_POST['term'];//Срок вклада в месяцах
$percent = $_POST['percent'];//процентная ставка
$sum_add = $_POST['sumAdd'];//Сумма поплнения вклада

$result = new Calculator();
$result->start_date_format = $start_date_format;
$result->sum = $sum;
$result->term = $term;
$result->percent = $percent;
$result->sum_add = $sum_add;
$result->start_date = strtotime($start_date_format);
echo $result->getResult();