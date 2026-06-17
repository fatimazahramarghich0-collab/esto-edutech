<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le cours</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f3f4f6;
        }
        .container {
            max-width: 500px;
            width: 100%;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            font-weight: 600;
            margin-bottom: 6px;
        }
        input[type="text"], input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            outline: none;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            text-align: center;
            text-decoration: none;
        }
        .btn:hover {
            background-color: #45a049;
        }
        .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 999;
        }

    </style>
</head>
<body>  <button onclick="goBack()" class="btn btn-secondary back-button">Retour</button>

<!-- Votre formulaire ici -->
 <div style="margin-top: 50px;">
    
    <div class="container">
        <h2 class="text-2xl font-semibold mb-6">Modifier le cours</h2>
        @if(session('success'))
            <div class="bg-green-200 text-green-800 py-2 px-4 rounded mb-4">{{ session('success') }}</div>
        @endif
        <form action="{{ route('documents.update', $course->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nom du cours:</label>
                <input type="text" id="name" name="name" value="{{ $course->name }}" required>
            </div>
            <div class="form-group">
                <label for="file">Fichier du cours:</label>
                <input type="file" id="file" name="file">
            </div>
            <button type="submit" class="btn">Modifier le cours</button>
        </form>
    </div>
 </div>
 <script>
    function goBack() {
        window.history.back();
    }
</script>
</body>
</html>
