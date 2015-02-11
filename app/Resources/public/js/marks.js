rules = {};

$('.ui.form .lesson-mark').each(function() {
    id = $(this).attr('id');

    rules['mark' + id] = {
        identifier: id,
        rules: [
            {
                type: 'integer[1..20]'
            }
        ]
    }
});

$('.ui.form').form(rules, {
    on: 'blur'
});

function supportsHtml5Storage() {
    try {
        return 'localStorage' in window && window['localStorage'] !== null;
    } catch (e) {
        return false;
    }
}

function getSum(array) {
    ret = 0;
    array.forEach(function(element) {
        ret += element;
    });

    return ret;
}

function updateRationalScore(big, numerator, denominator) {
    $("#mark-large-score").text(big);
    $("#mark-enumerator").text(numerator);
    $("#mark-denominator").text(denominator);
}

function updateDecimalScore(big, small) {
    $("#mark-decimal-score")
        .text(big)
        .popup('destroy')
        .popup({
            variation: 'small inverted',
            position: 'right center',
            content: small,
        });

}

function round(number) {
    power = 10.0;

    if (number % 1 < 0.05)
        return Math.round(number);

    return number.toFixed(1);
}

function calculateScore() {
    smallPrecision = 4;

    values = [];
    allValid = true;
    $(".lesson-mark").each(function() {
        if ($(this).prop('disabled')) {
            return;
        }

        value = parseInt($(this).val());
        if (isNaN(value) || value < 0 || value > 20) {
            allValid = false;
            return;
        }

        if (supportsHtml5Storage()) {
            localStorage.setItem("pointForm" + $(this).attr("id"), $(this).val());
        }

        values.push(value);
    });

    if (allValid) {
        sum = getSum(values);

        averageDecimal   = (values.length === 0) ? 0 : sum / values.length;
        averageLarge     = Math.floor(averageDecimal);
        averageNumerator = sum % values.length;

        updateRationalScore(averageLarge, averageNumerator, values.length);
        updateDecimalScore(round(averageDecimal), averageDecimal.toFixed(smallPrecision));
    } else {
        updateRationalScore("??", "?", "?");
        updateDecimalScore("??", "???")
    }
}

if (supportsHtml5Storage()) {
    // Get the contents from the localStorage and put them on the form
    // fields
    $(".lesson-mark").each(function() {
        value = localStorage.getItem("pointForm" + $(this).attr("id"));
        if (typeof value !== "undefined") {
            $(this).val(value);
        }
    });
}

$("button").click(function() {
    calculateScore();
});
$("form").change(function() {
    calculateScore();
});
$("input").keyup(function() {
    calculateScore();
});

calculateScore();
