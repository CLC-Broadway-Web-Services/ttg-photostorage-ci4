
<!DOCTYPE html>
<html>
<head>
    <title>Print PDF using Dynamic iFrame</title>
    <style>
		* { font: 15px 'Segoe UI'; }
    </style>
</head>
<body>
    <input type="button" id="bt" onclick="" value="Print PDF" />
</body>

<script>
	let print = (doc) => {
    	let objFra = document.createElement('iframe');   // Create an IFrame.
        objFra.style.visibility = 'hidden';    // Hide the frame.
        objFra.src = 'https://ttg-photostorage.com/?filehash=<?php echo $_GET['filehash'] ?>&inline=true';                      // Set source.
         objFra.id = "doc1"; 
        document.body.appendChild(objFra);  // Add the frame to the web page.
        objFra.contentWindow.focus();       // Set focus.
     //   objFra.contentWindow.print();      // Print it.
    }
 print();
    document.getElementById("doc1").onload=document.getElementById("doc1").contentWindow.print();;
    
    // Using regular js features.
    
//     function print(doc) {
//         var objFra = document.createElement('iframe');
//         objFra.style.visibility = 'hidden';
//         objFra.src = doc;                  
//         document.body.appendChild(objFra);
//         objFra.contentWindow.focus();  
//         objFra.contentWindow.print();  
//     }
</script>
</html>