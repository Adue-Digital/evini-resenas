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
                onStepChanging: function (event, currentIndex, newIndex) {
                    if(currentIndex > newIndex) {
                        return true;
                    }
                    var rating = $("#order-review-stepper-p-"+currentIndex+" .product-rating");
                    if(rating.val() == 0) {
                        $("#order-review-stepper-p-"+currentIndex+" .error-message").text('La valoración en estrellas es obligatoria');
                        $("#order-review-stepper-p-"+currentIndex+" .error-message").show();
                        return false;
                    }

                    $("#order-review-stepper-p-"+currentIndex+" .resena-slider").each(function(index) {
                        console.log($(this).val());
                        if($(this).val() == 0) {
                            $("#order-review-stepper-p-"+currentIndex+" .error-message").text('Todos los campos de sabores son obligatorios');
                            $("#order-review-stepper-p-"+currentIndex+" .error-message").show();
                            return false;
                        }
                    });

                    if (!$.trim($("#order-review-stepper-p-"+currentIndex+" .comment").val())) {
                        $("#order-review-stepper-p-"+currentIndex+" .error-message").text('El campo de comentarios es obligatorio');
                        $("#order-review-stepper-p-"+currentIndex+" .error-message").show();
                        return false;
                    }

                    $("#order-review-stepper-p-"+currentIndex+" .error-message").hide();
                    return true;
                },
                onFinishing: function(event, currentIndex) {
                    $("#loader").show();
                    var data = $("#order-review-form").serialize();
                    $.ajax({
                        type: "post",
                        url: $("#order-review-form").attr('action'),
                        data: data,
                        success: function(result){
                            if(result.success) {
                                return true;
                            } else {
                                $("#loader").hide();
                            }
                        }
                    })
                },
                onFinished: function (event, currentIndex) {
                    $("#order-review-thanks").show();
                    $("#container").hide();
                    $("#loader").hide();
                }
            });

            var ratingConfig = {
                useFullStars: true,
                strokeWidth: 30,
                strokeColor: 'gold',
                hoverColor: 'gold',
                ratedColor: 'gold',
                emptyColor: 'transparent',
                disableAfterRate: false,
                callback: function(currentRating, $el) {
                    $("#custom-rating-"+$el.data('id')).val(currentRating);
                    $(".remove-rating[data-id="+$el.data('id')+"]").show();
                }
            }

            $(".my-rating-8").starRating(ratingConfig);

            $(".remove-rating").click(function(e) {
                e.preventDefault();
                $("#custom-rating-"+$(this).data('id')).val(0);
                $(".my-rating-8[data-id="+$(this).data('id')+"]").starRating('unload');
                $(this).parent().prepend('<div class="my-rating-8" data-id="'+$(this).data('id')+'"></div>');
                $(".my-rating-8[data-id="+$(this).data('id')+"]").starRating(ratingConfig);
            })

        }

    });
})(jQuery);
