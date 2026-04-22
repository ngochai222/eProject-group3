<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white font-sans">

<div class="min-h-screen p-6">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold mb-6">Employee Details</h1>

        <div class="bg-gray-900 rounded-2xl p-6">
            <div class="mb-4">
                <h2 class="text-xl font-bold">{{ $employee->name }}</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm mb-6">
                <div>
                    <span class="text-gray-400">Name:</span>
                    <span>{{ $employee->name }}</span>
                </div>
                <div>
                    <span class="text-gray-400">Email:</span>
                    <span>{{ $employee->email }}</span>
                </div>
                <div>
                    <span class="text-gray-400">Phone:</span>
                    <span>{{ $employee->phone ?? 'N/A' }}</span>
                </div>
                <div>
                    <span class="text-gray-400">Position:</span>
                    <span class="capitalize">{{ $employee->position }}</span>
                </div>
                <div>
                    <span class="text-gray-400">Salary:</span>
                    <span>${{ number_format($employee->salary, 2) }}</span>
                </div>
                <div>
                    <span class="text-gray-400">Room:</span>
                    <span>{{ $employee->room->name ?? 'N/A' }}</span>
                </div>
            </div>

            <div class="flex gap-4">
                <a href="{{ route('admin.employees.index') }}" class="bg-gray-700 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg transition">
                    Back to Employees
                </a>
                <a href="{{ route('admin.employees.edit', $employee->id) }}" class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-lg transition">
                    Edit
                </a>
            </div>
        </div>
    </div>
</div>

</body>
</html>