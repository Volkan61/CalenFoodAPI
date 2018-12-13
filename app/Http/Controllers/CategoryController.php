<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Listen;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function postCategory(Request $request)
    {
        $id = $request->input('id');
        $listid = $request->input('listid');
        $spriteCssClass = $request->input('spriteCssClass');

        $category = new Category();
        $category->text = $request->input('text');
        $category->spriteCssClass = $request->input('spriteCssClass');
        $category->save();

        if($id!=null) {
        $foundCategory = Category::find($id);
        $foundCategory->parent()->save($category);
        }

        if($listid!=null) {
        $foundListen = Listen::find($id);
        $foundListen->category()->save($category);
        }

        return response()->json([
            'quote' => $category
        ], 201);
    }




    public function postDrag(Request $request)
    {

        $id1 = $request->input('id1');
        $id2 = $request->input('id2');

        $result =  DB::update(DB::raw('UPDATE category SET parent_id = '.$id2.' WHERE id IN ('.$id1.')'));

        return response()->json([
            'quote' => "drag"
        ], 201);
    }


    public function getMainCategories()
    {
        $result =  DB::select(DB::raw('SELECT * FROM category WHERE parent_id is NULL'));
        return response()->json($result, 200);
    }


    public function getMainCategoriesArray()
    {
        $result =  DB::select(DB::raw('SELECT * FROM category WHERE parent_id is NULL'));
        return $result;
    }



    public function getSubCategories($id)
    {
        $result =  DB::select(DB::raw('SELECT * FROM category WHERE parent_id ='.$id));
        return response()->json($result, 200);
    }


    public function getSubCategories2($id)
    {
        $result =  DB::select(DB::raw('SELECT * FROM category WHERE parent_id ='.$id));
        return $result;
    }


    public function createTreeView($id)
    {
       $return =  Category::find($id)->toArray();
       $return['items'] = [];
       $return['name'] = 'test';

       $return['expanded'] = true;

        $test =  $this->getSubCategories2($id);

        if (empty($test)) {
            return $return;

        }
        else {
            $max = sizeof($test);

            for ($i = 0; $i < $max; $i++) {
              $id =  $test[$i]->id;
                $childresult = $this->createTreeView($id);
                array_push($return['items'], $childresult);
            }
            return $return;

        }

// https://stackoverflow.com/questions/32780258/how-to-debug-php-artisan-serve-in-phpstorm

    }


    public function getCategories()
    {

        $result = [];
        $mainCategories= $this->getMainCategoriesArray();
        $mainCategoriesSize = sizeof($mainCategories);

        for ($i = 0; $i < $mainCategoriesSize; $i++) {
            $currentCategory = $mainCategories[$i];
            $currentCategoryId = $currentCategory->id;
            $categoryTreeView = $this->createTreeView($currentCategoryId);
            array_push($result, $categoryTreeView);
        }

            //  getMainCategories()


        // TODO sprites für order und für listen
        // TODO Ordner erstellen und Listen erstellen trennen

        //phpinfo();
        //$result =  DB::select(DB::raw('SELECT * FROM category WHERE parent_id ='.$id));
        return response()->json($result, 200);
    }
    

}
