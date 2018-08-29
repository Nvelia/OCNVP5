$(document).ready(function(){
     $("#myTextField").on('keyup', function() { 
             var input = $(this).val(); // We take the input value
             if ( input.length >= 1 ) { 
                     var data = {input: input}; // We pass input argument in Ajax
                     $.ajax({
                             type: "POST",
                             url: ROOT_URL + "autocomplete", 
                             data: data, // Send dataFields var
                             dataType: 'json', // json method
                             timeout: 3000,
                             success: function(response){ 
                                     $('#match').html(response.storyList); // Return data
                                     $('.story').css('display', 'none');
                                     $('#pagination').css('display', 'none');
                             },
                             error: function() { 
                                     $('#match').text('Aucune suggestion.');
                             }
                     });
             } else {
                     $('#match').text('');
                     $('.story').css('display', '');
                     $('#pagination').css('display', '');
             }
     });
 });