var clicked = false;
	function view() {

		if(clicked) {
			document.getElementById('dropdownbox').setAttribute('style', 'display:none');
			document.getElementById('dropdown').style.transform = "rotate(0deg)"; 
			document.getElementById('bluedropdown').style.transform = "rotate(0deg)"; 
			
			clicked = false;
		} else {
			document.getElementById('dropdownbox').setAttribute('style', 'display:block');
			document.getElementById('dropdown').style.transform = "rotate(180deg)"; 
			document.getElementById('bluedropdown').style.transform = "rotate(180deg)"; 
			clicked = true;
		}
		

	}
