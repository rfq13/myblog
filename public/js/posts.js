// import axios from 'axios';
axios.defaults.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');
const baseUrl = document.getElementById('base_url').value
const formEditor = document.getElementById('formEditor')
const dataForm = new FormData(formEditor)
const postUpdate = document.getElementById('postupdate')

$('.selectpicker').selectpicker();

  if (postUpdate != null) {
    const data = JSON.parse(postUpdate.value)
    $('#thumbnail').attr("data-default-file", baseUrl+"/storage/app/"+data.thumbnail);
  }

$('#thumbnail').dropify();

var froalaEditor = new FroalaEditor('#editor',
{
    height:500,
    placeholderText: 'Edit Your Content Here!',
    imageUploadMethod: "post",
    imageUploadURL: baseUrl+'/storage/upload-handle',
    imageUploadParam: "file",
    imageMove:true,
    imageUploadParams: {
      _token:$('meta[name="csrf-token"]').attr('content'),
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
      },
      'initialized':function () {
        if (postUpdate != null) {
          const data = JSON.parse(postUpdate.value)
          froalaEditor.html.set(data.content);
        }
      }
    }
})

const getPosts = () => {
    axios.get(baseUrl+'/admin/posts/all')
    .then(response => {
     const posts = response.data.data;
     console.log(`GET posts`, posts);
   })
    .catch(error => console.error(error));
};

const storageHandle = (transaction = "upload", data) => {

  const formData = new FormData()
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

function create(e) {
    e.preventDefault();
    const endpoint = baseUrl+"/admin/posts/store";

    const formData = new FormData()
    const data = {
      title:document.getElementById('title').value,
      category:$('.selectpicker').selectpicker('val'),
      content:froalaEditor.html.get(),
      thumbnail:document.getElementById('thumbnail').files[0],
    };

    console.log(data.category,'ctg');

    formData.append('title',data.title);
    formData.append('thumbnail',data.thumbnail);
    formData.append('content',data.content);
    formData.append('category',data.category);

    axios({
      method: 'post',
      url: endpoint,
      data: formData,
      headers: {'Content-Type': 'multipart/form-data' }
    })
    .then(function (response) {
        console.log(response.data);
        const formEditor = document.getElementById('formEditor')
        formEditor.reset()
        $('.selectpicker').selectpicker('val','');
        $('.selectpicker').selectpicker('refresh');
    })
    .catch(function (error) {
        console.error(error,'hoooy');
    });
}

function getCategories() {
  axios.get(baseUrl+'/categories')
    .then(response => {
      categories = response.data
      const selector = document.getElementById('selectpicker')
      let option = "";
      data = "";
      if (postUpdate != null) {
        data = JSON.parse(postUpdate.value).category
      }
      categories.data.forEach((el,i) => {
        option += `
          <option ${el.id == data ? 'selected' : ''} value="${el.id}">${el.name.toUpperCase()}</option>
        `
      });
      $("#selectpicker").html(option)
      $('.selectpicker').selectpicker('refresh');
    })
    .then(el=>{
      const value = $("#selectpicker").val()
      $('.selectpicker').val(value);
      $('.selectpicker').selectpicker('refresh');
    })
    .catch(error => console.error(error));
}

function checkUpdate() {
  if (postUpdate != null) {
    const data = JSON.parse(postUpdate.value)
    document.getElementById('title').value = data.title
    $('#selectpicker').val(data.category);
    $('#selectpicker').selectpicker('refresh');
  }
}

function update(e,id) {
  e.preventDefault()
  
  const formData = new FormData()
  const data = {
    title:document.getElementById('title').value,
    category:$('.selectpicker').selectpicker('val'),
    content:froalaEditor.html.get(),
    thumbnail:document.getElementById('thumbnail').files[0],
  };
  formData.append('title',data.title);
  formData.append('thumbnail',data.thumbnail);
  formData.append('content',data.content);
  formData.append('category',data.category);

  axios({
    method:'post',
    url:baseUrl+"/admin/posts/"+id,
    data:formData,
    headers: {'Content-Type': 'multipart/form-data' }
  })
  .then((response)=>{
    if(response.data.messages == "success"){
      window.location.href=baseUrl+"/admin/posts"
    }
  })
  .catch((err)=>{
    console.error(err);
  })
}

getCategories();
checkUpdate();