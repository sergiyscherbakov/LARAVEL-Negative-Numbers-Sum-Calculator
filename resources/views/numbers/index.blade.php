@extends('layouts.app')

@section('title', 'Калькулятор суми від\'ємних чисел')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0"><i class="bi bi-plus-circle"></i> Додати число вручну</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('numbers.store') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <input type="number" step="0.01" class="form-control @error('value') is-invalid @enderror"
                               name="value" placeholder="Введіть число" required>
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle"></i> Додати
                        </button>
                    </div>
                    @error('value')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-shuffle"></i> Генерація випадкових чисел</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('numbers.generate') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <input type="number" class="form-control" name="count" value="10" min="1" max="100" required>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-shuffle"></i> Згенерувати
                        </button>
                    </div>
                    <small class="text-muted">Кількість чисел для генерації (від -100 до 100)</small>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header bg-dark text-white">
                <h4 class="mb-0"><i class="bi bi-list-ol"></i> Список чисел</h4>
            </div>
            <div class="card-body">
                <div class="alert alert-info mb-4">
                    <h5><i class="bi bi-calculator-fill"></i> Сума від'ємних елементів: <strong>{{ number_format($negativeSum, 2) }}</strong></h5>
                </div>

                @if($numbers->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th width="10%">#</th>
                                    <th width="30%">Значення</th>
                                    <th width="30%">Дата створення</th>
                                    <th width="30%" class="text-center">Дії</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($numbers as $number)
                                    <tr>
                                        <td>{{ $number->id }}</td>
                                        <td>
                                            <span class="badge {{ $number->value < 0 ? 'bg-danger' : 'bg-success' }} fs-6">
                                                {{ number_format($number->value, 2) }}
                                            </span>
                                        </td>
                                        <td>{{ $number->created_at->format('d.m.Y H:i:s') }}</td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-warning" onclick="editNumber({{ $number->id }}, {{ $number->value }})">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <form action="{{ route('numbers.destroy', $number) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Ви впевнені?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-warning text-center">
                        <i class="bi bi-exclamation-triangle"></i> Немає доданих чисел. Додайте число вручну або згенеруйте випадкові.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal для редагування -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title"><i class="bi bi-pencil"></i> Редагувати число</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Значення числа</label>
                        <input type="number" step="0.01" class="form-control" id="editValue" name="value" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Скасувати</button>
                    <button type="submit" class="btn btn-warning">Оновити</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function editNumber(id, value) {
    document.getElementById('editValue').value = value;
    document.getElementById('editForm').action = '/numbers/' + id;
    new bootstrap.Modal(document.getElementById('editModal')).show();
}
</script>
@endsection
