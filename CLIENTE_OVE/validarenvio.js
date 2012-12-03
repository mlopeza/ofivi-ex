window.onload = initForm;

function initForm() {
		document.forms[0].onsubmit = function() {return validForm();}
}


function validForm() {
	var allGood = true;
	var allInputs = document.getElementsByTagName("input");
                                                    
     name =document.getElementById("name").value;
     mail =document.getElementById("mail").value;
     empresa =document.getElementById("empresa").value;
     cdo =document.getElementById("cdo").value;
     comments =document.getElementById("comment").value;  
                  if (name == "" ){
			allGood = false;
                  document.getElementById("name").className="invalid" ;
                  document.getElementById("nam").innerHTML=" *Ingresa tu nombre por favor";
		}else{document.getElementById("name").className="";
                  document.getElementById("nam").innerHTML=""; }  

                  if (mail == "" ){
			allGood = false;
                  document.getElementById("mail").className="invalid" ;
                  document.getElementById("mai").innerHTML=" *Ingresa tu correo electronico por favor";
		}else{document.getElementById("mail").className="";
                  document.getElementById("mai").innerHTML=""; } 
                  
                                   if (empresa == "" ){
			allGood = false;
                  document.getElementById("empresa").className="invalid" ;
                  document.getElementById("empr").innerHTML=" *Ingresa tu edad por favor";
		}else{document.getElementById("empresa").className="";
                  document.getElementById("empr").innerHTML=""; }  
                  
                                    if (cdo == "" ){
			allGood = false;
                  document.getElementById("cdo").className="invalid" ;
                  document.getElementById("cd").innerHTML=" *Ingresa tu ciudad por favor";
		}else{document.getElementById("cdo").className="";
                  document.getElementById("cd").innerHTML=""; } 
     
                  
                  if (comments == "" ){
			allGood = false;
                  document.getElementById("comment").className="invalid" ;
                  document.getElementById("com").innerHTML="*Es necesario que informes tu pedido, Gracias";
		}else{document.getElementById("comment").className="";
                  document.getElementById("com").innerHTML=""; }  
                  
                      
			      
	return allGood;
}

function resetForm() {
	var allInputs = document.getElementsByTagName("input");

	for (var i=0; i<allInputs.length; i++) {
            clase=allInputs[i].className;
		if (clase=="invalid") {
                  allInputs[i].className="reqd"

		}
	}

}