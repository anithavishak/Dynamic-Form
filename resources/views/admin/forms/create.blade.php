<form method="POST" action="{{ route('admin.forms.store') }}">
    @csrf
    <h1>Create your Forms here!.......</h1>
    <div style="padding: 10px;">
        <label for="name">Form Name:</label>
        <input type="text" id="name" name="name">
    </div>

    <div id="fields" style="padding: 10px;">
        <!-- Dynamic fields will be added here -->
    </div>

    <button class="btn btn-primary" type="button" onclick="addField()">Add Field</button>
    <button class="btn btn-primary" type="submit">Save Form</button>
</form>


<script>
    function addField() {
        const uniqueId = Date.now(); // Generate a unique identifier for this field group
        const fieldHtml = `
        <div>
            <label style="display: inline-block;">Label:</label>
            <input type="text" name="fields[${uniqueId}][label]"">
            <label style="display: inline-block; margin-left: 10px;">Type:</label>
            <select name="fields[${uniqueId}][type]" onchange="toggleOptions(this, '${uniqueId}')" style="width: 100px; margin-left: 10px;">
                <option value="text">Text</option>
                <option value="number">Number</option>
                <option value="select">Dropdown</option>
            </select>
            <div class="options" id="options-${uniqueId}" style="display: none; margin-left: 227px;">
                <label style="display: inline-block;">Options (comma separated):</label>
                <input style="display: inline-block; vertical-align: middle;" type="text" name="fields[${uniqueId}][options]">
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

    document.addEventListener('change', function (e) {
        if (e.target.name === 'fields[][type]') {
            const options = e.target.parentNode.querySelector('.options');
            if (e.target.value === 'select') {
                options.style.display = 'block';
            } else {
                options.style.display = 'none';
            }
        }
    });


</script>