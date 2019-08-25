<div class="ui visible left vertical sidebar menu no-border sidemenu">

    <a href="dashboard-v1.html" class="ui medium image borderless">
        <img src="{{url('img/bg/3.png')}}" />
    </a>
    <div class="ui accordion">

        <a class="item" href="{{ url('/')}}">
            Dashboard <i class="dashboard icon"></i>
        </a>

        @if(auth()->user()->hasRole('admin'))
        <a class="item" href="{{url('units')}}">
            Units
        </a>
        <a class="item" href="{{url('producttype')}}">
            Product Type
        </a>
        <a class="item" href="{{url('customers')}}">
            Customers
        </a>
        <a class="item" href="{{url('suppliers')}}">
            Suppliers
        </a>
        <a class="item" href="{{url('items')}}">
            Items
        </a>
        <a class="item" href="{{url('sales')}}">
            Sale Orders
        </a>
        <a class="item" href="{{url('purchases')}}">
            Parchase Orders
        </a>
        <a class="item" href="{{url('expenses')}}">
            Expense
        </a>
        <a class="item" href="{{url('category')}}">
            Expense Category
        </a>
        <div class="title">
            <i class="dropdown icon"></i>
            Reports
        </div>
        <div class="content">
          <a class="item" href="{{url('daily')}}">
             Daily
           </a>
           <a class="item" href="{{url('monthly')}}">
             Monthly
           </a>
           <a class="item" href="{{url('')}}">
             Yearly
           </a>
        </div>
        @else 

        <a class="item" href="{{url('sales')}}">
            Sale Orders
        </a>

        @endif
    </div>
</div>
