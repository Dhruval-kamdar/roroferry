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
        
                pickpoint: {required: {depends: function(e) {  
                    return ($('input[name="pickupservices"]:checked').val() == 'busservices');
                }}},
                
                droppoint: {required: {depends: function(e) {  
                    return ($('input[name="pickupservices"]:checked').val() == 'busservices');
                }}},
        
                vehical: {required: true},
        
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
                
                pickpoint: {
                    required: "please select pickup point "
                },
                
                droppoint : {
                    required: "please select drop point "
                },
                
                vehical : {
                    required: "please select vehicle "
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
                $('.returnTripTextDiv').removeClass("hidden");
                $('.returnFerryTime').removeClass("hidden");
            }else{
                $('#returnTripDate').addClass("hidden");
                $('.returnTripTextDiv').addClass("hidden");
                $('.returnFerryTime').addClass("hidden");
            }
        });
        
        $('.ferryTime').change(function(){
            var tripId=$('.ferryTime option:selected').attr('tripid'); 
            var postTripId={ tripId:tripId};
            ajaxcall(baseurl + 'get-class', postTripId, function(data) {
                var returnClass=JSON.parse(data);
                
                var htmlClass = "<option value=''>Select a ferry class...</option>";
                for(var lenclass = 0; lenclass < returnClass['data'].length ; lenclass++){
                    var temhtmlclass='';
                    temhtmlclass="<option  value="+ returnClass['data'][lenclass].id +">"+ returnClass['data'][lenclass].className +"</option>";
                    htmlClass=htmlClass+temhtmlclass;
                }
                $(".ferryClass").html(htmlClass);
            });
        });
        
        $('.ferryTimeReturn').change(function(){
            var tripId=$('.ferryTimeReturn option:selected').attr('tripid'); 
            var postTripId={ tripId:tripId};
            ajaxcall(baseurl + 'get-class', postTripId, function(data) {
                var returnClass=JSON.parse(data);
                
                var htmlClass = "<option value=''>Select a ferry class...</option>";
                for(var lenclass = 0; lenclass < returnClass['data'].length ; lenclass++){
                    var temhtmlclass='';
                    temhtmlclass="<option  value="+ returnClass['data'][lenclass].id +">"+ returnClass['data'][lenclass].className +"</option>";
                    htmlClass=htmlClass+temhtmlclass;
                }
                $(".ferryClassReturn").html(htmlClass);
            });
        });
        
        
        $('.tripFerrySelection').change(function () {
            var tripFerrySelection=$(".tripFerrySelection:checked").val();

                if(tripFerrySelection == 'With vehicle'){
                    $('.pageOne').removeAttr("data-next-form");
                    $('.pageOne').attr("data-next-form","2");
                    $('.pagefour').removeAttr("data-prev-form");
                    $('.pagefour').attr("data-prev-form","2");
                }else{
                    $('.pageOne').removeAttr("data-next-form");
                    $('.pageOne').attr("data-next-form","3");
                    $('.pagefour').removeAttr("data-prev-form");
                    $('.pagefour').attr("data-prev-form","3");
                }
        });
        
        $('.busservices').change(function () {
            var busservices=$(".busservices:checked").val();
//            alert(busservices);
//            exit;
            if(busservices == 'selfservices'){
                $('.bussationDiv').addClass("hidden");
            }else{
                $('.bussationDiv').removeClass("hidden");
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
                    var trip = $("input[name='trip']:checked").val();
                    var trip_type = $("input[name='trip_type']:checked").val();
                    var fromstaton = $('.fromstaton option:selected').text();
                    var tostation = $('.tostation option:selected').text();
                    var tripdate = $('#deparure').val();
                    var returntripdate = $('#return').val();
                    
                    $('.ferryText').text(trip);
                    $('.ferryTypeText').text(trip_type);
                    $('.ferryRouteText').text(fromstaton + ' To ' + tostation );
                    $('.ferryDateText').text(tripdate);
                    $('.returnferryRouteText').text(tostation + ' To ' + fromstaton  );
                    $('.returnferryTypeDateText').text(returntripdate);
                    
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
                    var trip = $("input[name='trip']:checked").val();
                    var trip_type = $("input[name='trip_type']:checked").val();
                    var fromstaton = $('.fromstaton option:selected').text();
                    var tostation = $('.tostation option:selected').text();
                    var tripdate = $('#deparure').val();
                    var returntripdate = $('#return').val();
                    
                    $('.ferryText').text(trip);
                    $('.ferryTypeText').text(trip_type);
                    $('.ferryRouteText').text(fromstaton + ' To ' + tostation );
                    $('.ferryDateText').text(tripdate);
                    $('.returnferryRouteText').text(tostation + ' To ' + fromstaton  );
                    $('.returnferryTypeDateText').text(returntripdate);
                    
                    $('.submit-form').addClass('hidden');
                    $('.form' + nextForm).removeClass('hidden');
                }      
            }
            
            if(nextForm == 4){
                validateTrip = true;
                var trip_type = $("input[name='trip_type']:checked").val();
                if(trip_type ==  'Without vehicle'){
                    
                }else{
                    $('#bookticket').submit();
                    if (validateTrip){
                        var tripType=$(".tripSelection:checked").val();
                        var tripdate = $('#deparure').val();
                        var fromstatonId = $('.fromstaton option:selected').val();
                        var tostationId = $('.tostation option:selected').val();
                        var vehicalId = $('.vehical').val();
                        var vehicleCategoryID = $('.vehical option:selected').attr('data-vehiclecategoryid');
                        var passanger = $('.vehical option:selected').attr('data-passanger');
                        
                        if(tripType == "round"){
                            var returntripdate = $('#return').val();
                            var postDataRound = {sourceID: tostationId, 
                                            destinationID: fromstatonId,
                                            vehicleTypeID: vehicalId ,
                                            vehicleCategoryID:vehicleCategoryID,
                                            departureDate:returntripdate };
                                            ajaxcall(baseurl + 'get-cargo-trips', postDataRound, function(data) {
                                            var returnOutput=JSON.parse(data);
                                            
                                            var htmlTime = "<option value=''>Select a ferry time...</option>";
                                            for(var len = 0; len < returnOutput['data'].length ; len++){
                                                var tem='';
                                                tem="<option tripId='"+ returnOutput['data'][len].tripID +"' value="+ returnOutput['data'][len].departureTime +">"+ returnOutput['data'][len].departureTime +"</option>";
                                                htmlTime=htmlTime+tem;
                                            }
                                            $(".ferryTimeReturn").html(htmlTime);

                                            var htmlpassanger = "<option value=''>Select a number of passenger...</option>";
                                            for(var lenpassanger = 1; lenpassanger <= passanger ; lenpassanger++){
                                                var temhtmlpassanger='';
                                                temhtmlpassanger="<option  value="+ lenpassanger +">"+ lenpassanger +"</option>";
                                                htmlpassanger=htmlpassanger+temhtmlpassanger;
                                            }
                                            $(".noPassangerReturn").html(htmlpassanger);
                                        });
                        }
                        var postData = {sourceID: fromstatonId, 
                                        destinationID: tostationId,
                                        vehicleTypeID: vehicalId ,
                                        vehicleCategoryID:vehicleCategoryID,
                                        departureDate:tripdate };
                                    
                                    ajaxcall(baseurl + 'get-cargo-trips', postData, function(data) {
                                        var output=JSON.parse(data);
                                        var htmlTime = "<option value=''>Select a ferry time...</option>";
                                        for(var len = 0; len < output['data'].length ; len++){
                                            var tem='';
                                            tem="<option tripId='"+ output['data'][len].tripID +"' value="+ output['data'][len].departureTime +">"+ output['data'][len].departureTime +"</option>";
                                            htmlTime=htmlTime+tem;
                                        }
                                        $(".ferryTime").html(htmlTime);
                                        
                                        var htmlpassanger = "<option value=''>Select a number of passenger...</option>";
                                        for(var lenpassanger = 1; lenpassanger <= passanger ; lenpassanger++){
                                            var temhtmlpassanger='';
                                            temhtmlpassanger="<option  value="+ lenpassanger +">"+ lenpassanger +"</option>";
                                            htmlpassanger=htmlpassanger+temhtmlpassanger;
                                        }
                                        $(".noPassanger").html(htmlpassanger);
                                    });
                                    $('.submit-form').addClass('hidden');
                                    $('.form' + nextForm).removeClass('hidden');
                    }
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