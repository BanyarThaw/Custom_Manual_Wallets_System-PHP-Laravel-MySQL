$(document).ready(function() {
    $(document).on('click','.payment_receipts', function(event) {
        //prevent default action
        event.preventDefault();
    
        //Get the modal
        var modal = document.getElementById("myModal");

        //Get the button that opens the modal
        var btn = document.getElementById("myBtn");

        //When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if(event.target == modal) {
                $("#myModal").fadeOut(500);
                
                // empty modal 2s later
                setTimeout(function() {
                    $('.modal-content div').empty();
                },1000);
            }
        }

        // // get href value
        var processFile = $(this).attr('href');

        $.ajax({
            url: processFile,
            type: "GET",
            dataType: 'text',
            success: function(response) {
                $('.modal-content div').html(response);

                // show modal 0.5s later
                setTimeout(function() {
                    $('.modal').fadeIn();
                },500);
            },
            error: function (error) {
                console.log('the page was NOT loaded', error); // show error message
            }
        });
    });
});