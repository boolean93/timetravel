<?php if (!defined('THINK_PATH')) exit();?>
<div class="nlist-2">
	<h3>
		<i></i>
		站点统计信息
	</h3>
	<ul>
		<li>用户数：<?php echo ($info["user"]); ?></li>
		<li>用户行为：<?php echo ($info["action"]); ?></li>
		<li>文档数：<?php echo ($info["article"]); ?></li>
		<li>分类数：<?php echo ($info["category"]); ?></li>
	</ul>
</div>
<div class="line20"></div>