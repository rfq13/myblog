@extends('admin.layouts')
@section('title','Categories')
@section('content')
<form action="{{ route('categories.store') }}" id="formStoreCategory" onsubmit="createCTG(event)" class="form-inline">
    <div class="form-group mx-sm-3 mb-2">
        <label for="name" class="sr-only">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Name">
    </div>
    <button type="submit" class="btn btn-primary mb-2">Create</button>
</form>

<table class="table table-borderless">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Last Modified</th>
      </tr>
    </thead>
    <tbody id="tableCtgBody">
        
    </tbody>
  </table>
@endsection

@push('script')
<script>
    const baseUrl = document.getElementById('base_url').value
    const token = document.getElementById('csrf_token').value
    const formCTG = document.getElementById('formStoreCategory')
    const dataForm = new FormData(formCTG)
    dataForm.append('_token',token);

    function createCTG(e) {
        e.preventDefault();
        const endpoint = baseUrl+"categories/store";
        const data = dataForm;

        data.append('name')

        axios({
            method: 'post',
            url: endpoint,
            data: data,
            // headers: {'Content-Type': 'multipart/form-data' }
        })
        .then(function (response) {
            console.log(response);
            console.log('removed');
        })
        .catch(function (error) {
            console.log(error);
        });
    }

    getctg()
    function getctg(){
        axios.get(baseUrl+'/categories/index')
        .then(response => {
            const posts = response.data.data;
            console.log(`GET ctg`, posts);
        })
        .catch(error => console.error(error));
    }

</script>
@endpush
