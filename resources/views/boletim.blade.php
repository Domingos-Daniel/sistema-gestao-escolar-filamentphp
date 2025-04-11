<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Boletim Escolar</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 20px;
            background-color: #f8f9fa;
            color: #333;
        }

        h1 {
            color: #0056b3;
            text-align: center;
            margin-bottom: 30px;
        }

        .student-info {
            text-align: center;
            margin-bottom: 20px;
        }

        .student-info h2 {
            color: #007bff;
            margin-bottom: 5px;
        }

        .student-info p {
            color: #777;
        }

        .discipline-section {
            margin-bottom: 20px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            border-radius: 8px;
            overflow: hidden;
        }

        .discipline-title {
            background-color: #007bff;
            color: white;
            padding: 12px 15px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: none;
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            background-color: #f0f0f0;
            color: #333;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        td {
            color: #555;
        }

        .grade-details {
            margin-top: 30px;
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            border-radius: 8px;
        }

        .grade-details h2 {
            color: #0056b3;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="student-info">
        <h2>Boletim Escolar</h2>
        <p><strong>Estudante:</strong> {{ $estudante->name }}</p>
        <p><strong>Classe:</strong> {{ $estudante->turma->classe->nome ?? 'N/A' }}</p>
        <p><strong>Turma:</strong> {{ $estudante->turma->nome ?? 'N/A' }}</p>
        <p><strong>Curso:</strong> {{ $estudante->turma->curso->nome ?? 'N/A' }}</p>
        <p><strong>Turno:</strong> {{ $estudante->turma->turno->nome ?? 'N/A' }}</p>
        <p><strong>Sala:</strong> {{ $estudante->turma->sala->nome ?? 'N/A' }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Disciplina</th>
                <th>Ano Letivo</th>
                <th>Avaliação</th>
                <th>Nota</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($disciplinas as $disciplina => $notas)
                @foreach ($notas as $nota)
                    <tr>
                        <td>{{ $disciplina }}</td>
                        <td>{{ $nota->anoLetivo->ano }}</td>
                        <td>{{ $nota->avaliacao->nome ?? 'N/A' }}</td>
                        <td>{{ $nota->nota }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>

    <div class="grade-details">
        <h2>Detalhes Adicionais</h2>
        <p>Este boletim apresenta o desempenho do aluno ao longo do ano letivo.</p>
        <p>Em caso de dúvidas, entre em contato com a coordenação.</p>
    </div>
</body>
</html>