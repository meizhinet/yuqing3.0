<?php
/**
 * 添加管理员组  admingroup_add.php
 *
 * @version		    $Id$
 * @createtime		2018/03/01
 * @updatetime		2018/03/01
 * @author          空竹
 * @copyright		Copyright (c) 芝麻开发 (http://www.zhimawork.com)
 */
	require_once('admin_init.php');
	require_once('admincheck.php');

	$POWERID       = '7001';//权限
	Admin::checkAuth($POWERID, $ADMINAUTH);

    $FLAG_LEFTMENU = 'admingroup_add';
	$FLAG_TOPNAV   = 'system';
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="author" content="芝麻开发 http://www.zhimawork.com" />
		<link rel="stylesheet" href="css/style.css" type="text/css" />
		<link rel="stylesheet" href="css/form.css" type="text/css" />
		<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
		<script type="text/javascript" src="js/layer/layer.js"></script>
		<script type="text/javascript" src="js/common.js"></script>
		<script type="text/javascript">
			$(function(){
				$('#btn_submit').click(function(){

					var admingroup_name = $('input[name="admingroup_name"]').val();
					var admingroup_type = $('#admingroup_type').val();
					
					if(admingroup_name == ''){
						layer.tips('组名不能为空', '#s_admingroup_name');
						return false;
					}
					if(admingroup_type == ''){
						layer.tips('组类型不能为空', '#s_admingroup_type');
						return false;
					}
					$.ajax({
						type        : 'POST',
						data        : {
								admingroup_name  : admingroup_name,
								admingroup_type  : parseInt(admingroup_type)
						},
						dataType:     'json',
						url :         'admingroup_do.php?act=add',
						success :     function(data){
											var code = data.code;
											var msg  = data.msg;
											switch(code){
												case 1:
													layer.alert(msg, {icon: 6,shade: false}, function(index){
														parent.location.reload();
													});
													break;
												default:
													layer.alert(msg, {icon: 5});
											}
									  }
					});
				});
			});
		</script>
	</head>
	<body>
		<div id="maincontent">
			<div id="formlist">
				<p>
					<label>组名称</label>
					<input type="text" class="text-input input-length-30" name="admingroup_name" id="admingroup_name" />
					<span class="warn-inline" id="s_admingroup_name">* </span>
				</p>
				<p>
					<label>组类型</label>
					<select name="admingroup_type" id="admingroup_type" class="select-option">
						<?php
							foreach($ARRAY_admin_type as $key => $value){
								echo '<option value="'.$key.'">'.$value.'</option>';
							}
						?>
					</select>
					<span class="warn-inline" id="s_admingroup_type">* </span>
				</p>
				<p>
					<label>　　</label>
					<input type="submit" id="btn_submit" class="btn_submit" value="提交" />
				</p>
			</div>
		</div>
	</body>
</html>