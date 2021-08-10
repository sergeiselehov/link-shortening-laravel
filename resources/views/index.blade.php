@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Создайте сокращенную ссылку!</h1>

        <div class="card">
            <div class="card-header">
                <form id="form_link">
                    <div class="input-group mb-3">
                        <input type="text" name="link" class="form-control" placeholder="Например: https://google.com">
                        <div class="input-group-append">
                            <button class="btn btn-success" type="submit">Сократить ссылку</button>
                        </div>
                    </div>
                    <span style="display: none;" id="error-link" class='alert alert-danger'></span>
                    <span style="display: none;" id="success-link" class='alert alert-success'></span>
                </form>
            </div>
        </div>
    </div>
@endsection
