<?php

namespace App\Controller;

use App\BaseController;
use App\Model\Request;
use App\Model\Search;

class SearchController extends BaseController
{
    public function index()
    {
        $search = new Search();
        if (isset($_GET['btnSearch'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                $request = new Request();
                $txtSearch = $request->get('txtSearch');
                $search->searchUser($txtSearch);
            }
        }
    }
}