function setUnitsCookie()
{
	var uc = getCookie('ogc_units') ;
	
	if  ( uc == 'US_standard' )
	{ 
		customize_cookie('usstandard') ;
		document.getElementById('unit_usstandard').checked  = true;
		document.getElementById('unitus').style.display  = '';
		document.getElementById('unitmetric').style.display  = 'none';
	}
	else if ( uc == 'Metric' ) 
 	{
		customize_cookie('metric') ;
		document.getElementById('unit_metric').checked  = true;
		document.getElementById('unitmetric').style.display  = '';
		document.getElementById('unitus').style.display  = 'none';
	}
	else
		setCookie('ogc_units', 'US_standard', 3600000);
}

function customize_cookie(obj) 
{
     
	if ( obj == 'usstandard' ) 
	{
		setCookie('ogc_units', 'US_standard', 3600000);
		document.getElementById('unitus').style.display  = '';
		document.getElementById('unitmetric').style.display  = 'none';		
	}
	else if  ( obj == 'metric' ) 
	{
		setCookie('ogc_units', 'Metric', 3600000);
		document.getElementById('unitmetric').style.display  = '';
		document.getElementById('unitus').style.display  = 'none';		
	}	 
}

 
function setCookie(c_name,value,exdays)
{
	var exdate=new Date();
	exdate.setDate(exdate.getDate() + exdays);
	var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
	document.cookie=c_name + "=" + c_value;
}

function getCookie(c_name)
{
	var i,x,y,ARRcookies=document.cookie.split(";");
	for (i=0;i<ARRcookies.length;i++)
	{
	  x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
	  y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
	  x=x.replace(/^\s+|\s+$/g,"");
	  if (x==c_name)
	  {
		return unescape(y);
	  }
	}
}
 
