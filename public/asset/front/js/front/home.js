var Home = function() {
    var mainForm = function() {
        var validateTrip = true;
        var submitFrom = false;
        $('#bookticket').validate({
            debug: true,
            rules: {
                trip: {required: true},
                trip_type: {required: true},
                fromstaton: {required: true},
                tostation: {required: true},
                depature: {required: true},
                returntrip: {required: {depends: function(e) {  
                    return ($('input[name="trip"]:checked').val() == 'round');
                }}},
            },
            messages: {
                trip_type: {
                    required: "please select trip type"
                },

                trip: {
                    required: "please select trip"
                },

                fromstaton: {
                    required: "please select depature station"
                },

                
                
                tostation: {
                    required: "please select destination station "
                },
                
                depature: {
                    required: "please select depature date "
                },
                
                returntrip : {
                    required: "please select return trip  date "
                },

                
            },
            invalidHandler: function(event, validator) {
                //display error alert on form submit
                validateTrip = false;
            },
            submitHandler: function(form) {
                if(submitFrom)
                {
                    form.submit();
                }
            }
        });
        
        $('.tripSelection').change(function () {
            var tripType=$(".tripSelection:checked").val();
            if(tripType == 'round'){
                $('#returnTripDate').removeClass("hidden");
            }else{
                $('#returnTripDate').addClass("hidden");
            }
        });
        
        $('.tripFerrySelection').change(function () {
            var tripFerrySelection=$(".tripFerrySelection:checked").val();

                if(tripFerrySelection == 'With vehicle'){
                    $('.pageOne').removeAttr("data-next-form");
                    $('.pageOne').attr("data-next-form","2");
                }else{
                    $('.pageOne').removeAttr("data-next-form");
                    $('.pageOne').attr("data-next-form","3");
                }
        });
        
        
        $('body').on('click', '.nextbtn', function(form) {
            var nextForm = $(this).attr('data-next-form');
            if (nextForm == 2)
            {   
                validateTrip = true;
                $('#bookticket').submit();
                if (validateTrip)
                {
                    $('.submit-form').addClass('hidden');
                    $('.form' + nextForm).removeClass('hidden');
                } 
            }
            
            if (nextForm == 3)
            {   
                validateTrip = true;
                $('#bookticket').submit();
                
                if (validateTrip)
                {
                    $('.submit-form').addClass('hidden');
                    $('.form' + nextForm).removeClass('hidden');
                }      
            }
        });
        
        $('body').on('click', '.prevbtn', function() {
             var prvForm = $(this).attr('data-prev-form');
                $('.submit-form').addClass('hidden');
                $('.form' + prvForm).removeClass('hidden'); 
        });
        
        $('body').on('change', '.tripFrom', function() {
            var selectedValue = $(this).val();

            $(".tripTo option").remove();
            $(".tripFrom option").each(function() {
                if ($(this).val() != '' && $(this).val() != selectedValue) {
                    $('.tripTo').append($('<option>', {value: $(this).val(), text: $(this).text()}));
                }
            });

        });
        
        var date = new Date();
        date.setDate(date.getDate());

        $('#deparure').datepicker({
            startDate: date,
            autoclose:true,
        });
        $('#return').datepicker({
            startDate: date,            
            autoclose:true,
        });

    }   
    


    


    return{
        init: function() {
            mainForm();
        },
    }
}();