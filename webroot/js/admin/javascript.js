/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function(){
    
    /* load - resize browser */
    $(window).bind("load resize", function() {
        topOffset = 60;
        width = this.window.innerWidth > 0 ? this.window.innerWidth : this.screen.width; 
        width < 768 ? ($("div.navbar-collapse").addClass("collapse"), topOffset = 100) : $("div.navbar-collapse").removeClass("collapse"); 
        height = (this.window.innerHeight > 0 ? this.window.innerHeight : this.screen.height) - 1, 
        height -= topOffset; 
        height < 1 && (height = 1); 
        height > topOffset && $("#page-wrapper").css("min-height", height + "px");
    });
    
    /* check all checkbox */
    $('#checkall').click(function () {
        var thisCheck = $(this);
        if (thisCheck.is(':checked')) {
            $('.table input.checkbox').prop('checked', true);
        } else {
            $('.table input.checkbox').removeAttr('checked');
        }
    });
    
    /* loadings */
    $(".preloader").fadeOut();
    /* navbar */
    $("#side-menu").metisMenu();
    
    /* disable feature image */
    $('.delete-icon').click(function(){
        $(this).parent().hide();
        $('#remove_feature_image').val(1);
    });
    
    //$('#tags').parent().find('.bootstrap-tagsinput').addClass('bootstrap-tagsinput-parent');
    /*
    var tags = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        prefetch: {
            url: baseUrl + 'tags/get-list-tags-name.json',
            filter: function(list) {
                return $.map(list, function(tags) {
                    return { name: tags }; 
                });
            }
        }
    });
    
    
    tags.initialize();

    $(".bootstrap-tagsinput input:not('.typeahead')").tagsinput({
        typeaheadjs: {
            name: 'tags',
            displayKey: 'name',
            valueKey: 'name',
            source: tags.ttAdapter()
        }
    });

    */  
});