<?php

namespace App\Http\Controllers;

use App\Models\RecordLabel;
use Illuminate\Http\Request;

class RecordLabelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view(
            'record_labels.index'
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', RecordLabel::class);

        return view(
            'record_labels.form'
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $record_label
     * @return \Illuminate\Http\Response
     */
    public function edit(RecordLabel $record_label)
    {
        $this->authorize('update', $record_label);
        return view(
            'record_labels.form',
            [
                'record_label' => $record_label
            ]
        );
    }
    public function __toString()
    {
        return $this->name;
    }
}
