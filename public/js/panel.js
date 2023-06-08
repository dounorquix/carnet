/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */



$(function(){
		$("#mostrar").click(function(event) {
			event.preventDefault();
			$("#caja").slideToggle();
		});

		$("#caja a").click(function(event) {
			event.preventDefault();
			$("#caja").slideUp();
		});
      
      $("#mostrar2").click(function(event) {
			event.preventDefault();
			$("#caja2").slideToggle();
		});

		$("#caja2 a").click(function(event) {
			event.preventDefault();
			$("#caja2").slideUp();
		});
	});
