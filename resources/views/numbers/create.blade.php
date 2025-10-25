@extends('layouts.app')

@section('title', 'Додати число')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="bi bi-plus-circle"></i> Додати нове число</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('numbers.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="value" class="form-label">Значення числа</label>
                        <input type="number" step="0.01" class="form-control @error('value') is-invalid @enderror"
                               id="value" name="value" value="{{ old('value') }}"
                               placeholder="Введіть число (наприклад: -5.25, 10.50)" required>
                        @error('value')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            Введіть додатне або від'ємне число з точністю до 2 знаків після коми
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle"></i> Зберегти
                        </button>
                        <a href="{{ route('numbers.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Повернутися до списку
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
