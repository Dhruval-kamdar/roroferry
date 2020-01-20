var Paynow = function() {
    var pay = function() {
        $('#paynow').validate({
            debug: true,
            rules: {
                firstname: {required: true},
                lastname: {required: true},
                email: {required: true,email:true},
                amount: {required: true,digits:true},
                mobileno: {required: true,digits:true},
                note: {required: true},
//                digits: true
            },
            messages: {
                firstname : {
                    required: "please enter first name"
                },
                lastname : {
                    required: "please enter last name"
                },
                email : {
                    required: "please enter your email address",
                    email: "please enter vaild email address"
                },
                amount : {
                    required: "please enter your amount",
                    digits: "please enter vaild amount"
                },
                mobileno : {
                    required: "please enter your mobile number",
                    digits: "please enter vaild mobile number"
                },
                note : {
                    required: "please enter your note here",
                },
                
            },
            highlight: function (element) { // hightlight error inputs
            $(element)
                    .closest('.form-control').addClass('error'); // set error class to the control group
            },
            unhighlight: function (element) { // revert the change done by hightlight
                $(element)
                        .closest('.form-control ').removeClass('error'); // set error class to the control group
            },
            success: function (label) {
                label
                        .closest('.form-control ').removeClass('error'); // set success class to the control group
            },
            submitHandler: function(form) {
                    form.submit();
            }
        });
        
       
        
    }   
    
    var c_payment = function (){
        alert("Hello");
        
    }
    return{
        init: function() {
           pay();
        },
        confirmpayment: function() {
           c_payment();
        },
    }
}();