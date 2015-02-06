function form_check(){
	var oDiv = document.getElementById('r_box');
	var oEmail =getByClass(oDiv,'r_email')[0];
	var c_Email =getByClass(oDiv,'config_email')[0];
	var oPsw =getByClass(oDiv,'r_psw')[0];
	var c_psw = getByClass(oDiv,'config_psw')[0];
	var oRepsw =getByClass(oDiv,'r_repsw')[0];
	var c_repsw = getByClass(oDiv,'config_repsw')[0];
	var oPhone = getByClass(oDiv,'r_phone')[0];
	var c_phone = getByClass(oDiv,'config_phone')[0];
	//youxiangyanzheng
	oEmail.onblur = function(){
		var econtent = oEmail.value;
		var eReg = /^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)+$/; 
		if(eReg.test(econtent)){
			c_Email.innerHTML = '';
			return true;
		}else if(oEmail.value==''){
			c_Email.innerHTML = '请输入邮箱';
			return false;
		}else{
			c_Email.innerHTML = '请输入正确的邮箱';
			return false;
		}
	}
	//mimayangzheng
	oPsw.onblur = function(){
		var pswcontent = oPsw.value;
		var re = getByClass(oDiv,'r_repsw')[0].value;
		if(pswcontent ==''){
			c_psw.innerHTML = '请输入密码';
			return false;
		}else if(re){
			if(re== pswcontent){
				c_psw.innerHTML = '';
				c_repsw.innerHTML = '';
				return true;
			}else{
				c_psw.innerHTML = '密码不一致';
				return false;
			}
		}else{
			c_psw.innerHTML = '';
				return true;
		}
	}
	//chongfumima
	oRepsw.onblur = function(){
		var repswcontent = oRepsw.value;
		var psw =getByClass(oDiv,'r_psw')[0].value;
		if(repswcontent==''){
			c_repsw.innerHTML = '请输入重复密码';
			return false;
		}else if(repswcontent != psw){
			c_repsw.innerHTML = '密码不一致';
			return false;
		}else{
			c_repsw.innerHTML = '';
			return true;
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


function login_box(){
	var oD = document.getElementById('order');
	oD.style.width=document.body.clientWidth+'px';
    oD.style.height=document.body.clientHeight+'px';
    oD.style.filter = 'alpha(opacity=50)';
    oD.style.opacity = 0.5;
    oD.style.background = '#000';
    var oDe  = document.getElementById('login_box');
    var oY = document.getElementById('login');
    var oYs = document.getElementById('logins');
    var oN = document.getElementById('cancel');
    var te = (document.documentElement.clientWidth-772)/2 +'px';
    oDe.style.left = te;
    oY.onclick =function(){
        oD.style.display = 'block';
        oDe.style.display = 'block';
    }
    oYs.onclick =function(){
        oD.style.display = 'block';
        oDe.style.display = 'block';
    }
    oN.onclick = function(){
    	oD.style.display = 'none';
        oDe.style.display = 'none';
    }
}