<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class ShortLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        return view('index');
    }

    /**
     * Store a new link.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $rules = [
            'link' => 'required|url'
        ];
        $messages = [
            'link.required' => 'Ссылка обязательна для заполнения.',
            'link.url' => 'Неверный формат ссылки.'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $slug = Str::random(8);
        ShortLink::create([
            'link' => $request->link,
            'slug' => $slug
        ]);

        return response()->json(['success' => $request->root().'/'.$slug]);
    }

    /**
     * Redirect to link.
     *
     * @param $slug
     * @return RedirectResponse
     */
    public function redirect($slug): RedirectResponse
    {
        $find = ShortLink::where('slug', $slug)->first();
        $find->count++;
        $find->save();

        return redirect($find->link);
    }
}
