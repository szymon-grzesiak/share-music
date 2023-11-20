<?php

namespace App\Http\Livewire\RecordLabels;

use Livewire\Component;
use App\Models\RecordLabel;
use WireUi\Traits\Actions;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class RecordLabelForm extends Component
{
    use Actions;
    use AuthorizesRequests;

    public RecordLabel $record_label;
    public Bool $editMode;

    public function rules()
    {
        return [
            'record_label.name' => [
                'required',
                'string',
                'min:2',
                'unique:record_labels,name' .
                ($this->editMode
                    ? (',' . $this->record_label->id)
                    : ''
                ),
            ],
        ];
    }

    public function validationAttributes()
    {
        return [
            'name' => Str::lower(
                __('record_labels.attributes.name')
            ),
        ];
    }

    public function mount(RecordLabel $record_label, Bool $editMode)
    {
        $this->record_label = $record_label;
        $this->editMode = $editMode;
    }

    public function render()
    {
        return view('livewire.record_labels.record_labels-form');
    }



    /**
     * Walidacja na żywo
     */
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        sleep(1);   // tymczasowo, celem pokazania opóźnienia
        if ($this->editMode) {
            $this->authorize('update', $this->record_label);
        } else {
            $this->authorize('create', RecordLabel::class);
        }
        $this->validate();
        $this->record_label->save();
        $this->notification()->success(
            $title = $this->editMode
                ? __('translation.messages.successes.updated_title')
                : __('translation.messages.successes.stored_title'),
            $description = $this->editMode
                ? __('record_labels.messages.successes.updated', ['name' => $this->record_label->name])
                : __('record_labels.messages.successes.stored', ['name' => $this->record_label->name])
        );

        $this->editMode = true;
        // opcjonalne przekierowanie na inny adres URL
        // return redirect()->route('genres.index');
    }
}
