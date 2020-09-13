@extends('layouts.app')
@section("title", "Dashboard")
@section('content')

    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-6 col-8 align-self-center">
                <h3 class="text-themecolor m-b-0 m-t-0">Dashboard</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-block">
                        <h4 class="card-title">{{ __('dashboard.today_sales') }}</h4>
                        <div class="row">
                            <div class="mr-auto ml-3 text-left">
                                <h2 class="font-light m-b-0">{{ $invoices }}</h2>
                                <span class="text-muted">{{ __('dashboard.invoices') }}</span>
                            </div>
                            <div class="ml-auto mr-3 text-right">
                                <h2 class="font-light m-b-0">{{ $total }}
                                    <span class="font-10">
                                        {{ __('dashboard.currency') }}
                                    </span>
                                </h2>
                                <span class="text-muted">{{ __('dashboard.today_income') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-block">
                        <h4 class="card-title">{{ __('dashboard.today_sale_credit') }}</h4>
                        <div class="row">
                            <div class="ml-auto mr-3 text-right">
                                <div class="text-right">
                                    <h2 class="font-light m-b-0">{{ $credit }} <span class="font-10">{{ __('dashboard.currency') }}</span></h2>
                                    <span class="text-muted">{{ __('dashboard.today_sale_credit') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-block">
                        <h4 class="card-title">{{ __('dashboard.today_profit') }}</h4>
                        <div class="text-right">
                            <h2 class="font-light m-b-0">{{ $profit }} <span class="font-10"> {{ __('dashboard.currency') }}</span> </h2>
                            <span class="text-muted">{{ __('dashboard.today_profit') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-block">
                        <h4 class="card-title">{{ __('dashboard.today_purchases') }}</h4>
                        <div class="row">
                            <div class="mr-auto ml-3 text-left">
                                <h2 class="font-light m-b-0">{{ $purchase }}</h2>
                                <span class="text-muted">{{ __('dashboard.invoices') }}</span>
                            </div>
                            <div class="ml-auto mr-3 text-right">
                                <h2 class="font-light m-b-0">{{ $p_total }} <span class="font-10"> {{ __('dashboard.currency') }}</span></h2>
                                <span class="text-muted">{{ __('dashboard.today_outcome') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-block">
                        <h4 class="card-title">{{ __("dashboard.today_purchase_credit") }}</h4>
                        <div class="text-right">
                            <h2 class="font-light m-b-0">{{ $p_credit }} <span class="font-10"> {{ __('dashboard.currency') }}</span></h2>
                            <span class="text-muted">{{ __("dashboard.today_purchase_credit") }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-block">
                        <h4 class="card-title">{{ __("dashboard.today_expense") }} </h4>
                        <div class="text-right">
                            <h2 class="font-light m-b-0">{{ $expense }} <span class="font-10"> {{ __('dashboard.currency') }}</span></h2>
                            <span class="text-muted">{{ __("dashboard.today_expense") }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-block">
                        <h4 class="card-title">{{ __('dashboard.today_sale_credit_invoice') }}</h4>
                        <div class="row">
                            <div class="ml-auto mr-3 text-right">
                                <h2 class="font-light m-b-0">{{ $today_sale_credit_invoice }}</h2>
                                <a href="{{ url('getTodayDueCredits') }}" style="color:white;"><span class="text-muted">{{ __('dashboard.invoices') }}</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
