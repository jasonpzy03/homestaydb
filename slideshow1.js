r1 = document.getElementById("r1");
	r2 = document.getElementById("r2");
	r3 = document.getElementById("r3");
	r4 = document.getElementById("r4");
	r5 = document.getElementById("r5");
	b1 = document.getElementById("b1");
	b2 = document.getElementById("b2");
	b3 = document.getElementById("b3");
	b4 = document.getElementById("b4");
	b5 = document.getElementById("b5");
	function checkBar() {
		 removeBar();
	if(r1.checked) {
    	b1.classList.add("barselected");
    }   else if(r2.checked) {
    	b2.classList.add("barselected");
    	
    } else if(r3.checked) {
    	b3.classList.add("barselected");
    	
    } else if(r4.checked) {
    	b4.classList.add("barselected");
    	
    } else if(r5.checked) {
    	b5.classList.add("barselected");
    	
    } 

		
	}

	function removeBar() {


    	b1.classList.remove("barselected");

    	b2.classList.remove("barselected");

    	b3.classList.remove("barselected");

    	b4.classList.remove("barselected");

    	b5.classList.remove("barselected");
    	

	}
	window.onload = function () {

    function changeImage() {
    if(r1.checked) {
    	r2.checked = true;
    }   else if(r2.checked) {
    	r3.checked = true;
    	
    } else if(r3.checked) {
    	r4.checked = true;
    	
    } else if(r4.checked) {
    	r5.checked = true;
    	
    } else if(r5.checked) {
    	r1.checked = true;
    	
    } 

    }
    window.setInterval(changeImage, 3500);
     window.setInterval(checkBar, 1);
}