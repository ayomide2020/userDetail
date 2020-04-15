<?php


namespace App\Http\Controllers;

use App\Http\Resources\User as UserResource;

use Illuminate\Http\Request;

use App\User;

class UserController extends Controller
{
    //@return UserResourceCollection
    public function index()
    {

        $users = User::paginate();
        
        return new UserResource($users);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            "title" => ['required', 'min:4', 'unique'],
            "first-name" => ['required'],
            "last-name" => ['required'],
            "email" => ['required', 'unique'],
        ]);
        User::create($data);
        return response()->json(["message" => "Record Created Successfully"]);
        // $user = User::create($this->validatedData());
        // return redirect('/users/' . $user->id);
    }

    public function show(User $user)
    {

        return new UserResource($user);
    }

    public function update(Request $request, User $user)
    {
        $updateData = $user->update($request->all());
        return response()->json(["data" => "Record Updated!!"], 200);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(["data" => "Record Deleted!!"], 200);

    }

    public function restore(User $user, $id)
    {
        $data = User::withTrashed()->find($id);
        $data->restore();
        return response()->json(["data" => "Record Restored!!"], 200);

    }
}
