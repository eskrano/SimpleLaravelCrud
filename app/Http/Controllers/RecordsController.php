<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\RecordCreateRequest;
use App\Http\Requests\RecordUpdateRequest;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Response;

class RecordsController extends Controller
{
    /**
     * @return Collection
     */
    public function index(): Collection
    {
        return Record::all();
    }

    /**
     * @param RecordCreateRequest $request
     * @return JsonResponse
     */
    public function store(RecordCreateRequest $request): JsonResponse
    {
        $record = Record::create($request->input());

        return new JsonResponse($record, Response::HTTP_CREATED);
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function show($id): ?Record
    {
        return Record::findOrFail($id);
    }


    /**
     * @param RecordUpdateRequest $request
     * @param $id
     * @return Response
     */
    public function update(RecordUpdateRequest $request, int $id): Response
    {
        $record = Record::findOrFail($id);

        $record->update($request->input());

        return new JsonResponse($record, Response::HTTP_OK);
    }

    /**
     * @param $id
     * @return Response
     */
    public function destroy(int $id): Response
    {
        $record = Record::findOrFail($id);
        $record->delete();

        return response()->setStatusCode(Response::HTTP_OK);
    }

    public function search(string $query): Response
    {
        $data = Record::where('name', $query)->get();

        if (0 === count($data)) {
            return new Response('', Response::HTTP_NO_CONTENT);
        }

        return new JsonResponse($data);
    }

}
