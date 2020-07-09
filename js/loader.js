$(document).ready(function() {
    $("#change").load("home.html");
});
$('a').click(function(){
    var page = $(this).attr("href");
    $("#change").load(page);
    
    return false;
});