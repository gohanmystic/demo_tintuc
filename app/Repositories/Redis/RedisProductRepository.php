<?php 
namespace App\Repositories\Redis;
use App\Repositories\Contracts\ProductRepositoryInterface;

class RedisProductRepository implements ProductRepositoryInterface
{
	public function all(){
		echo 'Get all products from redis';
	}

	public function find($id){
		echo 'Find single product by id: ' .$id;
	}
}
?>