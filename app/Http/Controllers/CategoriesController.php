<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Product;
use App\Exports\CategoryeExport;
use Validator;
use Log;
use DB;
use PDF;
use Excel;

class CategoriesController extends Controller
{
      public function store(Request $request)
      {
           // dd($request->all());
            try
            {
                DB::beginTransaction();
                $imageName = date('YmdHi').'.'.$request->image->extension();  
                $db_image_path = "images/".$imageName;
                $request->image->move(public_path('images'), $imageName);
                $new_category = new Categories();
                $new_category->name = $request->name;
                $new_category->image = $db_image_path;
                $new_category->save();

                DB::commit();
                return redirect()->back()->with('success','Category added successfully');
             
            } catch (\Exception $e) {
                // An error occured; cancel the transaction...
                DB::rollback();
                
                // and throw the error again.
                return redirect()->back()->with('error',$e->getMessage());
            }
          
      }

      public function view()
      {
          $categories = Categories::get();
          return view('view_category',['categories'=>$categories]);
      }

      public function excel_export()
      {
          return Excel::download(new CategoryeExport, 'list.xlsx');
      }
      public function pdf_export()
      {
        $categories = Categories::get();
        $data = ['categories' => $categories];
        $pdf = PDF::loadView('myPDF', $data);
  
        return $pdf->download('mypdf.pdf');
      }

      public function delete(Request $request)
      {
        try{
            Product::where('cat_id',$request->cat_id)->delete();
            Categories::where('id',$request->cat_id)->delete();

            $response = [
                'result'=>1
            ];
            
        } 
        catch (Throwable $e) {
            $response = [
                'result'=>0,
                'error'=>$e
            ];              
              
        }

        return  $response;
      }
      public function edit($pid)
    {
        $info = categories::where('id',$pid)->first();
        return view('edit_category',['category'=>$info]);
    }

    public function update(Request $request)
    {
        if ($request->isMethod('POST')) 
        {
                $request_data = $request->All();
                $messages = [
                    'name.required' => 'Please Enter product name', 
                    

                ];
                //validate for field
            
                $validator = Validator::make($request_data, [
                    'name' => 'required',
                     

                ], $messages);

                if ($validator->fails()) {

                    return redirect()->back()->with('error', 'Validation Error')->withErrors($validator)->withInput();
                } else {
                   //add the product

                   try 
                    {

                        $cat = Categories::find($request_data['cid']);
                        $cat->name = $request_data['name'];
                        if(isset($request_data['image']))
                        {
                            $imageName = date('YmdHi').'.'.$request->image->extension();  
                            $db_image_path = "images/".$imageName;
                            $request->image->move(public_path('images'), $imageName);
                            $cat->image = $db_image_path;
                        }
                       
                        
                         $cat->save();

                         return back()
                         ->with('success','You have successfully update the category.');
                        

                        


                    } 
                    catch (Throwable $e) {
                        //report($e);                
                        return back()
                        ->with('error',$e); 
                    }
                     
                }
        }
    
    }

}

