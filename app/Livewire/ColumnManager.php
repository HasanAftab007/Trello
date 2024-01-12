<?php

namespace App\Livewire;

use App\Models\Card;
use App\Models\Column;
use Livewire\Attributes\Validate;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class ColumnManager extends Component
{

    public $cardTitle = '';
    public $cardTitleId = '';
    public $columnCardIds = [];
    public $columns = '';
    public $columnTitleInputs = [];
    public $focusedColumnId = '';
    #[Validate('required', message: 'Please enter the title!')]
    #[Validate('string', message: 'Only letters are acceptable')]
    public $columnTitle = '';
    #[Validate('string', message: 'Only letters are acceptable')]
    public $columnTitleInput = '';
    protected $user;


    public function editCardTitle($columnId, $cardId) {
        $card = Card::where('user_id', auth()->id())->where('column_id', $columnId)->where('id', $cardId)->first();
        if ($card && $cardId === $this->cardTitleId) {
            $card->update(['title' => $this->cardTitle]);
            $this->cardTitleId = '';
            $this->dispatch('card-input-title-field');
        }
    }

    public function createCardTitle($columnId) {
        $this->validate([
            'cardTitle' => 'required'
        ]);

        Card::create([
            'user_id' => auth()->id(),
            'column_id' => $columnId,
            'title' => $this->cardTitle
        ]);
    }


    public function createColumn() {
        $this->validate();
        $this->user = auth()->user();
        Column::create([
            'user_id' => $this->user->id,
            'title' => $this->columnTitle
        ]);
        Alert::success('Success Title', 'Success Message');
        $this->reset('columnTitle');
        $this->dispatch('reset-input-field');
        $this->dispatch('hide-column-creation-form');
    }

    public function setFocusedColumn($columnId) {
        $this->focusedColumnId = $columnId;
    }

    public function editColumnTitle($columnId) {
        $column = Column::where('id', $columnId)->where('user_id', auth()->id())->first();
        if ($column && $columnId === $this->focusedColumnId) {
            $column->update(['title' => $this->columnTitleInput]);
            $this->focusedColumnId = '';
            $this->reset('columnTitleInput');
            $this->dispatch('hide-column-edit-div');
        }
    }

    public function deleteColumn(Column $column) {
        $column->delete();
    }

    public function render() {
        $this->columns = Column::with('cards')->where('user_id', auth()->id())->get();
        foreach ($this->columns as $column) {
            $this->columnTitleInputs[$column->id] = false;
        }

        foreach (Card::all() as $card) {
            $this->columnCardIds[$card->id] = false;
        }

        return view('livewire.column-manager');
    }
}
