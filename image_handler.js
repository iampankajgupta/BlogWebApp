 tinymce.init({
        selector: '#mytextarea',
        height:600,
        plugins: 'code image',
        toolbar:'undo redo | image code',
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