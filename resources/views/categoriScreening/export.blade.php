<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Data</title>
</head>

<body>
    <center>
        <h3>{{ $dataQuestions[0]->category_name }}</h3>
    </center>
    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Datetime</th>
                <th>Nama Respondent</th>
                @foreach ($dataQuestions as $question)
                    <th>{{ $question->question }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($answeredQuetions as $key => $answeredQuetion)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ date('Y-m-d H:i:s', strtotime($answeredQuetion->created_at)) }}</td>
                    <td>{{ $answeredQuetion->name }}</td>
                    @foreach ($detailAnswers[$key] as $answer)
                        <td>{{ $answer->answer }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
