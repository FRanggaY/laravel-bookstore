<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use App\Models\Book;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Contact;
use Illuminate\Http\UploadedFile;

class SystemRequirementTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;
    protected $user;
    protected $category;
    protected $book;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Setup Admin
        $this->admin = User::create([
            'fullname' => 'Admin User',
            'username' => 'admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Setup common data
        $this->category = Category::create(['name' => 'Fiction']);
        $this->book = Book::create([
            'category_id' => $this->category->id,
            'title' => 'Initial Book',
            'author' => 'Test Author',
            'description' => 'Initial Description',
            'price' => 50,
            'stock' => 100,
            'image' => 'books/default.jpg'
        ]);
    }

    /** @test */
    public function requirement_01_user_registration()
    {
        $response = $this->post('/register', [
            'fullname' => 'New User',
            'username' => 'newuser',
            'email' => 'new@test.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);
        $response->assertRedirect('/');
        $this->assertDatabaseHas('users', ['username' => 'newuser']);
    }

    /** @test */
    public function requirement_02_user_login()
    {
        $user = User::create([
            'fullname' => 'Test User',
            'username' => 'testuser',
            'email' => 'test@test.com',
            'password' => bcrypt('password123'),
            'role' => 'user',
        ]);

        $response = $this->post('/login', [
            'username' => 'testuser',
            'password' => 'password123',
        ]);
        $response->assertRedirect('/');
        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function requirement_03_admin_category_crud()
    {
        $this->actingAs($this->admin);
        
        // Create
        $this->post('/admin/categories', ['name' => 'Science']);
        $this->assertDatabaseHas('categories', ['name' => 'Science']);
        $cat = Category::where('name', 'Science')->first();

        // Update
        $this->put("/admin/categories/{$cat->id}", ['name' => 'Sci-Fi']);
        $this->assertDatabaseHas('categories', ['name' => 'Sci-Fi']);

        // Delete
        $this->delete("/admin/categories/{$cat->id}");
        $this->assertDatabaseMissing('categories', ['id' => $cat->id]);
    }

    /** @test */
    public function requirement_04_admin_book_crud()
    {
        $this->actingAs($this->admin);
        $file = UploadedFile::fake()->create('book.jpg', 100);

        // Create
        $this->post('/admin/books', [
            'category_id' => $this->category->id,
            'title' => 'The Great Book',
            'author' => 'Famous Author',
            'description' => 'A very long story',
            'price' => 25,
            'stock' => 30,
            'image' => $file,
        ]);
        $this->assertDatabaseHas('books', ['title' => 'The Great Book']);
        $book = Book::where('title', 'The Great Book')->first();

        // Update
        $this->put("/admin/books/{$book->id}", [
            'category_id' => $this->category->id,
            'title' => 'The Greatest Book',
            'author' => 'Very Famous Author',
            'description' => 'Even longer story',
            'price' => 35,
            'stock' => 20,
        ]);
        $this->assertDatabaseHas('books', ['title' => 'The Greatest Book']);

        // Delete
        $this->delete("/admin/books/{$book->id}");
        $this->assertDatabaseMissing('books', ['id' => $book->id]);
    }

    /** @test */
    public function requirement_05_admin_view_users()
    {
        User::create([
            'fullname' => 'Customer',
            'username' => 'customer01',
            'email' => 'c@test.com',
            'password' => bcrypt('pass'),
            'role' => 'user'
        ]);

        $this->actingAs($this->admin);
        $this->get('/admin/users')->assertStatus(200)->assertSee('customer01');
    }

    /** @test */
    public function requirement_06_user_view_book_list()
    {
        $this->get('/')->assertStatus(200)->assertSee('Initial Book');
    }

    /** @test */
    public function requirement_07_user_search_book()
    {
        $this->get('/?search=Initial')->assertStatus(200)->assertSee('Initial Book');
        $this->get('/?search=Unknown')->assertStatus(200)->assertDontSee('Initial Book');
    }

    /** @test */
    public function requirement_08_user_view_book_detail()
    {
        $this->get("/books/{$this->book->id}")->assertStatus(200)->assertSee('Initial Description');
    }

    /** @test */
    public function requirement_09_user_add_to_cart()
    {
        $user = User::create(['fullname' => 'U', 'username' => 'u', 'email' => 'u@t.com', 'password' => 'p', 'role' => 'user']);
        $this->actingAs($user);

        $this->post("/cart/add/{$this->book->id}");
        
        $this->assertDatabaseHas('carts', ['user_id' => $user->id, 'book_id' => $this->book->id, 'quantity' => 1]);
    }

    /** @test */
    public function requirement_10_user_checkout_cod()
    {
        $user = User::create(['fullname' => 'U', 'username' => 'u', 'email' => 'u@t.com', 'password' => 'p', 'role' => 'user']);
        Cart::create(['user_id' => $user->id, 'book_id' => $this->book->id, 'quantity' => 2]);
        
        $this->actingAs($user);
        $this->post('/orders', [
            'address' => '123 Street',
            'payment_method' => 'cod',
        ]);
        
        $this->assertDatabaseHas('orders', ['user_id' => $user->id, 'book_id' => $this->book->id, 'quantity' => 2, 'payment_method' => 'cod']);
        $this->assertEquals(98, $this->book->fresh()->stock);
    }

    /** @test */
    public function requirement_11_user_upload_payment_proof()
    {
        $user = User::create(['fullname' => 'U', 'username' => 'u', 'email' => 'u@t.com', 'password' => 'p', 'role' => 'user']);
        $order = Order::create(['user_id' => $user->id, 'book_id' => $this->book->id, 'quantity' => 1, 'total_price' => 50, 'address' => 'A', 'payment_method' => 'transfer', 'status' => 'pending']);
        
        $this->actingAs($user);
        $file = UploadedFile::fake()->create('proof.jpg', 100);
        
        $this->post("/orders/{$order->id}/payment", ['payment_proof' => $file]);
        $this->assertNotNull($order->fresh()->payment_proof);
    }

    /** @test */
    public function requirement_12_user_view_about_us()
    {
        $this->get('/about')->assertStatus(200)->assertSee('Our Story');
    }

    /** @test */
    public function requirement_13_user_send_contact_message()
    {
        $response = $this->post('/contact', [
            'name' => 'John',
            'email' => 'john@test.com',
            'subject' => 'Hello',
            'message' => 'Test message',
        ]);
        $this->assertDatabaseHas('contacts', ['name' => 'John', 'subject' => 'Hello']);
    }

    /** @test */
    public function requirement_14_admin_manage_orders()
    {
        $user = User::create(['fullname' => 'John', 'username' => 'john', 'email' => 'j@t.com', 'password' => 'p', 'role' => 'user']);
        $order = Order::create(['user_id' => $user->id, 'book_id' => $this->book->id, 'quantity' => 1, 'total_price' => 50, 'address' => 'A', 'status' => 'pending']);
        
        $this->actingAs($this->admin);
        
        // View orders
        $this->get('/admin/orders')->assertStatus(200)->assertSee('John');
        
        // Update status
        $this->put("/admin/orders/{$order->id}/status", ['status' => 'delivered']);
        $this->assertEquals('delivered', $order->fresh()->status);
    }
}
