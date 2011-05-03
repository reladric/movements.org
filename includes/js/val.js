$(document).ready(function(){
	$('[name=reg_addr]').change(valem);
	$('[name=reg_pwd]').change(valpd);
	$('[name=reg_rpwd]').change(valrpd);
	$('[name=regform]').submit(function() {
		if(valem()&&valpd()&&valrpd())
		if(!$('[name=terms]').is(':checked'))
			alert('agreeing to terms of agreement is mandatory');
	return valem()&&valpd()&&valrpd()&&$('[name=terms]').is(':checked');
	 });
	function valem()
	{
		var a = $('[name=reg_addr]').val();
		var email = $('[name=reg_addr]');
		var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
		//if it's valid email
		var retval = "abc";
		if(filter.test(a)){
				$.ajax({
				url : 'includes/email.php',
				type : 'POST',
				data : ({email : a}),
				async : false,
				dataType : 'html',				
				success : function (data) {
					if(data == 1) {
							email.removeClass("error").addClass("valid");
							$('#einf').html("Email OK").removeClass("ierror").addClass("ivalid");
							retval =  true;
					}
					else {
							email.addClass("error").removeClass("valid");
							$('#einf').html("Email address already exists").addClass("ierror").removeClass("ivalid");
							retval = false;
					}
				},
				complete: function(a,b) {
				if(retval != "abc")
					return retval;
				else
					retval= false;
				}
				});
			return retval;	
		}
		//if it's NOT valid
		else{
			email.addClass("error").removeClass("valid");
			$('#einf').html("Invalid Email").addClass("ierror").removeClass("ivalid");
			return false;
		}

}
	function valpd(){
		var flag=false;
		var p=$('[name=reg_pwd]').val();
		var pwdd=$('[name=reg_pwd]');
		if(p.length<4){
			pwdd.addClass('error').removeClass('valid');
			$('#pinf').html("Password length should be greater than 4").removeClass("ivalid").addClass("ierror");
		}
		else{
			pwdd.addClass('valid').removeClass('error');
			$('#pinf').html("Password OK").removeClass("ierror").addClass("ivalid");
			flag=true;
		}
		return flag;
	}
	function valrpd(){
		var flag=false;
		var rp=$('[name=reg_rpwd]').val();
		var p=$('[name=reg_pwd]').val();
		var pwdd=$('[name=reg_rpwd]');
		if(rp.length<4){
			pwdd.addClass('error').removeClass('valid');
			$('#rpinf').html("Password length should be greater than 4").removeClass("ivalid").addClass("ierror");
		}
		else if (p!=rp){
			pwdd.addClass('error').removeClass('valid');
			$('#rpinf').html("Passwords didn't match").removeClass("ivalid").addClass("ierror");
		}
		else{
			pwdd.addClass('valid').removeClass('error');
			$('#rpinf').html("Repeat Password OK").removeClass("ierror").addClass("ivalid");
			flag=true;
		}
		return flag;
	}
});
