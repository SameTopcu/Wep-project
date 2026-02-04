<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\WelcomeItem;

class WelcomeItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $obj = new WelcomeItem;
        $obj->heading = "Welcome to our website";
        $obj->description = "At TripSummit, our mission is to turn travel dreams into reality by providing personalized and memorable experiences.";
        $obj->photo = "about-1.jpg";
        $obj->button_text = "Read More";
        $obj->button_link = "#";
        $obj->video = "S4DI3Bve_bQ";
        $obj->status = "Show";
        $obj->save();
    }
}
