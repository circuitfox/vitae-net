<?php

namespace Tests\Unit;

use App\Order;
use App\Patient;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;

class OrderControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get('/orders');
        $response->assertViewIs('admin.orders');
    }

    public function testCreate()
    {
        $admin = factory(User::class)->states('admin')->create();
        $response = $this->actingAs($admin)->get('/orders/create');
        $response->assertViewIs('admin.orders.create');
    }

    public function testCreateInstructorOrAdmin()
    {
        $admin = factory(User::class)->states('admin')->create();
        $instructor = factory(User::class)->states('instructor')->create();
        $student = factory(User::class)->states('student')->create();
        $response = $this->actingAs($admin)->get('/orders/create');
        $response->assertViewIs('admin.orders.create');
        $response = $this->actingAs($instructor)->get('/orders/create');
        $response->assertViewIs('admin.orders.create');
        $response = $this->actingAs($student)->get('/orders/create');
        $response->assertStatus(403);
    }

    public function testStore()
    {
        $user = factory(User::class)->states('admin')->create();
        $patient = factory(Patient::class)->create();
        $response = $this->actingAs($user)->post('/orders', [
            'name' => 'test',
            'description' => 'description',
            'patient_id' => $patient->medical_record_number,
            'doc' => UploadedFile::fake()->create('test.pdf'),
            'completed' => false,
        ]);
        $response->assertRedirect();
        $order = Order::where([
            'name' => 'test',
            'description' => 'description',
            'patient_id' => $patient->medical_record_number
        ])->first();
        $this->assertNotNull($order);
        $this->assertEquals($order->name, 'test');
        $this->assertEquals($order->description, 'description');
        $this->assertEquals($order->patient_id, $patient->medical_record_number);
        $this->assertEquals($order->completed, 0);
        $this->assertNotNull($order->patient());
        $this->assertEquals($order->patient->medical_record_number, $patient->medical_record_number);
    }

    public function testStoreInstructorOrAdmin()
    {
        $user = factory(User::class)->states('student')->create();
        $admin = factory(User::class)->states('admin')->create();
        $patient = factory(Patient::class)->create();
        $patient1 = factory(Patient::class)->create();
        $response = $this->actingAs($admin)->post('/orders', [
            'name' => 'test',
            'description' => 'description',
            'patient_id' => $patient->medical_record_number,
            'doc' => UploadedFile::fake()->create('test.pdf'),
            'completed' => false,
        ]);
        $response->assertRedirect();
        $order = Order::where([
            'name' => 'test',
            'description' => 'description',
            'patient_id' => $patient->medical_record_number,
        ])->first();
        $this->assertNotNull($order);
        $this->assertEquals($order->name, 'test');
        $this->assertEquals($order->description, 'description');
        $this->assertEquals($order->patient_id, $patient->medical_record_number);
        $this->assertEquals($order->completed, 0);
        $this->assertNotNull($order->patient());
        $this->assertEquals($order->patient->medical_record_number, $patient->medical_record_number);
        $response = $this->actingAs($user)->post('/orders', [
            'name' => 'test',
            'description' => 'description',
            'patient_id' => $patient1->medical_record_number,
            'doc' => UploadedFile::fake()->create('test.pdf'),
            'completed' => false,
        ]);
        $response->assertStatus(403);
        $order = Order::where([
            'name' => 'test',
            'description' => 'description',
            'patient_id' => $patient1->medical_record_number
        ])->first();
        $this->assertNull($order);
    }

    public function testShow()
    {
        $admin = factory(User::class)->states('admin')->create();
        $order = factory(Order::class)->create();
        $response = $this->actingAs($admin)->get('/orders/' . $order->id);
        $response->assertViewIs('admin.order');
    }

    public function testEdit()
    {
        $admin = factory(User::class)->states('admin')->create();
        $order = factory(Order::class)->create();
        $response = $this->actingAs($admin)->get('/orders/' . $order->id . '/edit');
        $response->assertViewIs('admin.order.edit');
    }

    public function testEditInstructorOrAdmin()
    {
        $admin = factory(User::class)->states('admin')->create();
        $instructor = factory(User::class)->states('instructor')->create();
        $student = factory(User::class)->states('student')->create();
        $order = factory(Order::class)->create();
        $response = $this->actingAs($admin)->get('/orders/' . $order->id . '/edit');
        $response->assertViewIs('admin.order.edit');
        $response = $this->actingAs($instructor)->get('/orders/' . $order->id . '/edit');
        $response->assertViewIs('admin.order.edit');
        $response = $this->actingAs($student)->get('/orders/' . $order->id . '/edit');
        $response->assertStatus(403);
    }

    public function testUpdate()
    {
        $admin = factory(User::class)->states('admin')->create();
        $order = factory(Order::class)->create();
        $response = $this->actingAs($admin)->put('/orders/' . $order->id, [
            'name' => 'foo',
            'description' => $order->description,
            'patient_id' => $order->patient_id,
            'completed' => !$order->completed,
        ]);
        $order1 = Order::find($order->id);
        $this->assertNotNull($order1);
        $this->assertEquals($order1->name, 'foo');
        $this->assertEquals($order1->description, $order->description);
        $this->assertNotEquals($order1->completed, $order->completed);
        $this->assertEquals($order1->patient_id, $order->patient_id);
        $this->assertNotNull($order1->patient());
        $this->assertEquals($order1->patient->medical_record_number, $order->patient->medical_record_number);
    }

    public function testUpdatePatient()
    {
        $admin = factory(User::class)->states('admin')->create();
        $order = factory(Order::class)->create();
        $patient = factory(Patient::class)->create();
        $response = $this->actingAs($admin)->put('/orders/' . $order->id, [
            'description' => $order->description,
            'name' => $order->name,
            'patient_id' => $patient->medical_record_number,
            'completed' => !$order->completed,
        ]);
        $order1 = Order::find($order->id);
        $this->assertNotNull($order1);
        $this->assertEquals($order1->name, $order->name);
        $this->assertEquals($order1->description, $order->description);
        $this->assertNotEquals($order1->patient_id, $order->patient_id);
        $this->assertNotEquals($order1->completed, $order->completed);
        $this->assertEquals($order1->patient_id, $patient->medical_record_number);
        $this->assertNotNull($order1->patient);
        $this->assertNotEquals($order1->patient, $order->patient);
        $this->assertNotEquals($order1->patient->medical_record_number, $order->patient->medical_record_number);
        $this->assertEquals($order1->patient->medical_record_number, $patient->medical_record_number);
    }

    public function testUpdateInstructorOrAdmin()
    {
        $admin = factory(User::class)->states('admin')->create();
        $instructor = factory(User::class)->states('instructor')->create();
        $student = factory(User::class)->states('student')->create();
        $order = factory(Order::class)->create();
        $response = $this->actingAs($admin)->put('/orders/' . $order->id, [
            'name' => 'foo',
            'description' => $order->description,
            'patient_id' => $order->patient_id,
            'completed' => !$order->completed,
        ]);
        $order1 = Order::find($order->id);
        $this->assertNotNull($order1);
        $this->assertEquals($order1->name, 'foo');
        $this->assertEquals($order1->description, $order->description);
        $this->assertNotEquals($order1->completed, $order->completed);
        $this->assertEquals($order1->patient_id, $order->patient_id);
        $this->assertNotNull($order1->patient());
        $this->assertEquals($order1->patient->medical_record_number, $order->patient->medical_record_number);
        $response = $this->actingAs($instructor)->put('/orders/' . $order->id, [
            'name' => 'bar',
            'description' => $order->description,
            'patient_id' => $order->patient_id,
            'completed' => $order->completed,
        ]);
        $order1 = Order::find($order->id);
        $this->assertNotNull($order1);
        $this->assertEquals($order1->name, 'bar');
        $this->assertEquals($order1->description, $order->description);
        $this->assertEquals($order1->completed, $order->completed);
        $this->assertEquals($order1->patient_id, $order->patient_id);
        $this->assertNotNull($order1->patient());
        $this->assertEquals($order1->patient->medical_record_number, $order->patient->medical_record_number);
        $response = $this->actingAs($student)->put('/orders/' . $order->id, [
            'name' => 'foo',
            'description' => $order->description,
            'patient_id' => $order->patient_id,
            'completed' => !$order->completed,
        ]);
        $response->assertStatus(403);
        $order1 = Order::find($order->id);
        $this->assertNotNull($order1);
        $this->assertEquals($order1->name, 'bar');
        $this->assertEquals($order1->description, $order->description);
        $this->assertEquals($order1->completed, $order->completed);
        $this->assertEquals($order1->patient_id, $order->patient_id);
        $this->assertNotNull($order1->patient());
        $this->assertEquals($order1->patient->medical_record_number, $order->patient->medical_record_number);
    }

    public function testDelete()
    {
        $user = factory(User::class)->states('admin')->create();
        $order = factory(Order::class)->create();
        $response = $this->actingAs($user)->delete('/orders/' . $order->id);
        $response->assertRedirect();
        $this->assertNull(Order::find($order->id));
    }

    public function testDeleteInstructorOrAdmin()
    {
        $user = factory(User::class)->states('student')->create();
        $admin = factory(User::class)->states('admin')->create();
        $instructor = factory(User::class)->states('instructor')->create();
        $order = factory(Order::class)->create();
        $order1 = factory(Order::class)->create();
        $response = $this->actingAs($admin)->delete('/orders/' . $order->id);
        $response->assertRedirect();
        $this->assertNull(Order::find($order->id));
        $response = $this->actingAs($user)->delete('/orders/' . $order1->id);
        $response->assertStatus(403);
        $this->assertNotNull(Order::find($order1->id));
        $response = $this->actingAs($instructor)->delete('/orders/' . $order1->id);
        $response->assertRedirect();
        $this->assertNull(Order::find($order1->id));
    }

    public function testCompleteOrder()
    {
        $user = factory(User::class)->states('student')->create();
        $order = factory(Order::class)->states('incomplete')->create();
        $response = $this->actingAs($user)->post('/orders/complete', ['order_id'=>$order->id] );
        $order = Order::find($order->id);
        $this->assertNotNull($order);
        $this->assertEquals(1, $order->completed);
    }
}
