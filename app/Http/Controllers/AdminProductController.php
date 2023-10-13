<?php

namespace App\Http\Controllers;

use App\Components\Recusive;
use App\Http\Requests\ProductAddRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductTag;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Traits\StorageImageTrait;

class AdminProductController extends Controller
{
    use StorageImageTrait;

    private $category;
    private $product;
    private $productImage;
    private $tag;
    private $productTag;

    public function __construct(Category $category, Product $product, ProductImage $productImage, Tag $tag, ProductTag $productTag)
    {
        $this->category = $category;
        $this->product = $product;
        $this->productImage = $productImage;
        $this->tag = $tag;
        $this->productTag = $productTag;
    }

    public function index(Request $request)
    {
//        $products = product->get()
        return Product::get();
    }


    public function create()
    {
        $hmtlOptions = $this->getCategory($parent_Id = '');
        return view('admin.product.add', compact('hmtlOptions'));
    }

    public function getCategory($parent_Id)
    {
        $data = $this->category->All();
        $recusive = new Recusive($data);
        $hmtlOptions = $recusive->CategoriesShow($parent_Id);
        return $hmtlOptions;
    }

    public function store(ProductAddRequest $request)
    {
        try {
            DB::beginTransaction();
            $dataProductCreate = [
                'name' => $request->name,
                'sku' => $request->sku,
                'original_price' => $request->original_price,
                'discounted_price' => $request->discounted_price,
                'description' => $request->description,
                'sizes' => $request->sizes,
                'colors' => $request->colors,
                'user_id' => Auth::guard('admin')->id(),
                $request->category_id,
                'content' => 'chua update'
            ];
//        them anh dai dien
            $dataUploadFeatureImage = $this->storagetraitUpload($request, 'feature_image_path', 'product');
            if (!empty($dataUploadFeatureImage)) {
                $dataProductCreate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
                $dataProductCreate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
            }
            $product = $this->product->create($dataProductCreate);
//        them nhieu file anh
            if ($request->hasFile('image_path')) {
                foreach ($request->image_path as $fileItem) {
                    $dataProductImageDetail = $this->storagetraitUploadMutiple($fileItem, 'product');
                    $product->images()->create([
                        'image_path' => $dataProductImageDetail['file_path'],
                        'image_name' => $dataProductImageDetail['file_name']
                    ]);
                }
            }
//      Them tags
            if (!empty($request->tags)) {
                foreach ($request->tags as $tagItem) {
                    $tagInstance = $this->tag->firstOrCreate(['name' => $tagItem]);
                    $tagId[] = $tagInstance['id'];
                }
            }
            $product->tags()->attach($tagId);


            DB::commit();

            return response()->json([
                "status" => true
            ]);
        } catch (\Exception $exception) {
            DB::rollback();
            \Log::error('Message: ' . $exception->getMessage() . 'Line ' . $exception->getLine());
            return response()->json([
                "status" => false
            ]);
        }
    }

