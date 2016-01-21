<?php
	include('../system/global/header.inc');
	include('../system/global/session.inc');
	include('../system/global/navbar.inc');
?>
<link href="/paperevalu/static/css/home.css" rel="stylesheet" />
	<div class="col-xs-9 mt100"> 
     <form class="form-horizontal" id = "info_form"> 
	 
	  <div class="form-group" id = "info_certification" style = "display:none"> 
       <label for="inputEmail3" class="col-sm-2 control-label" style = "color:#F00">学位资格：</label> 
       <div class="col-sm-10"> 
	    <label for="inputEmail3" class="col-sm-8" style = "padding-top:7px;color:#F00" >没有学位资格</label> 
       </div> 
      </div>
	  
      <div class="form-group"> 
       <label class="col-sm-2 control-label">用户名：</label> 
       <div class="col-sm-10"> 
	    <label class="col-sm-8" for="inputEmail3" style = "padding-top:7px" id = "info_username" name = "info_username">用户名</label> 
       </div> 
      </div>
	  
	  <div class="form-group"> 
       <label class="col-sm-2 control-label">性别：</label> 
       <div class="col-sm-10"> 
	    <label class="col-sm-8" for="inputEmail3" style = "padding-top:7px" id = "info_gender" name = "info_gender">性别</label> 
       </div> 
      </div>
	  
	  <div class="form-group"> 
       <label class="col-sm-2 control-label">学 / 工号：</label> 
       <div class="col-sm-10"> 
	    <label class="col-sm-8" for="inputEmail3" style = "padding-top:7px" id = "info_student_number" name = "info_student_number">学 / 工号</label> 
       </div> 
      </div>

	  <div class="form-group"> 
       <label class="col-sm-2 control-label">入学时间：</label> 
       <div class="col-sm-10"> 
	    <label class="col-sm-8" for="inputEmail3" style = "padding-top:7px" id = "info_enterance_time" name = "info_enterance_time">入学时间</label> 
       </div> 
      </div>	  	  
	  
	  <div class="form-group"> 
       <label class="col-sm-2 control-label">邮箱：</label> 
       <div class="col-sm-10"> 
        <input type="email" for="inputEmail3" class="form-control" id = "info_email" name = "info_email" placeholder="邮箱" /> 
       </div> 
      </div>
	  
      <div class="form-group"> 
       <label class="col-sm-2 control-label">电话：</label> 
       <div class="col-sm-10"> 
        <input type="number" for="inputEmail3" class="form-control" id = "info_phone" name = "info_phone" placeholder="电话" /> 
       </div> 
      </div> 
	  
	  <div id = "extra_data" style = 'display:none'>
	  
		  <div class="form-group"> 
		   <label class="col-sm-2 control-label">职称：</label> 
		   <div class="col-sm-10"> 
			<input type="text" for="inputEmail3" class="form-control" id = "info_leader_name" name = "info_leader_name" placeholder="职称" /> 
		   </div> 
		  </div>
		  
		  <div class="form-group"> 
		   <label class="col-sm-2 control-label">是否硕导：</label> 
		   <div class="col-sm-10"> 
			<select class="form-control" for="inputEmail3" id = "info_if_leader" name = "info_if_leader">
				<option value = 1> 是 </option>
				<option value = 0> 否 </option>
			</select>
		   </div> 
		  </div>
		  
		  <div class="form-group"> 
		   <label class="col-sm-2 control-label">工作单位：</label> 
		   <div class="col-sm-10"> 
			<input type="text" for="inputEmail3" class="form-control" id = "info_work_place" name = "info_work_place" placeholder="工作单位" /> 
		   </div> 
		  </div>
		  
		  <div class="form-group"> 
		   <label class="col-sm-2 control-label">专业技术职务：</label> 
		   <div class="col-sm-10"> 
			<input type="text" for="inputEmail3" class="form-control" id = "info_special_name" name = "info_special_name" placeholder="专业技术职务" /> 
		   </div> 
		  </div>
		  
		  <div class="form-group"> 
		   <label class="col-sm-2 control-label">专业专长</label> 
		   <div class="col-sm-10"> 
			<select class="form-control" id = "info_skills" name = "info_skills">
				<option value = 1> 数据挖掘 </option>
			</select>
		   </div> 
		  </div>
	  </div>
	  
	  <div class="form-group"> 
       <div class="col-sm-offset-2 col-sm-10"> 
        <button class="btn btn-default" onclick = "modify()" type = "button">修改</button> 
       </div> 
      </div>
	  
	  <div id = "open_extra_data" onclick = "return open_more()">
		  <div class="form-group"> 
		   <div class="col-sm-offset-2 col-sm-10"> 
			<button class="form-control">查看更多</button> 
		   </div> 
		  </div>
	  </div>
     </form>
  </div>

