function CancelPage() {
  document.location.href= "index.php"
}


var i=1;

function copyAll(id)
{
	var chkbox,txtarea,n=document.getElementById("size"),name1;
	switch(id)
	{
		case "morn":
					chkbox=document.getElementById("morn");
					elem1=document.getElementById("morning_trip_1");
					name1="morning_trip_";
					break;
		case "ret130":
					chkbox=document.getElementById("ret130");
					elem1=document.getElementById("return_trip_130_1");
					name1="return_trip_130_";
					break;
		case "ret405":
					chkbox=document.getElementById("ret405");
					elem1=document.getElementById("return_trip_405_1");
					name1="return_trip_405_";
					break;
		case "ret510":
					chkbox=document.getElementById("ret510");
					elem1=document.getElementById("return_trip_510_1");
					name1="return_trip_510_";
					break;
	}
	
	if(chkbox.checked==true)
	{
		var j=2;
		var name0=name1;
		for(j=2;j<=parseFloat(n.value);j++)
		{
		j+='';
		name1+=j;
		var elemx=document.getElementById(name1);
		elemx.value=elem1.value;
		name1=name0;
		}
	}
	if(chkbox.checked==false)
	{
		var j=2;
		var name0=name1;
		for(j=2;j<=parseFloat(n.value);j++)
		{
		j+='';
		name1+=j;
		var elemx=document.getElementById(name1);
		elemx.value="";
		name1=name0;
		}
	}
}

function delRow(num)
{
	var trtag = document.getElementById("date_" + num).parentNode.parentNode;
	var table = trtag.parentNode;
	table.removeChild(trtag);
	
}

function addInput()
{
	i++;
	var tbody = document.getElementById("form").getElementsByTagName("TBODY")[0];
	
	var newdiv = document.createElement('tr');

	var td1 = document.createElement('td');
	var td2 = document.createElement('td');
	var td3 = document.createElement('td');
	var td4 = document.createElement('td');
	var td5 = document.createElement('td');
	var td6 = document.createElement('td');
	var td7 = document.createElement('td');
	
	
	var name="date_" + i;
	var morning_trip="morning_trip_" + i;
	var noon_trip="return_trip_130_" + i;
	var even_trip="return_trip_405_" + i;
	var five_trip="return_trip_510_" + i;
	
	td1.innerHTML = "<input type='text' size='10' name=" + name +" id="+ name + ">";
	
	td2.innerHTML= "<textarea name=" + morning_trip + " id=" + morning_trip + "></textarea>";
	
	td3.innerHTML= "<textarea name=" + noon_trip + " id=" + noon_trip + "></textarea>";

	td4.innerHTML= "<textarea name=" + even_trip + " id=" + even_trip + "></textarea>";

	td5.innerHTML= "<textarea name=" + five_trip + " id=" + five_trip + "></textarea>";
	
	td6.innerHTML= "<input type='button' class='deleterow' value='Delete row'  />";
	
	td7.innerHTML= "<input type='hidden' name='id' id='id' value=" + i + "  />";
	
        
	newdiv.appendChild(td1);
	newdiv.appendChild(td2);
	newdiv.appendChild(td3);
	newdiv.appendChild(td4);
	newdiv.appendChild(td5);
	newdiv.appendChild(td6);
	newdiv.appendChild(td7);
	
	var n=document.getElementById("size");
	n.setAttribute("value",i);
	
	tbody.appendChild(newdiv);
	$('textarea').expandable();
	$("#date_" + i).datepicker({dateFormat: 'dd/mm/y',showAnim: 'scale' });
	$('input.deleterow').click(function() {
		$(this).parent().parent().remove();
    });
	
     
    $('input.deleterow').confirm();
	//$("input:button,input:submit").button();
}
