<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Import Resident') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
            <form class="form-inline mb-4">
                <div class="form-group">
                    <label>Attach File: </label>
                    <input type="file" name="file" class="form-control" required id="fileUpload">
                </div>
                <button type="button" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" id="upload">Attach</button>
            </form>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form method="post" action="{{ route('import-save') }}" id="submit">
                        @csrf
                        <table class="min-w-full" id="table-import">
                            <thead class="bg-gray-800 dark:bg-gray-700">
                                <tr>
                                    @foreach($columns as $i => $col)
                                    <th class="py-3 px-6 text-xs font-medium tracking-wider text-left text-white uppercase dark:text-white">{{ $col }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                        <div class="float-right mt-5 mb-3">
                            <a href="#!" id="cancel" class="">Cancel</a>
                            <x-button class="mt-4 ml-3">Submit</x-button>
                        </div> 
                    </form>

                </div>
            </div>
        </div>
    </div>

    <x-slot name="script">
        <script type="text/javascript">
            var inputs = {!! json_encode($columns) !!}; 
            $(function () {
                
                $("#upload").bind("click", function () {
        
                    var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.csv|.txt)$/;
                    var table = $("#table-import tbody");
                    table.empty();
                    if (regex.test($("#fileUpload").val().toLowerCase())) {
                        if (typeof (FileReader) != "undefined") {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                var rows = e.target.result.split("\n");
                                for (var i = 1; i < rows.length; i++) {
                                    var row = $("<tr />");
                                    var cells = rows[i].split(",");
                                    for (var j = 0; j < cells.length; j++) {
                                        var cell_text = cells[j];
                                        var input = '<input type="text" class="border-0 text-center" name="import['+i+']['+inputs[j]+']" title="'+inputs[j]+'" value="'+cell_text+'" >';
                                        var cell = $("<td />");
                                        cell.html(input);
                                        row.append(cell);
                                    }
                                    table.append(row);
                                }
                                
                            }
                            reader.readAsText($("#fileUpload")[0].files[0]);
                        } else {
                            alert("This browser does not support HTML5.");
                        }
                    } else {
                        alert("Please upload a valid CSV file.");
                    }
                });
            });
        
            $('#cancel').on('click', function(e) { 
                swal ({
                    title: 'Are you sure?',
                    text: 'This will delete all data in the table',
                    showCancelButton: true,
                    icon: 'info',
                    buttons: true,
                    closeModal: false,
                }).then(result => {
                    if (result == true) {
                        $('#table-import tbody').empty();
                    }
                });
            });
        </script>
    </x-slot>
</x-app-layout>
