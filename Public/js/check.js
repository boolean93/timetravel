function check(){	
	//登陆框
	var oD = document.getElementById('order');
	oD.style.width=document.body.clientWidth+'px';
    oD.style.height=document.body.clientHeight+'px';
    oD.style.filter = 'alpha(opacity=50)';
    oD.style.opacity = 0.5;
    oD.style.background = '#000';
    var oDe  = document.getElementById('login_box');
    var oY = document.getElementById('login');
    var oN = document.getElementById('cancel');
     var te = (document.documentElement.clientWidth-772)/2 +'px';
    oDe.style.left = te;
    oY.onclick =function(){
        oD.style.display = 'block';
        oDe.style.display = 'block';
    }
    oN.onclick = function(){
    	oD.style.display = 'none';
        oDe.style.display = 'none';
    }
	
	//表单验证
	var oBody = document.getElementById('b_content');
	var oName = getByClass(oBody,'f_name')[0];
	var cName = getByClass(oBody,'c_name')[0];
	var oPhone = getByClass(oBody,'f_phone')[0];
	var cPhone = getByClass(oBody,'c_phone')[0];
	var oEmail = getByClass(oBody,'f_email')[0];
	var cEmail= getByClass(oBody,'c_email')[0];
	var oCheck = getByClass(oBody,'check')[0];
	var oGo = getByClass(oBody,'s_go')[0];
	//姓名验证
	oName.onblur = function(){
		var namecontent  = oName.value; 
		var Reg = /[^\u0000-\u00FF]/;
		if(Reg.test(namecontent)){
			cName.innerHTML = '';
			return true;
		}else if(namecontent==''){
			cName.innerHTML = '请输入你的姓名';
		}else{
			cName.innerHTML = '请输入正确的姓名';
		}
		
	}
	
	//电话验证
	oPhone.onblur = function(){
		var phonecontent = oPhone.value;
		phonecontent = phonecontent.replace(/\ /g,"");
		//alert(phonecontent);
		var p_reg= /^1\d{10}$/;
		//alert(c_phone);
		if(p_reg.test(phonecontent)){
			//alert(11);
			cPhone.innerHTML = '';
			return true;
		}else if(phonecontent==''){
			cPhone.innerHTML = '请输入联系手机';
			return false;
		}else{
			cPhone.innerHTML = '请输入正确的手机号码';
			return false;
		}
	}
	
	//邮箱验证
	oEmail.onblur = function(){
		var econtent = oEmail.value;
		var eReg = /^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)+$/; 
		if(eReg.test(econtent)){
			cEmail.innerHTML = '';
			return true;
		}else if(oEmail.value==''){
			cEmail.innerHTML = '请输入邮箱';
			return false
		}else{
			cEmail.innerHTML = '请输入正确的邮箱';
			return false;
		}
	}
	//判断复选框是否被选中
	oCheck.onclick = function(){
		// var test = oCheck.checked;
		// switch(test){
		// 	case false:
		// 	alert(1);
		// 		oCheck.checked= true;
		// 		return true;
		// 		break;
		// 	case true:
		// 	alert(2);
		// 		oCheck.checked = true;
		// 		return false;
		// 		break;
		// }
		if(oCheck.checked == "false"){
			oCheck.checked = true;
		}
		if(oCheck.checked =="true"){
			oCheck.checked= false;
		}
	}


	//提交按钮的时候判断是否全部的已经完成验证
	oGo.onclick = function(){
		if(oName.onblur()&&oPhone.onblur()&&oEmail.onblur()&&oCheck.checked){
			submit();     
		}else{
			history.go(0);
			return false;
		}
	}

	
}
function getByClass(oparent,sClass){
		var aResult=[];
		var aEle = oparent.getElementsByTagName('*');
		for(var i=0;i<aEle.length;i++){
			if(aEle[i].className==sClass){
				aResult.push(aEle[i]);
			}
		}
		return aResult;
}