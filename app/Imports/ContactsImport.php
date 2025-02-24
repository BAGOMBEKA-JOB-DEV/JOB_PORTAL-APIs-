<?php 
namespace App\Imports;

use App\Models\Contact;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ContactsImport implements ToModel, WithHeadingRow
{
    /**
     * Define how each row of the file is mapped to the Contact model
     */
    public function model(array $row)
    {
        return new Contact([
            'name' => $row['name'], // Assuming 'name' is a column in your Excel/CSV file
            'email' => $row['email'],
            'phone' => $row['phone'],
        ]);
    }
}
