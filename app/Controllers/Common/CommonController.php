<?php

namespace App\Controllers\Common;

use App\Controllers\BaseController;

class CommonController extends BaseController
{
    public function change_country($country = null)
    {
        if ($country) {
            session()->set('country', $country);
        } else {
            session()->remove('country');
        }

        return redirect()->back();
    }
}
