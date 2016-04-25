<?php

/**
 * Created by PhpStorm.
 * User: hp
 * Date: 5/11/2015
 * Time: 11:57 AM
 */
class CategoriesController extends \BaseController
{
    public function index()
    {
        $categories = Category::orderBy('id', 'DESC')->paginate(15);
        $breadcrumbs = array(
            array(
                "type" => "active",
                "value" => "Control Panel",
                "url" => "login-form"
                ),
            array(
                "type" => "inactive",
                "value" => "Categories List"
                ),
            );

        return View::make('admin.categories.index')->with("breadcrumbs", $breadcrumbs)->with("categories", $categories);
    }

    public function delete($id)
    {
      
       $category = Category::findOrFail($id);
       $category->delete();
       $msgs = array("type" => "alert alert-danger",
        "msg" => "The Record Have Been Deleted Successfully!");
       return Redirect::route('categories')->with("msgs", $msgs);


   }
   

public function add()
{
    if (Request::isMethod('post')) {
        $rules = array(
            'name' => 'Required'

            );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->passes()) {
            $category = new Category;

            $category->name = Input::get('name');
            $category->save();
            $msgs = array("type" => "alert alert-success",
                "msg" => "The Record Have Been  Successfully Added!");
            return Redirect::route('categories')->with("msgs", $msgs);

        } else {
            return Redirect::back()->withErrors($validator->errors());
        }
    } else {
        $breadcrumbs = array(
            array(
                "type" => "active",
                "value" => "Control Panel",
                "url" => "login-form"
                ),
            array(
                "type" => "active",
                "value" => "Categories List",
                "url" => "categories"
                ),
            array(
                "type" => "inactive",
                "value" => "Add Category"
                ),
            );

        return View::make('admin.categories.add')->with("breadcrumbs", $breadcrumbs);
    }
}


public function update($id)
{
    $category = Category::findOrFail($id);
        if (Request::isMethod('post')) {///Means form have been submitted
            $rules = array(
                'name' => 'Required'

                );
            $validator = Validator::make(Input::all(), $rules);
            if ($validator->passes()) {


                $category->name = Input::get('name');
                $category->save();
                $msgs = array("type" => "alert alert-success",
                    "msg" => "The Record Have Been  Successfully Changed!");
                return Redirect::route('categories')->with("msgs", $msgs);

            } else {
                return Redirect::back()->withErrors($validator->errors());
            }
        } else {
            $breadcrumbs = array(
                array(
                    "type" => "active",
                    "value" => "Control Panel",
                    "url" => "login-form"
                    ),
                array(
                    "type" => "active",
                    "value" => "Categories",
                    "url" => "categories"
                    ),
                array(
                    "type" => "active",
                    "value" => "Add Category",
                    "url" => "add_category"
                    ),
                array(
                    "type" => "inactive",
                    "value" => "Update Category"
                    )
                );

            return View::make('admin.categories.update')->with("breadcrumbs", $breadcrumbs)->with("category", $category);
        }
    }
}