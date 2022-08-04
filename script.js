$(document).ready(function () {
    new AirDatepicker('#date', {
        buttons: ['today', 'clear'],
        locale: {
            today: 'Today',
            clear: 'Clear',
            dateFormat: 'dd.MM.yyyy',
            firstDay: 0
        }
    });

    $('#monthly').on('change', function () {
        $('.custom-input__monthly').toggleClass('hidden');
    });

    $('#select-data').on('change', function () {
        if ($('#select-data').val() == 'year') {
            $('#dep_date').attr('name', 'dep_date_y');
        } else {
            $('#dep_date').attr('name', 'dep_date');
        }
    });

    $.validator.addMethod("anyDate",
        function(value, element) {
            return value.match(/^(0?[1-9]|[12][0-9]|3[0-1])[/., -](0?[1-9]|1[0-2])[/., -](19|20)?\d{2}$/);
        }
    );

    $("#calc").validate({
        submitHandler: function () {
            $('.main-result').removeClass('hidden');
            let dep_date = parseInt($('#dep_date').val());
            if ($('#select-data').val() == 'year') {
                dep_date *= 12;
            }
            let monthly_sum;
            if (!$('#monthly').prop('checked')) {
                monthly_sum = 0;
            } else {
                monthly_sum = $('#monthly_sum').val();
            }

            $.ajax({
                url: 'calc.php',
                type: 'post',
                dataType: 'json',
                data: {
                    startDate: $('#date').val(),
                    sum: $('#sum').val(),
                    term: dep_date,
                    percent: $('#percent').val(),
                    sumAdd: monthly_sum
                },
                success: function (data) {
                    var result = JSON.parse(data);
                    $('#main-form-result').text('₽ ' + data);
                }
            });
        },
        rules: {
            date: {
                required: true,
                anyDate: true
                    //date: true
            },
            sum: {
                required: true,
                min: 1000,
                max: 3000000
            },
            dep_date: {
                required: true,
                min: 1,
                max: 60
            },
            dep_date_y: {
                required: true,
                min: 1,
                max: 5
            },
            monthly_sum: {
                min: 0,
                max: 3000000
            },
            percent: {
                required: true,
                min: 3,
                max: 100
            }
        },
        messages: {
            date: "",
            sum: "",
            dep_date: "Не более 5-ти лет",
            dep_date_y: "Не более 5-ти лет",
            monthly_sum: "",
            percent: "",
        }
    });
});