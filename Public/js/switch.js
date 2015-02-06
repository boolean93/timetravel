function show(){
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
}
function switchImg()
{	
	getClass();
	var aBtn = Array.prototype.slice.call(document.getElementsByClassName('pre'));
	var aDiv = document.getElementsByClassName('switch-div');
	var aMove = document.getElementsByClassName('move');
	var aImg = document.getElementById('img');
	aImgimg = aImg.getElementsByTagName('img');
	aImli = aImg.getElementsByTagName('li');
	for(var i = 0,len = aImli.length; i < len; i++)
	{
		aImli[i].style.width = aImgimg[i].width;
	}
	for(var i = 0,len = aBtn.length; i < len; i++)
	{
		myDiv = aMove[i].getElementsByClassName("switch-div");
		aMove[i].style.left = -(myDiv.length - 1) * aDiv[0].offsetWidth + 'px';
		aMove[i].style.width = myDiv.length * aDiv[0].offsetWidth + 'px';

		//aMove[i].style.width = aDiv.length/3 * aDiv[0].offsetWidth + 'px';
		//aMove[i].style.left = -(aDiv.length/3 - 1 ) * aDiv[0].offsetWidth + 'px';
	}
	for(var i = 0,len = aBtn.length;i < len; i++)
	{
		(function(i)
		{
			aBtn[i].onclick = function()
			{
				myDiv = aMove[i].getElementsByClassName("switch-div");
				aBtn[i].disabled = true;
				if(aMove[i].offsetLeft < 0){
				Move(aMove[i],{left:aMove[i].offsetLeft + aDiv[0].offsetWidth},function()
				{
					aBtn[i].disabled = false;
				});
				}else{
				Move(aMove[i],{left:-(myDiv.length-1) * aDiv[0].offsetWidth},function()
				{
					aBtn[i].disabled = false;
				});
				}
				return;
			}
		})(i);
	}
}
function getClass()
{
	if(!document.getElementsByClassName)
	{  
		document.getElementsByClassName = function(className, element)
		{  
			var children = (element || document).getElementsByTagName('*');  
			var elements = new Array();  
			for (var i = 0; i < children.length; i++)
			{  
				var child = children[i];  
				var classNames = child.className.split(' ');  
				for (var j = 0; j < classNames.length; j++)
				{
					if (classNames[j] == className)
					{   
						elements.push(child);  
						break;  
					}  
				 }  
			}   
			return elements;  
		}  
	}  
}
function getStyle(obj, attr) 
{ 
	if(obj.currentStyle) 
	{ 
		return obj.currentStyle[attr]; 
	} 
	else 
	{ 
		return getComputedStyle(obj,false)[attr]; 
	} 
} 

function Move(obj,json,fn)
{
   clearInterval(obj.timer);
   obj.timer = setInterval(function()
   {
		var bStop = true;
		for(var attr in json)
		{
		   var iCur = 0;
		   if(attr == 'opacity')
		   {
				iCur = parseFloat( getStyle(obj,attr) * 100);
		   }
		   else
			{
				iCur = parseInt( getStyle(obj,attr));
			}
			var iSpeed = (json[attr]-iCur)/6;
			iSpeed=iSpeed>0?Math.ceil(iSpeed):Math.floor(iSpeed);
			if(iCur != json[attr])
			{
				bStop = false;
			}
			if(attr =='opacity')
			{
			   obj.style.filter = 'alpha(opacity:'+(iCur + iSpeed)+')';
			   obj.style.opacity = (iCur+iSpeed)/100;
			}
			else
			{
				 obj.style[attr] = iCur+iSpeed+'px';
			}
		}
			
		if(bStop)
		{
			clearInterval(obj.timer);
			if(fn)
			{
				fn();
			}
		}
		
	},30);
}