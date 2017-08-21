<?php

namespace Tests\Feature;

use App\Models\Record;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RecordControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetAllRecords()
    {
        $records = factory(Record::class)->times(20)->create();

        $this->get(route('record.index'))
            ->assertStatus(Response::HTTP_OK)
            ->assertJson($records->toArray());
    }

    public function testCreateRecord()
    {
        $recordStub = factory(Record::class)->make();

        $this->post(route('record.store'), $recordStub->toArray())
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJson($recordStub->toArray());
    }

    public function testShowRecord()
    {
        $record = factory(Record::class)->create();
        $id = $record->id;

        $this->get(route('record.show', compact('id')))
            ->assertStatus(Response::HTTP_OK)
            ->assertJson($record->toArray());
    }

    public function testEditRecord()
    {
        $record = factory(Record::class)->create();
        $recordUpdated = factory(Record::class)->make();

        $this->put(route('record.update', ['id' => $record->id]), $recordUpdated->toArray())
            ->assertStatus(Response::HTTP_OK)
            ->assertJson($recordUpdated->toArray());
    }
}
