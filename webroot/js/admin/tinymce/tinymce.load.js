$(function() {
    tinyMCE.init({
        selector: 'textarea[class="tinymce"]',
        plugins: [
            'advlist autolink autoresize lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools hr'
        ],
        toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'print preview media | forecolor backcolor emoticons',file_browser_callback: RoxyFileBrowser,
        image_advtab: true,
        autoresize_min_height: 350,
        imagetools_toolbar: "rotateleft rotateright | flipv fliph | editimage imageoptions",
        elements : "description",
        templates: [
          { title: 'Test template 1', content: 'Test 1' },
          { title: 'Test template 2', content: 'Test 2' }
        ],
        setup : function(ed) {
            ed.on('init', function() {
                this.getDoc().body.style.fontSize = '14px';
            });
        }
    }); 
});

function RoxyFileBrowser(field_name, url, type, win) {
    var roxyFileman = baseUrl + 'webroot/js/admin/tinymce/plugins/fileman/index.html';
    if (roxyFileman.indexOf("?") < 0) {     
      roxyFileman += "?type=" + type;   
    } else {
      roxyFileman += "&type=" + type;
    }
    roxyFileman += '&input=' + field_name + '&value=' + win.document.getElementById(field_name).value;
    if(tinyMCE.activeEditor.settings.language){
      roxyFileman += '&langCode=' + tinyMCE.activeEditor.settings.language;
    }
    tinyMCE.activeEditor.windowManager.open({
       file: roxyFileman,
       title: 'Roxy Fileman',
       width: 850, 
       height: 650,
       resizable: "yes",
       plugins: "media",
       inline: "yes",
       close_previous: "no"  
    }, {
        window: win,
        input: field_name
    });
    return false; 
}