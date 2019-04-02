var Home = function() {
    var mainForm = function() {
        var validateTrip = true;
        var submitFrom = false;
        $('#bookticket').validate({
            debug: true,
            rules: {
                fromstaton: {required: true},                
                tostation: {required: true},
                depature: {required: true},
                returntrip: {required: {depends: function(e) {  
                            return ($('input[name="trip"]').val() == 'round');
                        }}},
                vehical: {required: true}, 
                tripTime: {required: true}, 
                tripTimeReturn: {required: {depends: function(e) {  
                            return ($('input[name="trip"]').val() == 'round');
                        }}},
            },
            messages: {
                fromstaton: {
                    required: "please select from station"
                },

                tripTime: {
                    required: "please select from trip (Out Bound) Time"
                },

                tripTimeReturn: {
                    required: "please select from trip (Return) Time"
                },

                vehical: {
                    required: "please select from vehicle "
                },

                tostation: {
                    required: "please select to station"
                },
                depature: {
                    required: "please select to depature"
                },
                returntrip: {
                    required: "please select to return"
                },
                
            },
            invalidHandler: function(event, validator) { //display error alert on form submit
                validateTrip = false;
            },
            submitHandler: function(form) {
                // validateTrip = checkCustom();
               // $('#bookticket').submit();
                //   $(form).ajaxSubmit();
                if(submitFrom)
                {
                     form.submit();
                }
//                  form.submit();
            }


        });


        $('body').on('click', '.nextbtn', function(form) {
            var nextForm = $(this).attr('data-next-form');
            if (nextForm == 2)
            {
                $('#bookticket').submit();
                 var trip_type = $("input[name='trip_type']:checked").val();
                 var trip = $("input[name='trip']:checked").val();
                 var fromstaton = $('.fromstaton option:selected').text();
                 var tostation = $('.tostation option:selected').text();
                 var deparureDate = $('#deparure').val();
                

                if (validateTrip)
                {
                    $(".ferryType").text(trip_type);
                    $(".ferryRoute").text(fromstaton + ' to ' + tostation);
                    $(".ferryDate").text(deparureDate);

                    if(trip == 'round'){
                        var returnDate = $('#return').val();
                        $(".returnTrip").text('Return Date : '+ returnDate +'');
                    }else{
                        $(".returnTrip").text('');
                    }

                    if( trip_type == 'With vehicle'){
                        $('.submit-form').addClass('hidden');
                        $('.form' + nextForm).removeClass('hidden');
                    }else{
                         nextForm++;
                        $('.submit-form').addClass('hidden');
                        $('.form' + nextForm).removeClass('hidden');
                    }
                }
            }

            if (nextForm == 4)
            {
                $('#bookticket').submit();
                var trip=$("input[name='trip']:checked").val();

                var trip_type = $("input[name='trip_type']:checked").val();
                var fromId = $('.fromstaton').val();
                var toId = $('.tostation').val();
                var vehicalId = $('.vehical').val();
                var vehicleCategoryID = $('.vehical option:selected').attr('data-vehicleCategoryID');
                var tripdate = $('#deparure').val();
                var fromstaton = $('.fromstaton option:selected').text();
                var tostation = $('.tostation option:selected').text();
                if (validateTrip)
                {   
                    if( trip_type == 'With vehicle'){
                        var vehicleName = $('.vehical option:selected').text();                        
                        $(".vehicleName").text('Vehicle Name : '+ vehicleName +'');
                        
                    if(trip == 'round'){

                        var tripReturndate = $('#return').val();
                        $('.returnTripDiv').removeClass('hidden');
                        $(".returnTripDate").text('Return Trip Route : '+ tostation + ' to ' + fromstaton +'');
                        var postData = {sourceID: toId , destinationID: fromId , vehicleTypeID: vehicalId ,vehicleCategoryID:vehicleCategoryID,departureDate:tripReturndate };
                        ajaxcall(baseurl + 'get-cargo-trips', postData, function(data) {
                            var outputround = JSON.parse(data);
                            
                            var htmlround = " <option value=''>Select Trip(Return) Time</option>";
                            for (var i = 0; i < outputround.data.length; i++) {
                                var markupround="";
                                markupround='<option value="'+ outputround.data[i].departureTime +'">'+ outputround.data[i].departureTime +'</option>';
                                htmlround=htmlround+markupround;
                            }
                            $('.tripTimeReturn').html(htmlround);
                        });
                    }else{
                        $('.returnTripDiv').addClass('hidden');  
                        $(".returnTripDate").text('');
                        // $('.returnTripDiv').html('');
                    }

                        var postData = {sourceID: fromId, destinationID: toId, vehicleTypeID: vehicalId ,vehicleCategoryID:vehicleCategoryID,departureDate:tripdate };
                        ajaxcall(baseurl + 'get-cargo-trips', postData, function(data) {
                                var output = JSON.parse(data);
                                // console.log(output.data[0].departureTime);
                                
                                var html = "<option value=''>Select Trip(Out Bound) Time...</option>";
                                for (var i = 0; i < output.data.length; i++) {
                                    var markup="";
                                    markup='<option value="'+ output.data[i].departureTime +'">'+ output.data[i].departureTime +'</option>';
                                    html=html+markup;
                                }
                                $('.tripTime').html(html);
                        });
                    }else{
                        $(".vehicleName").text('');;
                    }

                   
                    $('.submit-form').addClass('hidden');
                    $('.form' + nextForm).removeClass('hidden');
                }
            }


            if (nextForm == 5)
            {
                $('#bookticket').submit();
                if (validateTrip)
                {
                    alert(":HELLO");
                }
            }
            
            
        });

        $('body').on('click', '.prevbtn', function() {
            var nextForm = $(this).attr('data-prev-form');
            var trip_type = $("input[name='trip_type']:checked").val();

                if(nextForm == 3){
                    if( trip_type == 'With vehicle'){
                        // 2
                        nextForm--;
                         $('.submit-form').addClass('hidden');
                         $('.form' + nextForm).removeClass('hidden');
                    }else{
                        // 3
                         
                         $('.submit-form').addClass('hidden');
                        $('.form' + nextForm).removeClass('hidden');

                    }
                }else{
                    $('.submit-form').addClass('hidden');
                    $('.form' + nextForm).removeClass('hidden');
                }
           
        });
        
        
    }   
    


    var handleGenral = function() {
        

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
            handleGenral();
        },
    }
}();