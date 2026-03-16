<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\HomeItem;
class HomeItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $obj = new HomeItem;
        $obj->destination_heading = "Discover Our Destinations";
        $obj->destination_subheading = "Explore the world with us";
        $obj->destination_status = "Show";
        $obj->feature_status = "Show";
        $obj->package_heading = "Our Packages";
        $obj->package_subheading = "Choose your package";
        $obj->package_status = "Show";
        $obj->testimonial_heading = "What Our Clients Say";
        $obj->testimonial_subheading = "See what our clients have to say";
        $obj->testimonial_background = "";
        $obj->testimonial_status = "Show";
        $obj->blog_heading = "Latest Blog Posts";
        $obj->blog_subheading = "Read our latest blog posts";
        $obj->blog_status = "Show";
        $obj->save();
    }
}
