<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Customer;
use App\Company;
use App\Employee;
use App\Position;
use App\Driver;
use App\Load;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        User::truncate();
        Company::truncate();
        Position::truncate();
        Customer::truncate();
        Employee::truncate();
        Driver::truncate();
        Load::truncate();

        // $userQuentity = 10;
        $CompanyQuentity = 1;
        $PositionQuentity = 10;;
        $CustomerQuentity = 1;
        $EmployeeQuentity = 1;
        $DriverQuentity = 1;
        $LoadQuentity = 10;

        // factory(User::class , $userQuentity)->create();
        factory(Company::class , $CompanyQuentity)->create();
        factory(Position::class , $PositionQuentity)->create();
        factory(Employee::class , $EmployeeQuentity)->create();
        factory(Customer::class , $CustomerQuentity)->create();
        factory(Driver::class , $DriverQuentity)->create();
        // factory(Load::class , $LoadQuentity)->create();
    }
}
