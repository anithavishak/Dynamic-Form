
<div class="container">
    <h1>Edit Form</h1>

    <form method="POST" action="{{ route('admin.forms.update', $form->id) }}">
        @csrf
        @method('PUT')

        <label for="name">Form Name:</label>
        <input type="text" id="name" name="name" value="{{ $form->name }}">

        <div id="fields">
            @foreach($form->fields as $field)
                <div>
                    <label>Label:</label>
                    <input type="text" name="fields[{{ $field->id }}][label]" value="{{ $field->label }}">
                    <label>Type:</label>
                    <select name="fields[{{ $field->id }}][type]" onchange="toggleOptions(this, '{{ $field->id }}')">
                        <option value="text" @if($field->type == 'text') selected @endif>Text</option>
                        <option value="number" @if($field->type == 'number') selected @endif>Number</option>
                        <option value="select" @if($field->type == 'select') selected @endif>Dropdown</option>
                    </select>
                    <div class="options" id="options-{{ $field->id }}" style="display: {{ $field->type == 'select' ? 'block' : 'none' }};">
                        <label>Options (comma separated):</label>
                        <input type="text" name="fields[{{ $field->id }}][options]" value="{{ $field->options ? implode(', ', json_decode($field->options, true)) : '' }}">
                    </div>
                </div>
            @endforeach
        </div>

        <button type="button" onclick="addField()">Add Field</button>
        <button type="submit">Save</button>
    </form>
</div>

<script>
    function addField() {
        const uniqueId = Date.now();
        const fieldHtml = `
        <div>
            <label>Label:</label>
            <input type="text" name="fields[${uniqueId}][label]">
            <label>Type:</label>
            <select name="fields[${uniqueId}][type]" onchange="toggleOptions(this, '${uniqueId}')">
                <option value="text">Text</option>
                <option value="number">Number</option>
                <option value="select">Dropdown</option>
            </select>
            <div class="options" id="options-${uniqueId}" style="display: none;">
                <label>Options (comma separated):</label>
                <input type="text" name="fields[${uniqueId}][options]">
            </div>
        </div>
        `;
        document.getElementById('fields').insertAdjacentHTML('beforeend', fieldHtml);
    }

    function toggleOptions(selectElement, uniqueId) {
        const optionsDiv = document.getElementById(`options-${uniqueId}`);
        if (selectElement.value === 'select') {
            optionsDiv.style.display = 'block';
        } else {
            optionsDiv.style.display = 'none';
        }
    }
</script>
