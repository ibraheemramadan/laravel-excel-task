<?php

namespace App\Imports;

use App\Jobs\SendEmailImportResultJop;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Validators\Failure;


class UsersImport implements toModel, WithStartRow, WithChunkReading, ShouldQueue, WithValidation,
    SkipsOnFailure, WithEvents
{

    use Importable, SkipsFailures;


    /**
     * @param array $row
     * @return Model|Model[]|null
     */
    public function model(array $row)
    {
        $success = session()->get('success') ?: 0;
        session()->put('success', (int)++$success);

        return User::create([
            'first_name' => $row[0],
            'second_name' => $row[1],
            'family_name' => $row[2],
            'UID' => $row[3],
        ]);
    }


    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }


    /**
     * @return int
     */
    public function batchSize(): int
    {
        return 2;
    }


    /**
     * @return int
     */
    public function chunkSize(): int
    {
        return 2;
    }


    /**
     * @param Failure ...$failures
     */
    public function onFailure(Failure ...$failures)
    {
        \session()->put('fails', count($failures));
    }




    /**
     * @return array|string[]
     */
    public function rules(): array
    {
        return [
            '*.0' => 'required',
            '*.1' => 'required',
            '*.2' => 'required',
            '*.3' => ['required','unique:users,UID']
        ];
    }


    /**
     * @return string[]
     */
    public function customValidationAttributes()
    {
        return [
            '0' => 'first_name',
            '1' => 'second_name',
            '2' => 'family_name',
            '3' => 'UID',
        ];
    }



    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterImport::class => function(AfterImport $event) {
                dispatch(new SendEmailImportResultJop(\session()->get('fails'), \session()->get('success')));

                session()->put('fails', 0);
                session()->put('success', 0);
            },
        ];
    }

}
