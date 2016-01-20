
function printPaperAndExpert( paperSet , expertSet ) {
    $.each( paperSet , function () {
        $('#paperlist').append( "<tr><td><input type="checkbox" value=" + $(this)[0]["paper_id"] +
        " name="checkpaper"></td><td>"+ $(this)[0]["paper_title"] +"</td></tr>");
    } );
}

$(document).ready( function(){
    $.ajax({
        url: "../app/listMajor.php",
        type: "POST",
        data:{
            test:"con"
        },
        dataType: "json",
        error: function(data){
            alert("no");
            console.log(data);
        },
        success: function(data){//如果调用php成功

            var majorSet = data.majorSet;
            var paperSet = data.paperSet;
            var expertSet = data.expertSet;


            $.each( majorSet , function(){
                console.log( $(this) );
                $('#major').append("<option value = " + $(this)[0]["major_id"] + ">" + $(this)[0]["major_name"] + "</option>")
            } );

            // 打印全部论文和专家列表
            printPaperAndExpert( data.paperSet , data.expertSet );
        }
    });


    $('#confirmMajor').click( function () {
        alert( $('#major').value );
        // 提交选中的值
    } );

    $('#major').change( function(){
        alert( $('#major').val() );
        // 根据选中的值打印
    } )

} );

