<?php

namespace App\Http\Livewire\RecordLabels;

use App\Http\Livewire\RecordLabels\Actions\RestoreRecordLabelAction;
use App\Http\Livewire\RecordLabels\Actions\SoftDeletesRecordLabelAction;
use App\Models\RecordLabel;
use WireUi\Traits\Actions;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;
use LaravelViews\Actions\RedirectAction;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Livewire\Filters\SoftDeletedFilter;
use App\Http\Livewire\RecordLabels\Actions\EditRecordLabelAction;


class RecordLabelsTableView extends TableView
{
    use Actions;
//    use SoftDeletes;
//    use Restore;

    /**
     * Sets the searchable properties
     */
    public $searchBy = [
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Sets a initial query with the data to fill the table
     *
     * @return Builder Eloquent query
     */
    public function repository(): Builder
    {
        return RecordLabel::query()->withTrashed();
    }

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return [
            Header::title(__('record_labels.attributes.name'))->sortBy('name'),
            Header::title(__('translation.attributes.created_at'))->sortBy('created_at'),
            Header::title(__('translation.attributes.updated_at'))->sortBy('updated_at'),
            Header::title(__('translation.attributes.deleted_at'))->sortBy('deleted_at'),
        ];
    }

    /**
     * Sets the data to every cell of a single row
     *
     * @param $model Current model for each row
     */
    public function row($model): array
    {
        return [
            $model->name,
            $model->created_at,
            $model->updated_at,
            $model->deleted_at,
        ];
    }

    /**
     * Set filters
     */
    protected function filters()
    {
        return [
            new SoftDeletedFilter,
        ];
    }

    /** Actions by item */
    protected function actionsByRow()
    {
        return [
            new EditRecordLabelAction(
                'record_labels.edit',
                __('record_labels.actions.edit')
            ),
            new SoftDeletesRecordLabelAction(),
            new RestoreRecordLabelAction(),
        ];
    }

//    protected function softDeletesNotificationDescription(Model $model)
//    {
//        return __('record_labels.messages.successes.destroyed', [
//            'name' => $model
//        ]);
//    }
//
//    protected function restoreNotificationDescription(Model $model)
//    {
//        return __('record_labels.messages.successes.restored', [
//            'name' => $model
//        ]);
//    }

    public function softDeletes(int $id)
    {
        $record_label = RecordLabel::find($id);
        $record_label->delete();
        $this->notification()->success(
            $title = __('translation.messages.successes.destroyed_title'),
            $description = __('record_labels.messages.successes.destroyed', [
                'name' => $record_label->name
            ])
        );
    }

    public function restore(int $id)
    {
        $record_label = RecordLabel::withTrashed()->find($id);
        $record_label->restore();
        $this->notification()->success(
            $title = __('translation.messages.successes.restored_title'),
            $description = __('record_labels.messages.successes.restored', [
                'name' => $record_label->name
            ])
        );
    }
}
