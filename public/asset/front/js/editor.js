tinymce.init({
    selector: 'textarea',
    //skin: 'myldl',
    language: 'ru',
    height: 400,
    plugins: [
        'advlist autolink lists link image charmap print preview hr anchor pagebreak',
        'searchreplace wordcount visualblocks visualchars code fullscreen',
        'insertdatetime media nonbreaking save table contextmenu directionality',
        'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc'
    ],
    toolbar1: 'undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media emoticons codesample | forecolor backcolor',
    toolbar2: 'preview code',
    image_advtab: true,
    relative_urls: false,
    remove_script_host: false,
    document_base_url: window.protocol + '//' + window.hostname + '/new',
    images_upload_url: '/new/ajax/upload',
    images_upload_credentials: true,
    file_picker_types: 'image media',
    file_picker_callback: function(cb, value, meta) {
        var input = document.createElement('input');

        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'video/*|image/*');
        input.onchange = function() {
            var file = this.files[0];
            var id = 'blobid' + (new Date()).getTime();
            var blobCache = tinymce.activeEditor.editorUpload.blobCache;
            var blobInfo = blobCache.create(id, file);

            blobCache.add(blobInfo);

            cb(blobInfo.blobUri(), { title: file.name });
        };

        input.click();
    },
    content_css: [
        '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
        '//www.tinymce.com/css/codepen.min.css'
    ]
});