<x-app-layout>
    @push('head-scripts')
        <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    @endpush
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>

        <h1 class="text-center text-2xl font-extrabold">
            AOTR MZD
        </h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                    <p class="text-gray-500 dark:text-gray-400 leading-relaxed">

                    <form action="{{ route("projects.store") }}" method="POST" enctype="multipart/form-data" class="w-full mx-auto">
                        @csrf
                        <x-validation-errors class="mb-4" />
                        {{-- Name/Description fields, irrelevant for this article --}}

                        <div class="mt-4 w-full">
                            <label for="type" class="block text-gray-700 font-bold mb-2">Select an option:</label>
                            <select id="type" required name="type" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded leading-tight ">
                                <option value="" selected>None</option>
                                <option value="sphone_snet_br">SPHONE/SNET Br</option>
                                <option value="sfiber_br">SFIBER Br</option>
                                <option value="revenue_br">REVENUE Br</option>
                                <option value="recovery_br">RECOVERY Br</option>
                                <option value="disc_rest">DISC & REST</option>
                                <option value="ait_certificate">AIT Certificate</option>
                            </select>
                        </div>

                        <div class="mt-4 w-full">
                            <label for="exchange_name" class="block text-gray-700 font-bold">Exchange Name</label>
                            <input type="text" id="exchange_name" name="exchange_name" class="mt-2 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent w-full">
                        </div>

                        <div class="mt-4 w-full">
                            <label for="telephone" class="block text-gray-700 font-bold">Telephone Number</label>
                            <input type="tel" maxlength="10" min="10" id="telephone" name="telephone" pattern="[0-9]{10,}" required onkeypress="return isNumeric(event)" class="mt-2 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent w-full">
                        </div>

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
                            <button class="px-4 py-2 text-white bg-red-500 rounded hover:bg-red-600" type="submit">Submit</button>
                        </div>
                    </form>



                    </p>
                </div>


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
                        for (var i in files) {
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
