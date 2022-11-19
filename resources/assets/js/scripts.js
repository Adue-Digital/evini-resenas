function onChangeSlider(e) {
    e.nextElementSibling.value = e.value + "%";

    let percentage =  e.value;
    e.style.background = 'linear-gradient(to right, #F21259, #F21259 ' + percentage + '%, #cccccc ' + percentage + '%, #cccccc 100%)';
}

function wineTastedChange(e) {
    var wineTasted = document.querySelector(".radio-toolbar input[type=\"radio\"]:checked");
    if(wineTasted.value == 'no') {
        jQuery(".wine-attribute-container").hide();
    } else {
        jQuery(".wine-attribute-container").show();
    }
}

(function($) {
    $(document).ready(function(){

        var stepperContiner = $("#order-review-stepper");

        if(stepperContiner.length) {
            var steps = $(".product-step").length;
            stepperContiner.steps({
                titleTemplate: '<span class="number">#index#/'+steps+'</span>',
                headerTag: "header",
                bodyTag: "section",
                transitionEffect: "slideLeft",
                autoFocus: true,
                labels: {
                    current: '',
                    previous: 'Anterior',
                    next: 'Siguiente',
                },
                onFinishing: function(event, currentIndex) {
                    $("#loader").show();
                    var data = $("#order-review-form").serialize();
                    $.ajax({
                        type: "post",
                        url: $("#order-review-form").attr('action'),
                        data: data,
                        success: function(result){
                            console.log(result);
                            return true;
                        }
                    })
                },
                onFinished: function (event, currentIndex) {
                    $("#loader").hide();
                }
            });

            $(".my-rating-8").starRating({
                useFullStars: true,
                disableAfterRate: false,
                callback: function(currentRating, $el) {
                    $("#custom-rating-"+$el.data('id')).val(currentRating);
                }
            });

        }

    });
})(jQuery);
