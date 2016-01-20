$(document).ready( function(){
    $.ajax({
        url: "../app/listMajor.php",
        type: "POST",
        data:{
            test:"con"
        },
        dataType: "json",
        error: function(){
            alert('Error');
        },
        success: function(data){//如果调用php成功

            var dataCnt = data.count;
            var dataSet = data.major;

            $.each( dataSet , function(){
                console.log( $(this) );
                $('#major').append("<option id = " + $(this)[0]["major_id"] + ">" + $(this)[0]["major_name"] + "</option>")
            } );
        }
    });


    $('#confirmMajor').click( function () {
        alert("confirm");
    } );
} );