 tinymce.init({
        selector: '#mytextarea',
        height:600,
        plugins: 'code image',
        toolbar:'undo redo | image code',
        formats: {
            // Changes the default format for h1 to have a class of heading
            h1: { block: 'h1', classes: 'heading' }
          },
          style_formats: [
            // Adds the h1 format defined above to style_formats
            { title: 'My heading', format: 'h1' }
          ],
        
        forced_root_block : 'div',
        image_upload_url:'upload.php',
        images_upload_handler:function(blobInfo,success,failure){
            var xhr, formData;

            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', 'upload.php');

            xhr.onload = function() {
                var json;

                if (xhr.status != 200) {
                    failure('HTTP Error: ' + xhr.status);
                    return;
                }

                json = JSON.parse(xhr.responseText);

                if (!json || typeof json.location != 'string') {
                    failure('Invalid JSON: ' + xhr.responseText);
                    return;
                }
                success(json.location);
            };
            formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());

            xhr.send(formData);
             }
        });