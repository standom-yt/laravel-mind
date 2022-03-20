<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Meal;

class RecordController extends Controller
{
    /**
     * home画面の表示
     * 
     * @param int $y, $m
     * return view
     */
    public function showAll(Request $request){
        // 日付が指定されていた場合
        if($request->y){
            // 指定された年月を取得する
            $y = $request->y;
            $m = $request->m;
        } else {
            // 現在の年月を取得する
            $ym_now = date("Ym");
            $y = substr($ym_now, 0, 4);
            $m = substr($ym_now, 4, 2);
        }
        
        $d = 1;
        // 1日の曜日を取得
        $wd1 = date("w", mktime(0, 0, 0, $m, 1, $y));
        // 月末の曜日を取得
        $wdx = date("w", mktime(0, 0, 0, $m + 1, 0, $y));

        // ログインユーザーの記録を全て取得
        function getUserLogs(){
            $userLogs = Meal::where('user_id', Auth::user()->id)->get();
            $mind_data = array();
            
            foreach($userLogs as $out){
            $day_out = $out['date'];
            $score_out = $out['score'];
            $mind_data[$day_out] = $score_out;  
            }
            ksort($mind_data);
            return $mind_data;
        } 

        $mind_array = getUserLogs();
        
        return view('record.home', compact('y', 'm', 'd', 'wd1', 'wdx', 'mind_array'));
    }

    /**
     * 記録作成画面の表示
     * 
     * @param int $ymd
     * return view
     */
    public function showLogForm($ymd){
        
        $y = substr($ymd, 0, 4);
        $m = substr($ymd, 4, 2);
        $d = substr($ymd, 6, 2);

        if (checkdate($m, $d, $y)) {
            $disp_date = "$y-$m-$d";
        } else {
            // 指定された日付が存在しない場合は処理を停止
            \Session::flash('msg', '該当するデータがありません');
            return redirect(route('home'));
        }
        // 指定された日付の記録が既に存在すれば処理を停止
        // ログインユーザーのその日付の投稿が存在するか確認
        $meal_log = Meal::where('date', $ymd)->where('user_id', Auth::user()->id)->first();
        if ($meal_log){
            \Session::flash('msg', 'その日付の記録は既に存在しています');
            return redirect(route('home'));
        }
        
        return view('record.logForm', compact('ymd', 'disp_date'));
    }

    /**
     * 記録登録
     * 
     * @param object $request
     * return view
     */
    function exeStore(Request $request){

        $meal_data = new Meal;
        unset($request['_token']);

        // 配列が空の場合は置換処理をしない
        if (!empty($request->good_food)) {
            // 受け取った配列を文字列に置換
            $good_food = implode(',', $request->good_food);
        }else {
            $good_food = '';
        }
        if (!empty($request->bad_food)) {
            // 受け取った配列を文字列に置換
            $bad_food = implode(',', $request->bad_food);
        } else {
            $bad_food = '';
        }

        \DB::beginTransaction();
        try {
            $meal_data->user_id = $request->user_id;
            $meal_data->date = $request->date;
            $meal_data->good_food = $good_food;
            $meal_data->bad_food = $bad_food;
            $meal_data->memo = $request->memo;
            $meal_data->score = $request->post_score;
            $meal_data->save();
            \DB::commit();
        } catch(\Throwable $e){
            \DB::rollback();
            abort(500);
        }
        
        \Session::flash('msg', '記録を保存しました');
        return redirect(route('home'));
    }

    /**
     * 記録内容の表示
     * 
     * @param int $ymd
     * return view
     */
    public function showDetail($ymd){
        // その日付の投稿を取得
        $meal_log = Meal::where('date', $ymd)->where('user_id', Auth::user()->id)->first();
        // 指定された日付の記録が存在しなければ処理を停止
        if (!$meal_log) {
            \Session::flash('msg', '該当する記録がありません');
            return redirect(route('home'));
        } else {
            $good_food_array = explode(',', $meal_log['good_food']);
            $bad_food_array = explode(',', $meal_log['bad_food']);
        }
        
        $y = substr($ymd, 0, 4);
        $m = substr($ymd, 4, 2);
        $d = substr($ymd, 6, 2);
        $disp_date = "$y-$m-$d";

        return view('record.detail', compact('ymd', 'meal_log', 'good_food_array', 'bad_food_array', 'disp_date'));
    }

    /**
     * 記録編集画面を表示する
     * 
     * return view
     */

    function showEdit($id){
        $mind_log = Meal::where('id', $id)->where('user_id', Auth::user()->id)->first();
        // 指定された記録が存在しなければ処理を停止
        if (!$mind_log) {
            \Session::flash('msg', '該当する記録がありません');
            return redirect(route('home'));
        }
        $good_food_array = explode(',', $mind_log['good_food']);
        $bad_food_array = explode(',', $mind_log['bad_food']);
        return view('record.edit', compact('mind_log', 'good_food_array', 'bad_food_array'));
    }

    /**
     * 記録更新処理
     * 
     * @param object $request
     * return view
     */
    function exeUpdate(Request $request){

        $meal_data = Meal::where('id', $request->id)->where('user_id', Auth::user()->id)->first();
        // 指定されたidが存在しない場合
        if (!$meal_data) {
            \Session::flash('msg', '該当する記録がありません');
            return redirect(route('home'));
        }
        $form = $request->all();
        unset($form['_token']);

        // 配列が空の場合は置換処理をしない
        if (!empty($request->good_food)) {
            // 受け取った配列を文字列に置換
            $good_food = implode(',', $request->good_food);
        }else {
            $good_food = '';
        }
        if (!empty($request->bad_food)) {
            // 受け取った配列を文字列に置換
            $bad_food = implode(',', $request->bad_food);
        } else {
            $bad_food = '';
        }

        \DB::beginTransaction();
        try {
            $meal_data->good_food = $good_food;
            $meal_data->bad_food = $bad_food;
            $meal_data->memo = $request->memo;
            $meal_data->score = $request->post_score;
            $meal_data->save();
            \DB::commit();
        } catch(\Throwable $e){
            \DB::rollback();
            abort(500);
        }
      
        \Session::flash('msg', '記録内容を更新しました');
        return redirect(route('home'));
    }

    /**
     * 記録を削除する
     * 
     * @param int $id
     * return view
     */
    function exeDelete($id){
        // 指定されたidが存在しない場合
        $meal_data = Meal::where('id', $id)->where('user_id', Auth::user()->id)->first();
        if (!$meal_data) {
            \Session::flash('msg', '該当する記録がありません');
            return redirect(route('home'));
        }
        try {
            $meal_data->delete();
        } catch(\Throwable $e){
            abort(500);
        }
        
        \Session::flash('msg', '記録を削除しました');
        return redirect(route('home'));
    }   
}