<script type = "text/javascript">

function modify() {
	var email = $('#info_email').val();
	var mobile = $('#info_phone').val();
	var leader_name =  $('#info_leader_name').val();
	var work_place =  $('#info_work_place').val();
	var user_post =  $('#info_special_name').val();
	var if_leader = $('#info_if_leader').val();
	var user_major = $('#info_skills').val();
	var xmlhttp;
	var url="../app/message.php";
	var type = 0;
	var uid = "";
	var poststr = "type=" + type + "&uid=" + uid + "&email=" + email + "&mobile=" + mobile + "&leader_name=" + leader_name;
	poststr += "&user_unit=" + work_place + "&user_post=" + user_post + "&if_leader=" + if_leader + "&user_major=" + user_major;
	if (window.XMLHttpRequest)	{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	} else {// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	} 
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status== 200)	{
			e = xmlhttp.responseText;
			if (e == '0') {
				alert("修改成功");
			} else {
				alert("修改失败");
			}
			window.location.href = window.location.href;
		}
	}
	xmlhttp.open("POST",url,true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send(poststr);
}

function open_more() {
	$('#extra_data').css('display','block');
	$('#open_extra_data').css('display','none');
	return false;
}

$(document).ready(function(data){
	var xmlhttp;
	var url="../app/message.php";
	var type = 1;
	var uid = "";
	var poststr = "type=" + type + "&uid=" + uid;
	if (window.XMLHttpRequest)	{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	} else {// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	} 
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status== 200)	{
			e = xmlhttp.responseText;
			eval("var result = e" );
			alert(e);
			if (result == "") {
				alert("无这个用户");
			} else {
				var datas = new Function("return" + result)();
				$('#info_username').html(datas.realname);
				$('#info_student_number').html(datas.user_number);
				if (datas.sex == 0) {
					$('#info_gender').html("女");
				} else {
					$('#info_gender').html("男");
				}
				if(datas.entrance_time != null){
					$('#info_enterance_time').html(datas.entrance_time);
				}
				if (datas.email != null)
					$('#info_email').val(datas.email);
				if (datas.mobile != null)
					$('#info_phone').val(datas.mobile);
				if (datas.leader_name != null)
					$('#info_leader_name').val(datas.leader_name);
				if (datas.user_unit != null)
					$('#info_work_place').val(datas.user_unit);
				if (datas.user_unit != null)
					$('#info_special_name').val(datas.user_post);
				if (datas.if_degree != null && datas.if_degree == 0)
					$('#info_certification').css('display','block');
				if (datas.if_leader == 0) {
					$('#info_if_leader').val(0);
				} else {
					$('#info_if_leader').val(1);
				}

				getMajor();
				if (datas.user_major != null)	{
					$('#info_skills').val(datas.user_major);
				}
				if (datas.status_id == 1) {
					$('#open_extra_data').css('display','none');
				}
			}
		}
	}
	xmlhttp.open("POST",url,true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send(poststr);
});


function getMajor() {
	var xmlhttp;
	var url="../app/major.php";
	var poststr = "uid=";
	if (window.XMLHttpRequest)	{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	} else {// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	} 
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status== 200)	{
			e = xmlhttp.responseText;
			$("#info_skills").html(e);
		}
	}
	xmlhttp.open("POST",url,true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send(poststr);
}

$('#info_form').validate({
    errorElement:'span',
    success:function(label){
        
        },
    rules:{
		'info_email':{
			maxlength:250,
		},
		'info_phone':{
			maxlength:15,
		},
		'info_leader_name':{
			maxlength:250,
		},
		'info_work_place':{
			maxlength:250,
		},
		'info_special_name':{
			maxlength:250,
		}
    },
    messages:{
		'info_email':{
			maxlength:'<code>   邮箱地址过长</code>',
		},
		'info_phone':{
			maxlength:'<code>   手机号过长</code>',
		},
		'info_leader_name':{
			maxlength:'<code>   职称过长</code>',
		},
		'info_work_place':{
			maxlength:'<code>   地址过长</code>',
		},
		'info_special_name':{
			maxlength:'<code>   专业职称过长</code>',
		}
	}
});
	
</script>

  
<?php
  include('../system/global/navbarfooter.inc');
?>