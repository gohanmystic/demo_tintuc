<?php 

namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Product;

class ProductRepository implements ProductRepositoryInterface
{
	public function all(){
		$Products = Product::all();

    	foreach ($Products as $Product) {
    		echo $Product->id. ':';
    		echo $Product->Ten. '<br>';
    	}
	}

	public function find($id){
		$Product = Product::find($id);

    	echo $Product->id. ':';
    	echo $Product->Ten. '<br>';
	}
}
?>