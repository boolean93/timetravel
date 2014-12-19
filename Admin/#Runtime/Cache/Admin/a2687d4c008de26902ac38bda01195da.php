<?php if (!defined('THINK_PATH')) exit();?>
<div class="nlist-2">
	<h3>
		<i></i>
		站点信息
	</h3>
	<ul>
		<li>站点名称：<?php echo ($sysdata["systemname"]); ?></li>
		<li>系统版本：<?php echo ($sysdata["version"]); ?></li>
		<li>版本更新时间：<?php echo ($sysdata["updatetime"]); ?></li>
		<li>MySQL版本：<?php echo ($sysdata["mysql"]); ?></li>
		<li>PHP版本：<?php echo ($sysdata["php_version"]); ?></li>
		<li>文件上传目录：<?php echo ($sysdata["uploadDirectory"]); ?></li>
	</ul>
</div>
<div class="line20"></div>