@extends('layouts.app')

@section('title', 'Перегляд числа')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-info text-white">
                <h4 class="mb-0"><i class="bi bi-eye"></i> Деталі числа #{{ $number->id }}</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th width="40%">ID:</th>
                        <td>{{ $number->id }}</td>
                    </tr>
                    <tr>
                        <th>Значення:</th>
                        <td>
                            <span class="badge {{ $number->value < 0 ? 'bg-danger' : 'bg-success' }} fs-5">
                                {{ number_format($number->value, 2) }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Тип числа:</th>
                        <td>
                            @if($number->value < 0)
                                <span class="badge bg-danger">Від'ємне</span>
                            @elseif($number->value > 0)
                                <span class="badge bg-success">Додатне</span>
                            @else
                                <span class="badge bg-secondary">Нуль</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Дата створення:</th>
                        <td>{{ $number->created_at->format('d.m.Y H:i:s') }}</td>
                    </tr>
                    <tr>
                        <th>Дата оновлення:</th>
                        <td>{{ $number->updated_at->format('d.m.Y H:i:s') }}</td>
                    </tr>
                </table>

                <div class="d-grid gap-2">
                    <a href="{{ route('numbers.edit', $number) }}" class="btn btn-warning">
                        <i class="bi bi-pencil"></i> Редагувати
                    </a>
                    <a href="{{ route('numbers.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Повернутися до списку
                    </a>
                    <form action="{{ route('numbers.destroy', $number) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100" onclick="return confirm('Ви впевнені, що хочете видалити це число?')">
                            <i class="bi bi-trash"></i> Видалити
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
