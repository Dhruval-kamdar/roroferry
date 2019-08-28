var Booking = function() {

    var list = function() {
       
        var form = $('#reportPdf');
        var rules = {
            date:{required: true},
            route:{required: true},
            ferryTime:{required: true},
        };
        handleFormValidate(form, rules, function(form) {
            
//            handleAjaxFormSubmit(form,true);
                ajaxcall($(form).attr('action'), $(form).serialize(), function (output) {
                    window.open(output, '_blank');
//                    console.log(output);
//                    exit();
//                    handleAjaxResponse(output);
                });
        });
        
        
       $('body').on('change','.route',function(){
           var id = $('#route :selected').val();
            $.ajax({
                type: "POST",
                url: baseurl + "routeTimeList",
                data: {id: id},
                success: function(output) {
                    var details = JSON.parse(output);
                    var html="<option value=''>Select Ferry Time</option>";
                    for(var i = 0; i < details.length ; i++){
                        var temp = "";
                        temp = "<option value='"+ details[i].time +"'>"+ details[i].time +"</option>";
                        html = html + temp;
                    }
                    $('.time1').html(html);
                }
            });
       }) 
        
       var dataTable = $('#passengerList').DataTable({ 
           "processing":true,  
           "serverSide":true,
           "ordering": false,  
           "ajax":{
                data: {'action': 'bookingList'},
                url:baseurl + "booking-ajaxcall",
                type:"POST"  
           },  
           "columnDefs":[  
            {  
                 
            },  
           ],  
        });
    };
    
   
    return{
        Init: function() {
            list();
        },
    };
}();