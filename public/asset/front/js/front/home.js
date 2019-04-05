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
        
                busRoute: {required: {depends: function(e) {  
                    return ($('input[name="pickupservices"]:checked').val() == 'busservices');
                }}},
                
                tripTime: {required: {depends: function(e) {  
                    return ($('input[name="pickupservices"]:checked').val() == 'busservices');
                }}},
        
        
                tripPickUpTime: {required: {depends: function(e) {  
                    return ($('input[name="pickupservices"]:checked').val() == 'busservices');
                }}},
                
                tripDropTime: {required: {depends: function(e) {  
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
                vehical : {
                    required: "please select vehicle "
                },
                
                busRoute : {
                    required: "please select bus route "
                },
                
                tripTime : {
                    required: "please select trip time "
                },
                
                tripPickUpTime : {
                    required: "please select bus pick up time and station"
                },
                
                tripDropTime : {
                    required: "please select bus drop time and station "
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
            
            var trip_type = $("input[name='trip_type']:checked").val();
            if(trip_type ==  'Without vehicle'){
                
            }else{
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
            }
            
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
                    $('.noPassangerDiv').removeClass("hidden");
                    $('.nonVehiclePassanger').addClass("hidden");
                }else{
                    $('.pageOne').removeAttr("data-next-form");
                    $('.pageOne').attr("data-next-form","3");
                    $('.pagefour').removeAttr("data-prev-form");
                    $('.pagefour').attr("data-prev-form","3");
                    $('.noPassangerDiv').addClass("hidden");
                    $('.nonVehiclePassanger').removeClass("hidden");
                }
        });
        
        $('.busservices').change(function () {
            var busservices=$(".busservices:checked").val();
            if(busservices == 'selfservices'){
                $('.bussationDiv').addClass("hidden");
            }else{
                $('.bussationDiv').removeClass("hidden");
            }
        });
        
        $('.busRoute').change(function () {
            var routeId=$(".busRoute option:selected").val();
            var postData={routeId:routeId};
            ajaxcall(baseurl + 'get-trip-time', postData, function(data) {
                var output=JSON.parse(data);
                
                var htmlTripTime='<option value="">Select a trip time...</option>';
                for(var i = 0 ; i < output.length ; i++){
                    var tempHtml='';
                    tempHtml='<option  value="'+ output[i].id +'">'+ output[i].time +'</option>';
                    htmlTripTime = htmlTripTime + tempHtml;
                }
                $('.tripTime').html(htmlTripTime);
            });
        });
        
        $('.tripTime').change(function () {
            var routeId=$(".busRoute option:selected").val();
            var tripTimeId = $('.tripTime option:selected').text();
            
            var postData={tripTimeId:tripTimeId,routeId:routeId};
            ajaxcall(baseurl + 'get-trip-pickUp', postData, function(data) {
                var output=JSON.parse(data);
                var htmlPickUp='<option value="">Select a trip pickup station name - Time...</option>';
                for(var i = 0 ; i < output.length ; i++){
                    var tempHtml='';
                    tempHtml='<option  value="'+ output[i].id +'">'+ output[i].stationName + ' - ' + output[i].time + '</option>';
                    htmlPickUp = htmlPickUp + tempHtml;
                }
                $('.tripPickUpTime').html(htmlPickUp);
            });
            
            ajaxcall(baseurl + 'get-trip-drop', postData, function(data) {
                var output=JSON.parse(data);
                
                var htmldrop='<option value="">Select a trip drop station name - Time...</option>';
                for(var i = 0 ; i < output.length ; i++){
                    var tempHtml='';
                    tempHtml='<option  value="'+ output[i].id +'">'+ output[i].stationName + ' - ' + output[i].time + '</option>';
                    htmldrop = htmldrop + tempHtml;
                }
                $('.tripDropTime').html(htmldrop);
            });
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
                    $('#bookticket').submit();
                    if (validateTrip){
                        var tripType=$(".tripSelection:checked").val();
                        var tripdate = $('#deparure').val();
                        var fromstatonId = $('.fromstaton option:selected').val();
                        var tostationId = $('.tostation option:selected').val();
                        if(tripType == "round"){
                            
                        }
                        var postData={departureDate:tripdate,
                                      destinationID:tostationId,
                                      sourceID:fromstatonId};
                            ajaxcall(baseurl + 'get-without-cargo-trips', postData, function(data) {
                             var output=JSON.parse(data);
                             var htmlFerryTime="<option value=''>Select a ferry time...</option>";
                             for(var j = 0;j < output['data'].length;j++){
                                 var tempHtml="";
                                 tempHtml="<option tripId='"+ output['data'][j].tripID +"' value='"+ output['data'][j].departureTime +"'>"+ output['data'][j].departureTime +"</option>";
                                 htmlFerryTime= htmlFerryTime + tempHtml;
                             }
                             $(".ferryTime").html(htmlFerryTime);
                             
                            
                        });
                        
                        
                        $('.submit-form').addClass('hidden');
                        $('.form' + nextForm).removeClass('hidden');
                    }
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