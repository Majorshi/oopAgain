function inputRate(paperID)
{
	var paperRate = document.getElementById(paperID).value;

	if (paperRate == "")
	{
		alert("不能为空！")
		return false;
	}


$.post(
	"../app/inputRate.php",
	{
		paperID:paperID,
		paperRate:paperRate
	},
 function(data,status){
    //alert("Data: " + data + "\nStatus: " + status);
     //window.location.href = "adminCheckResult.php";
    if(data == "0"){
	    alert("error!");
    }
    else if(data == "1"){
	    window.location.href = "adminCheckResult.php";
	    //alert(data);
    }
  }
);



 
	
}