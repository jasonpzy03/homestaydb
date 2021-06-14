function changeSize(size) {
		if(size == 1) {
			$("body").css("fontSize", "100%");
			$(".main-nav ul").css("margin-top", "32px");
			$(".cta a").css("width", "50px");
			$(".cta a").css("margin-top", "20px");
			$(".about").css("padding", "50px 40px");
			$(".contact").css("padding", "50px 40px");
		} else if(size == 2) {
			$("body").css("fontSize", "105%");
			$(".main-nav ul").css("margin-top", "31px");
			$(".cta a").css("width", "50px");
			$(".cta a").css("margin-top", "19px");
			$(".about").css("padding", "50px 40px");
			$(".contact").css("padding", "50px 40px");
		} else if(size == 3) {
			$("body").css("fontSize", "110%");
			$(".main-nav ul").css("margin-top", "29.5px");
			$(".cta a").css("width", "60px");
			$(".cta a").css("margin-top", "18px");
			$(".about").css("padding", "60px 40px 60px 40px");
			$(".contact").css("padding", "60px 40px 60px 40px");
		} else if(size == 4) {
			$("body").css("fontSize", "115%");
			$(".main-nav ul").css("margin-top", "28.5px");
			$(".cta a").css("width", "65px");
			$(".cta a").css("margin-top", "17px");
			$(".about").css("padding", "40px 40px 65px 40px");
			$(".contact").css("padding", "40px 40px 65px 40px");
		} else if(size == 5) {
			$("body").css("fontSize", "119%");
			$(".main-nav ul").css("margin-top", "27.5px");
			$(".cta a").css("width", "70px");
			$(".cta a").css("margin-top", "16px");
			$(".about").css("padding", "40px 40px 65px 40px");
			$(".contact").css("padding", "40px 40px 65px 40px");
		} 
		
	}