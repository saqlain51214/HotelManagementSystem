"use strict";
$(document).ready(function(){


    $(document).on("click", ".customer_delete_btn", function() {
    
        let _this = $(this);
        let id = _this.data('id');
        alert(id);
        if (id != null) {
            $.ajax({
                type: "GET",
                url: "{{url('delete-customer')}}/"+id,
                data: {
                    // _token: "{{ csrf_token() }}",
                },
                cache: false,
                dataType: "json",

                beforeSend: function() {
                    $(".preloader").css({ display: "", opacity: "0.5px" });
                },
                success: function(response) {
                    $(".preloader").css({ display: "none", opacity: "" });

                console.log(response);
                },
                error: function(xhr) {
                    console.log("XHR", xhr);
                    $(".preloader").css({ display: "none", opacity: "" });

                },
            });
        } else {
            alert("Select any type");
        }
    });

});