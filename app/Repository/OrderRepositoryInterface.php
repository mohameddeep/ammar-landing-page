<?php

namespace App\Repository;

interface OrderRepositoryInterface extends RepositoryInterface
{
       public function getCountOrders();
       public function getOrdersByFilter($request);

       public function getForUser(array $columns = ['*'], array $relations = []);

}
