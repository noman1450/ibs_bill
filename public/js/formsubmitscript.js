
// ***************Select option search**************************
$("#company").select2( {
    placeholder: "Select company",
    allowClear: true
});

// ***************from submit script**************************

$( "#frm_data" ).submit(function(event){
    event.preventDefault();

    $("#btnSubmit").attr("disabled", true);
    $("#btnSubmit").val('Please wait..');
    var $form   = $( this ),
        url         = $form.attr( "action" );
    token = $("[name='_token']").val();
    $.ajax({
        type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
        url         : url, // the url where we want to POST
        data : $form.serialize(),
        dataType    : 'json', // what type of data do we expect back from the server
        encode      : true,
        _token : token
    })
        .done(function(data) {
            if(data['success']) {
                // window.open('{{URL::to('/')}}/journal_voucher/'+(data.master_id), '_blank');
                // window.location.replace("{{ URL::to('data_process')}}");
                // data['messages'];
                // var erreurs ='<div class="alert alert-success"><ul>';
                // erreurs += '<li>'+data.messages+'</li>';
                // erreurs += '</ul></div>';
                // $('#alert-success1').html(erreurs);
                // $('#alert-success1').show(0).delay(4000).hide(0);

                $('#btnSubmit').attr("disabled", false);
                $("#btnSubmit").val('Submit');
                url="javascript:window.history.go(-1);";
                //window.location.replace(url+toastr.success(data.messages));
                url="javascript:window.history.go(-1);";
                toastr.success(data.messages)
                var audio = new Audio('http://localhost/info/accounts/public/audio/audio_file.mp3');
                audio.play();

                //window.setTimeout(window.location.replace(url),7000);
                window.setTimeout(function () {
                    window.location.href =url;
                }, 3000)
            } else {

                toastr.error(data.messages);
                var audio = new Audio('http://localhost/info/accounts/public/audio/audio_file1.mp3');
                audio.play();
                // var erreurs ='<div class="alert alert-danger"><ul>';
                // erreurs += '<li>'+data.messages+'</li>';
                // erreurs += '</ul></div>';
                // $('#alert-danger1').html(erreurs);
                // $('#alert-danger1').show(0).delay(8000).hide(0);

                $('#btnSubmit').attr("disabled", false);
                $("#btnSubmit").val('Submit');
            }
        });
});



// ***************modal submit script**************************

$( "#modal_frm_data" ).submit(function(event){
    event.preventDefault();

    $("#btnSubmit").attr("disabled", true);
    $("#btnSubmit").val('Please wait..');
    var $form   = $( this ),
        url         = $form.attr( "action" );
    token = $("[name='_token']").val();
    $.ajax({
        type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
        url         : url, // the url where we want to POST
        data : $form.serialize(),
        dataType    : 'json', // what type of data do we expect back from the server
        encode      : true,
        _token : token
    })
        .done(function(data) {
            if(data['success']) {
                // window.open('{{URL::to('/')}}/journal_voucher/'+(data.master_id), '_blank');
                // window.location.replace("{{ URL::to('data_process')}}");
                // data['messages'];
                // var erreurs ='<div class="alert alert-success"><ul>';
                // erreurs += '<li>'+data.messages+'</li>';
                // erreurs += '</ul></div>';
                // $('#alert-success1').html(erreurs);
                // $('#alert-success1').show(0).delay(4000).hide(0);

                $('#btnSubmit').attr("disabled", false);
                $("#btnSubmit").val('Submit');
                url="javascript:window.history.go(-1);";
                //window.location.replace(url+toastr.success(data.messages));
                url="javascript:window.history.go(-1);";
                toastr.success(data.messages)
                var audio = new Audio('http://localhost/info/accounts/public/audio/audio_file.mp3');
                audio.play();
                $('.closeId').click();
                // //window.setTimeout(window.location.replace(url),7000);
                // 	  window.setTimeout(function () {
                // 	        window.location.href =url;
                // 	    }, 3000)
            } else {
                toastr.error(data.messages);
                var audio = new Audio('http://localhost/info/accounts/public/audio/audio_file1.mp3');
                audio.play();
                // var erreurs ='<div class="alert alert-danger"><ul>';
                // erreurs += '<li>'+data.messages+'</li>';
                // erreurs += '</ul></div>';
                // $('#alert-danger1').html(erreurs);
                // $('#alert-danger1').show(0).delay(8000).hide(0);

                $('#btnSubmit').attr("disabled", false);
                $("#btnSubmit").val('Submit');
            }
        });
});





