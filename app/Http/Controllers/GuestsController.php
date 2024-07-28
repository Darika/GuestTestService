<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuestsStoreRequest;
use App\Http\Requests\GuestsUpdateRequest;
use App\Http\Resources\GuestResource;
use App\Models\Guest;
use Illuminate\Http\JsonResponse;
use Propaganistas\LaravelPhone\PhoneNumber;
use App\Services\GuestService;

class GuestsController extends Controller
{
    private GuestService $guestService;

    public function __construct(GuestService $guestService)
    {
        $this->guestService = $guestService;
    }

    /**
     * @return JsonResponse
     */
    public function index() : JsonResponse
    {
        $guests = $this->guestService->index();

        return response()->json([
            'status' => 'ok',
            'data' => GuestResource::collection($guests),
        ]);
    }

    /**
     * @param GuestsStoreRequest $request
     * @return JsonResponse
     */
    public function store(GuestsStoreRequest $request) : JsonResponse
    {
        $this->guestService->store($request);

        return response()->json([
            'status' => 'ok',
            'data' => null,
        ]);
    }

    /**
     * @param string $id
     * @return JsonResponse
     */
    public function show(string $id) : JsonResponse
    {
        $guest = $this->guestService->getGuestById($id);

        return response()->json([
            'status' => 'ok',
            'data' => GuestResource::make($guest),
        ]);
    }

    /**
     * @param GuestsUpdateRequest $request
     * @return JsonResponse
     */
    public function update(GuestsUpdateRequest $request) : JsonResponse
    {
        $this->guestService->update($request);

        return response()->json([
            'status' => 'ok',
            'data' => null,
        ]);
    }

    /**
     * @param string $id
     * @return JsonResponse
     */
    public function destroy(string $id) : JsonResponse
    {
        $this->guestService->destroy($id);

        return response()->json([
            'status' => 'ok',
            'data' => null,
        ]);
    }
}
