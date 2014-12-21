function show(){
		var oDiv = document.getElementById('slider');
		var oPrev = document.getElementById('prev');
		var oNext = document.getElementById('next');
		var oTr = document.getElementById('travel');
		var oEx = document.getElementById('explore');
		var aA = getByClass(oTr,'test');
		var nows1 = 0;
		var s_prev = getByClass(oEx,'s_prev')[0];
		var s_next = getByClass(oEx,'s_next')[0];
		var aLi2 = oEx.getElementsByTagName('li');
		//alert(aLi2.length);
		var aUl1 = oEx.getElementsByTagName('ul')[0];
		s_prev.onclick= function(){
			nows1--;
			if(nows1==-1){
				nows1 = aLi2.length-1;
			}
			startMove(aUl1,{left:-980*nows1});
		}
		s_next.onclick= function(){
			nows1++;
			if(nows1==aLi2.length){
				nows1=0;
			}
			//console.log(nows1);
			startMove(aUl1,{left:-980*nows1});
		}

		var nows =0
		var f_prev = getByClass(oTr,'f_prev')[0];
		var f_next = getByClass(oTr,'f_next')[0];
		var oLook = document.getElementById('pic_look');
		var oLo = getByClass(oTr,'look');
		//alert(oLo[0].offsetWidth);
		//oLook.style.Width = oLo.length*oLo[0].offsetWidth;
		//alert(oLook.style.Width);
		//alert(oLo.length);
		f_prev.onclick =function(){
			nows--;
			if(nows==-1){
				nows = oLo.length-1;
			}
			//alert(nows);
			//console.log(oLo.length);
			startMove(oLook,{left:-998*nows});
		}
		f_next.onclick =function(){
			nows++;
			if(nows==oLo.length){
				nows =0;
			}
			//console.log(oLo.length);
			startMove(oLook,{left:-998*nows});
		}
		var aLi1 = oTr.getElementsByTagName('li');
		var oUl = oDiv.getElementsByTagName('ul')[0];
		var aLi = oUl.getElementsByTagName('li');
		var oWid = aLi[0].offsetWidth;
		var now = 0;
		var times = null;
		
		for(var i = 0;i < aLi1.length ; i++)
		{
			aLi1[i].index = i;
			aLi1[i].onmouseover = function()
			{
				//alert(this.index);
				startMove(aA[this.index],{top:0});
			}
			aLi1[i].onmouseout =  function(){
				//alert(this.index);
				//aA[this.index].style.top = 166+'px';
				startMove(aA[this.index],{top:166});
			}
		}

		function tab(now){
			startMove(oUl,{left:-(oWid*now)});
		}
		oDiv.onmouseover = function(){
			oPrev.style.display ='block';
			oNext.style.display ='block';
			clearInterval(timers);
		}
		oDiv.onmouseout = function(){
			oPrev.style.display ='none';
			oNext.style.display ='none';
			timers = setInterval(oNext.onclick,2000);
		}
		oPrev.onclick = function(){
			now--;
			if(now==-1){
				now = aLi.length-1;
			}
			tab(now);
		}
		oNext.onclick = function(){
			now++;
			if(now==aLi.length){
				now=0;
			}
			tab(now);
		}
		 timers = setInterval(oNext.onclick,2000);
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

	    //young 训练营
	var t_now = 0;
	var oTrain = document.getElementById('train');
	var oBig = getByClass(oTrain,'big_pic')[0];
	var oTnext = getByClass(oTrain,'t_next')[0];
	var oTprev= getByClass(oTrain,'t_prev')[0];
	oTnext.onclick =function(){
		t_now++;
		if(t_now ==oSmall.length){
			t_now = 0;
		}
		for(var i=0,len = oSmall.length;i<len;i++){
				oSmall[i].style.filter = 'alpha(opacity:40)';
				oSmall[i].style.opacity = 0.4;
			}
		for(var i=0,len = oSmall.length;i<len;i++){
			oBig.src = oSmall[t_now].src;
			oSmall[t_now].style.filter = 'alpha(opacity:100)';
			oSmall[t_now].style.opacity = 1;
		}
	}
	oTprev.onclick =function(){
		//alert(t_now);
		t_now--;
		if(t_now ==-1){
			t_now = oSmall.length-1;
		}
		for(var i=0,len = oSmall.length;i<len;i++){
				oSmall[i].style.filter = 'alpha(opacity:40)';
				oSmall[i].style.opacity = 0.4;
			}
		for(var i=0,len = oSmall.length;i<len;i++){
			oBig.src = oSmall[t_now].src;
			oSmall[t_now].style.filter = 'alpha(opacity:100)';
			oSmall[t_now].style.opacity = 1;
		}
	}

	var oSmall = getByClass(oTrain,'small_pic');
	for(var i=0;i<oSmall.length;i++){
		oSmall[i].index =i;
		oSmall[i].onclick = function(){
			for(var i=0,len = oSmall.length;i<len;i++){
				oSmall[i].style.filter = 'alpha(opacity:40)';
				oSmall[i].style.opacity = 0.4;
			}
			t_now=this.index;
			oBig.src =this.src;
			this.style.filter = 'alpha(opacity:100)';
			this.style.opacity = 1;
		}
	}
}



window.onscroll = function(){
		 var oFix = document.getElementById("fixed");
		 var oTop = getByClass(oFix,'f_t')[0];
		if (document.documentElement.scrollTop + document.body.scrollTop > 360) { 
		    oFix.style.display = "block"; 
		} 
		else { 
		     oFix.style.display = "none"; 
		} 
}