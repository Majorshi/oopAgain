<div class="col-xs-9 mt100">
	<p style="font-size:20px;">研究生学位论文评审情况</p>
	<table class="table table-hover" style="margin-bottom:50px">
	<thead>
		<tr class="papertr">
			<td class="papertitle">论文标题</td>
			<td class="paperperiod">时期</td>
			<td class="paperstatue">评审状态</td>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach ($data as $paper) {
				$stephtml = $step[$paper['paper_step']];
				if ($type[$paper['paper_step']] == "button") {
					$class = "btn btn-";
					if ($color[$paper['paper_step']] == "#428bca") {
						$class = $class."primary";
					}
					if ($color[$paper['paper_step']] == "#d9534f") {
						$class = $class."danger";
					}
					$stephtml = "<a class='".$class."' href='".$href[$paper['paper_step']]."'>".$step[$paper['paper_step']]."</a>";
				}
				echo "<tr class='papertr'>";
				echo "<td class='papertitle'>".$paper['paper_title'];
				echo "</td>";
				echo "<td class='paperperiod'>".$paper['evaluate_name'];
				echo "</td>";
				echo "<td class='paperstatue' style='color:".$color[$paper['paper_step']]."'>".$stephtml;
				echo "</td>";
				echo "</tr>";
			}
		 ?>
	</tbody>
	</table>
	<a class="btn btn-primary" href="./evaluateApply.php" role="button">申请审批</a>
</div>