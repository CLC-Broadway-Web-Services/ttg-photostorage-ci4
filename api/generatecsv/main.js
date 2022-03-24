$("#button").click(function(){
	var csv = "csv";
	$.ajax({
		type: 'POST',
		url: 'data.php',
		data: {csv:csv},
	    success: function(result) {
	      console.log(result);
	      setTimeout(function() {
				  var dlbtn = document.getElementById("dlbtn");
				  var file = new Blob([result], {type: 'text/csv'});
				  dlbtn.href = URL.createObjectURL(file);
				  dlbtn.download = 'myfile.csv';
				  $( "#mine").click();
				}, 2000);
	    }
	});
});