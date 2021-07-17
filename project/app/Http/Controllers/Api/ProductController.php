<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductFile;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Image;
use DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Products()
  {

   $Products = DB::table('products')
        ->join('product_files','products.id','product_files.product_id')
        ->select('product_files.*', 'products.*')
        ->get();

    return response()->json([
      'data' => $Products ? $Products : null,
      'message' =>  $Products?'Successfully Received' : 'Error',
    ], 200);
  }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function StoreProduct(Request $request)
  {
    set_time_limit(1000);
    $id = IdGenerator::generate(['table' => 'products', 'length' => 10, 'prefix' =>date('ym')]);
    $Product = new Product();

    $Product->id =  $id;
    $Product->name =  $request->name;
    $Product->details =  $request->details;
    $Product->save();

    $Product_File = new ProductFile();

    $Product_File->product_id =  $id;
    
        if($request->product_file)
        {
                $products_file = $request->file('product_file');
                $product_files_name = time() . $id . '.' . $products_file->getClientOriginalExtension();
                $product_files_path = public_path('/Product_File/');
                $products_file->move($product_files_path,$product_files_name);
                $Product_File->product_file ='/Product_File/' . $product_files_name;
        }

    $Product_File->save();

    return response()->json([
      'data' => $Product ?  $Product : null,
      'message' => $Product ? 'Successfully Inserted' : 'Error',
      'another_data' => $Product_File ?  $Product_File : null,
      'another_message' => $Product_File ? 'Successfully Inserted' : 'Error'
    ], 201);


  }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function Products_Details($id)
  {

   $Products = DB::table('products')
        ->join('product_files','products.id','product_files.product_id')
        ->where('products.id', '=', "$id")
        ->select('product_files.*', 'products.*')
        ->get();

    return response()->json([
      'data' => $Products ? $Products : null,
      'message' =>  $Products?'Successfully Received' : 'Error',
    ], 200);
  }

  public function UpdateProduct(Request $request, $id)
  {
    set_time_limit(1000);
    
    //$id = $request->id;


    $Product = Product::find($id);

    $Product->id =  $id;
    $Product->name =  $request->name;
    $Product->details =  $request->details;
    
    $Product->save();


    // $Product_File = DB::table('product_files')
    //     ->where('product_files.product_id', '=', "$id");


    //$Product_File->product_id =  $product_id;
    
        
                $products_file_property = $request->file('product_file');
                $product_files_name = time() . $id . '.' . $products_file_property->getClientOriginalExtension();
                $product_files_path = public_path('/Product_File/');
                $products_file_property->move($product_files_path,$product_files_name);
                $Product_File_for_DB ='/Product_File/' . $product_files_name;
                


$Product_File = ProductFile::where('product_id', $id)
                ->update(['product_file' => $Product_File_for_DB]
                        );

    
    

    return response()->json([
      'data' => $Product ?  $Product : null,
      'message' => $Product ? 'Successfully Updated' : 'Error',
      'another_data' => $Product_File ?  $Product_File : null,
      'another_message' => $Product_File ? 'Successfully Updated' : 'Error'
    ], 201);


  }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function DeleteProduct($id)
  {
    $delete = Product::find($id)->delete();

        if($delete)
        {
            return response()->json([
                    'data' => $delete ? $delete : null,
                    'message' => $delete ? 'Successfully Deleted' : 'Error',
                ], 201);
        }
  }
}
