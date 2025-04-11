<!DOCTYPE html>
<html>
<head>
    <title>Resumo Financeiro - Ano Letivo {{ $ano_letivo_id }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        .totals { font-weight: bold; margin-top: 20px; }
    </style>
</head>
<body>
    <h1>Resumo Financeiro - Ano Letivo {{ $ano_letivo_id }}</h1>
    <table>
        <thead>
            <tr>
                <th>Estudante</th>
                <th>Turma</th>
                <th>Valor Matrícula</th>
                <th>Propinas Pagas</th>
                <th>Propinas Pendentes</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($matriculas as $matricula)
                <tr>
                    <td>{{ $matricula->estudante->name }}</td>
                    <td>{{ $matricula->turma->nome }}</td>
                    <td>{{ $matricula->valor_matricula }}</td>
                    <td>{{ $matricula->propinas->where('pago', true)->sum('valor') }}</td>
                    <td>{{ $matricula->propinas->where('pago', false)->sum('valor') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="totals">
        <p>Total Matrículas: {{ $totalMatriculas }}</p>
        <p>Total Propinas Pagas: {{ $totalPropinasPagas }}</p>
        <p>Total Propinas Pendentes: {{ $totalPropinasPendentes }}</p>
    </div>
</body>
</html>