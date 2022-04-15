@extends('layouts.adminMain');

@section('content')
{{-- @if($errors->any())
    @foreach($errors->all() as $error)
    <x-alert :message="$error"></x-alert>
    @endforeach
@endif --}}
@include('message')

    <form method="POST" enctype="multipart/form-data"
        @if($news->id)
        action="{{ route('admin.news.update',['news'=>$news]) }}"
        @else
          action="{{ route('admin.news.store') }}"
        @endif
    >
    @csrf    
    @if($news->id)
        @method('PUT')
    @endif

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">{{$news->id ? 'Update':'Create'}} news</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <button type="submit" class="btn btn-success float-sm-end">{{$news->id ? 'Update': 'Create'}}</button>
            </div>
        </div>

        <div class="row my-2">
            <label for="date" class="col-sm-1 col-form-label">Date</label>
            <div class="col-sm-11">
                <input type="date" class="form-control" id="date" name="date" value="{{old('date') ? old('date') : $news->date}}">
            </div>
        </div>
        <div class="row my-2">
            <label for="title" class="col-sm-1 col-form-label">Title</label>
            <div class="col-sm-11">
                <input type="input" class="form-control" id="title" name="title" value="{{old('title') ? old('title') : $news->title}}">
            </div>
        </div>

        <div class="row my-2">
            <label for="description" class="col-sm-1 col-form-label">Description</label>
            <textarea name="description" id="description" cols="30" rows="10">
                {{$news->description}}
            </textarea>
        </div>

        <div class="row my-2">
          <label for="category" class="col-sm-1 col-form-label">Category</label>
          <div class="col-sm-11">
              <select id="category" name="category_id" class="form-select" aria-label="Default select example">
                  <option selected>Select the category</option>
                  @foreach ($categories as $item)
                  @if(old('category_id'))
                        <option value="{{ $item->category_id }}" {{$item->category_id == old('category_id') ? 'selected' : ''}}>
                    @else
                        <option value="{{ $item->category_id }}" {{$item->category_id == $news->category_id ? 'selected' : ''}}>
                  @endif
                        {{ $item->category_name }}
                        </option>
                  @endforeach
              </select>
          </div>
        </div>

        <div class="row my-2">
            <label for="author" class="col-sm-1 col-form-label">Author</label>
            <div class="col-sm-11">
                <input type="input" class="form-control" id="author" name="author" value="{{old('author') ? old('author') : $news->author}}">
            </div>
        </div>

        <div class="row my-2">
            <label for="image" class="col-sm-1 col-form-label">Image</label>
            <div class="col-sm-11">
                <input type="file" class="form-control" id="image" name="image" value="{{old('image') ? old('image') : $news->image}}">
            </div>
        </div>

        <div class="row my-2">
            <label for="active" class="col-sm-1">Active</label>
            <div class="col-sm-11 form-check form-switch">
                @if(old('active'))
                    <input type="checkbox" class="form-check-input" role="switch" id="active" name="active" checked>
                @else
                    <input type="checkbox" class="form-check-input" role="switch" id="active" name="active" {{$news->active ? 'checked' : ''}}>
                @endif
                
            </div>
        </div>
        @empty(!$news->image)
        <img src="{{ Storage::disk('public')->url($news->image) }}" style="width:250px;"> &nbsp;    
        <a href="javascript:;" class="remove" data-id="{{ $news->id }}" data-category_id="{{ $news->category_id }}">
            <svg class="bi bi-trash3" width="16" height="16">
                <use xlink:href="#trash" />
            </svg>
        </a>
        @endempty
        
        

    </form>
@endsection

@push('scripts')


    <script type="text/javascript">
    // delete image
        document.addEventListener('DOMContentLoaded', (event) => {
            const trashLinks = document.querySelectorAll('.remove');
            trashLinks.forEach(element => {
                element.addEventListener('click', (event) => {
                    id = element.dataset.id;
                    catId = element.dataset.id;
                    deleteImage(id, catId).then((response) => {
                        response.json().then((res) => {
                            location.reload();
                        })
                    });
                })
            });
        })

        function deleteImage(id, category_id) {
            return fetch('/admin/remove/'+id, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
            })
        }
    </script>

