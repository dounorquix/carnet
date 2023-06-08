$(function(){

	$('#frm_login').submit(function(e){

		logi= $('#txt_usua').val();
		pass= sha1($('#txt_pass'). val().toString());
		inst=$('#cmd_inst option:selected').val();

        $.ajax({
			url:'auth/validate',
			async: false,
			type: 'POST',
			data:{
				logi: logi,
				pass: pass.toString(),
				inst: inst
			},
			success: function(data){
				switch(data.toString()){
                   case "inicio":
					redireccion("inicio");
					break;
					default:
						$("#spa_erro").html(data);

				}


			},


		});
		

		e.preventDefault();

	});

	function redireccion (contr, meth){
		location.replace("/version" + contr + (meth ? "/" + meth : ""));

	}

	function sha1(valo){
		return crypto.SHA1(valo);

	}

});










