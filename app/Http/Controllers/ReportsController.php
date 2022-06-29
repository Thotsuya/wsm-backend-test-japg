<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index(Request $request)
    {

        ray($request->all());
        $reports = Account::query()
            ->with('metrics:accountId,spend,impressions,clicks,costPerClick')
            ->when($request->has('accountId'),fn($query) => $query->account($request->accountId))
            ->get()
            ->map(function ($account) {
                return [
                    'accountId'     => $account->accountId,
                    'accountName'   => $account->accountName,
                    'spend'         => $account->metrics->sum('spend'),
                    'impressions'   => $account->metrics->sum('impressions'),
                    'clicks'        => $account->metrics->sum('clicks'),
                    'costPerClick'  => $account->metrics->sum('clicks') > 0
                                                ? $account->metrics->sum('spend') / $account->metrics->sum('clicks')
                                                : 0,
                ];
            })
            ->sortByDesc('spend');

        return view('welcome', compact('reports'));
    }
}
