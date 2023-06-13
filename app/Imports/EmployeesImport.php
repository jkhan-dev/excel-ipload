<?php

namespace App\Imports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithheadingRow;
class EmployeesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $hire_date = explode('/',$row['hire_date']);
        return new Employee([
            'employee_id'=> $row['employee_id'],
            'full_name'=> $row['full_name'],
            'job_title'=> $row['job_title'],
            'department'=> $row['department'],
            'business_unit'=> $row['business_unit'],
            'gender'=> $row['gender'],
            'ethnicity'=> $row['ethnicity'],
            'age'=> $row['age'],
            'hire_date'=>   \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['hire_date'])),
            'annual_salary'=> $row['annual_salary'],
            'bonus'=> $row['bonus'],
            'country'=> $row['country'],
            'city'=> $row['city'],
            'exit'=> $row['exit_date'],
        ]);
    }
}
