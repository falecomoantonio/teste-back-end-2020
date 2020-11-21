<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCreate;
use App\Http\Requests\ProductDestroy;
use App\Http\Requests\ProductUpdate;
use App\Models\Product as ProductModel;
use App\Transformers\Product as ProductTransformer;
use Flugg\Responder\Responder;

class ProductController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param Responder $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Responder $request)
    {
        return responder()->success(ProductModel::paginate())->respond();
    }


    /**
     * @param Responder $responder
     * @param ProductCreate $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Responder $responder, ProductCreate $request)
    {
        try {

            $data = $request->all();
            $data['thumbnail'] = 'product-default.png';

            if($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid())
            {
                $extension = $request->file('thumbnail')->getClientOriginalExtension();
                $date = md5(date('d/m/Y H:i:s'));
                $fileNameToStore= $date . '.'.$extension;
                $path = $request->file('thumbnail')->storeAs('public/', $fileNameToStore);
                $data['thumbnail'] = $fileNameToStore;
            }

            $product = new ProductModel($data);
            $saved = $product->save();

            if(!$saved) {
                throw new \Exception("Não foi possível registrar o produto {$product->getName()}");
            }

            return $responder->success($product)->respond(201,['resource' => url('api/products/') . '/' . $product->getId() ]);
        } catch (\Exception $e) {
            return $responder->error($e->getMessage())->respond(404,[]);
        }
    }

    /**
     * @param Responder $responder
     * @param $productId
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Responder $responder, $productId)
    {
        try
        {
            $productId = intval($productId);
            $product = ProductModel::find($productId);

            if($product == null) {
                throw new \Exception("Produto {$productId} não foi localizado");
            }

            return $responder->success($product)->respond();
        }
        catch (\Exception $e)
        {
            return $responder->error(404, $e->getMessage())->respond(404,[]);
        }
    }


    /**
     * @param ProductUpdate $request
     * @param Responder $responder
     * @param $productId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($productId, ProductUpdate $request, Responder $responder)
    {
        try
        {
            $productId = intval($productId);
            $product = ProductModel::find($productId);

            if($product == null)
            {
                throw new \Exception("Produto {$productId} não foi localizado");
            }


            $product->fill($request->all());
            $saved = $product->save();

            if(!$saved) {
                throw new \Exception("Produto {$product->getId()} não foi atualizado.");
            }

            return $responder->success($product, ProductTransformer::class)->respond(200,[]);
        }
        catch (\Exception $e)
        {
            return $responder->error(404, $e->getMessage())->respond(404,[]);
        }
    }


    /**
     * @param ProductDestroy $request
     * @param Responder $responder
     * @param $productId
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(ProductDestroy $request, Responder $responder, $productId)
    {
        try
        {
            $productId = intval($productId);
            $product = ProductModel::find($productId);

            if($product == null)
            {
                throw new \Exception("Produto {$productId} não foi localizado");
            }

            $deleted = $product->delete();

            if(!$deleted) {
                throw new \Exception("Produto {$product->getId()} não foi removido.");
            }

            return $responder->success()->respond(200,[]);
        }
        catch (\Exception $e)
        {
            return $responder->error(404, $e->getMessage())->respond(404,[]);
        }
    }
}
