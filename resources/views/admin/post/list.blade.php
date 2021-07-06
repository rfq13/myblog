@extends('admin.layouts')
@section('title','Blogs')

@section('content')
<style>
  .toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20px; }
  .toggle.ios .toggle-handle { border-radius: 20px; }
</style>
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Visibility</th>
        <th scope="col">Modified</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      @php
          $posts = \App\Models\Post::orderby('created_at','desc')->get();
          $no=1;
      @endphp
      @foreach ($posts as $post)
        <tr>
          <th scope="row">{{ $no++ }}</th>
          <td>{{ \Illuminate\Support\Str::limit($post->title,30) }}</td>
          <td>
            <input type="checkbox" onchange="visibility(event,this,{{ $post->id }})" {{ $post->show == 1 ? 'checked' : ""}} data-toggle="toggle" data-style="ios">
          </td>
          <td>{{ $post->modified }}</td>
          <td>
            
            <!-- Example single danger button -->
            <div class="btn-group">
              <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{-- <i class="fa fa-caret-down" aria-hidden="true"></i> --}}
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Delete</a>
                <a class="dropdown-item" href="{{ route('edit.post',encrypt($post->id)) }}">Edit</a>
                <a class="dropdown-item" href="#">Something else here</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Separated link</a>
              </div>
            </div>

          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection
@push('script')
<script>
  axios.defaults.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');
  const baseUrl = document.getElementById('base_url').value
  function visibility(e,that,id) {
    const formData = new FormData()
    formData.append('show',$(that).prop('checked'));
    formData.append('id',id);

    axios.post(baseUrl+'/admin/posts/updateVisibility', formData)
    .then(function (response) {
      console.log(response.data.message);
    })
    .catch(function (error) {
      console.log(error);
    });
  }
</script>
@endpush