<style>
    /* Style for the dynamic input fields */
    .input-group {
        margin-bottom: 10px;
    }

    .input-group input[type="text"] {
        width: 150px;
        padding: 5px;
        margin-right: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    /* Style for the "Add More Fields" button */
    #add-input {
        display: block;
        margin-top: 10px;
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    #add-input:hover {
        background-color: #0056b3;
    }
</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="post" action="{{ route('settings.store') }}">
                        @csrf
                        @foreach($settings as $setting)
                        <div class="input-group" id="dynamic-data-{{$setting->id}}">
                            <input type="text" value="{{$setting->option_name}}" name="option_name[]" placeholder="Option Name" >
                            <input type="text" value="{{$setting->option_name}}" name="option_value[]" placeholder="Option Value">
                            <button type="button" class="remove-btn" onclick="removeRow({{$setting->id}})">Remove</button>
                        </div>
                        @endforeach
                        <div id="dynamic-inputs"></div>
                        <button type="button" id="add-input">Add More Fields</button>
                        <button type="submit" id="add-input" style="float: right;margin: 10px">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    // Function to add new input fields
    function addInputFields() {
        const container = document.getElementById('dynamic-inputs');
        const inputGroup = document.createElement('div');
        inputGroup.classList.add('input-group');

        // Create new input fields
        const newInput1 = document.createElement('input');
        newInput1.type = 'text';
        newInput1.name = 'option_name[]';
        newInput1.placeholder = 'Option Name';

        const newInput2 = document.createElement('input');
        newInput2.type = 'text';
        newInput2.name = 'option_value[]';
        newInput2.placeholder = 'Option Value';

        // Create a "Remove" button
        const removeButton = document.createElement('button');
        removeButton.textContent = 'Remove';
        removeButton.type = 'button';
        removeButton.classList.add('remove-btn');
        removeButton.addEventListener('click', () => {
            container.removeChild(inputGroup); // Remove the input group when "Remove" is clicked
        });

        // Append the new input fields and "Remove" button to the input group
        inputGroup.appendChild(newInput1);
        inputGroup.appendChild(newInput2);
        inputGroup.appendChild(removeButton);

        // Append the input group to the container
        container.appendChild(inputGroup);
    };
    function removeRow(id) {
        const container = document.getElementById(`dynamic-data-${id}`);
        container.parentNode.removeChild(container)
    }

    // Event listener for the "Add More Fields" button
    const addButton = document.getElementById('add-input');
    addButton.addEventListener('click', addInputFields);

    // Event delegation for removing input groups
    const dynamicInputs = document.getElementById('dynamic-inputs');
    dynamicInputs.addEventListener('click', (e) => {
        if (e.target.classList.contains('remove-btn')) {
            dynamicInputs.removeChild(e.target.parentNode); // Remove the parent input group
        }
    });
</script>

