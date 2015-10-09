function showErrorLogs(error) {
    		var ol = document.querySelector("div.error > ol");
    		var div = document.querySelector("div.error");
    		if(!ol) {
    			ol = document.createElement("ol");
    			div.appendChild(ol);
    		}
   			var li = document.createElement("li");
   			li.innerHTML = error;
   			ol.appendChild(li);
    	}
    	
function clearErrorLog() {
    		var div = document.querySelector("div.error");
    		var img = document.getElementById("preview");
    		div.innerHTML = "";
    		img.src = "";
    	}
    	
function validateInput(){
    		clearErrorLog();
    		var uname = document.forms["myForm"]["uname"].value;
    		var pwd = document.forms["myForm"]["pwd"].value;
    		var cpwd = document.forms["myForm"]["cpwd"].value;
    		var em = document.forms["myForm"]["e-mail"].value;
    		var error = true;
			var file = document.forms["myForm"]["profileIcon"].files[0];
      		
      		var maxsize = 2*1024*1024; // 2m
      		var error = true;
      		
    		if(file && file.size > maxsize) {
    			showErrorLogs("File Should Exist and The size should less than 2M");
    			error = false;
    		}
    		
    		if(em =="" || em ==null){
    			showErrorLogs("Email must be filled!");
    			error = false;
    		}
    		if(file && !/\.(jpg|png|gif|jpeg)$/gi.test(file.name)) {
    			showErrorLogs("The file you upload is not valid,please upload an image");
    			error = false;
    		}
      		
    		if(uname == "" || uname == null){
    			showErrorLogs("Sorry, Username can not be empty");
    			error = false;
    		}
    		if(pwd == "" || pwd == null ){
    			showErrorLogs("Sorry, Password cannot be empty");
    			error = false;
    		}
    		else if(cpwd != pwd){
    			showErrorLogs("Sorry, Two passwords do not match");
    			error = false;
    		}
    		
    		if(!error) {
    			return false;
    		} else {
    			return true;
    		}
    	}
    	
function showimg(input) {
    		var file = input.files[0];
    		var reader = new FileReader();
    		var maxsize = 2*1024*1024; // 2m
    		if(!file || file.size > maxsize) {
    			return;
    		}
    		if(!/\.(jpg|png|gif|jpeg)$/gi.test(file.name)) {
    			return;
    		}
    		reader.onloadend = function () {
    			var img = document.getElementById("preview");
    			img.src = reader.result;
    		}
    		if(file) {
    			reader.readAsDataURL(file);
    		}
    	}



    	