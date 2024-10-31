jQuery( function() {

	 var editor = CodeMirror.fromTextArea(mwa_rgl_desc_custcss, {
	    lineNumbers: true,
	    mode: "text/html",
        extraKeys: {"Ctrl-Space": "autocomplete"},
        value: document.documentElement.innerHTML
	  });
	 
	jQuery( "#tabs" ).tabs();

	if (typeof(Storage) !== "undefined") {		
		var mwargl_tab 			= localStorage.getItem("mwargl_tab");		

		if(mwargl_tab==0){			
			jQuery( "#tabs" ).tabs({ active: mwargl_tab });
		}else if(mwargl_tab==1){			
			jQuery( "#tabs" ).tabs({ active: mwargl_tab });
		}else if(mwargl_tab==2){			
			jQuery( "#tabs" ).tabs({ active: mwargl_tab });
		}else if(mwargl_tab==3){			
			jQuery( "#tabs" ).tabs({ active: mwargl_tab });
		}else if(mwargl_tab==4){			
			jQuery( "#tabs" ).tabs({ active: mwargl_tab });
		}else{
			jQuery( "#tabs" ).tabs({ active: 0 });
		}
	}

	jQuery('.mwargl_scode').on('click', function(e){
		e.preventDefault();	

		var copyText = document.getElementById("inptxt_mwargl_scode");

		/* Select the text field */
		copyText.select();
		copyText.setSelectionRange(0, 99999); /* For mobile devices */

		/* Copy the text inside the text field */
		document.execCommand("copy");

		var x = document.getElementById("snackbar");
		x.className = "show";
		setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
	});

	jQuery('#mwargl_tab1').on('click', function(e){
		if (typeof(Storage) !== "undefined") {			 
			localStorage.setItem("mwargl_tab", "0");	
		} 
	});

	jQuery('#mwargl_tab2').on('click', function(e){
		if (typeof(Storage) !== "undefined") {			 
			localStorage.setItem("mwargl_tab", "1");
		}
	});

	jQuery('#mwargl_tab3').on('click', function(e){
		if (typeof(Storage) !== "undefined") {			 
			localStorage.setItem("mwargl_tab", "2");
		}
	});

	jQuery('#mwargl_tab4').on('click', function(e){
		if (typeof(Storage) !== "undefined") {			 
			localStorage.setItem("mwargl_tab", "3");
		}
	});

	jQuery('#mwargl_tab5').on('click', function(e){
		if (typeof(Storage) !== "undefined") {			 
			localStorage.setItem("mwargl_tab", "4");
		}
	});

	jQuery('#mwa_rglgallery_type').on('change', function(e){
		var galtypeval = jQuery('#mwa_rglgallery_type option:selected').val();		
		if( galtypeval == 1 ){
			jQuery('#thumbclrhover_1,#thumbclrhover_2,#thumb_bult_clr,#thumb_bult_type,#gal_navtype,#cap_posi,#cap_delay').hide();
			jQuery('#trans_effect,#mwa_rglgallery_thumb_border_clr,#mwa_rglgallery_thumb_border_size,#mwa_rglgallery_galcol,#mwa_rglgallery_thumblbl_bg_clr,#mwa_rglgallery_thumblbl_fg_clr,#mwa_rglgallery_thumblbl_opacity').show();
		}else if( galtypeval == 2 ){
			jQuery('#thumbclrhover_1,#thumbclrhover_2,#cap_posi,#cap_delay').hide();
			jQuery('#thumb_bult_clr,#thumb_bult_type,#gal_navtype,#trans_effect,#mwa_rglgallery_thumb_border_clr,#mwa_rglgallery_thumb_border_size,#mwa_rglgallery_galcol,#mwa_rglgallery_thumblbl_bg_clr,#mwa_rglgallery_thumblbl_fg_clr,#mwa_rglgallery_thumblbl_opacity').show();
		}else{

		}	
	});

	 jQuery( '.swipebox' ).swipebox();		
      var owl = jQuery('.owl-carousel');
      owl.owlCarousel({
        loop: true,
        autoplay:true,
        margin: 10,
        nav: true,
		navText: ["<div class='nav-btn prev-slide'></div>","<div class='nav-btn next-slide'></div>"],
        navRewind: false,
        responsive: {
          0: {
            items: 1
          },
          600: {
            items: 3
          },
          1000: {
            items: 5
          }
        }
      });
});