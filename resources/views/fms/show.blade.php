<x-app-layout>
    @push('head-scripts')
        <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet"/>
    @endpush
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('File Management') }}
        </h2>

        <h1 class="text-center text-2xl font-extrabold">
            AOTR MZD
        </h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                <p class="text-black mb-2 dark:text-black font-bold leading-relaxed text-center">
                    Telephone No: {{$fms->telephone}}, Total Documents: {{$fms->getMedia('document')->count()}}

                </p>
                @if (session('status'))
                    <div class="mb-4 mt-4 mr-4 ml-4 text-center font-bold text-green-600 dark:text-green-400">
                        {{ session('status') }}
                    </div>
                @endif


                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach($fms->getMedia('document') as $collection)
                        <div>
                            <a href="{{$collection->getUrl()}}" target="_blank">
                                <img class="h-auto max-w-full rounded-lg border-2 border-gray-200" src="{{$collection->getUrl('preview')}}" alt="">
                            </a>
                            @can('delete')
                                <form action="{{route('projects.destroy',[ $collection->id, $fms->id])}}" method="post" class="mt-4">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out" onclick="if(confirm('Are you sure you want to delete this item?')){return true;}else{return false;}">
                                        Delete
                                    </button>
                                </form>
                            @endcan
                        </div>
                    @endforeach
                </div>


                <br>
                <br>
                <br>

                <hr>

                <form action="{{ route("projects.update", $fms->id) }}" method="POST" enctype="multipart/form-data" class="w-full mx-auto">
                    @csrf
                    @method('PUT')
                    <x-validation-errors class="mb-4"/>
                    <script>
                        function isNumeric(event) {
                            // Get the ASCII code of the key that was pressed
                            var charCode = (event.which) ? event.which : event.keyCode;
                            // If the key code is not a number, prevent the default action
                            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                                event.preventDefault();
                                return false;
                            }
                            return true;
                        }
                    </script>


                    <div class="mt-4">
                        <label for="document-dropzone" class="block text-gray-700 font-bold">Documents</label>
                        <div class="mt-2 px-6 py-4 border border-gray-300 border-dashed rounded-md needsclick dropzone" id="document-dropzone">
                        </div>
                    </div>
                    <div class="mt-4">
                        <button class="px-4 py-2 text-white bg-red-500 rounded hover:bg-red-600" type="submit">Update</button>
                    </div>
                </form>

            </div>

        </div>
    </div>

    @push('modals')
        {{-- JS assets at the bottom --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.js"></script>
        {{-- ...Some more scripts... --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
        <script>


            var uploadedDocumentMap = {}
            Dropzone.options.documentDropzone = {
                url: '{{ route('projects.storeMedia') }}',
                maxFilesize: 5, // MB
                addRemoveLinks: true,
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function (file, response) {
                    $('form').append('<input type="hidden" name="document[]" value="' + response.name + '">')
                    uploadedDocumentMap[file.name] = response.name
                },
                removedfile: function (file) {
                    file.previewElement.remove()
                    var name = ''
                    if (typeof file.file_name !== 'undefined') {
                        name = file.file_name
                    } else {
                        name = uploadedDocumentMap[file.name]
                    }
                    $('form').find('input[name="document[]"][value="' + name + '"]').remove()
                },
                init: function () {

                    @if(isset($project) && $project->document)
                    var files =
                        {!! json_encode($project->document) !!}
                        for(
                    var i
                in
                    files
                )
                    {
                        var file = files[i]
                        this.options.addedfile.call(this, file)
                        file.previewElement.classList.add('dz-complete')
                        $('form').append('<input type="hidden" name="document[]" value="' + file.file_name + '">')
                    }
                    @endif

                }
            }
        </script>
    @endpush

</x-app-layout>
