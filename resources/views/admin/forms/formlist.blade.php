<div class="container">
    <h1>Forms</h1>

    <a href="{{ route('admin.forms.create') }}" class="btn btn-primary"
        style="display: inline-block; padding: 8px 16px; text-decoration: none; border: 1px solid #007bff; border-radius: 4px; background-color: #3cb371; color: #fff;">
        Create New Form
    </a>

    @if(session()->has('success') && !empty(session('success')))
        <div id="success-message" style="display: none;">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($forms as $form)
                <tr>
                    <td>{{ $form->id }}</td>
                    <td>{{ $form->name }}</td>
                    <td>
                        <a href="{{ route('admin.forms.show', $form->id) }}" class="btn btn-sm btn-primary">View</a>
                        <a href="{{ route('admin.forms.edit', $form->id) }}" class="btn btn-sm btn-secondary">Edit</a>
                        <form method="POST" action="{{ route('admin.forms.delete', $form->id) }}" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-trash"
                                onclick="return confirm('Are you sure you want to delete this form?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const successMessage = document.getElementById('success-message');

        if (successMessage) {
            alert(successMessage.textContent);
        }
    });
</script>