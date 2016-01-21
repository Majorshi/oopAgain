
var globMajorSet = null;
var globPaperSet = null;
var globExpertSet = null;

function printPaperAndExpert( paperSet , expertSet , major ) {

    if( !arguments[2] ) {
        major = 0;
    }

    $('#paperlist').html("");
    $('#expertlist').html("");

    $.each( paperSet , function () {

        if( major > 0 && $(this)[0]["paper_major"] != major ) { // 限制
            return true;
        }
        $('#paperlist').append( "<tr><td><input type=\"checkbox\" value=" + $(this)[0]["paper_id"] +
        " name=\"checkpaper\"></td><td>"+ $(this)[0]["paper_title"] +"</td></tr>");
    } );
    $.each( expertSet , function () {
        if( major > 0 && $(this)[0]["user_major"] != major ) { // 限制
            return true;
        }
        $('#expertlist').append("<tr><td><input type=\"checkbox\" value=" + $(this)[0]["uid"] +
            " name=\"checkexpert\"></td><td>"+ $(this)[0]["realname"] +"</td></tr>");
    } )
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

            globMajorSet = majorSet;
            globPaperSet = paperSet;
            globExpertSet = expertSet;


            $.each( majorSet , function(){
                $('#major').append("<option value = " + $(this)[0]["major_id"] + ">" + $(this)[0]["major_name"] + "</option>")
            } );


            // 打印全部论文和专家列表
            printPaperAndExpert( data.paperSet , data.expertSet );
        }
    });


    $('#confirmMajor').click( function () {
        alert( "major:" + $('#major').val() );
        // 提交选中的值
        var postData ={
            major:$('#major').value,
        };

        // 获取选中的论文和专家
        var paperChosen = Array();
        $("input[name='checkpaper']").each(function(){
            if( $(this).prop("checked", true) ) {
                paperChosen.push( $(this).val() );
            }
        } );

        var expertChosen = Array();
        $("input[name='checkexpert']").each(function(){
            if( $(this).prop("checked", true) ) {

                expertChosen.push( $(this).val() );
            }
        } );

        $.ajax({
            url: "../app/assignPaperToExpert.php",
            type: "POST",
            data: {
                major: $("#major").val(),
                paperChosen: paperChosen,
                expertChosen: expertChosen
            },
            dataType: "json",
            error: function (data) {
                alert("no");
                console.log(data);

            },
            success: function (data) {
                alert("ok");
                console.log(data);
            }
        });

    } );

    $('#major').change( function(){
        // 显示特定领域
        printPaperAndExpert( globPaperSet , globExpertSet , $('#major').val() );
    } );

} );

