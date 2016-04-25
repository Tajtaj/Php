<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 5/18/2015
 * Time: 5:53 PM
 */
class CareerLevelsController extends \BaseController
{
    public function index()
    {
        $careerlevels= CareerLevel::orderBy('id', 'DESC')->paginate(15);
        $breadcrumbs = array(
            array(
                "type" => "active",
                "value" => "Control Panel",
                "url" => "login-form"
            ),
            array(
                "type" => "inactive",
                "value" => "Career Level  List"
            ),
        );
        return View::make('admin.careerlevels.index')->with("breadcrumbs", $breadcrumbs)->with("careerlevels", $careerlevels);

    }

    public function deleteRecord($id)
    {
        $careerlevel = CareerLevel::findOrFail($id);
        $careerlevel->delete();
        $msgs = array("type" => "alert alert-danger",
            "msg" => "The Record Have Been Deleted Successfully!");
        return Redirect::route('careerlevels')->with("msgs", $msgs);
    }

    public function addRecord()
    {
        if (Request::isMethod('post')) {
            $rules = array(
                'name' => 'Required'

            );
            $validator = Validator::make(Input::all(), $rules);
            if ($validator->passes()) {
                $careerlevel = new CareerLevel;

                $careerlevel->name = Input::get('name');
                $careerlevel->save();
                $msgs = array("type" => "alert alert-success",
                    "msg" => "The Record Have Been  Successfully Added!");
                return Redirect::route('careerlevels')->with("msgs", $msgs);

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
                    "value" => "Career level",
                    "url" => "careerlevels"
                ),
                array(
                    "type" => "inactive",
                    "value" => "Add New Career Level"
                ),
            );

            return View::make('admin.careerlevels.add')->with("breadcrumbs", $breadcrumbs);
        }
    }

    public function updateRecord($id)
    {
        $careerlevel = CareerLevel::findOrFail($id);
        if (Request::isMethod('post')) {///Means form have been submitted
            $rules = array(
                'name' => 'Required'

            );
            $validator = Validator::make(Input::all(), $rules);
            if ($validator->passes()) {


                $careerlevel->name = Input::get('name');
                $careerlevel->save();
                $msgs = array("type" => "alert alert-success",
                    "msg" => "The Record Have Been  Successfully Changed!");
                return Redirect::route('careerlevels')->with("msgs", $msgs);

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
                    "value" => "Career Levels",
                    "url" => "careerlevels"
                ),
                array(
                    "type" => "active",
                    "value" => "Add Career Level",
                    "url" => "add_careerlevel"
                ),
                array(
                    "type" => "inactive",
                    "value" => "Update Career Level"
                )
            );

            return View::make('admin.careerlevels.update')->with("breadcrumbs", $breadcrumbs)->with("careerlevel", $careerlevel);
        }

    }

    public function viewRecord($id)
    {
        $breadcrumbs = array(
            array(
                "type" => "active",
                "value" => "Control Panel",
                "url" => "login-form"
            ),
            array(
                "type" => "active",
                "value" => "Career Level List",
                "url" => "careerlevels"
            ),
            array(
                "type" => "inactive",
                "value" => "Career Level  View"
            ),
        );
        $careerlevel = CareerLevel::find($id);
        return View::make('admin.careerlevel.view')->with("breadcrumbs", $breadcrumbs)->with("$careerlevel", $careerlevel);
    }


}
