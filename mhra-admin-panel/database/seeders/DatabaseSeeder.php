<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Blog;
use App\Models\BlogComment;
use App\Models\BlogCommentLike;
use App\Models\Badge;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\BlogLike;

class DatabaseSeeder extends Seeder
{
    public function run()
    {

        // Create an admin user
        \App\Models\User::factory()->admin()->create([
            'first_name'    => 'Admin',
            'last_name'     => 'User',
            'email'         => 'admin@example.com',
            'password' => '123456',
        ]);

        \App\Models\User::factory()->admin()->create([
            'first_name'    => 'User',
            'last_name'     => 'User',
            'email'         => 'user@example.com',
            'password' => '123456',
        ]);

        // Users
        User::factory(50)->create();

        // Badges
        Badge::factory(10)->create();

        // Assign Badges to Users
        User::all()->each(function ($user) {
            $badges = Badge::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $user->badges()->attach($badges, ['acquired_at' => now()]);
        });

        // User Connections
        $users = User::all();
        foreach ($users as $user) {
            $friends = $users->where('id', '!=', $user->id)->random(rand(1, 5))->pluck('id');
            foreach ($friends as $friend_id) {
                $user->connections()->attach($friend_id, ['status' => 'accepted']);
            }
        }

        // Recommendations
        \App\Models\Recommendation::factory(100)->create();

        // Notification Preferences
        \App\Models\NotificationPreference::factory(50)->create();

        // Blogs
        \App\Models\Blog::factory(20)->create();

        // Blog Sections
        \App\Models\BlogSection::factory(60)->create();

        // Blog Comments
        \App\Models\BlogComment::factory(100)->create();

        // Blog Comment Likes - Adjusted to prevent duplicates
        // Fetch all blog comments
        $blogComments = BlogComment::all();

        // Fetch all users
        $allUsers = User::all();

        // For each comment, assign a random set of users to like it
        foreach ($blogComments as $comment) {
            // Determine how many likes to assign (e.g., between 1 and 10)
            $likeCount = rand(1, 10);

            // Select unique users for likes
            $usersForLikes = $allUsers->random(min($likeCount, $allUsers->count()));

            foreach ($usersForLikes as $user) {
                // Ensure the user hasn't already liked this comment
                // Although unlikely since we're selecting unique users per comment
                BlogCommentLike::create([
                    'comment_id' => $comment->id,
                    'user_id'    => $user->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Blog Relations
        $blogs = \App\Models\Blog::all();
        foreach ($blogs as $blog) {
            $relatedBlogs = $blogs->where('id', '!=', $blog->id)->random(rand(1, 3))->pluck('id');
            $blog->relatedBlogs()->attach($relatedBlogs);
        }

        // Events
        \App\Models\Event::factory(40)->create();

        // Event Ticket Types
        \App\Models\Event::all()->each(function ($event) {
            \App\Models\EventTicketType::factory(3)->create(['event_id' => $event->id]);
        });

        // Speakers
        \App\Models\Speaker::factory(20)->create();

        // Assign Speakers to Events
        \App\Models\Event::all()->each(function ($event) {
            $speakers = \App\Models\Speaker::inRandomOrder()->take(rand(2, 5))->pluck('id');
            $event->speakers()->attach($speakers, ['speaker_type' => 'Guest', 'order' => rand(1, 10)]);
        });

        // Agendas
        \App\Models\Event::all()->each(function ($event) {
            \App\Models\Agenda::factory()->create(['event_id' => $event->id]);
        });

        // Agenda Items
        \App\Models\Agenda::all()->each(function ($agenda) {
            \App\Models\AgendaItem::factory(rand(5, 10))->create(['agenda_id' => $agenda->id]);
        });

        // Ticket Purchases
        \App\Models\TicketPurchase::factory(100)->create();

        // Employees
        \App\Models\Employee::factory(15)->create();

        // General Info
        \App\Models\GeneralInfo::factory()->create();


        BlogLike::factory()->count(50)->create();
    }
}
