<?php

namespace App\Http\Controllers;

use App\Services\FrontService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class FrontController extends Controller
{
    private FrontService $frontService;

    public function __construct(FrontService $frontService)
    {
        $this->frontService = $frontService;
    }

    function index(): View|RedirectResponse
    {
        $data = $this->frontService->getFrontPageData();

        if (Auth::check() && !Auth::user()->hasVerifiedEmail() && !(Auth::user()->role == 'admin')) {
            return redirect()->route('verification.notice');
        }

        return view('front.index', $data);
    }


}
