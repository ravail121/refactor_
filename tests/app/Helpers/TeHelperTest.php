<?php

use DTApi\Helpers\TeHelper;

class TeHelperTest extends TestCase
{
    public function testExpiresInLessThanOrEqualTo90Min()
    {
        $created_at = Carbon::now();
        $due_time = $created_at->copy()->addMinutes(90); 
        
        $result = TeHelper::willExpireAt($due_time->format('Y-m-d H:i:s'), $created_at->format('Y-m-d H:i:s'));

        $this->assertEquals($due_time->format('Y-m-d H:i:s'), $result);
    }

    public function testExpiresInLessThanOrEqualTo24Hours()
    {
        $created_at = Carbon::now();
        $due_time = $created_at->copy()->addHours(24);
        
        $result = TeHelper::willExpireAt($due_time->format('Y-m-d H:i:s'), $created_at->format('Y-m-d H:i:s'));

        $this->assertEquals($due_time->format('Y-m-d H:i:s'), $result);
    }

    public function testExpiresInBetween24And72Hours()
    {
        $created_at = Carbon::now();
        $due_time = $created_at->copy()->addHours(72); 
        
        $result = TeHelper::willExpireAt($due_time->format('Y-m-d H:i:s'), $created_at->format('Y-m-d H:i:s'));

        $this->assertEquals($due_time->format('Y-m-d H:i:s'), $result);
    }

    public function testExpiresAfter72Hours()
    {
        $created_at = Carbon::now();
        $due_time = $created_at->copy()->addHours(80);
        $due_time_check = $due_time->copy()->subHours(48); 
        
        $result = TeHelper::willExpireAt($due_time->format('Y-m-d H:i:s'), $created_at->format('Y-m-d H:i:s'));

        $this->assertEquals($due_time_check->format('Y-m-d H:i:s'), $result);
    }
}