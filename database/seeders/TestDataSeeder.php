<?php

namespace Database\Seeders;

use App\Models\ActivityType;
use App\Models\Building;
use App\Models\College;
use App\Models\EnrollmentFee;
use App\Models\EnrollmentStatus;
use App\Models\InstructionLanguage;
use App\Models\LoadType;
use Illuminate\Database\Seeder;
use App\Models\MeetingType;
use App\Models\Student;
use App\Models\StudentBalance;
use Database\Factories\ActivityTypeFactory;
use Database\Factories\BuildingFactory;
use Database\Factories\CollegeFactory;
use Database\Factories\EnrollmentFeeFactory;
use Database\Factories\EnrollmentStatusFactory;
use Database\Factories\InstructionLanguageFactory;
use Database\Factories\LoadTypeFactory;
use Database\Factories\StudentBalanceFactory;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $meetingTypes = ['(LEC)' => 'Lecture', '(LAB)' => 'Laboratory'];
        $modes = ['ONLINE' => 'Teams Meeting', 'F2F' => 'Face to Face', 'FIELD' => 'Field'];

        foreach ($modes as $key=>$mode) {
            foreach ($meetingTypes as $key2=>$meetingType) {
                $existing = MeetingType::where('meeting_type_code', $key . '-' . $key2)->first();
                if ($existing) {
                    continue;
                }
                MeetingType::create([
                    'meeting_type_code' => $key . '-' . $key2,
                    'label' => $mode. ' ' .$meetingType,
                    'active_status' => true,
                ]);
            }
        }

        $res = EnrollmentStatus::all();
        if ($res->count() < 20) {
            EnrollmentStatusFactory::new()->count(20)->create();
        }

        $res = EnrollmentFee::all();
        if ($res->count() < 20) {
            EnrollmentFeeFactory::new()->count(20)->create();
        }

        $res = College::all();
        if ($res->count() < 20) {
            CollegeFactory::new()->count(20)->create();
        }

        $res = InstructionLanguage::all();
        if ($res->count() < 20) {
            InstructionLanguageFactory::new()->count(20)->create();
        }
        
        $res = LoadType::all();
        if ($res->count() < 20) {
            LoadTypeFactory::new()->count(20)->create();
        }

        $res = Building::all();
        if ($res->count() < 20) {
            BuildingFactory::new()->count(20)->create();
        }

        $res = ActivityType::all();
        if ($res->count() < 20) {
            ActivityTypeFactory::new()->count(20)->create();
        }

        $res = StudentBalance::all();
        if ($res->count() < 20) {
            $students = Student::all();
            foreach ($students as $student) {
                StudentBalanceFactory::new()
                    ->count(5)
                    ->for($student)
                    ->create();
            }
        }


    }
}
