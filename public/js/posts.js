const baseUrl = document.getElementById('base_url').value
const token = document.getElementById('csrf_token').value
const formEditor = document.getElementById('formEditor')
const dataForm = new FormData(formEditor)

var froalaEditor = new FroalaEditor('#editor',
{
    height:500,
    placeholderText: 'Edit Your Content Here!',
    imageUploadMethod: "post",
    imageUploadURL: baseUrl+'/storage/upload-handle',
    imageUploadParam: "file",
    imageMove:true,
    imageUploadParams: {
      _token:token,
    },
    toolbarButtons: {
      'moreText': {
        'buttons': ['bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', 'fontFamily', 'fontSize', 'textColor', 'backgroundColor', 'inlineClass', 'inlineStyle', 'clearFormatting']
      },
      'moreParagraph': {
        'buttons': ['alignLeft', 'alignCenter', 'formatOLSimple', 'alignRight', 'alignJustify', 'formatOL', 'formatUL', 'paragraphFormat', 'paragraphStyle', 'lineHeight', 'outdent', 'indent', 'quote']
      },
      'moreRich': {
        'buttons': ['insertLink', 'insertImage', 'insertTable', 'emoticons', 'fontAwesome', 'specialCharacters', 'embedly', 'insertHR']
      },
      'moreMisc': {
        'buttons': ['undo', 'redo', 'fullscreen', 'print', 'getPDF', 'spellChecker', 'selectAll', 'html', 'help'],
        'align': 'right',
        'buttonsVisible': 2
      }
    },
    events: {
      'image.beforeUpload': function (images) {
        console.log('before upload');
      },
      'image.uploaded': function (response) {
        console.log(response);
      },
      'image.inserted': function ($img, response) {
        // Do something here.
        // this is the editor instance.
        console.log(this);
      },
      'image.replaced': function ($img, response) {
        // Image was replaced in the editor.
      },
      'image.removed': function ($img) {
        const path = $img.attr('src')
        .replace(baseUrl,"")
        storageHandle('remove',{'path':path});
      }
    }
})

const getPosts = () => {
    axios.get(baseUrl+'/posts/all')
    .then(response => {
     const posts = response.data.data;
     console.log(`GET posts`, posts);
   })
    .catch(error => console.error(error));
};

const storageHandle = (transaction = "upload", data) => {

  const formData = new FormData()
  formData.append('_token',token)
  let endpoint = baseUrl+'/storage/upload-handle';

  if (transaction == "remove") {
    endpoint = baseUrl+'/storage/remove-storage-handle';
    formData.append('path',data.path)
  }else{
    formData.append('file',data.file)
    formData.append('type',data.type)
  }
  

  axios({
      method: 'post',
      url: endpoint,
      data: formData,
      headers: {'Content-Type': 'multipart/form-data' }
  })
  .then(function (response) {
      console.log(response);
      console.log('removed');
  })
  .catch(function (error) {
      console.log(error);
  });
}

    


function test(e) {
    e.preventDefault();
    const endpoint = baseUrl+"/posts/create";

    const formData = new FormData()
    formData.append('_token',token)

    const data = {
      title:document.getElementById('title').value,
      content:froalaEditor.html.get(),
      thumbnail:document.getElementById('thumbnail').files[0],
    };
    formData.append('tittle',data.tittle);
    formData.append('thumbnail',data.thumbnail);
    formData.append('content',data.content);

    
    

    axios({
      method: 'post',
      url: endpoint,
      data: formData,
      headers: {'Content-Type': 'multipart/form-data' }
  })
  .then(function (response) {
      console.log(response);
  })
  .catch(function (error) {
      console.error(error,'hoooy');
  });
}


getPosts();

