<?php

namespace App\Livewire;

use Livewire\Component;
use Spatie\DbDumper\Databases\MySql;

class DumpDB extends Component
{
    public function dumpDB() {

        $filePath = storage_path('/app/public/db_record/trello.sql');

        MySql::create()
            ->setDbName('trello')
            ->setUserName('root')
            ->setPassword('')
            ->dumpToFile($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);

    }

    public function render() {
        return view('livewire.dump-db');
    }
}
