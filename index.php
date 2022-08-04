<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Депозитный калькулятор</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,700;1,100&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="assets/air-datepicker/air-datepicker.css">
</head>
<body>
<div class="header">
    <div class="header-container">
        <img src="assets/icons/logo-light.svg" class="header-logo" width="87" height="24">
        <div class="header-heading">Deposit Calculator</div>
    </div>
</div>
<div class="main container">
    <h1>Депозитный калькулятор</h1>
    <p class="main-description">Калькулятор депозитов позволяет рассчитать ваши доходы после внесения суммы на счет в
        банке по опредленному тарифу.</p>
    <div class="calc-body">
        <form class="main-form" id="calc" method="post" action="">
            <div class="form-wrapper">
                <div class="custom-input">
                    <input type="text" id="date" name="date" placeholder=" ">
                    <label for="date" class="label-heading">Дата открытия</label>
                </div>
                <div class="custom-input">
                    <input type="number" id="dep_date" name="dep_date" placeholder=" " min="0">
                    <label for="dep_date" class="label-heading">Срок вклада</label>
                    <select class="custom-select" id="select-data">
                        <option value="month">месяц</option>
                        <option value="year">год</option>
                    </select>
                </div>
                <div class="custom-input">
                    <input type="number" id="sum" name="sum" placeholder=" " min="0">
                    <label for="sum" class="label-heading">Сумма вклада</label>
                </div>
                <div class="custom-input">
                    <input type="number" id="percent" name="percent" placeholder=" " min="0">
                    <label for="percent" class="label-heading">Процентная ставка, % годовых</label>
                </div>
                <div class="custom-checkbox">
                    <label for="monthly">
                        <input type="checkbox" id="monthly" placeholder=" ">
                        <span class="custom-checkbox-label">Ежемесячное пополнение вклада</span>
                        <span class="custom__new-checkbox"></span>
                    </label>
                </div>
                <div class="custom-input custom-input__monthly hidden">
                    <input type="number" id="monthly_sum" name="monthly_sum" placeholder=" " min="0" value="0">
                    <label for="monthly_sum" class="label-heading">Сумма пополнения вклада</label>
                </div>
            </div>
            <input type="submit" class="form-submit" value="Рассчитать">
        </form>
        <div class="main-result hidden">
            <hr>
            <p class="main-result-text">Сумма к выплате</p>
            <div class="main-form-result" id="main-form-result">

            </div>
        </div>
    </div>
</div>
</body>


<script src="assets/jquery-3.6.0.min.js"></script>
<script src="assets/air-datepicker/air-datepicker.js"></script>
<script src="assets/jquery-validation-1.19.5/jquery.validate.min.js"></script>
<script src="assets/jquery-validation-1.19.5/localization/messages_ru.js"></script>
<script src="script.js"></script>
</html>