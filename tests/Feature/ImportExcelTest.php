<?php

namespace Tests\Feature;

use App\Http\Middleware\VerifyCsrfToken;
use App\Imports\UsersImport;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;

use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Tests\TestCase;

class ImportExcelTest extends TestCase
{


    public function test_if_extention_invalid()
    {
        $file = UploadedFile::fake()->image('img.png');

        Excel::fake();

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $res = $this->post('/import', [
            'file' => $file
        ]);

        $res->assertSessionHasErrors('file');

    }

    public function test_upload_works()
    {

        $file = UploadedFile::fake()->create('myexcel.xlsx');

        Excel::fake();

        $this->post('/import', [
            'file' => $file
        ]);

        Storage::disk('local')->assertExists('app/users/import/myexcel.xlsx');

    }


    public function test_upload_not_works()
    {

        $file = UploadedFile::fake()->create('myexcel.xlsx');

        Excel::fake();

        $this->post('/import', [
            'file' => $file
        ]);

        Storage::disk('local')->assertMissing('app/users/import/missing.xlsx');

    }

}
