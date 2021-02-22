<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\modelDatatable;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class ctlDatatable extends Controller
{
    public function test_data(){
        $modelDatatable = new modelDatatable();
        $select_modelDatatable=$modelDatatable->all();
        $columns = Schema::getColumnListing('model_datatables');
        return  view('data',['columns'=>$columns,'data'=>$select_modelDatatable]);
    }

}
