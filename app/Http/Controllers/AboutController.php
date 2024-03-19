<?php

namespace App\Http\Controllers;

/**
 * Class AboutController
 *
 * @package App\Http\Controllers
 * @author Mahammad Mammadov <codega.az@gmail.com>
 */
class AboutController extends Controller
{
    public function aboutUS()
    {
        return view('pages.about');
    }
}
