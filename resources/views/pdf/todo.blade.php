<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>
<body>

<h2>My Tasks</h2>

<table>
    <tr>
        <th>Name</th>
        <th>Description</th>
        <th>Created time</th>
    </tr>
    @foreach($todos as $todo)
        <tr>
            <td>{{$todo->title}}</td>
            <td>{{$todo->description}}</td>
            <td>{{$todo->created_at}}</td>
        </tr>
    @endforeach
</table>
</body>
</html>

