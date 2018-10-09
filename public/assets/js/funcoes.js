$(document).ready(function() {
	$(".mapa-tipo-select").change(function(){
		var tipoC = $(this).val();
		$.post("/mapas/carregar-classificacao",
		    {
				tipo: tipoC
		    },
		    function(data, status){
		        $("#classificacao-tipo").html(data);
		    });
	});
});
