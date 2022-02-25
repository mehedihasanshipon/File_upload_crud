<?php

namespace App\Imports;

use App\Models\Contact;
use App\Models\Group;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ContactImport implements ToCollection,WithHeadingRow,WithValidation,SkipsOnFailure
{
    use SkipsFailures;

    private $filelist;

    private $count;

    public function __construct($filelist,$count)
    {   
        $this->filelist=$filelist;
        $this->count=$count;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach( $rows->chunk(100) as $key=>$chunk){
           $group=$this->filelist->groups()->create([
               'name'=>"group_".($key+1),
               'total_contact'=>$chunk->count()
           ]);

           foreach($chunk as $contact){
               $group->contacts()->create([
                   'number'=>$contact['number'],
                   'first_name'=>$contact['first_name'],
                   'last_name'=>$contact['last_name'],
                   'email'=>$contact['email'],
                   'state'=>$contact['state'],
                   'zip'=>$contact['zip'],
               ]);
           }
        }
        $this->filelist->update([
            'total_uploaded'=>$this->count,
            'total_processed'=>$rows->count(),
        ]);
    }

    public function rules(): array
    {
        return [
            'number' => [
                'required',
                'integer',
                'digits_between:1,12'
            ],
            'first_name' => [
                'nullable',
                'string',
            ],
            'last_name' => [
                'nullable',
                'string',
            ],
            'email' => [
                'nullable',
                'email',
            ],
            'state' => [
                'nullable',
                'string',
            ],
            'zip' => [
                'nullable',
            ],
        ];
    }
}
