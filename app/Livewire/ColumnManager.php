<?php

namespace App\Livewire;

use App\Models\Card;
use App\Models\Column;
use Livewire\Attributes\Validate;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class ColumnManager extends Component
{
    public $columnId, $cardId = '';
    public $cardDescription = '';
    public $cardActivity = '';
    public $cardTitle = '';
    public $cardTitleId = '';
    public $columnCardIds = [];
    public $columns = '';
    public $columnTitleInputs = [];
    public $focusedColumnId = '';
    public $columnTitle = '';
    #[Validate('string', message: 'Only letters are acceptable')]
    public $columnTitleInput = '';

    public function mount() {
        $this->dispatch('rerender-ckeditor');
    }

    public function updateCardPosition($columnId, $cardId) {
        $userId = auth()->id();
        $card = Card::where('user_id', $userId)->where('id', $cardId)->first();
        if ($card) {
            $card->update(['column_id' => $columnId]);
        }
    }

    public function updatedCardDescription() {
        $cardDescription = preg_replace('/<figure[^>]*>.*?<\/figure>/', '', $this->cardDescription);
        $card = Card::where('id', $this->cardId)->where('user_id', auth()->id())->where('column_id', $this->columnId)->first();
        if ($cardDescription && $card) {
            $card->update(['description' => $cardDescription]);
        } else {
            $card->update(['description' => NULL]);
        }
    }

    public function updatedCardActivity() {
        $cardActivity = preg_replace('/<figure[^>]*>.*?<\/figure>/', '', $this->cardActivity);
        $card = Card::where('id', $this->cardId)->where('user_id', auth()->id())->where('column_id', $this->columnId)->first();
        if ($cardActivity && $card) {
            $card->update(['activity' => $cardActivity]);
        } else {
            $card->update(['activity' => NULL]);
        }
    }

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
        $this->reset('cardTitle');
        $this->dispatch('reset-card-title');
    }

    public function updatedCardTitle() {
        $this->dispatch('rerender-ckeditor');
    }

    public function createColumn() {
        $this->validate(['columnTitle' => 'required|string']);
        Column::create([
            'user_id' => auth()->id(),
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
        $this->validate(['columnTitleInput' => 'required']);
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
