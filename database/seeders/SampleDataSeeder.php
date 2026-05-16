<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Category;
use App\Models\User;
use App\Models\Book;
use App\Models\Contact;

class SampleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Categories (5)
        $categories = [
            ['name' => 'Fiction & Literature'],
            ['name' => 'Technology & Programming'],
            ['name' => 'Science & Nature'],
            ['name' => 'History & Biography'],
            ['name' => 'Art & Design'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        $allCategories = Category::all();

        // 2. Users (5)
        $users = [
            [
                'fullname' => 'John Doe',
                'username' => 'johndoe',
                'email' => 'john@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
            ],
            [
                'fullname' => 'Jane Smith',
                'username' => 'janesmith',
                'email' => 'jane@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
            ],
            [
                'fullname' => 'Andi',
                'username' => 'andi',
                'email' => 'andi@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
            ],
            [
                'fullname' => 'Alice Johnson',
                'username' => 'alicej',
                'email' => 'alice@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
            ],
            [
                'fullname' => 'Bob Wilson',
                'username' => 'bobw',
                'email' => 'bob@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }

        $allUsers = User::all();

        // 3. Books (5)
        $books = [
            [
                'category_id' => $allCategories[0]->id,
                'title' => 'The Great Gatsby',
                'author' => 'F. Scott Fitzgerald',
                'description' => 'A story of the fabulously wealthy Jay Gatsby and his love for the beautiful Daisy Buchanan.',
                'price' => 15.99,
                'stock' => 50,
                'image' => 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?auto=format&fit=crop&q=80&w=800'
            ],
            [
                'category_id' => $allCategories[1]->id,
                'title' => 'Clean Code',
                'author' => 'Robert C. Martin',
                'description' => 'A Handbook of Agile Software Craftsmanship. Even bad code can function.',
                'price' => 34.50,
                'stock' => 20,
                'image' => 'https://images.unsplash.com/photo-1516116216624-53e697fedbea?auto=format&fit=crop&q=80&w=800'
            ],
            [
                'category_id' => $allCategories[2]->id,
                'title' => 'A Brief History of Time',
                'author' => 'Stephen Hawking',
                'description' => 'A landmark volume in science writing by one of the great minds of our time.',
                'price' => 18.25,
                'stock' => 15,
                'image' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?auto=format&fit=crop&q=80&w=800'
            ],
            [
                'category_id' => $allCategories[3]->id,
                'title' => 'Sapiens: A Brief History of Humankind',
                'author' => 'Yuval Noah Harari',
                'description' => 'Dr. Yuval Noah Harari spans the whole of human history.',
                'price' => 22.90,
                'stock' => 30,
                'image' => 'https://images.unsplash.com/photo-1461360228754-6e81c478b882?auto=format&fit=crop&q=80&w=800'
            ],
            [
                'category_id' => $allCategories[4]->id,
                'title' => 'The Design of Everyday Things',
                'author' => 'Don Norman',
                'description' => 'Even the smartest among us can feel inept as we fail to figure out which light switch or oven burner to turn on.',
                'price' => 19.99,
                'stock' => 25,
                'image' => 'https://images.unsplash.com/photo-1586717791821-3f44a563dc4c?auto=format&fit=crop&q=80&w=800'
            ],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }

        // 4. Contacts (5)
        $contacts = [
            [
                'user_id' => $allUsers[0]->id,
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'subject' => 'Inquiry about Gatsby',
                'message' => 'Is the Great Gatsby available in hardcover?',
                'status' => 'pending',
            ],
            [
                'user_id' => $allUsers[1]->id,
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'subject' => 'Clean Code Shipping',
                'message' => 'When will my order for Clean Code be shipped?',
                'status' => 'replied',
            ],
            [
                'user_id' => $allUsers[3]->id,
                'name' => 'Alice Johnson',
                'email' => 'alice@example.com',
                'subject' => 'Bulk Order',
                'message' => 'Do you offer discounts for bulk orders of Sapiens?',
                'status' => 'pending',
            ],
            [
                'user_id' => $allUsers[4]->id,
                'name' => 'Bob Wilson',
                'email' => 'bob@example.com',
                'subject' => 'Technical Support',
                'message' => 'I am having trouble accessing my digital library.',
                'status' => 'pending',
            ],
            [
                'user_id' => null,
                'name' => 'Guest User',
                'email' => 'guest@example.com',
                'subject' => 'General Inquiry',
                'message' => 'What are your store hours?',
                'status' => 'pending',
            ],
        ];

        foreach ($contacts as $contact) {
            Contact::create($contact);
        }
    }
}

