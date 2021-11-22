"use strict";

$("#commentForm").bootstrapValidator({
    fields: {
        room_type: {
            validators: {
                notEmpty: {
                    message: "Room type is required",
                },
            },
            required: true,
        },
        price: {
            validators: {
                notEmpty: {
                    message: "Price is required",
                },
            },
            required: true,
          
        },
        total_bed: {
            validators: {
                notEmpty: {
                    message: "No of beds is required",
                },
            },
            required: true,
        },
        extra_bed: {
            validators: {
                notEmpty: {
                    message: "No of Extra beds is required",
                },
            },
            required: true,
        },
        // description: {
        //     validators: {
        //         notEmpty: {
        //             message: "Description is required",
        //         },
        //     },
        //     required: true,
          

        // },
        status: {
            validators: {
                notEmpty: {
                    message: " Status is required",
                },
            },
            required: true,
           
        },

       
       
    },
});


$("#submit .finish").click(function() {
    var $validator = $("#commentForm").data("bootstrapValidator").validate();
    if ($validator.isValid()) {
        event.preventDefault();
        document.getElementById("commentForm").submit();
    
    } else {
        $.toast({
            heading: "error!",
            position: "bottom-right",
            text: "Fill the required fields Before Submit",
            loaderBg: "#c31b00",
            icon: "error",
            hideAfter: 3000,
            stack: 6,
        });
    }
});

$("#commentForm").keypress(function(event) {
    if (event.which == "13") {
        event.preventDefault();
    }
});


 $(document).ready(function(){
    $('#total_bed,#extra_bed,#status').select2();
    $("#room_type").keyup(function() {
        var Text = $(this).val();
        Text = Text.toLowerCase();
        var regExp = /\s+/g;
        Text = Text.replace(regExp,'-');
        $("#slug").val(Text);        
    });
    

    // let i;
    // var select = '<option>Select</option>';
    // for (i=0;i<=100;i++){
    //     if(i == 0){
         
    //         select += '<option value=' + i + '>' + i + ' '+ 'Bed'+ '</option>';
    //     }else if(i==1){
          
    //         select += '<option value=' + i + '>' + i + ' '+ 'Bed'+ '</option>';
    //     }else{
    //         select += '<option value=' + i + '>' + i + ' '+ 'Beds'+ '</option>';
    //     }
        
    // }
    // $('#total_bed,#extra_bed').html(select);
});


