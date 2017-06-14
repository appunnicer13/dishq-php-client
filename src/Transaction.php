<?php

namespace DishqClient\Api;

class Transaction extends Entity
{

    /**
     * @param $id Order id description
     */
    public function insert($user_id,$order_id,$order_details)
    {
      $relativeUrl = 'order/add/';

       if($user_id === NULL || $user_id === '' || $order_id === NULL || $order_id === '' ){
      $error = [ 'message' => 'Missing user_id and order_id', 'response' => 'error' ];
       echo json_encode($error);
       }else{
         if($this->validArray($order_details)){
              if(!is_integer($user_id)) {
                $error = [ 'message' => 'User id is an integer', 'response' => 'error' ];
                 echo json_encode($error);
              }else{
                $json_array = ['user_id' => $user_id, 'order_id' => $order_id, 'order_details' => $order_details];
                $attributes = json_encode($json_array);
                return parent::create($attributes, $relativeUrl);
              }

         }else{
           $error = [ 'message' => 'Order array missing dish id or quantity', 'response' => 'error' ];
            echo json_encode($error);
         }
       }

    }

    protected function validArray($order_details){
      foreach ($order_details as $value){
        if(!isset($value['dish_id']) || empty($value['dish_id']) || !isset($value['quantity']) || empty($value['quantity'])){
          return false;
        }
      }
      return true;
    }

}