<script>
    

    

class MyUploadAdapter {
    constructor( loader ) {
        // The file loader instance to use during the upload. It sounds scary but do not
        // worry — the loader will be passed into the adapter later on in this guide.
        this.loader = loader;
        console.log('loader ', loader);
    }

    // Starts the upload process.
    upload() {
        console.log('upload process', this);
        return this.loader.file
            .then( file => new Promise( ( resolve, reject ) => {
                this._initRequest();
                this._initListeners( resolve, reject, file );
                this._sendRequest( file );
            } ) );
    }

    // Aborts the upload process.
    abort() {
        if ( this.xhr ) {
            this.xhr.abort();
        }
    }

    // ...

     // Initializes the XMLHttpRequest object using the URL passed to the constructor.
     _initRequest() {
        console.log('init Request');
        const xhr = this.xhr = new XMLHttpRequest();

        // Note that your request may look different. It is up to you and your editor
        // integration to choose the right communication channel. This example uses
        // a POST request with JSON as a data structure but your configuration
        // could be different.

        // xhr.open( 'POST', '{{route('admin.images.store')}}', true );
        xhr.open( 'POST', '{{route('unisharp.lfm.upload')}}', true );
        xhr.setRequestHeader('x-csrf-token', '{{ csrf_token() }}');
        xhr.responseType = 'json';
    }

    // Initializes XMLHttpRequest listeners.
    _initListeners( resolve, reject, file ) {
        console.log('init Listeners');
        const xhr = this.xhr;
        const loader = this.loader;
        const genericErrorText = `Couldn't upload file: ${ file.name }.`;

        xhr.addEventListener( 'error', () => reject( genericErrorText ) );
        xhr.addEventListener( 'abort', () => reject() );
        xhr.addEventListener( 'load', () => {
            const response = xhr.response;
            console.log('loading process...', file);

            // This example assumes the XHR server's "response" object will come with
            // an "error" which has its own "message" that can be passed to reject()
            // in the upload promise.
            //
            // Your integration may handle upload errors in a different way so make sure
            // it is done properly. The reject() function must be called when the upload fails.
            if ( !response || response.error ) {
                return reject( response && response.error ? response.error.message : genericErrorText );
            }

            // If the upload is successful, resolve the upload promise with an object containing
            // at least the "default" URL, pointing to the image on the server.
            // This URL will be used to display the image in the content. Learn more in the
            // UploadAdapter#upload documentation.
            resolve( {
                default: response.url
            } );
        } );

        // Upload progress when it is supported. The file loader has the #uploadTotal and #uploaded
        // properties which are used e.g. to display the upload progress bar in the editor
        // user interface.
        if ( xhr.upload ) {
            xhr.upload.addEventListener( 'progress', evt => {
                if ( evt.lengthComputable ) {
                    loader.uploadTotal = evt.total;
                    loader.uploaded = evt.loaded;
                }
            } );
        }
    }

     // Prepares the data and sends the request.
     _sendRequest( file ) {
        // Prepare the form data.
        const data = new FormData();

        data.append( 'upload', file );

        // Important note: This is the right place to implement security mechanisms
        // like authentication and CSRF protection. For instance, you can use
        // XMLHttpRequest.setRequestHeader() to set the request headers containing
        // the CSRF token generated earlier by your application.

        // Send the request.
        this.xhr.send( data );
    }



}

function SimpleUploadAdapterPlugin( editor ) {
    editor.plugins.get( 'FileRepository' ).createUploadAdapter = ( loader ) => {
        // Configure the URL to the upload script in your back-end here!
        return new MyUploadAdapter( loader );
    };
}


    ClassicEditor
            .create( document.querySelector( '#description' ), {
        extraPlugins: [ SimpleUploadAdapterPlugin ],

    } )

</script>
    
@endpush
