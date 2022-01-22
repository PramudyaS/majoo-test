@extends('layouts.layout')

@push('css-style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
<div class="container px-6 mx-auto grid">
        <h2
            class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
        >
            Form Create Product
        </h2>

        @if($errors->any())
            <x-alert text="Error failed insert data" class="p-4 mb-4 text-sm text-white bg-red-500 rounded-lg" role="alert">
                <span class="font-medium">Error !</span> {!! implode('', $errors->all('<div>:message</div>')) !!}
            </x-alert>
        @endif

        @if(\Session::has('message'))
            <x-alert class="p-4 mb-4 text-sm text-white bg-green-500 rounded-lg" role="alert">
                <span class="font-medium">{{ \Session::get('message')  }}</span>
            </x-alert>
        @endif

        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col my-2">
            <form action="{{  route('admin.product.store')  }}" method="POST">
                @csrf
                <div class="-mx-3 md:flex mb-6">
                    <div class="md:w-full px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-first-name">
                            Name
                        </label>
                        <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3"
                               id="grid-first-name" type="text" name="name" placeholder="Product name...">
                        @error('name')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="-mx-3 md:flex mb-6">
                    <div class="w-full px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-city">
                            Product Category
                        </label>
                        <select class="js-example-basic-single" name="product_category_id" style="width:100%">
                            @foreach($product_category as $category)
                            <option value="{{  $category->id  }}">{{  $category->name  }}</option>
                            @endforeach
                        </select>
                        @error('product_category_id')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="-mx-3 md:flex mb-6">
                    <div class="md:w-full px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-first-name">
                            Price
                        </label>
                        <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red
                        rounded py-3 px-4 mb-3" id="grid-first-name" name="price" type="number" placeholder="Rp.xxx.xxx.xx"
                               min="0">
                        @error('price')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="-mx-3 md:flex mb-6">
                    <div class="md:w-full px-3 mb-6 md:mb-0">
                        <input type="hidden" name="images_id" id="image-id">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-first-name">
                            Image
                        </label>
                        <input id="image" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red
                        rounded py-3 px-4 mb-3" name="image" type="file"
                        >
                        <div class="progress-bar w-full bg-blue-500 rounded-lg text-center text-white hidden"></div>
                        <span class="text-red-500 font-medium hidden" id="error-upload">Failed Upload Image</span>
                        @error('images_id')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="-mx-3 md:flex mb-6">
                    <div class="md:w-full px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-first-name">
                            Description
                        </label>
                        <textarea class="ckeditor form-control" name="description"></textarea>
                        @error('description')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="-mx-3 md:flex mb-6 ml-3 space-x-2 items-end content-end md:justify-end">
                    <a href="{{   route('admin.product.index')  }}" class="px-8 py-2 text-sm mt-4 mb-4 text-gray-600
                            hover:bg-gray-500 hover:text-white
                            rounded-md">Cancel</a>

                    <button type="submit" class="bg-purple-600 px-8 py-2 text-sm mt-4 mb-4 text-white
                            hover:bg-purple-700
                            rounded-md" id="btn-submit-update">Submit</button>
                </div>
            </form>
        </div>
</div>
@endsection

@push('js-script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script>

    function onUploadImage()
    {
        var url = '{{route('api.upload_image')}}';
        var formData = new FormData();
        var file = $('#image')[0].files;

        formData.append('image',file[0]);

        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();

                xhr.upload.addEventListener("progress", function(evt) {
                    $('.progress-bar').removeClass('hidden');
                    if (evt.lengthComputable) {
                        var percentComplete = (evt.loaded / evt.total) * 100;
                        $('.progress-bar').width(percentComplete+'%');
                        $('.progress-bar').html(percentComplete+'%');

                    }
                }, false);
                return xhr;
            },
            url: url,
            type: "POST",
            data: formData,
            async: true,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                const { data } = response;
                $('#image-id').val(data.id);
            },
            error:function(error){
                const { errors } = error.responseJSON;
                console.log(errors);
                $('#error-upload').text(errors.image.join("\r\n"));
                $('#error-upload').removeClass('hidden');
                $('.progress-bar').addClass('hidden');
            }
        });
    }

    $(document).ready(function() {
        $('.js-example-basic-single').select2();

        $('#image').change(function (){
            $('#error-upload').addClass('hidden');
           onUploadImage();
        });
    });
</script>
@endpush
