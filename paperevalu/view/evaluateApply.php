<div class="col-xs-9 mt100">
	<p style="font-size:20px;">研究生学位论文评审申请书</p>
	<form method="post" action="/paperevalu/app/evaluateApply.php">
		<div class="fromset">学号: <?php echo $dataset['user_number']; ?></div>
		<div class="fromset">姓名: <?php echo $dataset['user_name']; ?></div>
		<div class="fromset">指导教师: <?php echo $dataset['teacher_name']; ?></div>
		<div class="fromset">入学时间: <?php echo $dataset['entrance_time']; ?></div>
		<div class="fromset">手机: <?php echo $dataset['mobile']; ?></div>
		<div class="fromset">邮箱: <?php echo $dataset['email']; ?></div>
		<div class="form-group">
			<label>论文方向：</label>
			<select class="form-control" name="majorid">
			  <?php 
			  	foreach ($majordata as $major) {
			  		echo "<option value='".$major['major_id']."'>".$major['major_name']."</option>";
			  	}
			  ?>
			</select>
		</div>
		<div class="form-group">
	    	<label>论文题目：</label>
	    	<input name="paper_title" type="text" class="form-control" id="inputTitle" placeholder="请输入您的论文题目">
		</div>
		<div class="form-group">
	    	<label>论文摘要：</label>
	    	<textarea name="paper_abstract" class="form-control" placeholder="请填写论文摘要" style="height:200px"></textarea>
		</div>
		<button type="submit" class="btn btn-primary" style="margin:0 auto;">提交</button>
	</form>
</div>