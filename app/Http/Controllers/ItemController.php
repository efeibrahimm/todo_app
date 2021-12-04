<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ItemController extends Controller
{
    public function index(){

        return Item::orderBy('created_at', 'DESC')->get();
    }
    public function create(Request $request){

        $newItem = new Item;
        $newItem->name = $request->item['name'];
        $newItem->save();

        return $newItem;
    }
    public function update(Request $request,$id){

        if ($existinItem = Item::find($id)) {

            $existinItem = Item::find($id);

            $existinItem->completed = $request->item['completed'] ? true: false;
            // $existinItem->completed_at = $request->item['completed_at'] ? Carbon::now() : false;

            $existinItem->save();
            return $existinItem;

        };

            return "İtem Not Found";

    }
    public function delete($id){
        $existinItem = Item::find($id);
        if ( $existinItem ) {
            $existinItem->delete();
            return "İtem Deleted Successfuly";
        }


         return "İtem Not Found";


    }
}
