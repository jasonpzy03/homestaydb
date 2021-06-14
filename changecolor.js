function changeColor(color) {
		if(color == 1) {
			window.location.replace("index.php");

		} else if(color == 2) {
			$("p, h1, h2, h3, h4, h5, h6, a, li").css("color", "#e6a611");
			$(".banner a").css("background-color", "grey");
			$(".functionbtn").css("border", "1px solid grey");
			$(".functionbtn").mouseover(function() {
			    $(this).css("background-color","grey");
			}).mouseout(function() {
			    $(this).css("background-color","transparent");
			});
			$(".logoutbtn").css("color", "#e6a611");
			$(".logoutbtn").css("border", "1px solid grey");
			$(".logoutbtn").mouseover(function() {
			    $(this).css("background-color","grey");
			}).mouseout(function() {
			    $(this).css("background-color","transparent");
			});
			$(".banner a").css("border", "1px solid grey");
			$(".b2").css("background-color", "grey");
			$(".b2").css("border", "1px solid grey");
		} else if(color == 3) {
			$("p, h1, h2, h3, h4, h5, h6, a, li").css("color", "#89bf43");
			$(".banner a").css("background-color", "grey");
			$(".functionbtn").css("border", "1px solid grey");
			$(".functionbtn").mouseover(function() {
			    $(this).css("background-color","grey");
			}).mouseout(function() {
			    $(this).css("background-color","transparent");
			});
			$(".logoutbtn").css("color", "#89bf43");
			$(".logoutbtn").css("border", "1px solid grey");
			$(".logoutbtn").mouseover(function() {
			    $(this).css("background-color","grey");
			}).mouseout(function() {
			    $(this).css("background-color","transparent");
			});
			$(".banner a").css("border", "1px solid grey");
			$(".b2").css("background-color", "grey");
			$(".b2").css("border", "1px solid grey");
		} else if(color == 4) {
			$("p, h1, h2, h3, h4, h5, h6, a, li").css("color", "#c23b37");
			$(".banner a").css("background-color", "grey");
			$(".functionbtn").css("border", "1px solid grey");
			$(".functionbtn").mouseover(function() {
			    $(this).css("background-color","grey");
			}).mouseout(function() {
			    $(this).css("background-color","transparent");
			});
			$(".logoutbtn").css("color", "#c23b37");
			$(".logoutbtn").css("border", "1px solid grey");
			$(".logoutbtn").mouseover(function() {
			    $(this).css("background-color","grey");
			}).mouseout(function() {
			    $(this).css("background-color","transparent");
			});
			$(".banner a").css("border", "1px solid grey");
			$(".b2").css("background-color", "grey");
			$(".b2").css("border", "1px solid grey");
		}
		
	}