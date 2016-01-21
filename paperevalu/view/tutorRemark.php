<link rel="stylesheet" type="text/css" href="../static/css/home.css">
<div class="col-xs-9 mt100">
	<p style="font-size:20px;">研究生学位论文评审申请书</p>
	<form method="post" action="/paperevalu/app/tutorRemark.php">
		<div class="fromset">学号: <?php echo $studata['user_number']; ?></div>
		<div class="fromset">姓名: <?php echo $studata['user_name']; ?></div>
		<div class="fromset">指导教师: <?php echo $paperdata['tutor_name']; ?></div>
		<div class="fromset">入学时间: <?php echo $studata['entrance_time']; ?></div>
		<div class="fromset">手机: <?php echo $studata['mobile']; ?></div>
		<div class="fromset">邮箱: <?php echo $studata['email']; ?></div>
		<div class="form-group" style="width:100%">论文方向: <?php echo $paperdata['major_name']; ?></div>
		<div class="form-group" style="width:100%">论文标题: </div>
		<div class="form-group" style="width:100%"><?php echo $paperdata['paper_title']; ?></div>
		<div class="form-group">
	    	<label>论文摘要：</label>
	    	<p style="min-height:100px"><?php echo $paperdata['paper_abstract']; ?></p>
	    </div>
		<div class="form-group">
	    	<label>申请理由：</label>
	    	<div>我已获得软件工程硕士培养计划中规定的全部学分,并完成了学位论文的 撰写工作。现申请进行学位论文评审,请审批。</div>
		</div>
		<div class="form-group">
	    	<label>导师意见：</label>
	    	<textarea required="required" name="tutor_opinion" class="form-control" placeholder="请填写导师意见" style="height:200px"></textarea>
		</div>
		<input style="display:none" name="paper_id" value=<?php echo "'".$paperdata['paper_id']."'"; ?> type="text" />
		<button type="submit" class="btn btn-primary" style="margin:0 auto;">提交</button>
	</form>
</div>