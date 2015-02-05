function showPic(Img,Img_l,Img_detail){
		var Img_width = Img.offsetWidth;
		var Img_height = Img.offsetHeight;
		var Img_dwidth = Img_detail.offsetWidth;
		var Img_dheight = Img_detail.offsetHeight;
		var Timer = null;
		if((Img_dwidth>=Img_width&&Img_dheight>=Img_height)||(Img_dwidth>=Img_width&&Img_dheight<Img_height)){
			Img_twidth = Img_width/2;
			Img_detail.style.height = Img_height +'px';
			Img_l.style.left = 0 + 'px';
			Img_l.style.top = 0 + 'px';
			Img.onmousemove = function(ev){
				clearInterval(Timer);
				Timer = setInterval(function(){
					var event = ev||window.event;
					var x = event.clientX;
					var y = event.clientY;
					var divX = Img.offsetLeft;
					var left = x-divX;
					console.log(divX);
					var Img_dwidth = Img_detail.offsetWidth;
					if(Img_dwidth >=Img_width){
						var speed = 7;
						var Img_cwidth = Img_dwidth-Img_width;
						if(left>Img_twidth){
							if(Img_l.offsetLeft <= -Img_cwidth){
								clearInterval(Timer);
							}else{
								Img_l.style.left = Img_l.offsetLeft-speed+'px';
							}
						}else{
							console.log("ff");
							if(Img_l.offsetLeft>=0){
								clearInterval(Timer);
							}else{
								Img_l.style.left = Img_l.offsetLeft+speed+'px';
							}
						}
					}else{
						Img_detail.style.width = Img_width +'px';
						Img_detail.style.height = Img_height +'px';
						Img_l.style.left = 0 + 'px';
						Img_l.style.top = 0 + 'px';
					}
				},30);
			}
		}else{
			Img_detail.style.width = Img_width +'px';
			Img_detail.style.height = Img_height +'px';
			Img_l.style.left = 0 + 'px';
			Img_l.style.top = 0 + 'px';
		}
		Img.onmouseout = function(){
			clearInterval(Timer);
		}
	}

	function showPi(Img,Img_l,Img_detail){
		var Img_width = Img.offsetWidth;
		var Img_height = Img.offsetHeight;
		var Img_dwidth = Img_detail.offsetWidth;
		var Img_dheight = Img_detail.offsetHeight;
		var Timer = null;
		if((Img_dwidth>=Img_width&&Img_dheight>=Img_height)||(Img_dwidth>=Img_width&&Img_dheight<Img_height)){
			Img_twidth = Img_width/2;
			Img_detail.style.height = Img_height +'px';
			Img_l.style.left = 0 + 'px';
			Img_l.style.top = 0 + 'px';
			Img.onmousemove = function(ev){
				clearInterval(Timer);
				Timer = setInterval(function(){
					var event = ev||window.event;
					var x = event.clientX;
					var y = event.clientY;
					var divX = Img.offsetLeft;
					var left = x-divX;
					var Img_dwidth = Img_detail.offsetWidth;
					
				},30);
			}
		}else{
			Img_detail.style.width = Img_width +'px';
			Img_detail.style.height = Img_height +'px';
			Img_l.style.left = 0 + 'px';
			Img_l.style.top = 0 + 'px';
		}
		Img.onmouseout = function(){
			clearInterval(Timer);
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