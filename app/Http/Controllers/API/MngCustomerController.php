<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;
use App\Models\Customer;

class MngCustomerController extends Controller
{
    //

    public function create(Request $request){

        $validator = Validator::make($request->all(), [
            'cusEmail' => 'required|unique:customer,cusEmail|email',
            'cusName' => 'required',
            'cusPhoneNo' => 'regex:/^\+[0-9]{11}$/|unique:customer,cusPhoneNo',
            'cusPassword' => 'required',
            'gender' =>  ['required', 'regex:/^([f|m]|[F|M]){1}$/'],
        ],
        [
            'cusPhoneNo.regex' => 'invalid phone number,valid format:  "+" symbol with eleven digit  Example :+60123456789',
            'gender.regex' => 'invalid format ,only accept  f,F,m,M'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' =>  "Invalid Data",
                'invalidDtl' =>$validator->messages(),
            ], 200);
        }else{
            $cusId= $this->generateId();
            $cusCode = $this->generateCusCode();
            $hashPass =Hash::make($request->cusPassword);

            $request->request->add(['cusId' => $cusId]);
            $request->request->add(['cusCode' => $cusCode]);
            $request->merge(['cusPassword' => $hashPass]);
            //insert customer data
            $customer = Customer::create($request->all());

            return response()->json([
                'message' =>  "successful inserted",
                'customerId' =>$cusId,
            ],200);
        }
    }
    public function generateId(){
        $cusRowNum = Customer::count();
        $cusID="C10001";
        if($cusRowNum >0){
            $cusID = Customer::max('cusId');
            $cusID++;
        }
        return $cusID;
    }

    public function generateCusCode(){
        $cusRowNum = Customer::count();
        $cusID="CT00001";
        if($cusRowNum >0){
            $cusID = Customer::max('cusCode');
            $cusID++;
        }
        return $cusID;
    }

    public function findCusDtlByEmail($email){
        $cusData = Customer::where('cusEmail',$email)->first();

        $message = "Customer Data Found";
        if($cusData === null){
            $message = "Customer Data Not Found";
        }
        return response()->json([
            'message' =>  $message,
            'customer' =>$cusData,
        ],200);


    }

    public function findCusDtlByPhoneNo($phoneNumber){
        $cusData = Customer::where('cusPhoneNo',$phoneNumber)->first();

        $message = "Customer Data Found";
        if($cusData === null){
            $message = "Customer Data Not Found";
        }
        return response()->json([
            'message' =>  $message,
            'customer' =>$cusData,
        ],200);

    }
    public function listAllCustomer(){

        $cusData =  Customer::all();
        if($cusData !== null){
            $message = "Customer Data Found";
        }else{
            $message = "No Record in Database";
        }

        return response()->json([
            'message' =>  $message,
            'customer' =>$cusData,
        ],200);

    }



    public function updateNameById(Request $request){
        try{
            $customer = Customer::findOrFail($request->cusId);
            $message='Invalid customer Id';
            if($customer !== null){
                $customer->cusName = $request->cusName;
                $result = $customer->save();
                if($result){
                    $message='successfully updated';
                }else{
                    $message='failed to update';
                }
            }
        }catch (ModelNotFoundException $e){
            $message="Invalid Customer ID";
        } catch (Exception $e){
            $message="failed to update customer name";
        }  finally {
            return response()->json([
                'message' => $message,
            ],200);
        }
    }


    public function deleteById($id){
        try{
            $customer = Customer::findOrFail($id);
            $customer->delete();
            $message="successfully deleted";
        }catch (ModelNotFoundException $e){
            $message="Invalid Customer ID";
        } catch (Exception $e){
            $message="failed to delete";
        }  finally {
            return response()->json([
                'message' => $message,
            ],200);
        }

    }



}
