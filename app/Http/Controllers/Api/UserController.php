<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return $request->user();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = $request->user();
        $input = $request->all();

        Validator::make($input, [
            'name' => [
                'required',
                'string',
                'max:255'
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'image' => [
                'nullable',
                'mimes:jpg,jpeg,png'
            ]
        ])->validateWithBag('updateProfileInformation');

        $fileName = $user->image ?? null;
        if ($request->hasFile('image')) {

            if (Storage::exists($user->image)) {
                Storage::delete($user->image);
            }

            $file = $request->file('image');
            $fileName = $file->storeAs('users', $file->getClientOriginalName());
        }

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
                $user->forceFill([
                    'name' => $input['name'],
                    'email' => $input['email'],
                    'email_verified_at' => null,
                    'image' => $fileName,
                ])->save();
        
                $user->sendEmailVerificationNotification();
        } else {
            $user->forceFill([
                'name' => $input['name'],
                'email' => $input['email'],
                'image' => $fileName,
            ])->save();
        }

        return $user;
    }
}
