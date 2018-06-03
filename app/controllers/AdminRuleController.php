<?php

class AdminRuleController extends BaseController {

    public function index()
    {
        $col = Input::get('col');
        $rows = Input::get('rows');

        $q = Rule::select(array('*'));

        if(Input::get('search')){
            $q = $q ->where(function($q){
                $q  ->orWhere('name','LIKE', '%' . Input::get('search') . '%')
                    ->orWhere('id','=', Input::get('search'));
            });
        }

        if($col){
            $order = (Input::get('order')) ? Input::get('order') : 'ASC';
            $q = $q->orderBy($col, $order);
        }

        if(isset($rows)){
            $rules = $q->paginate($rows);
        }else{
            $rules = $q->paginate(Config::get('ilosool.rows_default'));
        }

        // Show the page
        return View::make('admin.rule.index')->with('rules', $rules);
        
    }

    public function view($id){

        $rule = Rule::find($id);

        return View::make('admin.rule.view')->with('rule', $rule);

    }
    
    public function add()
    {
        $permissions = Config::get('ilosool.permissions');
        $pers = Rule::convertArray($permissions);
        return View::make('admin.rule.add')->with('pers',$pers);
    }

    public function edit($id){
        $rule = Rule::find($id);
        $permissions = Config::get('ilosool.permissions');
        $pers = Rule::convertArray($permissions);
        return View::make('admin.rule.edit')->with('rule', $rule)->with('pers',$pers);
    }

    public function delete($id){

        $rule = Rule::find($id);
        $res = $rule->delete();

        if($res){
            $message = 'The Rule <strong>' . $rule->name . '</strong> is deleted Successfully';
        }else{
            $message = 'The Rule <strong>' . $rule->name . '</strong> can not be deleted';
        }

        return Redirect::route('admin.rules')
                ->with('action', 'delete')
                ->with('result', $res)
                ->with('message', $message);
    }

    public function add_post()
    {

        $validator = Rule::validate(Input::all());

        if ($validator->fails()){
            return Redirect::route('admin.rule.add')->withErrors($validator)->withInput();
        }

        $rule = new Rule();
        $rule->name = Input::get('name');
        $rule->permissions = Input::get('permissions');
        //$rule->permissions = json_encode(Config::get('ilosool.permissions'));
        $res = $rule->save();

        if($res){
            $message = 'The Rule <strong>' . $rule->name . '</strong> is created Successfully';
        }else{
            $message = 'The Rule <strong>' . $rule->name . '</strong> can not be created';
        }

        return Redirect::route('admin.rules')
                ->with('action', 'add')
                ->with('result', $res)
                ->with('message', $message);
    }

    public function edit_post($id){
        
        $validator = Rule::validate(Input::all());

        if ($validator->fails()){
            return Redirect::route('admin.rule.edit', $id)->withErrors($validator)->withInput();
        }

        $rule = Rule::find($id);
        $rule->name = Input::get('name');
        $rule->permissions = Input::get('permissions');
        //$rule->permissions = json_encode(Config::get('ilosool.permissions'));
        $res = $rule->save();
        
        if($res){
            $message = 'The Rule <strong>' . $rule->name . '</strong> is edited Successfully';
        }else{
            $message = 'The Rule <strong>' . $rule->name . '</strong> can not be edited';
        }

        return Redirect::route('admin.rules')
                ->with('action', 'edit')
                ->with('result', $res)
                ->with('message', $message);
    }
}