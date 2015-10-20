@extends('app')

@section('content')
    <div class="container">
        <h3>Cupom</h3>
        <br>

        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td>Cupom:</td>
                    <td>R$ {{$cupom->code}}</td>
                </tr>
                <tr>
                    <td>Valor:</td>
                    <td>R$ {{$cupom->value}}</td>
                </tr>
            </tbody>
        </table>

    </div>
@endsection