    public function add(Request $request)
    {
        try {
            DB::beginTransaction();
            $dataProductCreate = [
                'name' => 'Test',
                'sku' => $request->sku,
                'original_price' => $request->original_price,
                'discounted_price' => $request->discounted_price,
                'description' => $request->description,
                'sizes' => $request->sizes,
                'colors' => $request->colors,
                'user_id' => 1,
                'category_id' => 1,
                'content' => 'chua update'

            ];
            if ($request->feature_image_path) {
                $folderPath = "storage/img/";

                // Tạo thư mục nếu nó chưa tồn tại
                if (!Storage::exists($folderPath)) {
                    Storage::makeDirectory($folderPath);
                }

                $base64Image = explode(";base64,", $request->feature_image_path);
                $explodeImage = explode("image/", $base64Image[0]);
                $imageType = $explodeImage[1];
                $image_base64 = base64_decode($base64Image[1]);
                $file = $folderPath . Str::random(20) . '.' . $imageType;
                $dataProductCreate['feature_image_path'] = '/' . $file;
                file_put_contents($file, $image_base64);
            }

            $product = $this->product->create($dataProductCreate);
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => "Successfully created"
            ]);
        } catch (\Exception $exception) {
            DB::rollback();
            \Log::error('Message: ' . $exception->getMessage() . 'Line ' . $exception->getLine());
            return response()->json([
                "status" => false,
                'message' => "Failed"
            ]);
        }

    }

    public function edit($id)
    {
        $product = $this->product->find($id);
        return $product;
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $dataProductUpdate = [
                'name' => $request->name,
                'sku' => $request->sku,
                'original_price' => $request->original_price,
                'discounted_price' => $request->discounted_price,
                'description' => $request->description,
                'sizes' => $request->sizes,
                'colors' => $request->colors,
                'user_id' => 1,
                'category_id' => 1,
                'content' => 'chua update'

            ];
            if ($request->feature_image_path) {
                $folderPath = "storage/img/";

                // Tạo thư mục nếu nó chưa tồn tại
                if (!Storage::exists($folderPath)) {
                    Storage::makeDirectory($folderPath);
                }

                $base64Image = explode(";base64,", $request->feature_image_path);
                $explodeImage = explode("image/", $base64Image[0]);
                $imageType = $explodeImage[1];
                $image_base64 = base64_decode($base64Image[1]);
                $file = $folderPath . Str::random(20) . '.' . $imageType;
                $dataProductCreate['feature_image_path'] = '/' . $file;
                file_put_contents($file, $image_base64);
            }

            $product = $this->product->find($id)->update($dataProductUpdate);
//            die();
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => "Success"
            ]);
        } catch (\Exception $exception) {
            DB::rollback();
            \Log::error('Message: ' . $exception->getMessage() . 'Line ' . $exception->getLine());
            return response()->json([
                "status" => false,
                'message' => "Failed"
            ]);
        }
    }

//    public function update(Request $request , $id){
//        try {
//            DB::beginTransaction();
//            $dataProductUpdate = [
//                'name' => $request->name,
//                'sku' => $request->sku,
//                'original_price' =>$request->original_price,
//                'discounted_price' => $request->discounted_price,
//                'description' => $request->description,
//                'sizes' => $request->sizes,
//                'colors' => $request->colors,
//                'user_id' => Auth::guard('admin')->id(),
//                'category_id' => $request->category_id,
//                'content' => 'chua update'
//            ];
////        them anh dai dien
//            $dataUploadFeatureImage = $this->storagetraitUpload($request,'feature_image_path', 'product' );
//            if (!empty($dataUploadFeatureImage)){
//                $dataProductUpdate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
//                $dataProductUpdate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
//            }
//            $this->product->find($id)->update($dataProductUpdate);
//            $product = $this->product->find($id);
//
////        add images
//            if ($request->hasFile('image_path')){
//                $this->productImage->where('product_id', $id)->delete();
//                foreach ($request->image_path as $fileItem){
//                    $dataProductImageDetail = $this->storagetraitUploadMutiple($fileItem,'product');
//                    $product->images()->create([
//                        'image_path' => $dataProductImageDetail['file_path'],
//                        'image_name' => $dataProductImageDetail['file_name']
//                    ]);
//                }
//            }
////      Add tags
//            if(!empty($request->tags)){
//                foreach ($request->tags as $tagItem){
//                    $tagInstance = $this->tag->firstOrCreate(['name' => $tagItem]);
//                    $tagId[] = $tagInstance['id'];
//                }
//            }
//            $product->tags()->sync($tagId);
//
//
//            DB::commit();
//
//            return redirect()->route('product.index');
//        } catch (\Exception $exception){
//            DB::rollback();
//            \Log::error('Message: ' .$exception->getMessage() . 'Line ' . $exception->getLine() );
//        }
//    }

    public function delete($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['status' => false, 'message' => 'Không tìm thấy sản phẩm']);
        }

        $product->delete();

        return response()->json(['status' => true, 'message' => 'Đã xoá thành công']);
    }

    public function deleteMultiple(Request $request)
    {
        $productIds = $request->input('products');

        if (!empty($productIds)) {
            Product::destroy($productIds);
        }

        return response()->json(['status' => true, 'message' => 'Đã xoá thành công']);
    }

}
