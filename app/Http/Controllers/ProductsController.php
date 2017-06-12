<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Repositories\Contracts\ProductRepositoryInterface;
class ProductsController extends Controller
{
	protected $productRepository;

	public function __construct(ProductRepositoryInterface $productRepository){
		$this->productRepository = $productRepository;
	}

    public function index(){
    	
    	$products = $this->productRepository->all();
    }

    public function show($id){
    	$product = $this->productRepository->find($id);
    }
}
