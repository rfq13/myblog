@php 
    $method = isset($post) ? 'update' : 'create';
@endphp
@extends('admin.layouts')
@section('title','Write now!')

@section('style')
<link href="{{ asset('public/vendor/froala/css/froala_editor.pkgd.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Include TUI CSS. -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tui-image-editor@3.2.2/dist/tui-image-editor.css">
<link rel="stylesheet" href="https://uicdn.toast.com/tui-color-picker/latest/tui-color-picker.css">

<!-- Include TUI Froala Editor CSS. -->
<link rel="stylesheet" href="{{ asset('public/vendor/froala/css/third_party/image_tui.min.css') }}">
<!-- Include Embedly plugin style. -->
<link rel="stylesheet" href="{{ asset('public/vendor/froala/css/third_party/embedly.min.css') }}">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" />
    
@endsection
@section('content')
    @isset($post)
        <input type="hidden" id="postupdate" value="{{ json_encode($post) }}">
    @endisset
    <h1>write now!</h1>
    <form method="post" id="formEditor" enctype="multipart/form-data">
        @csrf
        <input type="text" name="title" id="title" class="form-control mb-3" placeholder="Judul">
        <input type="file" name="thumbnail" id="thumbnail" class="form-control mb-3" placeholder="thumbnail">
        <select class="selectpicker form-control mb-3 mt-3" name="category" id="selectpicker" data-live-search="true" title="select a category">
            <option>Mustard</option>
            <option>Ketchup</option>
            <option>Barbecue</option>
        </select>          
        <textarea name="content" id="editor" cols="30" rows="10"></textarea>
        <div class="text-right">
            {{-- <button type="submit" class="btn btn-primary mt-3">Post</button> --}}
            <button type="submit" class="btn btn-primary mt-3" onclick="{{ $method == "create" ? 'create(event)' : 'update(event,`'.encrypt($post->id).'`)' }}">Posting</button>
        </div>
    </form>
@endsection
@push('script')
<script type="text/javascript" src="{{ asset('public/vendor/froala/js/froala_editor.pkgd.min.js') }}"></script>
<!-- Include TUI JS. -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/1.6.7/fabric.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/tui-code-snippet@1.4.0/dist/tui-code-snippet.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/tui-image-editor@3.2.2/dist/tui-image-editor.min.js"></script>
<!-- Include TUI plugin. -->
<script type="text/javascript" src="{{ asset('public/vendor/froala/js/third_party/image_tui.min.js') }}"></script>
<script src="https://cdn.embedly.com/widgets/platform.js" charset="UTF-8"></script>

{{-- <script src="{{ asset('public\vendor\froala\js\plugins\image.min.js') }}"></script> --}}

<!-- Include Embedly plugin JS. -->
<script type="text/javascript" src="{{ asset('public/vendor/froala/js/third_party/embedly.min.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous"></script>


{{-- custom js --}}
<script src="{{ asset('js/posts.js') }}"></script>
@endpush