@extends('layouts.app')
@section('styles')
<style type="text/css">
  .ui.inverted.statistic .value{
    font-size: 2rem;
    text-transform:none;
  }
</style>
@endsection
@section('content')
<div class="ui equal width left aligned padded grid stackable">
    <div class="row">
        <div class="eight wide tablet four wide computer column">
            <div class="ui horizontal segments">
                <div class="ui inverted teal segment center aligned">

                    <div class="ui inverted  statistic">
                        <div class="value" style="font-size: 23px;">
                            {{$invoices}}
                        </div>
                        <div class="label">
                            Invoices
                        </div>
                    </div>
                </div>
                <div class="ui inverted teal tertiary segment center aligned">
                   <div class="ui inverted  statistic">
                        <div class="value" style="font-size: 23px;">
                            Today
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="eight wide tablet four wide computer column">
            <div class="ui horizontal segments">
                <div class="ui inverted red segment center aligned">

                    <div class="ui inverted statistic">
                        <div class="value" style="font-size: 23px;">
                            {{$total}} Ks
                        </div>
                        <div class="label">
                            Income
                        </div>
                    </div>
                </div>
                <div class="ui inverted red tertiary segment center aligned">
                  <div class="ui inverted  statistic">
                       <div class="value" style="font-size: 23px;">
                           Today
                       </div>
                   </div>
                </div>
            </div>
        </div>
        <div class="eight wide tablet four wide computer column">
            <div class="ui horizontal segments">
                <div class="ui inverted blue segment center aligned">

                    <div class="ui inverted statistic">
                        <div class="value" style="font-size: 23px;">
                            {{$credit}} Ks
                        </div>
                        <div class="label">
                            Credit
                        </div>
                    </div>
                </div>
                <div class="ui inverted blue tertiary segment center aligned">
                  <div class="ui inverted  statistic">
                       <div class="value" style="font-size: 23px;">
                           Today
                       </div>
                   </div>
                </div>
            </div>
        </div>
        <div class="eight wide tablet four wide computer column">
            <div class="ui horizontal segments">
                <div class="ui inverted green segment center aligned">

                    <div class="ui inverted statistic">
                        <div class="value" style="font-size: 23px;">
                            {{$profit}} Ks
                        </div>
                        <div class="label">
                            Profit
                        </div>
                    </div>
                </div>
                <div class="ui inverted green tertiary segment center aligned">
                    <div class="ui inverted  statistic">
                        <div class="value" style="font-size: 23px;">
                            Today
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="eight wide tablet four wide computer column">
            <div class="ui horizontal segments">
                <div class="ui inverted teal segment center aligned">

                    <div class="ui inverted  statistic">
                        <div class="value" style="font-size: 23px;">
                            {{$purchase}}
                        </div>
                        <div class="label">
                            P-Invoices
                        </div>
                    </div>
                </div>
                <div class="ui inverted teal tertiary segment center aligned">
                   <div class="ui inverted  statistic">
                        <div class="value">
                            Today
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="eight wide tablet four wide computer column">
            <div class="ui horizontal segments">
                <div class="ui inverted red segment center aligned">

                    <div class="ui inverted statistic">
                        <div class="value" style="font-size: 23px;">
                            {{$p_total}} Ks
                        </div>
                        <div class="label">
                            Outcome
                        </div>
                    </div>
                </div>
                <div class="ui inverted red tertiary segment center aligned">
                  <div class="ui inverted  statistic">
                       <div class="value">
                           Today
                       </div>
                   </div>
                </div>
            </div>
        </div>
        <div class="eight wide tablet four wide computer column">
            <div class="ui horizontal segments">
                <div class="ui inverted blue segment center aligned">

                    <div class="ui inverted statistic">
                        <div class="value" style="font-size: 23px;">
                            {{$p_credit}} Ks
                        </div>
                        <div class="label">
                            P-Credit
                        </div>
                    </div>
                </div>
                <div class="ui inverted blue tertiary segment center aligned">
                  <div class="ui inverted  statistic">
                       <div class="value">
                           Today
                       </div>
                   </div>
                </div>
            </div>
        </div>
        <div class="eight wide tablet four wide computer column">
            <div class="ui horizontal segments">
                <div class="ui inverted blue segment center aligned">

                    <div class="ui inverted statistic">
                        <div class="value" style="font-size: 23px;">
                            {{$expense}} Ks
                        </div>
                        <div class="label">
                            Expense
                        </div>
                    </div>
                </div>
                <div class="ui inverted blue tertiary segment center aligned">
                  <div class="ui inverted  statistic">
                       <div class="value">
                           Today
                       </div>
                   </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="eight wide tablet four wide computer column">
            <div class="ui horizontal segments">
                <div class="ui inverted teal segment center aligned">
                    <div class="ui inverted  statistic">
                        <div class="value" style="font-size: 23px;">
                            {{$totalDueDateCredits}}
                        </div>
                        <div class="label">
                            Credit Due Date
                        </div>
                    </div>
                </div>
                <div class="ui inverted teal tertiary segment center aligned">
                   <div class="ui inverted  statistic">
                        <div class="value">
                            <a style="color:white;" href="{{ url('getTodayDueCredits') }}">Today</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection
