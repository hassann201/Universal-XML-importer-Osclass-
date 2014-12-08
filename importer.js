      $(document).ready(function(){
            $("#user").hide();
            $("#email").change(function(){
                  $("#user").show();
               $("#user").text("Hola "+ $("#email option:selected").attr("class"));
                
                $("#user_email").val($("#email option:selected").text());
               $("#user_name").val($("#email option:selected").attr("class"));
            })
			$("#start").blur(function(){
				var st = $("#start").val();
				if(isNaN(st)){
					alert("Porfavor, intrduzca numero");
				
				}
			})
				$("#finish").blur(function(){
				var fin = $("#finish").val();
				if(isNaN(fin)){
					alert("Porfavor, intrduzca numero");
				
				}
			})
        })