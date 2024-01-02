        function loading_spinner(typeOfLoading) {

               if (typeOfLoading === "show") {
                   $(".loading-container").removeClass("d-none d-flix");
                }

               if (typeOfLoading === "hide") {
                   $(".loading-container").addClass("d-none d-flix");
               }
        }

         $('#form_submit').on('click', function () {

            $.ajax({
            type: 'post',
            url: $('#url').val(),
            data: $('form').serialize(),
            beforeSend: function (withoutLoading) {
            loading_spinner("show");
            },
            success: function () {
              loading_spinner("hide");
              alert('form was submitted');
            },
             error: function(data)
             {
                 var response = JSON.parse(data.responseText);
                 $.each( response.errors, function( key, value) {
                     $('#'+key+'_error').show();
                     $('#'+key+'_error').html(value);

                 });
                  loading_spinner("hide");
             }
          });

        });




