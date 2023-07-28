<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Reward;
use App\Models\RewardConversionRatio;
use Illuminate\Http\Request;
use Exception;

class RewardController extends Controller
{
    public function store(Request $request){
        try{
        $reward = new Reward;
        $reward -> c_id = $request->c_id;
        $reward -> t_id = $request->t_id;
        $conversion_ratio ="";
        $reward_conversion_ratio_id = 0;
        $points = 0.0;
        //get the card type from request and use it to get the conversion ratio
        $conversion_ratio = RewardConversionRatio::where(['card_type'=>$request->card_type])->first();
        $reward_conversion_ratio_id = $conversion_ratio->id;
        /**
        * calculate the reward points using the formula amount spent divide by set ecpenditure times min points
        */
        $points = ($request->amount /$conversion_ratio->expenditure)*$conversion_ratio->min_points;
        $reward-> points = $conversion_ratio->id;
        $reward -> $reward_conversion_ratio_id = $reward_conversion_ratio_id;
        $reward -> points = $points;
        $reward -> status_id = 1;
        $reward->save();
        return response()->json([
            'success'=>true,
            'message'=>"Points saved successfully",
            'rewards'=> $reward,
        ]);
        }
        catch (Exception $e){
            return response()->json([
                'success'=>false,
                'message'=>$e->getMessage(),
            ]);
        }

    }
}
