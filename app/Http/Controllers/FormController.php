<?php

namespace App\Http\Controllers;

use App\Jobs\sendEmailNotificationForFormCreation;
use App\Models\Form;
use App\Models\FormSubmitData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FormController extends Controller
{
    public function index()
    {
        $forms = Form::all();
        return view('admin.forms.formlist', compact('forms'));
    }

    public function create()
    {
        return view('admin.forms.create');
    }

    // public function store(Request $request)
    // {
    //     $form = Form::create($request->only('name'));

    //     foreach ($request->fields as $field) {
    //         $form->fields()->create($field);
    //     }

    //     // dispatch(new SendFormCreatedEmail($form));

    //     return redirect()->route('admin.forms.index');
    // }
    public function store(Request $request)
    {
        Log::debug("entered");
        //  dd($request->all());

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'fields.*.label' => 'required|string|max:255',
            'fields.*.type' => 'required|string|in:text,number,select',
            'fields.*.options' => 'nullable|string',
        ]);
        $form = Form::create([
            'name' => $validatedData['name'],
        ]);

        if (!empty($validatedData['fields'])) {
            foreach ($validatedData['fields'] as $fieldData) {
                $form->fields()->create([
                    'label' => $fieldData['label'],
                    'type' => $fieldData['type'],
                    'options' => $fieldData['type'] === 'select' ? json_encode(explode(',', $fieldData['options'])) : null,
                ]);
            }
        }
        sendEmailNotificationForFormCreation::dispatch($form)->onQueue('emails');

        return redirect()->route('admin.forms.formlist')->with('success', 'Form created successfully.');
    }

    public function show($id)
    {
        $form = Form::with('fields')->findOrFail($id);
        return view('admin.forms.show', compact('form'));
    }

    public function edit($id)
    {
        $form = Form::with('fields')->findOrFail($id);
        return view('admin.forms.edit', compact('form'));
    }

    public function submit(Request $request, $id)
    {
        $form = Form::with('fields')->findOrFail($id);

        $validatedData = $request->validate([
            'fields.*' => 'required',
        ]);

        foreach ($form->fields as $field) {
            FormSubmitData::create([
                'form_id' => $form->id,
                'field_id' => $field->id,
                'response' => $validatedData['fields'][$field->id],
            ]);
        }

        return redirect()->route('admin.forms.formlist')->with('success', 'Form submitted successfully.');
    }

    public function update(Request $request, $id)
    {
        $form = Form::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'fields.*.label' => 'required|string|max:255',
            'fields.*.type' => 'required|string|in:text,number,select',
            'fields.*.options' => 'nullable|string',
        ]);

        $form->update([
            'name' => $validatedData['name'],
        ]);

        $form->fields()->delete();

        if (!empty($validatedData['fields'])) {
            foreach ($validatedData['fields'] as $fieldData) {
                $form->fields()->create([
                    'label' => $fieldData['label'],
                    'type' => $fieldData['type'],
                    'options' => $fieldData['type'] === 'select' ? json_encode(explode(',', $fieldData['options'])) : null,
                ]);
            }
        }

        return redirect()->route('admin.forms.formlist')->with('success', 'Form updated successfully.');
    }

    /**
     * Function to delete form
     * @param $id
     */
    public function delete($id)
    {
        $form = Form::findOrFail($id);
        $form->delete();

        $form->fields()->delete();

        return redirect()->route('admin.forms.formlist')->with('success', 'Form deleted successfully.');
    }
}
