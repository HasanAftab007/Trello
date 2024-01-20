<?php

namespace App\Livewire;

use App\Models\Card;
use App\Models\Column;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ColumnManager extends Component
{
    public $columnId, $cardId, $cardDescription, $cardActivity, $cardTitle, $cardTitleId, $columns, $focusedColumnId, $columnTitle = '';

    public $columnCardIds, $columnTitleInputs = [];
    #[Validate('string', message: 'Only letters are acceptable')]
    public $columnTitleInput = '';

    public function mount() {
        $this->dispatch('rerender-ckeditor');
    }

    public function placeholder() {
        return view('vendor.skeleton');
    }

    public function sortColumn($sortedColumns) {
        foreach ($sortedColumns as $sortedColumn) {
            $column = Column::where('id', $sortedColumn['value'])->where('user_id', auth()->id())->first();
            if ($column) {
                $column->update(['position' => $sortedColumn['order']]);
            }
        }
    }

    public function updateCardPosition($columnId, $cardId, $oldColumnCardIds, $newColumnCardIds) {

        $userId = auth()->id();

        $card = Card::where('user_id', $userId)->where('id', $cardId)->first();
        if ($card) {
            $card->update(['column_id' => $columnId]);
        }

        foreach ($oldColumnCardIds as $index => $oldColumnCardId) {
            $oldColumnCard = Card::where('user_id', $userId)->where('id', $oldColumnCardId)->first();
            if ($oldColumnCard) {
                $oldColumnCard->update(['position' => $index]);
            }
        }

        foreach ($newColumnCardIds as $index => $newColumnCardId) {
            $newColumnCardId = Card::where('user_id', $userId)->where('id', $newColumnCardId)->first();
            if ($newColumnCardId) {
                $newColumnCardId->update(['position' => $index]);
            }
        }

        $this->dispatch('rerender-ckeditor');
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

        $position = Card::max('position') ?? 0;
        $position++;

        Card::create([
            'user_id' => auth()->id(),
            'column_id' => $columnId,
            'title' => $this->cardTitle,
            'position' => $position
        ]);
        $this->reset('cardTitle');
        $this->dispatch('reset-card-title');
    }

    public function updatedCardTitle() {
        $this->dispatch('rerender-ckeditor');
    }

    public function createColumn() {

        $this->validate(['columnTitle' => 'required|string']);

        $position = Column::max('position') ?? 'zero';
        if ($position === 'zero') {
            $position = 0;
        }
        $position++;

        Column::create([
            'user_id' => auth()->id(),
            'title' => $this->columnTitle,
            'position' => $position
        ]);

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

        $this->columns = Column::with(['cards' => function ($query) {
            $query->orderBy('position');
        }])->where('user_id', auth()->id())
            ->orderBy('position')
            ->get();

        foreach ($this->columns as $column) {
            $this->columnTitleInputs[$column->id] = false;
        }

        foreach (Card::all() as $card) {
            $this->columnCardIds[$card->id] = false;
        }

        return view('livewire.column-manager');
    }
}
