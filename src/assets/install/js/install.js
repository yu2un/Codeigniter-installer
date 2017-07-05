var form = $("#install-ci").show();

form.steps({
    headerTag: "h3",
    bodyTag: "fieldset",
    transitionEffect: "slideLeft",
    onStepChanging: function (event, currentIndex, newIndex)
    {
        $("#install-ci .actions a[href='#finish']").hide();
        if (currentIndex > newIndex)
        {
            return true;
        }
        if (currentIndex < newIndex)
        {
            form.find(".body:eq(" + newIndex + ") label.error").remove();
            form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
        }

        form.validate().settings.ignore = ":disabled,:hidden";
        return form.valid();

    },
    onStepChanged: function (event, currentIndex, priorIndex)
    {

        if(currentIndex == 1){

          $( "#test" ).on( "click", function() {
            if(form.valid() == true){
              var data = $("#install-ci").serialize();
              var url  = $("#base_url").val();
              $.ajax({
                  type: 'post',
                  url: url + 'install/testconnect',
                  dataType:"json",
                  data: data,
                  success: function(response){
                    if(response.success == true){
                      swal("" , response.message , "success");
                      $("#install-ci .actions a[href='#finish']").show();
                    }else{
                      swal("" , response.message , "warning");
                    }
                  },
                  error: function (request, status, error) {
                      if(request.status == 404){
                        swal("" , " Base url is wrong , Please check Base url" , "error");
                        form.steps("previous");
                      }
                  }
              });
            }
          });
        }
    },
    onFinishing: function (event, currentIndex)
    {
        form.validate().settings.ignore = ":disabled";
        return form.valid();
    },
    onFinished: function (event, currentIndex)
    {
      var url  = $("#base_url").val();
      var data = $("#install-ci").serialize();
      $.ajax({
          type: 'post',
          url: url + 'install/changeconfig',
          dataType:"json",
          data: data,
          success: function(response){

          },
          error: function (request, status, error) {
            swal(
              'Deleted!',
              'Your file has been deleted.',
              'success'
            );
            window.setTimeout(function() {
                window.location.href = url;
            }, 2000);
          }
      });
    }
}).validate({
    errorPlacement: function errorPlacement(error, element) { element.before(error); },
    rules: {
        confirm: {

        }
    }
});
