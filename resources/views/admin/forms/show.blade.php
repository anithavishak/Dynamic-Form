

<div class="container">
    <h1>{{ $form->name }}</h1>
    
    <form method="POST" action="{{ route('form.submit', $form->id) }}">
        @csrf

        @foreach($form->fields as $field)
            <div>
                <label>{{ $field->label }}</label>
                @if($field->type == 'text')
                    <input type="text" name="fields[{{ $field->id }}]">
                @elseif($field->type == 'number')
                    <input type="number" name="fields[{{ $field->id }}]">
                @elseif($field->type == 'select')
                    <select name="fields[{{ $field->id }}]">
                        @foreach(json_decode($field->options, true) as $option)
                            <option value="{{ $option }}">{{ $option }}</option>
                        @endforeach
                    </select>
                @endif
            </div>
        @endforeach

        <button type="submit">Submit</button>
    </form>
</div>
