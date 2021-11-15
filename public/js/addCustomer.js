"use strict";
//bootstrap wizard//
// $("#gender, #gender1").select2({
//     theme: "bootstrap",
//     placeholder: "",
//     width: "100%",
// });
$(
    'input[type="checkbox"].custom-checkbox, input[type="radio"].custom-radio'
).iCheck({
    checkboxClass: "icheckbox_minimal-blue",
    radioClass: "iradio_minimal-blue",
    increaseArea: "20%",
});
$("#cnic_or_passport_expiry_date").datepicker({
    dateFormat: "yy-m-d",
    widgetPositioning: {
        vertical: "bottom",
    },
    keepOpen: false,
    useCurrent: false,
    maxDate: moment().add(1, "h").toDate(),
});
$("#commentForm").bootstrapValidator({
    fields: {
        first_name: {
            validators: {
                notEmpty: {
                    message: "The first name is required",
                },
            },
            required: true,
            minlength: 3,
            maxlength: 3,
        },
        last_name: {
            validators: {
                notEmpty: {
                    message: "The last name is required",
                },
            },
            required: true,
            minlength: 3,
            maxlength: 3,
        },
        father_name: {
            validators: {
                notEmpty: {
                    message: "The Father name is required",
                },
            },
            required: true,
            minlength: 3,
        },
        customer_type: {
            validators: {
                notEmpty: {
                    message: "The Customer Type is required",
                },
            },
            required: true,
            minlength: 3,
        },
        customer_status: {
            validators: {
                notEmpty: {
                    message: "The Customer Status is required",
                },
            },
            required: true,
            minlength: 3,
        },

        tour_reason: {
            validators: {
                notEmpty: {
                    message: "The Tour Reason is required",
                },
            },
            required: true,
            minlength: 3,
        },

        next_destination: {
            validators: {
                notEmpty: {
                    message: "The Next Destination is required",
                },
            },
            required: true,
            minlength: 3,
        },
        country: {
            validators: {
                notEmpty: {
                    message: "The Country is required",
                },
            },
            required: true,
            minlength: 3,
        },
        // province: {
        //     validators: {
        //         notEmpty: {
        //             message: "The Provice is required",
        //         },
        //     },
        //     required: true,
        //     minlength: 3,
        // },
        // city: {
        //     validators: {
        //         notEmpty: {
        //             message: "The City is required",
        //         },
        //     },
        //     required: true,
        //     minlength: 3,
        // },
        cell_number: {
            validators: {
                notEmpty: {
                    message: "The Cell Number is required",
                },
            },
            required: true,
            minlength: 10,
        },
        address: {
            validators: {
                notEmpty: {
                    message: "The Address is required",
                },
            },
            required: true,
            minlength: 3,
        },
        cnic: {
            validators: {
                notEmpty: {
                    message: "The CNIC is required",
                },
            },
            required: true,
            minlength: 3,
        },
        // cnic_or_passport_expiry_date: {
        //     validators: {
        //         notEmpty: {
        //             message: "The Expiry Date is required",
        //         },
        //     },
        //     required: false,
        // },
        password: {
            validators: {
                notEmpty: {
                    message: "Password is required",
                },
                different: {
                    field: "first_name,last_name",
                    message: "Password should not match first name",
                },
                minlength: 3,
            },
        },
        password_confirmation: {
            validators: {
                notEmpty: {
                    message: "Confirm Password is required",
                },
                identical: {
                    field: "password",
                },
                different: {
                    field: "first_name,last_name",
                    message: "Confirm Password should match with password",
                },
            },
        },
        email: {
            validators: {
                notEmpty: {
                    message: "The email address is required",
                },
                emailAddress: {
                    message: "The input is not a valid email address",
                },
            },
        },
        bio: {
            validators: {
                notEmpty: {
                    message: "Bio is required and cannot be empty",
                },
            },
            minlength: 20,
        },

        gender: {
            validators: {
                notEmpty: {
                    message: "Please select a gender",
                },
            },
        },

        group: {
            validators: {
                notEmpty: {
                    message: "You must select a group",
                },
            },
        },
    },
});

// $("#rootwizard").bootstrapWizard({
//     tabClass: "nav nav-pills",
//     onNext: function(tab, navigation, index) {
//         var $validator = $("#commentForm").data("bootstrapValidator").validate();
//         return $validator.isValid();
//     },
//     onTabClick: function(tab, navigation, index) {
//         return false;
//     },
//     onTabShow: function(tab, navigation, index) {
//         var $total = navigation.find("li").length;
//         var $current = index + 1;

//         // If it's the last tab then hide the last button and show the finish instead
//         if ($current >= $total) {
//             $("#rootwizard").find(".pager .next").hide();
//             $("#rootwizard").find(".pager .finish").show();
//             $("#rootwizard").find(".pager .finish").removeClass("disabled");
//         } else {
//             $("#rootwizard").find(".pager .next").show();
//             $("#rootwizard").find(".pager .finish").hide();
//         }
//     },
// });

$("#rootwizard .finish").click(function() {
    var $validator = $("#commentForm").data("bootstrapValidator").validate();
    if (
        $("#customer_details_btn").is(":checked") ||
        $("#cuntomer_profile_btn").is(":checked") ||
        $("#customer_address_btn").is(":checked")
    ) {
        if ($validator.isValid()) {
            document.getElementById("commentForm").submit();
        }
    } else {
        $.toast({
            heading: "error!",
            position: "bottom-right",
            text: "Fill Your Form Before Submit",
            loaderBg: "#c31b00",
            icon: "error",
            hideAfter: 3000,
            stack: 6,
        });
    }
});
// $('#activate').on('ifChanged', function(event){
//     $('#commentForm').bootstrapValidator('revalidateField', $('#activate'));
// });
$("#commentForm").keypress(function(event) {
    if (event.which == "13") {
        event.preventDefault();
    }
});

$(document).ready(function() {
    $("#cell_number_old").intlTelInput({});

    $(".iti").attr("style", "display: block !important");

    $("#cuntomer_profile_btn").on("click", function() {
        if (!$("#cuntomer_profile_btn").is(":checked")) {
            $("#customer_profile").slideToggle();
        } else {
            $("#customer_profile").slideToggle();
        }
    });

    $("#customer_details_btn").on("click", function() {
        if (!$("#customer_details_btn").is(":checked")) {
            $("#customer_details").slideToggle();
        } else {
            $("#customer_details").slideToggle();
        }
    });

    $("#customer_address_btn").on("click", function() {
        if (!$("#customer_address_btn").is(":checked")) {
            $("#customer_address").slideToggle();
        } else {
            $("#customer_address").slideToggle();
        }
    });
    // Initialize select2
    $("#province,#country,#city").select2();
});