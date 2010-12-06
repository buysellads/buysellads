jQuery(document).ready(function($) 
{
  // Set Timeout
  var t = setTimeout('fade_message()', 2000);
  
  // External Links
  $(function() {
    $('a[rel~=external]').attr('target', 'blank');
  });
    
});

// Fade Out Message
function fade_message() 
{
  jQuery('.fade').fadeOut(500);
  clearTimeout(t);
}