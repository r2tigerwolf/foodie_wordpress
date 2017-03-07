jQuery(document).ready(function( $ ) {
   $(document).on("click", ".expand-sidebar", function () {  
         if($('#sidebar').css("display") == "none") {
            $('#sidebar').slideDown("fast");
         } else {
            $('#sidebar').slideUp("fast");
         }
    });
    
    $(".center").insertBefore(".container.center");
    $(".left-headline").insertBefore(".center-headline");		
    $(".right-headline").insertAfter(".center-headline");
    
    $( ".left-headline" ).append($(".left-article"));
    $( ".center-headline" ).append($(".center-article"));
    $( ".right-headline" ).append($(".right-article"));
    $( ".default-headline" ).append($(".default-article"));
    
    $('td').each(function(){
        $('.right-article .the-content p').text($('.right-article .the-content p').text().substring(0,8)+"...");
    });
    
    
    $(".side-title").click(function(){
       $(this).next("ul").toggle( "slow");
    });

    // Just a hack.  Loop through each list. Copy text and url of each list.  Replace content of each list.

    $( ".recentcomments" ).each(function( index, item ) {
        var linktext = $(this).text();
        var linkurl = $(this).find("a:nth-child(2)").attr("href");        
        $(this).html("<a href='" + linkurl +"'>"+linktext+"</a>");
        
    });

});