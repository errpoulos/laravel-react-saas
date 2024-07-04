<?php

namespace App\Http\Controllers;

use App\Http\Resources\FeatureResource;
use App\Models\Feature;
use App\Models\UsedFeature;
use Illuminate\Http\Request;

class Feature1Controller extends Controller
{
    public ?Feature $feature = null;

//    render the form
    public function index()
    {

        return intertia('Feature1/Index', [
            'feature' => new FeatureResource($this->feature),
            'answer' => session('answer'),
        ]);

    }

//    handle feature logic, redirect user to feature index with output
    public function calculate(Request $request)
    {
        $user = $request->user();
        if ($user->available_credits < $this->feature->required_credits) {
            return back();
        }

        $data = $request->validate([
            'number1' => ['required', 'numeric'],
            'number2' => ['required', 'numeric'],
        ]);

        $number1 = (float)$data['number1'];
        $number2 = (float)$data['number2'];

        $user->decreaseCredits($this->feature->required_credits);

        UsedFeature::create([
            'feature_id' => $this->feature->id,
            'user_id' => $this->user->id,
            'credits' => $this->feature->required_credits,
            'data' => $data,
        ]);

        return to_route('feature1.index')->with('answer', $number1 + $number2);
    }

    public function __construct()
    {
        $this->feature = Feature::where('route_name', 'feature1.index')
            ->where('active', true)
            ->firstOrFail();
    }
}
