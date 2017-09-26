//la boite modale
	// Get the modal
	var modal = document.getElementById('myModal');
    
        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];
    
        //  open the modal 
        function afficheModal() {
            modal.style.display = "block";
        }
        // close the modal
        function cacheModal() {
            modal.style.display = "none";
        }
        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }
    
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
        // ============= end modal
    
        var explode = function(){
                setTimeout(afficheModal, 5000);
                setTimeout(cacheModal, 10000);
        };
    
        setInterval(explode, 15000);