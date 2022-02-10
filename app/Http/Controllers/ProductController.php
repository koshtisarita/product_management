<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Product;
use App\Exports\CategoryeExport;
use App\Exports\ProductExport;
use Validator;
use Log;
use DB;
use PDF;
use Excel;

class ProductController extends Controller
{
    public function index()
    {
        $cat = Categories::all();
        return view("product",["category"=>$cat]);
    }
    public function store(Request $request)
    {
        if ($request->isMethod('POST')) 
        {
                $request_data = $request->All();
                $messages = [
                    'category.required' => 'Please Enter category name',
                    'name.required' => 'Please Enter Product name',
                    

                ];
                //validate for field
            
                $validator = Validator::make($request_data, [
                    'category' => 'required',
                    'name' => 'required',
                   

                ], $messages);

                if ($validator->fails()) {

                    return redirect()->back()->with('error', 'Validation Error')->withErrors($validator)->withInput();
                } else {
                   //add the product

                   try 
                    {
                        DB::beginTransaction();
                        $imageName = date('YmdHi').'.'.$request->image->extension();  
                        $db_image_path = "images/".$imageName;
                        $request->image->move(public_path('images'), $imageName);
                        $product = new Product;
                        $product->cat_id = $request_data['category']; 
                        $product->name = $request_data['name']; 
                        $product->quantity = $request_data['qty']; 
                        $product->price = $request_data['price'];
                        $product->image =  $db_image_path;
                        $product->save();                           

                         DB::commit();

                         return back()
                         ->with('success','You have successfully add the product.');
                         
                    } 
                    catch (Throwable $e) {
                        DB::rollback();               
                        return back()
                        ->with('error',$e); 
                    }
                     
                }
        }
    
    }

    public function view()
    {
        $products = Product::join('categories as c','cat_id','=','c.id')
        ->select('products.*','c.name as category_name')->orderBy('id','DESC')->get();
        return view('view_product',['products'=>$products]);
    }
 
    
    public function delete(Request $request)
    {
        try{
                
                $products = Product::where('id',$request->product_id)->delete();
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
        $categories = Categories::all();
        $product = Product::join('categories as c','cat_id','=','c.id')
        ->select('products.*','c.name as category_name')
        ->where('products.id','=',$pid) 
        ->first();
        return view('edit_product',['product'=>$product,'categories'=>$categories]);
    }

    public function update(Request $request)
    {
        if ($request->isMethod('POST')) 
        {
                $request_data = $request->all();
                $messages = [
                    'category.required'=>'Please select category name',
                    'name.required' => 'Please Enter Product name',
                    

                ];
                //validate for field
            
                $validator = Validator::make($request_data, [
                    'name' => 'required',
                    'category'=>'required',

                ], $messages);

                if ($validator->fails()) {

                    return redirect()->back()->with('error', 'Validation Error')->withErrors($validator)->withInput();
                } else {
                   //add the product

                   try 
                    {
                        
                        $product = Product::find($request_data['pid']);
                        DB::beginTransaction();
                        if(isset($request_data['image']))
                        {
                            $imageName = date('YmdHi').'.'.$request->image->extension();  
                            $db_image_path = "images/".$imageName;
                            $request->image->move(public_path('images'), $imageName);
                            $product->image =  $db_image_path;
                        }                      
                         
                        $product->cat_id = $request_data['category']; 
                        $product->name = $request_data['name']; 
                        $product->quantity = $request_data['qty']; 
                        $product->price = $request_data['price'];                       
                        $product->save();                           

                         DB::commit();

                         return back()
                         ->with('success','You have successfully update the product.');
                        
                        

                        


                    } 
                    catch (Throwable $e) {
                        //report($e);                
                        return back()
                        ->with('error',$e); 
                    }
                     
                }
        }
    
    }

    public function product_pdf_export()
    {
        $products = Product::join('categories as c','cat_id','=','c.id')
        ->select('products.*','c.name as category_name')->orderBy('id','DESC')->get();
        $data = ['products' => $products];

        
        $pdf = PDF::loadView('productPdf', $data);
        return $pdf->download('product_list.pdf');
  
    }
    public function product_excel_export()
    {
        return Excel::download(new ProductExport, 'product.xlsx');
  
    }
}

