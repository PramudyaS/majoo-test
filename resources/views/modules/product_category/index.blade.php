@extends('layouts.layout')

@section('content')
    <div class="container grid px-6 mx-auto">
            <h2
                class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
            >
                Product Category
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

        <div class="flex justify-between">
            <h4
                class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300"
            >
                Table Product Category
            </h4>
            <button class="px-2 py-1 text-sm font-medium leading-5
            text-white transition-colors duration-150
            bg-purple-600 border border-transparent
            rounded-md active:bg-purple-600 hover:bg-purple-700
            focus:outline-none focus:shadow-outline-purple"
            id="btn-modal-category"
            >
                Create New
            </button>
        </div>
        <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap mb-5">
                    <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                    >
                        <th class="px-4 py-3">#</th>
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Action</th>
                    </tr>
                    </thead>
                    <tbody
                        class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                    >
                    @forelse($product_category as $category)
                        <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">
                            <div class="flex items-center text-sm">
                                <div>
                                    <p class="font-semibold">{{   $loop->iteration  }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm">
                           {{  $category->name  }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <div class="flex space-x-2">
                                <button class="flex items-center justify-between px-2 py-2
                                text-sm font-medium leading-5 text-white transition-colors
                                duration-150 bg-purple-600 border border-transparent rounded-full
                                active:bg-purple-600 hover:bg-purple-700 focus:outline-none
                                focus:shadow-outline-purple"
                                        onclick="editCategory({{ $category->id  }})"
                                        aria-label="Edit">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                    </svg>
                                </button>

                                <a href="{{  route('admin.product_category.destroy',$category->id)  }}" class="flex
                                items-center
                                justify-between px-2
                                py-2 text-sm
                                font-medium
                                leading-5 text-white transition-colors duration-150 bg-red-600 border
                                border-transparent rounded-full active:bg-purple-600 hover:bg-red-700
                                focus:outline-none focus:shadow-outline-purple action_delete" aria-label="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         width="20"
                                         height="20" viewBox="0 0 22 24" fill="currentColor">
                                        <path d="M9 19c0 .552-.448 1-1 1s-1-.448-1-1v-10c0-.552.448-1 1-1s1 .448 1 1v10zm4 0c0 .552-.448 1-1 1s-1-.448-1-1v-10c0-.552.448-1 1-1s1 .448 1 1v10zm4 0c0 .552-.448 1-1 1s-1-.448-1-1v-10c0-.552.448-1 1-1s1 .448 1 1v10zm5-17v2h-20v-2h5.711c.9 0 1.631-1.099 1.631-2h5.315c0 .901.73 2 1.631 2h5.712zm-3 4v16h-14v-16h-2v18h18v-18h-2z"/>
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                        <tr class="text-gray-700">
                            <td colspan="3" class="text-center px-4 py-4">Data Kosong</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            {{  $product_category->links()  }}
        </div>


        <!--- Modal Create Form --->
        <div class="fixed hidden inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full"
             id="modal-category"
        >
            <div
                class="relative top-20 mx-auto p-5 border md:w-1/3 shadow-lg rounded-md bg-white"
            >
                <div class="mt-3 text-left">
                   <h3 class="text-md font-medium">Form Product Category</h3>
                    <form action="{{   route('admin.product_category.store')   }}"  method="POST">
                        @csrf
                        <div class="w-full mt-5">
                            <label for="first-name" class="block text-sm font-medium text-gray-700">First
                                name</label>
                            <input type="text" name="name" id="first-name" autocomplete=""
                                   class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm
                                   sm:text-sm border-gray-500 border-2 rounded-md px-2 py-2">
                            @error('name')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="button" id="btn-cancel" class="px-2 py-2 text-sm mt-4 mb-4 text-gray-600
                        hover:bg-gray-500 hover:text-white
                        rounded-md">Cancel</button>

                        <button type="submit" class="bg-purple-600 px-2 py-2 text-sm mt-4 mb-4 text-white
                        hover:bg-purple-700
                        rounded-md">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        <!--- Modal Edit Form ---->
        <div class="fixed hidden inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full"
             id="modal-category-edit"
        >
            <div
                class="relative top-20 mx-auto p-5 border md:w-1/3 shadow-lg rounded-md bg-white"
            >
                <div class="mt-3 text-left">
                    <h3 class="text-md font-medium">Form Product Category</h3>
                    <form action=""  method="POST" id="form-edit-category">
                        @csrf @method('PATCH')
                        <input type="hidden" id="edit-id">
                        <div class="w-full mt-5">
                            <label for="first-name" class="block text-sm font-medium text-gray-700">First
                                name</label>
                            <input type="text" name="name" id="name" autocomplete=""
                                   class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm
                                   sm:text-sm border-gray-500 border-2 rounded-md px-2 py-2">
                            @error('name')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="button" class="px-2 py-2 text-sm mt-4 mb-4 text-gray-600
                        hover:bg-gray-500 hover:text-white
                        rounded-md" onclick="hideEditModal()">Cancel</button>

                        <button type="button" class="bg-purple-600 px-2 py-2 text-sm mt-4 mb-4 text-white
                        hover:bg-purple-700
                        rounded-md" id="btn-submit-update">Submit</button>
                    </form>
                </div>
            </div>
        </div>
@endsection

@push('js-script')
<script>
    function editCategory(id)
    {
        var link = '{{ url('api/v1/product_category/')  }}' + `/${id}`;
        fetch(link,{
            headers:{
                "Content-Type" : "application/json"
            }
        }).then(res => res.json())
        .then(response =>{
            const { data } = response;

            $('#edit-id').val(data.id);
            $('#name').val(data.name);
            showEditModal();
        }).catch(error =>{
            console.log(error);
        });
    }

    function showEditModal()
    {
        $('#modal-category-edit').removeClass("hidden");
    }

    function hideEditModal()
    {
        $('#modal-category-edit').addClass("hidden");
    }

    function submitEditForm()
    {
        var id = $('#edit-id').val();
        var link = '{{ url('admin/product_category/') }}' + `/${ id }`;
        $('#form-edit-category').attr('action',link);
        $('#form-edit-category').submit();
    }

    $(document).ready(function(){

       $('#btn-modal-category').click(function(){
            $('#modal-category').removeClass("hidden");
       });

       $('#btn-cancel').click(function (){
          $('#modal-category').addClass("hidden");
       });

       $('#btn-submit-update').click(function(){
            submitEditForm();
       });

    });
</script>
@endpush

