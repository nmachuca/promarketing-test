<?php

namespace App\Http\Controllers\resources;

use App\Http\Controllers\Controller;
use App\Http\Requests\GameStoreRequest;
use App\Models\Game;
use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     * All roles have permission to use this service.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->sendResponse(
            Game::all(),
            null
        );
    }

    /**
     * Store a newly created resource in storage.
     * Role viewer does not have permissions to this service.
     *
     * @param GameStoreRequest $request
     * @return JsonResponse
     */
    public function store(GameStoreRequest $request): JsonResponse
    {
        $user = Auth::user();

        if($user->hasRole(Role::VIEWER_ROLE)) {
            return $this->sendError(
                'Unauthorized',
                [],
                401
            );
        }

        $validated = $request->validated();

        $game = Game::create([
            'name' => $validated['name'],
            'url' => $validated['url'],
            'description' => $validated['description'],
            'status' => $validated['status'],
        ]);

        if($validated['have_image']) {
            $game->addMediaFromRequest('image')->toMediaCollection($validated['name']);
            $game->save();
        }

        return $this->sendResponse(
            $game,
            'Game created successfully'
        );
    }

    /**
     * Display the specified resource.
     * All roles have permission to use this service.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $game = Game::find($id);

        if(!$game) {
            return $this->sendError(
                'Game not found'
            );
        }

        return $this->sendResponse(
            $game,
            null
        );

    }

    /**
     * Update the specified resource in storage.
     * Role viewer does not have permissions to this service.
     *
     * @param GameStoreRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(GameStoreRequest $request, $id): JsonResponse
    {
        $user = Auth::user();

        if($user->hasRole(Role::VIEWER_ROLE)) {
            return $this->sendError(
                'Unauthorized',
                null,
                401
            );
        }


        $validated = $request->validated();
        $game = Game::find($id);

        if(!$game) {
            return $this->sendError(
                'Game not found'
            );
        }

        // delete current associated media if any
        $game->clearMediaCollection($validated['name']);

        $game->name = $validated['name'];
        $game->url = $validated['url'];
        $game->description = $validated['description'];
        $game->status = $validated['status'];
        if($validated['have_image']) {
            $game->addMediaFromRequest('image')->toMediaCollection($validated['name']);
        }
        $game->save();

        return $this->sendResponse(
            $game,
            'Game updated successfully'
        );
    }

    /**
     * Remove the specified resource from storage.
     * Role admin does have permissions to this service.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $user = Auth::user();

        if(!$user->hasRole(Role::ADMIN_ROLE)) {
            return $this->sendError(
                'Unauthorized',
                null,
                401
            );
        }

        $game = Game::find($id);

        if(!$game) {
            return $this->sendError(
                'Game not found'
            );
        }

        $game->delete();

        return $this->sendResponse(
            null,
            'Game deleted successfully'
        );
    }
}
