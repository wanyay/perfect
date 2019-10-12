@extends('layouts.app')

@section('styles')
@endsection

@section('content')
    @include('errors.validation')
    <div class="ui equal width left aligned padded grid stackable">
        <div class="row">
            <div class="five wide column">
                Hello
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script type="text/javascript" src="{{url('js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
    <script type="text/javascript" src="{{url('js/angular.min.js')}}"></script>
    <script type="text/javascript" src="{{url('js/angular-barcode-scanner.js')}}"></script>
    <script type="text/javascript" src="{{url('js/angular-sale.js')}}"></script>
    <script type="text/javascript" src="{{url('js/sale.js')}}"></script>
    <script type="text/javascript">
        $(window).ready(function () {
            $('.scroll_content').slimscroll({
                height: '375px'
            });
        });

        function showModal() {
            $('.ui.modal').modal('show');
        }

    </script>
@endsection
